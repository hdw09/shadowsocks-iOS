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
                       关于如何使用shadowshocks，请访问页面<a href='./how.php'>如何使用shadowshocks科学上网</a>
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
                        另外每位新用户注册我们用免费发放5G每月的流量，你可以生成自己的验证码与您的好友共享您的流量。.
                    </p>
                </div>
            </div>

            <div class="col s12 m4">
                <div class="icon-block">
                    <h2 class="center light-blue-text"><i class="material-icons">settings</i></h2>
                    <h5 class="center">获取邀请码</h5>

                    <p class="light"  style='font-family: "Microsoft Yahei","Helvetica Neue",Helvetica,Arial,sans-serif;font-size: 16px;'>
                        由于主机流量问题，目前不再定期发放邀请码， 可以通过之前老用户找到管理员索要<font color='red'>“邀请码”</font>
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
