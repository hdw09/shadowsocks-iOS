<?php
include_once 'lib/config.php';
include_once 'header.php';
?>


<div class="section no-pad-bot" id="index-banner">
        <div class="container">
            <br><br>
            <h1 class="header center orange-text"><?php echo $site_name; ?></h1>
            <div class="row center">
                <h5 class="header col s12 light">轻松科学上网   保护个人隐私</h5>
            </div>
            <div class="row center">
                <a href="user/register.php" id="download-button" class="btn-large waves-effect waves-light orange">立即注册</a>
            </div>
            <br><br>
        </div>
</div>


<div class="container">
    <div class="section">

        <!--   Icon Section   -->
        <div class="row">
            <div class="col s12 m4">
                <div class="icon-block">
                    <h2 class="center light-blue-text"><i class="material-icons">flash_on</i></h2>
                    <h5 class="center">网站作用</h5>

                    <p class="light" style='font-family: "Microsoft Yahei","Helvetica Neue",Helvetica,Arial,sans-serif;font-size: 16px;'>
                    我们的网站是众多shadowshocks网站中的一个，我们的主要目的是为小伙伴们提供一个
                        更安全的上网方式，从而可以快速安全的访问google学术、IEEE等学术网站。更好的了解科技前沿，为您的研究工作带来巨大方便！
                       关于如何使用shadowshocks，请访问页面如何使用shadowshocks科学上网<a href='./how.php' target="_blank">教程(一)</a>、
					   <a href='http://www.ishadowsocks.com/' target="_blank">教程(二)</a>
                    </p>
                </div>
            </div>

            <div class="col s12 m4">
                <div class="icon-block">
                    <h2 class="center light-blue-text"><i class="material-icons">group</i></h2>
                    <h5 class="center">开源免费</h5>

                    <p class="light" style='font-family: "Microsoft Yahei","Helvetica Neue",Helvetica,Arial,sans-serif;font-size: 16px;'>
                        我们使用一种开源的软件共享我们的vpn资源，希望能为大家在科学研究文献查阅上带来一定的帮助。
                        网站会不定期发放验证码，欢迎关注我们网站的验证码页。
                        由于我们的vpn资源有限，我们会定期的维护管理网站中的用户，如果您长时间没有登录网站，我们可能会注销您的用户。
                        另外每位新用户注册我们用免费发放5G每月的流量，你可以生成自己的验证码与您的好友共享您的流量，每日签到还能随机获得100-200MB流量。.
                    </p>
                </div>
            </div>

            <div class="col s12 m4">
                <div class="icon-block">
                    <h2 class="center light-blue-text"><i class="material-icons">settings</i></h2>
                    <h5 class="center">捐赠我们</h5>

                    <p class="light"  style='font-family: "Microsoft Yahei","Helvetica Neue",Helvetica,Arial,sans-serif;font-size: 16px;'>
                        如果您喜欢我们的网站，可以捐助我们，得到的捐款我们会用在vpn服务器的续费维护上。您可以扫描下面二维码用支付宝转账给我们。5-10元我们认为是十分理智和善的捐赠金额。
                       转账时可以备注 <font color='red'>“ssshadow-我爱科研+注册Email”</font>，我们会按捐赠金额增加您每月的流量作为感谢。您的支持是我们继续维护的动力。
					   对一周未签到用户每周进行清理工作，捐赠用户除外！
                    </p>
                    <p style="text-align: center;">
                    <img src='./images/xbchzh.png' />
                    </p>
                </div>
            </div>
        </div>

    </div>
    <br><br>

    <div class="section">

    </div>
</div>
<?php  include_once 'ana.php';
       include_once 'footer.php';?>
