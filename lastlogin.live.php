<?php
require '/usr/local/cpanel/php/cpanel.php';
require 'src/Account.php';
require 'src/hostname.php';

$cpanel = new CPANEL();
print $cpanel->header( "Login Log" );
$accountName = Account::name($cpanel);
$hostname = hostname($cpanel);

$file = file("/home/$accountName/.lastlogin");
?> 

<link rel="stylesheet" type="text/css" href="assets/css/main.css" media="screen" />





<style>

.styled-table {
    border-collapse: collapse;
    margin: 25px 0;
    font-size: 1em;
    font-family: sans-serif;
    min-width: 400px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
}
.styled-table thead tr {
    background-color: #009879;
    color: #ffffff;
    text-align: left;
}
.styled-table th,
.styled-table td {
    padding: 12px 20px;
}
.styled-table tbody tr {
    border-bottom: 1px solid #dddddd;
}

.styled-table tbody tr:nth-of-type(even) {
    background-color: #f3f3f3;
}

.styled-table tbody tr:last-of-type {
    border-bottom: 2px solid #009879;
}


</style>


<div class="container" style="width: auto">
        <div v-model=""></div>
        <div class="content">
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <ul class="nav navbar-nav">
<li><a href="#" style="cursor:default;text-decoratio:none;">Your current IP address is: <b><?php echo $_SERVER['REMOTE_ADDR'];?></b></a></li>                        

                        <li><a  target="_blank" href="https://docs.cpanel.net/knowledge-base/security/how-to-reset-a-cpanel-account-password/"> How to Reset a cPanel Account Password</a></li>
                    </ul>
                </div>
            </nav>

<p>This is a list of the last <span id="rows">20</span> IP address that have successfully logged into your cPanel account.</p>
<p>Use the AbuseIPDB to check if it was already reported by other users. If you notice any strange IP's contact your hosting provider and change your cPanel password. </p>
<table id="table" class="styled-table">
<thead>
<tr>
    <th>IP Address</th>
    <th>Date</th>
<th>Time</th>
<th>AbuseIPDB</th>
  </tr>
</thead>

<?php

$file = fopen("/home/$accountName/.lastlogin", "r") or die("Unable to open file!");    

while (!feof($file)){   
    $data = fgets($file); 
    echo "<tr><td>" . str_replace(' ','</td><td>',$data) . '</td></tr>';
}
echo '</table>';
fclose($file);
?>

<script src="https://code.jquery.com/jquery-3.5.0.js"></script>

<script>
document.getElementById("rows").innerHTML = table.rows.length - 1;
</script>

<script>

// add AbuseIPDB links to the table
// side effect: sets the IP column in last place

(function () {
    var table = document.getElementById('table');
    var baseUrl = 'https://www.abuseipdb.com/check/'
    for (var i = 1; i < table.rows.length; i++) {
        var firstCol = table.rows[i].cells[0]; //first column
        var curElement = firstCol;
    var parent = curElement.parentElement;
    var newAElement = document.createElement('a');
    var path = baseUrl+curElement.innerHTML;
    newAElement.setAttribute('href', path);
    newAElement.setAttribute('target', '_blank');
    newAElement.appendChild(curElement);
    parent.appendChild(newAElement)
    console.log(parent)
    }
})();

// remove 3rd column that contains timezone
$("tr").each(function() {
    $(this).children("td:eq(3)").remove();
});

// switch 2nd and 3rd columns so that IP is back on the beginning

$.fn.switchColumns = function ( col1, col2 ) {
    var $this = this,
        $tr = $this.find('tr');

    $tr.each(function(i, ele){
        var $ele = $(ele),
            $td = $ele.find('td'),
            $tdt;
        
        $tdt = $td.eq( col1 ).clone();
        $td.eq( col1 ).html( $td.eq( col2 ).html() );
        $td.eq( col2 ).html( $tdt.html() );
    });
};
// again
$('#table').switchColumns( 0, 3 );


//replace # from the table with word 'check'
$('td').html(function(i, html){
  return html.replace(/#/g, 'check'); 
});

</script>
<?php
echo $cpanel->footer();
$cpanel->end();

