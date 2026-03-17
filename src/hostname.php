<?php
declare(strict_types=1);

/**
 * Returns the server hostname, HTML-escaped for safe output.
 *
 * Strategy (most-reliable first):
 *   1. PHP's native gethostname() — no cPanel dependency
 *   2. LiveAPI fallback           — for older cPanel installations
 *
 * @param  object|null $cpanel  LiveAPI CPANEL object (optional, fallback only)
 * @return string               HTML-safe hostname string
 */
function hostname(?object $cpanel = null): string
{
    // 1. Native PHP — works independently of cPanel LiveAPI
    $host = gethostname();
    if ($host !== false && $host !== '') {
        return htmlspecialchars($host, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    }

    // 2. LiveAPI fallback
    if ($cpanel !== null) {
        $host = $cpanel->cpanelprint('$hostname');
        if (is_string($host) && $host !== '') {
            return htmlspecialchars($host, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        }
    }

    return '';
}
