<?php

namespace ThumbnailHoverMenuForElementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class Plugin
{
    private static $_instance = null;

    public function __construct()
    {
        $this->add_actions();
    }

    public static function instance()
    {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    private function add_actions()
    {
        add_action( 'elementor/widgets/widgets_registered', [ $this, 'register_widgets' ] );

        add_action( 'elementor/frontend/after_register_scripts', [ $this, 'register_frontend_scripts' ] );
        add_action( 'elementor/frontend/after_enqueue_scripts', [ $this, 'enqueue_frontend_scripts' ] );

        add_action( 'elementor/editor/after_enqueue_styles', [ $this, 'enqueue_editor_styles' ] );

        add_action( 'elementor/frontend/after_enqueue_styles', [ $this, 'enqueue_frontend_styles' ] );
    }

    public function register_widgets()
    {
        $this->include_widgets_files();

        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\ThumbnailHoverMenu() );
    }

    private function include_widgets_files()
    {
        require __DIR__ . '/widgets/thumbnail-hover-menu.php';
    }

    public function register_frontend_scripts()
    {
        $suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

        wp_register_script( 'thumbnail-hover-menu-frontend', plugins_url( '/assets/js/frontend' . $suffix . '.js', __FILE__ ), [], \ThumbnailHoverMenuForElementor::VERSION, true );
    }

    public function enqueue_frontend_scripts()
    {
        wp_enqueue_script( 'thumbnail-hover-menu-frontend' );
    }

    public function enqueue_editor_styles()
    {
        $suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

        wp_enqueue_style( 'thumbnail-hover-menu-editor', plugins_url( '/assets/css/editor' . $suffix . '.css', __FILE__ ), [], \ThumbnailHoverMenuForElementor::VERSION );
    }

    public function enqueue_frontend_styles()
    {
        $suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

        wp_enqueue_style( 'thumbnail-hover-menu-frontend', plugins_url( '/assets/css/frontend' . $suffix . '.css', __FILE__ ), [], \ThumbnailHoverMenuForElementor::VERSION );
    }
}

Plugin::instance();
