# Last Login cPanel plugin
Outputs .lastlogin file as a table

<img src="https://raw.githubusercontent.com/stefanpejcic/LastLogin-cpanel-plugin/main/assets/img/screenshoot.png"></img>

## TO DO

- add hrefs to first column to AbuseIPDB
<pre>
(function () {
    var table = document.getElementById('table');
    var baseUrl = 'https://www.abuseipdb.com/check/'
    for (var i = 0; i < table.rows.length; i++) {
        var firstCol = table.rows[i].cells[0]; //first column
        var curElement = firstCol;
    var parent = curElement.parentElement;
    var newAElement = document.createElement('a');
    var path = baseUrl+curElement.innerHTML;
    newAElement.setAttribute('href', path);
    newAElement.appendChild(curElement);
    parent.appendChild(newAElement)
    console.log(parent)
    }
})();
</pre>
</hr>

- display ip info (ptr) 
- 
</hr>

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


