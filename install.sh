#!/usr/bin/env bash
# =============================================================================
# install.sh — cPanel Login Log Plugin Installer
#
# Installs the plugin for both the paper_lantern and jupiter cPanel themes.
#
# Usage: sudo ./install.sh
#
# Changes from v1.0.3:
#   - Fixed: mv → cp for jupiter theme (mv was destructively removing source
#     files after the paper_lantern install, leaving install_plugin with no
#     loginlog.tar to read for the jupiter step).
#   - Added: set -euo pipefail for safer scripting.
#   - Added: existence checks before copying files.
#   - Added: informational output for each step.
#   - Added: loginlog.svg (48×48 Jupiter-native SVG icon) copied to both themes.
# =============================================================================

set -euo pipefail

CPANEL_FRONTEND="/usr/local/cpanel/base/frontend"
INSTALL_BIN="/usr/local/cpanel/bin/install_plugin"
PLUGIN_TAR="loginlog.tar"

# Ensure we're running as root
if [[ "${EUID}" -ne 0 ]]; then
    echo "Error: This script must be run as root (sudo)." >&2
    exit 1
fi

# Ensure required files exist in the current directory
for required in "${PLUGIN_TAR}" "lastlogin.live.php" "src/Account.php" \
                "src/hostname.php" "assets/css/main.css" "loginlog.svg"; do
    if [[ ! -f "${required}" ]]; then
        echo "Error: Required file not found: ${required}" >&2
        exit 1
    fi
done

# ── paper_lantern theme ────────────────────────────────────────────────────
echo "Installing for theme: paper_lantern …"
PL_DIR="${CPANEL_FRONTEND}/paper_lantern/loginlog"

mkdir -p "${PL_DIR}/src"
mkdir -p "${PL_DIR}/assets/css"

cp "${PLUGIN_TAR}"             "${PL_DIR}/"
cp "lastlogin.live.php"        "${PL_DIR}/"
cp "src/Account.php"           "${PL_DIR}/src/"
cp "src/hostname.php"          "${PL_DIR}/src/"
cp "assets/css/main.css"       "${PL_DIR}/assets/css/"
cp "loginlog.svg"              "${PL_DIR}/"

"${INSTALL_BIN}" "${PL_DIR}/${PLUGIN_TAR}" --theme paper_lantern
echo "  → paper_lantern install complete."

# ── jupiter theme ──────────────────────────────────────────────────────────
echo "Installing for theme: jupiter …"
JUP_DIR="${CPANEL_FRONTEND}/jupiter/loginlog"

mkdir -p "${JUP_DIR}/src"
mkdir -p "${JUP_DIR}/assets/css"

# FIX: use cp (not mv) so source files remain intact after paper_lantern install.
# The original script used mv here, which (a) destroyed the local source copies
# and (b) caused install_plugin to fail because loginlog.tar had already been
# moved away from the working directory.
cp "${PLUGIN_TAR}"             "${JUP_DIR}/"
cp "lastlogin.live.php"        "${JUP_DIR}/"
cp "src/Account.php"           "${JUP_DIR}/src/"
cp "src/hostname.php"          "${JUP_DIR}/src/"
cp "assets/css/main.css"       "${JUP_DIR}/assets/css/"
cp "loginlog.svg"              "${JUP_DIR}/"

"${INSTALL_BIN}" "${JUP_DIR}/${PLUGIN_TAR}" --theme jupiter
echo "  → jupiter install complete."

echo ""
echo "Plugin installed successfully for both themes."
