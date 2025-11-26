<?php

/*
 * Plugin Name: Vertical Timeline Widget for Elementor
 * Description: Vertical Timeline Widget for Elementor Plugin add timeline element to Elementor Page builder.
 * Plugin URI: https://wordpress.org/plugins/3r-elementor-timeline-widget
 * Version:2.6
 * Requires at least: 5.2
 * Requires PHP:7.2
 * Author: Cool Plugins
 * License:GPL v2 or later
 * License URI:https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: 3r-elementor-timeline-widget
 * Requires Plugins: elementor
 */

if ( ! defined( 'ABSPATH' ) ) exit;

define( 'TWE_PLUGIN_URL', plugins_url( '/', __FILE__ ) );
define( 'TWE_PLUGIN_PATH', plugin_dir_path(__FILE__));


add_action( 'elementor/preview/enqueue_styles', 'twe_enqueue_style' );
add_action('wp_enqueue_scripts', 'twe_enqueue_style');

function twe_enqueue_style() {
    wp_enqueue_style( 'twe-preview', TWE_PLUGIN_URL  . 'assets/css/style.css', array());
}

class TweTimelinePlugin {
 
   private static $instance = null;
 
   public static function get_instance() {
      if ( ! self::$instance )
         self::$instance = new self;
      return self::$instance;
   }
 
   public function init(){
      add_action( 'elementor/widgets/widgets_registered', array( $this, 'widgets_registered' ) );
   }
 
   public function widgets_registered() {

      if ( ! current_user_can( 'edit_posts' ) ) {
         return;
      }

      if ( defined('ELEMENTOR_PATH') && class_exists('Elementor\Widget_Base') ) {
         $template_file = plugin_dir_path(__FILE__) . 'timeline-widget.php';
     
         if ( is_readable($template_file) ) {
             require_once $template_file;
         }
     }
   }
}
 
TweTimelinePlugin::get_instance()->init();