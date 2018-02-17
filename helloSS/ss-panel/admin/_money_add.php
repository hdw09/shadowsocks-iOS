<?php
require_once '../lib/config.php';
require_once '_check.php';

if(!empty($_POST)){
    $email = $_POST['email'];
    $money = $_POST['money'];
      
    //更新
    $User = new Ss\User\User();
    $array = $User->GetUserByRmail($email);
    $query = $User->updateUser($name,$email,$passwd,$transfer_enable,$invite_num);
    if($array){
    	$peoson = new Ss\User\User($array['uid']);
    	//增加流量
    	$array = $peoson->GetUserTransferEnable();
    	$old_transfer_enable= $array['transfer_enable'];
    	$float_money = floatval($money);
    	$peoson->updateUserTransferEnable($old_transfer_enable + $float_money*$togb);
    	//记录捐款
    	$ret = $peoson->updateMoney($money);
    	if($ret){
    		$ue['code'] = '1';
    		$ue['ok'] = '1';
    		$ue['msg'] = "修改成功！即将跳转到用户捐赠列表！";
    	}else{
    		$ue['code'] = '0';
    		$ue['msg'] = "无法修改！内部错误！";
    	}
                
    }else{
                $ue['code'] = '0';
                $ue['msg'] = "用户不存在";
    }
}
echo json_encode($ue);
