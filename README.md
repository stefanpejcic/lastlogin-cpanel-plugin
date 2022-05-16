# Last Login cPanel plugin
Outputs .lastlogin file as a table

<img src="https://raw.githubusercontent.com/stefanpejcic/lastlogin-cpanel-plugin/main/assets/img/screenshot.png"></img>

## TO DO
- display ip info (ptr) 
- 

## Installation

#### PaperLatern theme

<pre>
wget https://github.com/stefanpejcic/lastlogin-cpanel-plugin/archive/refs/heads/main.zip
unzip main.zip
/bin/cp lastlogin-cpanel-plugin-main -R /usr/local/cpanel/base/frontend/paper_lantern/lastlogin
/usr/local/cpanel/scripts/install_plugin /usr/local/cpanel/base/frontend/jupiter/lastlogin/info.json
</pre>

</hr>

#### Jupiter theme

<pre>
wget https://github.com/stefanpejcic/lastlogin-cpanel-plugin/archive/refs/heads/main.zip
unzip main.zip
/bin/cp lastlogin-cpanel-plugin-main  -R /usr/local/cpanel/base/frontend/jupiter/lastlogin/
/usr/local/cpanel/scripts/install_plugin /usr/local/cpanel/base/frontend/jupiter/lastlogin/info.json
</pre>


