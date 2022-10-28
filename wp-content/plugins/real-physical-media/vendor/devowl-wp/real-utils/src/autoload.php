<?php

namespace DevOwl\RealPhysicalMedia\Vendor\DevOwl\RealUtils;

// Simply check for defined constants, we do not need to `die` here
if (\defined('ABSPATH')) {
    \DevOwl\RealPhysicalMedia\Vendor\DevOwl\RealUtils\UtilsProvider::setupConstants();
    \DevOwl\RealPhysicalMedia\Vendor\DevOwl\RealUtils\Localization::instanceThis()->hooks();
}
