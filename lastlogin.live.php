<?php
declare(strict_types=1);

/**
 * lastlogin.live.php — cPanel Login Log Plugin
 *
 * Displays the last successful logins from ~/.lastlogin with
 * AbuseIPDB check links for each IP address.
 *
 * Compatibility : cPanel 96+, PHP 8.0+
 * Security      : XSS-safe (all output HTML-escaped server-side),
 *                 path-traversal protection on account name,
 *                 IP validation before URL construction.
 */

require '/usr/local/cpanel/php/cpanel.php';
require 'src/Account.php';
require 'src/hostname.php';

// ── cPanel init ────────────────────────────────────────────────────────────
$cpanel = new CPANEL();
print $cpanel->header('Login Log');

// ── Account name ───────────────────────────────────────────────────────────
$accountName = Account::name($cpanel);

// Strict validation: cPanel usernames are 1–16 lowercase alphanumeric chars
// (underscore allowed). Reject anything else to prevent path traversal.
if (!preg_match('/^[a-z0-9][a-z0-9_]{0,15}$/i', $accountName)) {
    echo '<div class="alert alert-danger">Error: Could not determine a valid account name. '
       . 'Please contact your hosting provider.</div>';
    echo $cpanel->footer();
    $cpanel->end();
    exit;
}

// ── Read .lastlogin ────────────────────────────────────────────────────────
$lastLoginPath = "/home/{$accountName}/.lastlogin";
$loginRows     = [];

if (is_readable($lastLoginPath)) {
    $handle = fopen($lastLoginPath, 'r');
    if ($handle !== false) {
        while (($line = fgets($handle)) !== false) {
            $line = trim($line);
            if ($line === '') {
                continue;
            }
            // Format: <IP> <DATE> <TIME> [<TIMEZONE>]
            $parts = preg_split('/\s+/', $line, 4);
            if (count($parts) >= 3) {
                $ip   = $parts[0];
                $date = $parts[1];
                $time = $parts[2];

                // Only accept valid IPv4 / IPv6 addresses
                if (filter_var($ip, FILTER_VALIDATE_IP) === false) {
                    continue;
                }

                $loginRows[] = [
                    'ip'       => $ip,
                    'date'     => $date,
                    'time'     => $time,
                    'checkUrl' => 'https://www.abuseipdb.com/check/' . urlencode($ip),
                ];
            }
        }
        fclose($handle);
    }
}

// ── Current visitor IP (escaped for safe display) ─────────────────────────
$clientIp = htmlspecialchars(
    $_SERVER['REMOTE_ADDR'] ?? 'Unknown',
    ENT_QUOTES | ENT_HTML5,
    'UTF-8'
);

$rowCount = count($loginRows);
?>
<link rel="stylesheet" type="text/css" href="assets/css/main.css" media="screen" />

<style>
/* ── Table styles ────────────────────────────────────────────────────────── */
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
.styled-table a {
    color: #009879;
    text-decoration: none;
}
.styled-table a:hover {
    text-decoration: underline;
}
.no-records {
    color: #666;
    font-style: italic;
}
</style>

<div class="container" style="width: auto">
    <div class="content">

        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="#" style="cursor:default; text-decoration:none;">
                            Your current IP address is: <strong><?= $clientIp ?></strong>
                        </a>
                    </li>
                    <li>
                        <a target="_blank"
                           rel="noopener noreferrer"
                           href="https://docs.cpanel.net/knowledge-base/security/how-to-reset-a-cpanel-account-password/">
                            How to Reset a cPanel Account Password
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <p>
            This is a list of the last
            <strong><?= $rowCount ?></strong>
            IP address<?= $rowCount !== 1 ? 'es' : '' ?> that
            <?= $rowCount !== 1 ? 'have' : 'has' ?> successfully logged into your cPanel account.
        </p>
        <p>
            Use AbuseIPDB to check if an IP has been reported by other users.
            If you notice any suspicious IPs, contact your hosting provider and
            change your cPanel password immediately.
        </p>

        <table class="styled-table">
            <thead>
                <tr>
                    <th>IP Address</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>AbuseIPDB</th>
                </tr>
            </thead>
            <tbody>
<?php if ($rowCount === 0): ?>
                <tr>
                    <td colspan="4" class="no-records">No login records found.</td>
                </tr>
<?php else: ?>
<?php   foreach ($loginRows as $row):
            // All values HTML-escaped at render time
            $safeIp       = htmlspecialchars($row['ip'],       ENT_QUOTES | ENT_HTML5, 'UTF-8');
            $safeDate     = htmlspecialchars($row['date'],     ENT_QUOTES | ENT_HTML5, 'UTF-8');
            $safeTime     = htmlspecialchars($row['time'],     ENT_QUOTES | ENT_HTML5, 'UTF-8');
            $safeCheckUrl = htmlspecialchars($row['checkUrl'], ENT_QUOTES | ENT_HTML5, 'UTF-8');
?>
                <tr>
                    <td><?= $safeIp ?></td>
                    <td><?= $safeDate ?></td>
                    <td><?= $safeTime ?></td>
                    <td>
                        <a href="<?= $safeCheckUrl ?>"
                           target="_blank"
                           rel="noopener noreferrer">Check</a>
                    </td>
                </tr>
<?php   endforeach; ?>
<?php endif; ?>
            </tbody>
        </table>

    </div><!-- .content -->
</div><!-- .container -->

<?php
echo $cpanel->footer();
$cpanel->end();
?>
