<?php
declare(strict_types=1);

/**
 * Account helper — retrieves the current cPanel username.
 *
 * Strategy (most-reliable first):
 *   1. $_ENV['REMOTE_USER']  – set by cPanel for every plugin request (cPanel 96+)
 *   2. $_SERVER['REMOTE_USER'] – alternative SAPI location
 *   3. LiveAPI fallback       – for older cPanel installations
 */
class Account
{
    /**
     * Returns the sanitised cPanel account username.
     *
     * @param  object|null $cpanel  LiveAPI CPANEL object (optional, used as fallback only)
     * @return string               Alphanumeric username, or empty string on failure
     */
    public static function name(?object $cpanel = null): string
    {
        // 1. Modern cPanel sets REMOTE_USER in the environment (cPanel 96+)
        foreach (['REMOTE_USER', 'HTTP_X_CPANEL_USER'] as $key) {
            if (!empty($_ENV[$key])) {
                return self::sanitise($_ENV[$key]);
            }
            if (!empty($_SERVER[$key])) {
                return self::sanitise($_SERVER[$key]);
            }
        }

        // 2. LiveAPI fallback (cPanel < 96 / legacy installations)
        if ($cpanel !== null) {
            $user = $cpanel->cpanelprint('$user');
            if (is_string($user) && $user !== '') {
                return self::sanitise($user);
            }
        }

        return '';
    }

    /**
     * Strip any character that is not valid in a cPanel/Linux username.
     * cPanel usernames: 1–16 lowercase alphanumeric characters.
     */
    private static function sanitise(string $value): string
    {
        return preg_replace('/[^a-z0-9_\-]/i', '', $value);
    }
}
