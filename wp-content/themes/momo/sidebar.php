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
    $cats_flat = get_categories(array('hierarchical'=>TRUE)); 
    // create a flat array so as you recursively loop through sub cats you can limit number of loops. 

    // solve the problem of nesting an array in 1 iteration from a flat array by passing the array references to itself. 
    $cats_nested = array(); 
    foreach ($cats_flat as $cat) {
        //echo '<pre>' ;var_dump(empty($cats_nested[$cat->cat_ID])); exit; 
        if (empty($cats_nested[$cat->cat_ID])) {
            $cats_nested[$cat->cat_ID] = array(); 
        }
        if (empty($cats_nested[$cat->cat_ID]['children'])){
            $cats_nested[$cat->cat_ID]['children'] = array(); 
        }
        $cats_nested[$cat->cat_ID]['name'] = $cat->cat_name; 
        $cats_nested[$cat->cat_ID]['parent'] = $cat->parent; 
        //$cats_nested[$cat->cat_ID]['used'] = FALSE; 
        if (empty($cats_nested[$cat->parent])) {
            $cats_nested[$cat->parent] = array(); 
            $cats_nested[$cat->parent]['children'] = array(); 
        }
        $cats_nested[$cat->parent]['children'][$cat->cat_ID] = &$cats_nested[$cat->cat_ID]; 
    }
    // at this point, you have an assoc array with nested internal pointers to to itself.  
    // to clean up, grab only the top level reference, which is stored under $cats_nested[0]
    $cats_nested = $cats_nested[0]; 
    //echo '<script type="text/javascript">var shit = '; echo(json_encode($cats_nested)); echo '</script>'; 

    // generate nested <ul> navigation, based on $cat_arr starting at $fitst_id
    $output = momo_get_nested_nav($cats_nested, TRUE); 

    return $output; 
}

// does recursion to generate navigation from $cats_nested
/*
 */
function momo_get_nested_nav(&$cats, $top_level = FALSE) {
    // start ul: 
    $out = $top_level ? "<ul>" : "<ul class='children'>";
    //echo '<pre>hey there '; var_dump(($cat['parent'] ));  

    foreach ($cats['children'] as $id => $cat) {
        $link = get_category_link($id); 
        $name = $cat['name']; 
        $curr_cat = is_category($id) ? ' curr_cat' : ''; 
        $out .= "<li class='cat-item$curr_cat'><a href='$link'>$name</a>"; 
        // if the current $cat 
        if (sizeof($cat['children']) > 0){
            $out .= momo_get_nested_nav($cat, FALSE); 
        }
        $out .= "</li>"; 
    } 
    
    // end ul: 
    $out .= '</ul>';
    return $out; 
}


function get_sidebar_page_links() {
    $pages = get_pages();
    $output = ''; 
    if(sizeof($pages)) {
        //$output .= "<h1 id='pages-header' class='widget-title'>Pages</h1>"; 
        $output .= '<ul id="pages-nav">'; 
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
                        <?php 
                            // get categories based on custom logicc
                            echo get_sidebar_cat_links(); 
                            // GET CATEGORIES USING THE WP DEFAULT get_the_category()
                                // -- deprecated in favor of custom functionality
                            /*$curr_cat = get_the_category(); 
                            $curr_cat_id = $curr_cat[0]->cat_ID; 
                            wp_list_categories(array(
                                'hierarchical' => true,
                                'title_li' => '',
                                'current_category' => $curr_cat_id, 
                            )); */
                        ?>
                        <?php 
                            echo get_sidebar_page_links(); 
                        ?>
                </aside>

</div>
