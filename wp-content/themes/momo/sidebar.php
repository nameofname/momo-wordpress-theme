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
?>
		<div id="secondary" class="widget-area" role="complementary">

                    <aside id="categories" class="widget">
                            <h1 class="widget-title"><?php _e( 'Categories', 'Momofuku' ); ?></h1>
                            <ul>
                                <?php echo get_sidebar_cat_links() ?>
                            </ul>
                    </aside>

		</div>
