<?php
    function add_theme_scripts(){
        // +Stylesheets+
        // Args{ name. path }
        // load the main stylesheet in root folder; style.css
        wp_enqueue_style( 'style', get_stylesheet_uri(), array('bootstrap_css') ); 
        // load the bootstrap stylesheet
	    wp_enqueue_style( 'bootstrap_css', get_theme_file_uri( '/assets/css/bootstrap.min.css' ) );
        // loead the font-awesoome
	    wp_enqueue_style( 'fontawesome_css', get_theme_file_uri( '/assets/css/fontawesome.min.css' ) );

        // +Scripts+
        // Args{ name. path, dependencies, in_footer }
        // load the popper.js on which bootstrap.js depends
        wp_enqueue_script( 'poper_js',  get_theme_file_uri( '/assets/js/popper.min.js' ), array('jquery'), true );
        // load the bootstrap script
        wp_enqueue_script( 'bootstrap_js',  get_theme_file_uri( '/assets/js/bootstrap.min.js' ), array('jquery', 'poper_js'), true );
    }
    add_action( 'wp_enqueue_scripts' , 'add_theme_scripts');

    // Theme supports
	add_theme_support( 'post-thumbnails' );
    
    // CUstomizing our search form 
    function wpdocs_my_search_form( $form ) {
        $form = '<form role="search" method="get" id="searchform" class="searchform" action="' . home_url( '/' ) . '" >
        <div><label class="screen-reader-text" for="s">' . __( 'Search for:' ) . '</label>
        <input type="text" value="' . get_search_query() . '" name="s" id="s" />
        <input type="submit" id="searchsubmit" value="'. esc_attr__( 'Search' ) .'" />
        </div>
        </form>';
     
        return $form;
    }
    add_filter( 'get_search_form', 'wpdocs_my_search_form' );

?>