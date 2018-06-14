<?php
/**
 * Template Name: Columcille Home Page
 *
 * This page has been designed to produce the distinctive front page feature in the Columcille theme
 *
 * @package Columcille
 * @since Columcille 0.0.1
 */

get_header(); ?>

	<div id="primary" class="site-content row" role="main">

		<div class="col grid_8_of_12">

			<?php if ( have_posts() ) : ?>

				<?php // Start the Loop ?>
				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'content', 'homepage' ); ?>
				<?php endwhile; ?>

			<?php endif; // end have_posts() check ?>

		</div> <!-- /.col.grid_8_of_12 -->
		<?php // get_sidebar(); ?>

	</div> <!-- /#primary.site-content.row -->
        
        <div id="columcille_secondary" class="clm_previews row">
            <?php
                $clm_preview_num = columcille_special_options();
            ?>
            <div id="clm_preview1" class="clm_previewbox columcille-box">
               
                <?php echo clm_mini_page_display($clm_preview_num['hp_p1']); ?>
            </div>
            <div id="clm_preview2" class="clm_previewbox columcille-box">
                <?php echo clm_mini_page_display(3); ?>
            </div>
            <div id="clm_preview3" class="clm_previewbox columcille-box">
                <?php echo clm_mini_page_display(); ?>
            </div>
        </div><!-- /#columcille_secondary.clm_previews.row -->

<?php get_footer(); ?>
