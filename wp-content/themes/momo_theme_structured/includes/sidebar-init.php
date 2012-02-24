<?php

// Register widgetized areas

function the_widgets_init() {
    if ( !function_exists('register_sidebars') )
        return;

    register_sidebar(array('name' => 'Homepage Left','id' => 'home-left','description' => "Homepage widgets left column", 'before_widget' => '<div id="%1$s" class="widget %2$s">','after_widget' => '</div>','before_title' => '<h3>','after_title' => '</h3>'));
    register_sidebar(array('name' => 'Homepage Right','id' => 'home-right','description' => "Homepage widgets right column", 'before_widget' => '<div id="%1$s" class="widget %2$s">','after_widget' => '</div>','before_title' => '<h3>','after_title' => '</h3>'));
    
    register_sidebar(array('name' => 'Sidebar Blog','id' => 'sidebar-blog','description' => "Normal full width Sidebar for Blog Pages", 'before_widget' => '<div id="%1$s" class="widget %2$s">','after_widget' => '</div>','before_title' => '<h3>','after_title' => '</h3>'));
    register_sidebar(array('name' => 'Sidebar Pages','id' => 'sidebar-pages','description' => "Normal full width Sidebar for Pages", 'before_widget' => '<div id="%1$s" class="widget %2$s">','after_widget' => '</div>','before_title' => '<h3>','after_title' => '</h3>'));
    
    register_sidebar(array('name' => 'Footer - Pages Left','id' => 'footer-pages-left','description' => "Footer Widgets - Pages - Left Column", 'before_widget' => '<div id="%1$s" class="widget %2$s">','after_widget' => '</div>','before_title' => '<h3>','after_title' => '</h3>'));
    register_sidebar(array('name' => 'Footer - Pages Right','id' => 'footer-pages-right','description' => "Footer Widgets - Pages - Right Column", 'before_widget' => '<div id="%1$s" class="widget %2$s">','after_widget' => '</div>','before_title' => '<h3>','after_title' => '</h3>'));
    
    register_sidebar(array('name' => 'Footer - Blog Left','id' => 'footer-blog-left','description' => "Footer Widgets - Blog - Left Column", 'before_widget' => '<div id="%1$s" class="widget %2$s">','after_widget' => '</div>','before_title' => '<h3>','after_title' => '</h3>'));
    register_sidebar(array('name' => 'Footer - Blog Right','id' => 'footer-blog-right','description' => "Footer Widgets - Blog - Right Column", 'before_widget' => '<div id="%1$s" class="widget %2$s">','after_widget' => '</div>','before_title' => '<h3>','after_title' => '</h3>'));
}

add_action( 'init', 'the_widgets_init' );


    
?>