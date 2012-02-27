<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package Momofuku
 * @since Momofuku 0.1
 */
?>

	</div><!-- #main -->

	<footer id="colophon" role="contentinfo">
		<div id="site-generator">
    &copy; <?php 
    $copyYear = 2012; 
    $curYear = date('Y'); 
    echo $copyYear . (($copyYear != $curYear) ? '-' . $curYear : '');
    ?> Momofuku
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
