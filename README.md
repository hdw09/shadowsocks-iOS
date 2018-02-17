
Shadowsocks for iOS 
===========================
[![Build Status](https://travis-ci.org/shadowsocks/shadowsocks-iOS.svg?branch=master)](https://travis-ci.org/shadowsocks/shadowsocks-iOS)


iOS
-----
[![iOS Icon](https://raw.github.com/shadowsocks/shadowsocks-iOS/master/ios_128.png)](https://github.com/shadowsocks/shadowsocks-iOS/wiki/Help)  
[iOS Version](https://github.com/shadowsocks/shadowsocks-iOS/wiki/Help)

* 原先的下载地址（https://github.com/shadowsocks/shadowsocks-iOS）被作者移除没有更新，下载编译后由于端口等问题无法使用。
* [binss](https://github.com/binss) 同学在它等分支上修改了端口问题，并用pod加载libsodium使得程序更容易编译。但由于扫码使用的是第三方库，这个库不知道什么原因在我上面一直编译不通过。
* 所以我利用系统的video库重新写了扫码加载的功能，并使其能在xcode10上编译，并且指出iOS7。哈哈哈

---

* 注意
  * 不保证工程中mac客户端点正常，如果有问题可以尝试原作者或binss同学的历史提交。
  * 一般developer账号真机测试的证书有效期只有6天，过期后会闪退，用付费账号可以使用。估计这个程序可通过不了appstore，应为大家都懂的原因。所以这个大概只供娱乐吧，嘻嘻
  * 推荐一个科学上网网址：http://ssshadow.xyz/ 会不定期发邀请码油！希望可以帮助大家搞科研！



License
-------
The project is released under the terms of [GPLv3](https://raw.github.com/shadowsocks/shadowsocks-iOS/master/LICENSE).

