<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WP_Bootstrap_Starter
 */

?>
<?php if(!is_page_template( 'blank-page.php' ) && !is_page_template( 'blank-page-with-container.php' )): ?>
			</div><!-- .row -->
		</div><!-- .container -->
	</div><!-- #content -->
    <?php get_template_part( 'footer-widget' ); ?>
	<footer class="main-footer ml-0 mt-5" role="contentinfo">
		<div class="container">
            <div class="row mx-auto">
			  <div class="col-lg-4 col-md-4 col-sm-4 col-12 text-center mb-3">
				<img src="http://<?=$_SERVER['SERVER_NAME']?>/blog/wp-content/uploads/2020/08/RRHHIngenia-Website2020_LogoFooter.png" alt="RRHH Ingenia" class="img-fluid logo">
			  </div>
			  <div class="col-lg-4 col-md-4 col-sm-4 col-12 text-center mb-3">
				<p>&copy; 2020 - SIGMA</p>
				<p>Todos los derechos reservados.</p>
			  </div>
			  <div class="col-lg-4 col-md-4 col-sm-4 col-12 text-center mb-3">
				<a href="https://www.facebook.com/RRHHIngenia/" target="_blank">
				  <img class="icon" src="http://<?=$_SERVER['SERVER_NAME']?>/blog/wp-content/uploads/2020/08/RRHHIngenia-Website2020_FacebookIcon.png" alt="Facebook">
				</a>
				<a href="https://mx.linkedin.com/company/rrhh-ingenia" target="_blank">
				  <img class="icon" src="http://<?=$_SERVER['SERVER_NAME']?>/blog/wp-content/uploads/2020/08/RRHHIngenia-Website2020_LinkedinIcon.png" alt="Linkedin">
				</a>

			  </div>
			</div>
		</div>
	</footer><!-- #colophon -->
<?php endif; ?>
</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>