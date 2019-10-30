<?php
/**
 * MT Writer functions and definitions
 *
 * @link https://mightythemes.com
 *
 * @package Mighty Themes
 */

?>

<div itemtype="https://schema.org/WPSideBar" itemscope="itemscope" id="sidebar" class="widget-area sidebar">
    <div class="sidebar-main">
    <?php
        if ( is_active_sidebar( 'sidebar-right' ) ) {
            dynamic_sidebar( 'sidebar-right' );
        }
    ?>
    </div>
</div>