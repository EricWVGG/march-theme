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
  	
    	<?php // _e( 'Categories for', 'html5blank' ); the_category(); ?>
            
        <?php get_template_part('loop'); ?>
    		
    	<?php get_template_part('pagination'); ?>
  	
  	</section>

</div>

<?php get_footer(); ?>