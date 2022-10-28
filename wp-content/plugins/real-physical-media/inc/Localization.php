<?php

namespace DevOwl\RealPhysicalMedia;

use DevOwl\RealPhysicalMedia\Vendor\MatthiasWeb\Utils\Localization as UtilsLocalization;
use DevOwl\RealPhysicalMedia\base\UtilsProvider;
// @codeCoverageIgnoreStart
\defined('ABSPATH') or die('No script kiddies please!');
// Avoid direct file request
// @codeCoverageIgnoreEnd
/**
 * i18n management for backend and frontend.
 */
class Localization {
    use UtilsProvider;
    use UtilsLocalization;
    /**
     * Get the directory where the languages folder exists.
     *
     * @param string $type
     * @return string[]
     */
    protected function getPackageInfo($type) {
        if ($type === \DevOwl\RealPhysicalMedia\Vendor\MatthiasWeb\Utils\Localization::$PACKAGE_INFO_BACKEND) {
            return [path_join(RPM_PATH, 'languages'), RPM_TD];
        } else {
            return [path_join(RPM_PATH, \DevOwl\RealPhysicalMedia\Assets::$PUBLIC_JSON_I18N), RPM_TD];
        }
    }
}
