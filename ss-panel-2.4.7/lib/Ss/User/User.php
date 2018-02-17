<?php


namespace Ss\User;


 class User {

     public  $uid;
     private $db;

     private $table = "user";

     function __construct($uid=0){
         global $db;
         $this->uid = $uid;
         $this->db  = $db;
         
     }

     function AllUser(){
        $datas = $this->db->select($this->table,"*");
        return $datas;
     }
     
     function AllDonateUser(){
     	$datas = $this->db->select($this->table,"*",[
     			"donate_money[>]" => 0
     			]);
     	return $datas;
     }

     function updateUser($name,$email,$passwd,$transfer_enable,$invite_num){
         return $this->db->update($this->table,[
             "user_name" => $name,
             "email" => $email,
             "passwd" => $passwd,
             "transfer_enable" => $transfer_enable,
             "invite_num" => $invite_num
         ],[
             "uid" => $this->uid
         ]);
     }
     
     function updateUserTransferEnable($transfer_enable){
     	return $this->db->update($this->table,[
     			"transfer_enable" => $transfer_enable],[
     			"uid" => $this->uid
     			]);
     }
     
     function GetUserTransferEnable(){
     	$datas = $this->db->select($this->table,"*",[
     			"uid" => $this->uid
     			]);
     	return $datas['0'];
     }
     
     function GetUserByRmail($email){
     	$datas = $this->db->select($this->table,"*",[
     			"email" => $email
     			]);
     	return $datas['0'];
     }
     
     function updateMoney($money){
     	$float_money = floatval($money);
     	return $this->db->update($this->table,[
     			"donate_money" => $float_money],[
     			"uid" => $this->uid
     			]);
     }

     //del user
     function del(){
         $this->db->delete("user",[
             "uid" => $this->uid
         ]);
         return 1;
     }

     //获取 临时 temp $pass
     function get_temp_pass(){
         $a = rand(10000,99999);
         return $a;
     }

     //判断username是否可用
     //可用,用户名不存在返回1
     function is_username_used($username){
         if($this->db->has("user",[
             "user_name" => $username
         ])){
             //用户名不可用
             return 0;
         }else{
             //用户名可用
             return 1;
         }
     }

     //is email used
     function is_email_used($email){
         if($this->db->has("user",[
             "email" => $email
         ])){
             return 0;
         }else{
             return 1;
         }
     }

     //login check
     function login_check($username,$passwd){
         if($this->db->has("user",[
             "AND" => [
                 "OR" => [
                     "user_name" => $username,
                     "email" => $username
                 ],
                 "pass" => $passwd
             ]
         ])){
             return 1;
         }else{
             return 0;
         }
     }

     //根据用户名返回UID
     function get_user_uid($username){
         $datas = $this->db->select("user","*", [
             "OR" => [
                 "user_name" => $username,
                 "email" => $username
             ],
             "LIMIT" => 1
         ]);
         return $datas['0']['uid'];
     }

     function UpdatePWd($pwd){
         $this->db->update("user",[
            "pass" => \Ss\User\Comm::SsPW($pwd)
         ],[
             "uid" => $this->uid
         ]);
     }

 }
