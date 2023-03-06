#!/bin/bash
mkdir -p /usr/local/cpanel/base/frontend/paper_lantern/loginlog
mkdir -p /usr/local/cpanel/base/frontend/paper_lantern/loginlog/src
mkdir -p /usr/local/cpanel/base/frontend/paper_lantern/loginlog/assets
mkdir -p /usr/local/cpanel/base/frontend/paper_lantern/loginlog/assets/css



mv loginlog.live.php /usr/local/cpanel/base/frontend/paper_lantern/loginlog
mv src/Account.php /usr/local/cpanel/base/frontend/paper_lantern/loginlog/src
mv src/hostname.php /usr/local/cpanel/base/frontend/paper_lantern/loginlog/src
mv assets/css/main.css /usr/local/cpanel/base/frontend/paper_lantern/loginlog/assets/css

/usr/local/cpanel/scripts/install_plugin /usr/local/cpanel/base/frontend/paper_lantern/loginlog/loginlog.tar.gz --theme paper_lantern
