//
// Created by clowwindy on 14-2-17.
// Copyright (c) 2014 clowwindy. All rights reserved.
//

#import "QRCodeViewController.h"
#import <Masonry.h>
#import <UIView+Toast.h>
#import <AVFoundation/AVFoundation.h>


@interface QRCodeViewController()<AVCaptureMetadataOutputObjectsDelegate>

@property (nonatomic, strong) QRCodeViewControllerReturnBlock returnBlock;
@property (nonatomic,strong) UILabel *textLabel;
@property (strong,nonatomic) AVCaptureDevice *device;
@property (strong,nonatomic) AVCaptureDeviceInput *input;
@property (strong,nonatomic) AVCaptureMetadataOutput *output;
@property (strong,nonatomic) AVCaptureSession *session;
@property (strong,nonatomic) AVCaptureVideoPreviewLayer *preview;

@property (nonatomic,strong) ScanImageView * scanImageView;

@property (nonatomic,strong) UIImageView *blockImage;

@property (nonatomic,strong) UIButton *flashbtn;

@end

@implementation QRCodeViewController

- (id)initWithReturnBlock:(QRCodeViewControllerReturnBlock)block {
    self = [super init];
    if (self) {
        _returnBlock = block;
        
    }
    return self;
}

- (void)viewDidLoad {
    [self setupAVCapture];
   
}

-(void)viewWillAppear:(BOOL)animated
{
     [self setupUI];
}

-(void)viewDidAppear:(BOOL)animated
{
}

-(void)viewWillDisappear:(BOOL)animated
{
    [self stopScan];
}


- (void)setupAVCapture
{
    
    NSString *mediaType = AVMediaTypeVideo;
    
    //在模拟器上
    if (TARGET_IPHONE_SIMULATOR) {
        [self.view makeToast:@"模拟器状态下无法进行扫码验证"];
        return;
    }
    
    //判断用户是否授权
    AVAuthorizationStatus authStatus = [AVCaptureDevice authorizationStatusForMediaType:mediaType];
    if(authStatus == AVAuthorizationStatusRestricted || authStatus == AVAuthorizationStatusDenied){
        
        CGFloat version = [[[UIDevice currentDevice] systemVersion] doubleValue];
        NSString *cameraMessage;
        
        cameraMessage = @"摄像头未授权";
        if ((version > 7.09) && (version < 8.0)) {
            cameraMessage = @"摄像头未授权，请去：\n设置->隐私->相机->开店宝 \n打开权限即可正常扫码";
        }else if (version > 8.0){
            cameraMessage = @"摄像头未授权，请去：\n设置->隐私->相机->开店宝 \n打开权限即可正常扫码";
        }else if (version < 7.09){
            cameraMessage = @"系统版本过低。请升级到7.1以上啊亲";
        }
        [self.view makeToast:cameraMessage];
        return;
    }
    
    [self setupCamera];
}

- (void)setupCamera
{
    // Device
    _device = [AVCaptureDevice defaultDeviceWithMediaType:AVMediaTypeVideo];
    
    // Input
    _input = [AVCaptureDeviceInput deviceInputWithDevice:self.device error:nil];
    
    // Output
    _output = [[AVCaptureMetadataOutput alloc]init];
    [_output setMetadataObjectsDelegate:nil queue:nil];//这是要闹哪样
    [_output setMetadataObjectsDelegate:self queue:dispatch_get_main_queue()];
    [_output setRectOfInterest:CGRectMake(0.25, 0, 0.5, 1)];
    
    // Session
    _session = [[AVCaptureSession alloc]init];
    [_session setSessionPreset:AVCaptureSessionPresetHigh];
    if ([_session canAddInput:self.input])
    {
        [_session addInput:self.input];
    }
    
    if ([_session canAddOutput:self.output])
    {
        [_session addOutput:self.output];
    }
    
    // 二维码
    _output.metadataObjectTypes = @[AVMetadataObjectTypeQRCode];
    
    // Preview
    _preview =[AVCaptureVideoPreviewLayer layerWithSession:self.session];
    _preview.videoGravity = AVLayerVideoGravityResizeAspectFill;
    _preview.frame = self.view.bounds;
    [self.view.layer insertSublayer:self.preview atIndex:0];
    
    
}

- (void)setupUI
{
    [self.view addSubview:self.scanImageView];
    
    [self.scanImageView mas_remakeConstraints:^(MASConstraintMaker *make) {
        make.centerX.equalTo(self.view.mas_centerX);
        make.centerY.equalTo(self.view.mas_centerY);
        make.width.height.mas_equalTo(200);
    }];
}

-(ScanImageView *)scanImageView
{
    if(!_scanImageView)
    {
        _scanImageView = [[ScanImageView alloc]init];
        _scanImageView.backgroundColor = [UIColor clearColor];
    }
    return _scanImageView;
}

-(UIImageView *)blockImage
{
    if(!_blockImage)
    {
        _blockImage = [[UIImageView alloc]init];
        UIGraphicsBeginImageContext(self.view.frame.size);
        CGContextRef ctx = UIGraphicsGetCurrentContext();
        CGContextSetRGBFillColor(ctx, 0,0,0,0.5);
        CGRect drawRect =CGRectMake(0, 0, self.view.frame.size.width,self.view.frame.size.height);
        
        CGContextFillRect(ctx, drawRect);   //draw the transparent layer
        
        drawRect = CGRectMake((self.view.frame.size.width/2)-100, (self.view.frame.size.height/2)-100, 200,200);
        CGContextClearRect(ctx, drawRect);  //clear the center rect  of the layer
        
        
        _blockImage.image = UIGraphicsGetImageFromCurrentImageContext();
        UIGraphicsEndImageContext();
    }
    return _blockImage;
}

- (void)startScan
{
    [_preview removeFromSuperlayer];
    _preview = nil;
    
    _preview =[AVCaptureVideoPreviewLayer layerWithSession:self.session];
    _preview.videoGravity = AVLayerVideoGravityResizeAspectFill;
    _preview.frame = self.view.bounds;
    [self.view.layer insertSublayer:self.preview atIndex:0];
    
    if (self.blockImage) {
        [self.view addSubview:self.blockImage];
        [self.blockImage mas_remakeConstraints:^(MASConstraintMaker *make) {
            make.top.bottom.left.right.equalTo(self.view);
        }];
    }
    
    if(self.flashbtn){
        [self.view addSubview:self.flashbtn];
        [self.flashbtn mas_remakeConstraints:^(MASConstraintMaker *make) {
            make.top.equalTo(self.view).offset(20);
            make.right.equalTo(self.view).offset(-20);
            make.height.width.mas_equalTo(40);
        }];
    }
    
    if (self.textLabel) {
        [self.view addSubview:self.textLabel ];
        [self.textLabel mas_remakeConstraints:^(MASConstraintMaker *make) {
            make.top.equalTo(self.view).offset(50);
            make.left.equalTo(self.view).offset(20);
            make.right.equalTo(self.view).offset(-20);
            make.height.equalTo(@100);
        }];
    }
    
    [_session startRunning];
}

- (void)stopScan
{
    [_session stopRunning];
}


-(void)turnOffLed
{
    AVCaptureDevice *device = [AVCaptureDevice defaultDeviceWithMediaType:AVMediaTypeVideo];
    if ([device hasTorch]) {
        [device lockForConfiguration:nil];
        [device setTorchMode: AVCaptureTorchModeOff];
        [device unlockForConfiguration];
    }
}

-(void)turnOnLed
{
    AVCaptureDevice *device = [AVCaptureDevice defaultDeviceWithMediaType:AVMediaTypeVideo];
    if ([device hasTorch]) {
        [device lockForConfiguration:nil];
        [device setTorchMode: AVCaptureTorchModeOn];
        [device unlockForConfiguration];
    }
}

-(UIButton *)flashbtn
{
    if (!_flashbtn) {
        _flashbtn = [[UIButton alloc]init];
        NSString *bundlePath = [[NSBundle mainBundle] pathForResource:@"QRcodeBundles" ofType:@"bundle"];
        NSBundle *bundle = [NSBundle bundleWithPath:bundlePath];
        
        [_flashbtn setImage:[UIImage imageNamed:@"flash_off_filled@2x.png" inBundle:bundle compatibleWithTraitCollection:nil] forState:UIControlStateNormal];
        [_flashbtn setImage:[UIImage imageNamed:@"flash_on@2x.png" inBundle:bundle compatibleWithTraitCollection:nil] forState:UIControlStateSelected];
        [_flashbtn addTarget:self action:@selector(flashbtnClick:) forControlEvents:UIControlEventTouchDown];
    }
    return _flashbtn;
}

- (void)flashbtnClick:(UIButton*)sender
{
    if (self.flashbtn.selected) {
        [self.flashbtn setSelected:NO];
        [self turnOffLed];
    } else {
        [self.flashbtn setSelected:YES];
        [self turnOnLed];
    }}

-(UILabel *)textLabel
{
    if (!_textLabel) {
        _textLabel = [[UILabel alloc]init];
        _textLabel.text = @"开始啦，嘻嘻嘻";
        _textLabel.textColor = [UIColor whiteColor];
        _textLabel.backgroundColor = [UIColor clearColor];
        _textLabel.textAlignment = NSTextAlignmentCenter;
        _textLabel.numberOfLines = 0;
    }
    return _textLabel;
}

#pragma mark -- AVCaptureMetadataOutputObjectsDelegate

-(void)captureOutput:(AVCaptureOutput *)captureOutput didOutputMetadataObjects:(NSArray *)metadataObjects fromConnection:(AVCaptureConnection *)connection
{
    @synchronized (self) {
        if ([metadataObjects count] >0)
        {
            AVMetadataMachineReadableCodeObject * metadataObject = [metadataObjects objectAtIndex:0];
            _returnBlock(metadataObject.stringValue);
            [self stopScan];
            [self dismissModalViewControllerAnimated:YES];
            
        }
    }
}


@end





@interface ScanImageView ()

@property(nonatomic, strong) NSTimer *timer;
@property(nonatomic, strong) UIImageView *scanLineView;

@end

@implementation ScanImageView

-(id) initWithFrame:(CGRect)frame
{
    self = [super initWithFrame:frame];
    if(self) {
        
        NSString *bundlePath = [[NSBundle mainBundle] pathForResource:@"QRcodeBundles" ofType:@"bundle"];
        NSBundle *bundle = [NSBundle bundleWithPath:bundlePath];
        self.image = [[UIImage imageNamed:@"scan_border.png" inBundle:bundle compatibleWithTraitCollection:nil]stretchableImageWithLeftCapWidth:20.0f topCapHeight:20.0f];
        [self addSubview:self.scanLineView];
        [self timer];
        
    }
    return self;
}

-(NSTimer *) timer{
    if(_timer){
        return _timer;
    }
    _timer=[NSTimer scheduledTimerWithTimeInterval: 0.01
                                            target: self
                                          selector: @selector(handleTimer:)
                                          userInfo: nil
                                           repeats: YES];
    return _timer;
}

-(UIImageView *) scanLineView
{
    if(_scanLineView) {
        return _scanLineView;
    }
    _scanLineView = [[UIImageView alloc] initWithFrame:CGRectMake(0.0f, 0.0f, 200, 7.0f)];
    NSString *bundlePath = [[NSBundle mainBundle] pathForResource:@"QRcodeBundles" ofType:@"bundle"];
    NSBundle *bundle = [NSBundle bundleWithPath:bundlePath];
    _scanLineView.image = [UIImage imageNamed:@"scanLine" inBundle:bundle compatibleWithTraitCollection:nil];
    return _scanLineView;
}

-(void) handleTimer:(id)sender
{
    if([[self superview] superview]) {
        CGRect newFrame1 = _scanLineView.frame;
        if (newFrame1.origin.y > self.frame.size.width-10.0f) {
            newFrame1.origin.y = 0;
            [_scanLineView setFrame:newFrame1];
        }else {
            newFrame1.origin.y =  newFrame1.origin.y+1.0;
            [_scanLineView setFrame:newFrame1];
        }
    }
}


@end