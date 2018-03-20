<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
//lib
require_once 'Lib/class.controller.php';
require_once 'Lib/class.models.php';
require_once 'Lib/class.Mobile_Detect.php';
require_once 'Lib/class.meta-post.php';
/**
 * Import Mod
 */
require_once 'Mod/Temp/class.template.php';
require_once 'Mod/Seo/class.seo-setup.php';
require_once 'Mod/Content/class.content.php';
require_once 'Mod/Single/class.single.php';
require_once 'Mod/class.shortcode.php';
require_once 'Mod/functions.php';
//Admin
if ( is_admin() ) {
    require_once 'Admin/class.metapost.php';
    require_once 'Admin/class.category.php';
    require_once 'Admin/class.script.php';
}
//custom taxomy
require_once 'Admin/class.taxonomy.php';