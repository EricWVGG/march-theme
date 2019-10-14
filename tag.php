<?php get_header(); ?>
	
<div class="ajax_replaceable" id="content">

  	<section role="main">
  	
    		<h1><?php _e( 'Tag Archive: ', 'html5blank' ); echo single_tag_title('', false); ?></h1>
    	
    		<?php get_template_part('loop'); ?>
    		
    		<?php get_template_part('pagination'); ?>
  	
  	</section>

</div>

<?php get_footer(); ?>