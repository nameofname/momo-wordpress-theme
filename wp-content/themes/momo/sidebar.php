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
        $cat_flag = is_category($cat->term_id) ? 'curr_cat' : NULL; 
        $link = get_category_link($cat->term_id); 
        $name = $cat->category_description; 
        if ($cat_flag) { 
            $output .= "<li class='$cat_flag'><a href='$link'>$name</a></li>"; 
        } else {
            $output .= "<li><a href='$link'>$name</a></li>"; 
        }
    }
    return $output; 
}
function get_sidebar_page_links() {
    $pages = get_pages();
    $output = ''; 
    if(sizeof($pages)) {
        $output .= "<h1 id='pages-header' class='widget-title'>Pages</h1>"; 
        $output .= '<ul>'; 
        foreach ($pages as $page) {
            $link = get_page_link($page->ID); 
            $name = $page->post_title; 
            $page_flag = is_page($page->ID) ? 'curr_cat' : NULL; 
            if ($page_flag) {
                $output .= "<li class='$page_flag'><a href='$link'>$name</a></li>"; 
            } else {
                $output .= "<li><a href='$link'>$name</a></li>"; 
            }
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
                            <?php 
                                $home_flag = is_home() ? 'current-cat' : NULL; 
                            ?>
                            <li class="cat-item <?php echo $home_flag ?>"><a href="/">Home</a>
                            <?php 
                                //echo get_sidebar_cat_links() 
                            ?>
                        </ul>
                        <?php 
                        $curr_cat = get_the_category(); 
                        $curr_cat_id = $curr_cat[0]->catID; 
                        //echo '<pre>'; print_r($curr_cat_id); exit; 
                        //$myCat = $catsy[0]->cat_ID;
                        wp_list_categories(array(
                            'hierarchical' => true,
                            'title_li' => '',
                            'current_category' => $curr_cat_id, 
                        )); 
                        ?>
                        <?php 
                            echo get_sidebar_page_links(); 
                        ?>
                </aside>

</div>
