<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package Momofuku
 * @since Momofuku 0.1
 */

/**
 *
 * @return - links for each of the categories to fill the sidebar.
 */
function get_sidebar_cat_links() {
    $cats = get_categories(); 
    $output = ''; 
    foreach ($cats as $cat) {
        $link = get_category_link($cat->term_id); 
        $name = $cat->category_description; 
        $output .= "<li><a href='$link'>$name</a></li>"; 
    }
    return $output; 
}
function get_sidebar_page_links() {
    $pages = get_pages();
    $output = ''; 
    if(sizeof($pages)) {
        $output .= "<h1 class='widget-title'>Pages</h1>"; 
        $output .= '<ul>'; 
        foreach ($pages as $page) {
            $link = get_page_link($page->ID); 
            $name = $page->post_title; 
            $output .= "<li><a href='$link'>$name</a></li>"; 
        }
        $output .= '</ul>'; 
    }
    return $output; 
}
?>
		<div id="secondary" class="widget-area" role="complementary">

                    <aside id="categories" class="widget">
                            <h1 class="widget-title"><?php _e( 'Categories', 'Momofuku' ); ?></h1>
                            <ul>
                                <li><a href="/">Home</a>
                                <?php echo get_sidebar_cat_links() ?>
                            </ul>
                            <?php 
                                echo get_sidebar_page_links(); 
                            ?>
                    </aside>

		</div>
