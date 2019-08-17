<?php
    function add_theme_scripts(){
        // +Stylesheets+
        // Args{ name. path }
        // load the main stylesheet in root folder; style.css
        wp_enqueue_style( 'style', get_stylesheet_uri(), array('bootstrap_css') ); 
        // load the bootstrap stylesheet
	    wp_enqueue_style( 'bootstrap_css', get_theme_file_uri( '/assets/css/bootstrap.min.css' ) );

        // +Scripts+
        // Args{ name. path, dependencies, in_footer }
        // load the popper.js on which bootstrap.js depends
        wp_enqueue_script( 'poper_js',  get_theme_file_uri( '/assets/js/popper.min.js' ), array('jquery'), true );
        // load the bootstrap script
        wp_enqueue_script( 'bootstrap_js',  get_theme_file_uri( '/assets/js/bootstrap.min.js' ), array('jquery', 'poper_js'), true );
    }
    add_action( 'wp_enqueue_scripts' , 'add_theme_scripts');
?>