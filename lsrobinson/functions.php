<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// BEGIN ENQUEUE PARENT ACTION
// AUTO GENERATED - Do not modify or remove comment markers above or below:

if ( !function_exists( 'chld_thm_cfg_parent_css' ) ):
    function chld_thm_cfg_parent_css() {
        wp_enqueue_style('wpestate_bootstrap',get_template_directory_uri().'/css/bootstrap.css', array(), '1.0', 'all');
        wp_enqueue_style('wpestate_bootstrap-theme',get_template_directory_uri().'/css/bootstrap-theme.css', array(), '1.0', 'all');
        wp_enqueue_style( 'chld_thm_cfg_parent', trailingslashit( get_template_directory_uri() ) . 'style.css' );
        wp_enqueue_style('wpestate_media',get_template_directory_uri().'/css/my_media.css', array(), '1.0', 'all');
    }
endif;
add_action( 'wp_enqueue_scripts', 'chld_thm_cfg_parent_css' );

// END ENQUEUE PARENT ACTION
require_once(get_stylesheet_directory().'/custom/branding.php');

  /* add custom widgets  */
  add_action( 'widgets_init', 'reach_widgets_init' );
  function reach_widgets_init() {
      if ( function_exists('register_sidebar') ) {
        // widget under media header.
         register_sidebar(array(
          'name' => 'Under Header widget',
          'id' => 'headerbottom',
          'description' => 'Widget under the header',
          'before_widget' => '<div id="reach-under-header"><div id="%1$s" class="widget %2$s">',
          'after_widget'  => '</div></div>',
          'before_title'  => '<h3 class="widget-title">',
          'after_title'   => '</h3><div class="tx-div small"></div>',
        ));

        register_sidebar(
                array(
                 'name' => __( 'Bottom Call to Action ', 'reach' ),
                 'id'   => 'reach-bottom-cta',
                 'description'   => __( 'Widget area (above footer)', 'reach' ),
                 'before_widget' => '<div id="%1$s" class="widget %2$s">',
                 'after_widget'  => '</div>',
                 'before_title'  => '<h6>',
                 'after_title'   => '</h6>',
              )
          );
      } //function_exists('register_sidebar')
    } // function reach_widgets_init
