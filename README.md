When we find malicious code on a user’s website, we scan his files with a plugin such as ImunifyAV and check .lastlogin file for any suspicious IP addresses that have been reported in the AbuseIP database.

This plugin streamlines the process by allowing both SysAdmins and cPanel users to quickly view file content and check IPs in the AbuseIPDB.

<!--img src="https://raw.githubusercontent.com/stefanpejcic/lastlogin-cpanel-plugin/main/assets/img/screenshot.png"></img-->

### Features

- generate table
- outputs client ip
- add links to abuseipdb

<!--### How to install the plugin

To install this free cpanel plugin you need access to the WHM and terminal. Login to SSH and run the following commands to install the plugin:


- PaperLatern theme:

```html
wget https://github.com/stefanpejcic/lastlogin-cpanel-plugin/archive/refs/heads/main.zip
unzip main.zip
/bin/cp lastlogin-cpanel-plugin-main -R /usr/local/cpanel/base/frontend/paper_lantern/lastlogin
/usr/local/cpanel/scripts/install_plugin /usr/local/cpanel/base/frontend/jupiter/lastlogin/info.json
```

- Jupiter theme:

```html
wget https://github.com/stefanpejcic/lastlogin-cpanel-plugin/archive/refs/heads/main.zip
unzip main.zip
/bin/cp lastlogin-cpanel-plugin-main  -R /usr/local/cpanel/base/frontend/jupiter/lastlogin/
/usr/local/cpanel/scripts/install_plugin /usr/local/cpanel/base/frontend/jupiter/lastlogin/info.json
```-->


### Changelog

#### v1.0.1
Released: May 22th, 2022

Added links to abuseipdb
jquery updated


#### v1.0.0
Released: May 1th, 2022

Stable Release

### Support

Because this is a free plugin, support is restricted to maintaining the source code and ensuring that the plugin functions on latest cPanel version.

Please see the additional services area below if you require assistance outside of this scope, such as with plugin installation, branding, or integrating it with your custom template.

### Whats next

In the next couple of months we're going to continue to improve the docs, create tutorials and fix bugs.

### Contribute

You can support me by giving [a GitHub star ★](https://github.com/stefanpejcic/lastlogin-cpanel-plugin/stargazers) and spread the word :)
