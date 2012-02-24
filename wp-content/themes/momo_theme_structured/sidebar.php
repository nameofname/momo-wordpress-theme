<?php if (!is_page() && woo_active_sidebar('sidebar-blog')) : ?>
    <div id="sidebar" class="col-right">
		<?php woo_sidebar('sidebar-blog'); ?>		           
	</div>        
<?php elseif (is_page() && woo_active_sidebar('sidebar-pages')) : ?>
	<div id="sidebar" class="col-right">
		<?php woo_sidebar('sidebar-pages'); ?>		           
	</div>
<?php endif; ?>