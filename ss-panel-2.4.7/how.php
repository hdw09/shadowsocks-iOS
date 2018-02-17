<?php
include_once 'lib/config.php';
include_once 'header.php';
?>


<div class="section no-pad-bot" id="index-banner">
        <div class="container">
            <br><br>
            <h1 class="header center orange-text">如何使用？</h1>
            <div class="row center">
                <h5 class="header col s12 light">怎么才能访问google学术呢？下面简单介绍一下，希望可以帮助到您。</h5>
            </div>
            <div class="row center">
                <p>
				<h5 class="header col s12 light orange-text">step1:注册自己的账户，登陆，获取连接配置二维码</h5>
				<image src='./images/step1_1.png'>
				<image src='./images/step1_2.png'>
				<image src='./images/step1_3.png'>
				</p>
				
				<p>
				<h5 class="header col s12 light orange-text">step2:下载shadowsocks，利用shadowsocks的扫描屏幕二维码的功能配置本机代理。注意记下本机代理端口是多少，下一个步骤要用到。</h5>
				<image src='./images/step2_1.png'>
				<image src='./images/step2_2.png'>
				<image src='./images/step2_3.png'>
				<image src='./images/step2_4.png'>
				</p>
				
				<p>
				<h5 class="header col s12 light orange-text">step3:给浏览器配置http代理，不同的浏览器有不同的配置方法，可以在网上搜索自己浏览器的配置代理的方法。下面以chrome浏览器为例简单展示一下，要自己先给chrome安装一个Proxy SwitchySharp管理代理的插件</h5>
				<image src='./images/step3_1.png'>
				<image src='./images/step3_2.png'>
				<image src='./images/step3_3.png'>
				</p>
            </div>
            <br><br>
        </div>
</div>

<?php  include_once 'ana.php';
       include_once 'footer.php';?>
