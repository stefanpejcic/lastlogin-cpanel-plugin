When we find malicious code on a user’s website, we scan his files with a plugin such as ImunifyAV and check .lastlogin file for any suspicious IP addresses that have been reported in the AbuseIP database.

This plugin streamlines the process by allowing both SysAdmins and cPanel users to quickly view file content and check IPs in the AbuseIPDB.

<!--img src="https://raw.githubusercontent.com/stefanpejcic/lastlogin-cpanel-plugin/main/assets/img/screenshot.png"></img-->

### Features

- generate table
- outputs client ip
- add links to abuseipdb

### Requirements

- cPanel **96 or later** (Jupiter theme recommended; paper_lantern also supported)
- PHP **8.0 or later**
- Root / WHM SSH access to the server

---

### How to install the plugin

You need WHM/root SSH access. Run the following commands:

```bash
cd /usr/local/src
wget https://github.com/windsofchange/lastlogin-cpanel-plugin/archive/refs/heads/main.zip
unzip main.zip
cd lastlogin-cpanel-plugin-main/
chmod +x install.sh
sudo ./install.sh
```

The script installs the plugin for both the **Jupiter** and **paper_lantern** cPanel themes automatically.

After installation the **Login Log** icon appears in the **Security** section of your cPanel dashboard.

---

### How to uninstall the plugin

To remove the plugin completely from both themes, run the following as root:

```bash
# Remove from Jupiter theme
/usr/local/cpanel/bin/uninstall_plugin \
  /usr/local/cpanel/base/frontend/jupiter/loginlog/loginlog.tar \
  --theme jupiter
rm -rf /usr/local/cpanel/base/frontend/jupiter/loginlog

# Remove from paper_lantern theme
/usr/local/cpanel/bin/uninstall_plugin \
  /usr/local/cpanel/base/frontend/paper_lantern/loginlog/loginlog.tar \
  --theme paper_lantern
rm -rf /usr/local/cpanel/base/frontend/paper_lantern/loginlog
```

Then rebuild the cPanel interface cache so the icon disappears immediately:

```bash
/usr/local/cpanel/bin/rebuild_sprites
```

---

### Changelog

#### v2.0.0
Released: March 17th, 2026

- **Security:** Fixed XSS via unescaped `.lastlogin` table output and `REMOTE_ADDR`
- **Security:** Added path-traversal protection on the account name
- **Security:** Replaced `die()` with graceful error handling
- **Security:** Removed jQuery 3.5.0 (CVE-2020-11022 / CVE-2020-11023); all rendering is now server-side PHP
- **PHP 8.x:** Added `declare(strict_types=1)` and typed parameters across all files
- **PHP 8.x:** Fixed double file-read bug and `while(!feof())` phantom-line issue
- **cPanel API:** `Account::name()` now uses `$_ENV['REMOTE_USER']` (cPanel 96+) with LiveAPI fallback
- **cPanel API:** `hostname()` now uses native `gethostname()` instead of LiveAPI
- **Icon:** Added `loginlog.svg` — 48×48 flat SVG icon for the Jupiter theme
- **install.sh:** Fixed critical bug where `mv` destroyed source files after paper_lantern install, causing the Jupiter theme registration to silently fail

#### v1.0.3
Released:  March 06th, 2022

Added installation script

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
