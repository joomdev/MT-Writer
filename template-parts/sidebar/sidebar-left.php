<?php
/**
 * MT Writer functions and definitions
 *
 * @link https://mightythemes.com
 *
 * @package Mighty Themes
 * @subpackage MT_Writer
 * @since 1.0.0
 */

?>

<div id="sidebar" class="widget-area sidebar">
    <div itemtype="https://schema.org/WPSideBar" itemscope="itemscope" class="sidebar-main">
    <?php
        if ( is_active_sidebar( 'sidebar-left' ) ) {
            dynamic_sidebar( 'sidebar-left' );
        }
    ?>
    </div>
</div>