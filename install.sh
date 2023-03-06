#!/bin/bash
mkdir -p /usr/local/cpanel/base/frontend/paper_lantern/loginlog
mkdir -p /usr/local/cpanel/base/frontend/paper_lantern/loginlog/src
mkdir -p /usr/local/cpanel/base/frontend/paper_lantern/loginlog/assets
mkdir -p /usr/local/cpanel/base/frontend/paper_lantern/loginlog/assets/css


mv loginlog.tar.gz /usr/local/cpanel/base/frontend/paper_lantern/loginlog
mv lastlogin.live.php /usr/local/cpanel/base/frontend/paper_lantern/loginlog
mv src/Account.php /usr/local/cpanel/base/frontend/paper_lantern/loginlog/src
mv src/hostname.php /usr/local/cpanel/base/frontend/paper_lantern/loginlog/src
mv assets/css/main.css /usr/local/cpanel/base/frontend/paper_lantern/loginlog/assets/css

/usr/local/cpanel/scripts/install_plugin /usr/local/cpanel/base/frontend/paper_lantern/loginlog/loginlog.tar.gz --theme paper_lantern




mkdir -p /usr/local/cpanel/base/frontend/jupiter/loginlog
mkdir -p /usr/local/cpanel/base/frontend/jupiter/loginlog/src
mkdir -p /usr/local/cpanel/base/frontend/jupiter/loginlog/assets
mkdir -p /usr/local/cpanel/base/frontend/jupiter/loginlog/assets/css


mv loginlog.tar.gz /usr/local/cpanel/base/frontend/jupiter/loginlog
mv lastlogin.live.php /usr/local/cpanel/base/frontend/jupiter/loginlog
mv src/Account.php /usr/local/cpanel/base/frontend/jupiter/loginlog/src
mv src/hostname.php /usr/local/cpanel/base/frontend/jupiter/loginlog/src
mv assets/css/main.css /usr/local/cpanel/base/frontend/jupiter/loginlog/assets/css

/usr/local/cpanel/scripts/install_plugin /usr/local/cpanel/base/frontend/jupiter/loginlog/loginlog.tar.gz --theme jupiter
