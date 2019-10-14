<?php get_header(); ?>
	
<div class="ajax_replaceable" id="content">

  	<section class="header header_sub header_sub_about">
        <header>
            <nav>
                <?php html5blank_nav('about_submenu'); ?>
            </nav>
        </header>
    </section>
  
  	<section role="main" class="ajax_replaceable" id="main_section">
  	
    		<h1><?php _e( 'Archives', 'html5blank' ); ?></h1>
    	
    		<?php get_template_part('loop'); ?>
    		
    		<?php get_template_part('pagination'); ?>
  	
  	</section>

</div>

<?php get_footer(); ?>