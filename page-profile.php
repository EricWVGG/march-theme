<?php /* Template Name: Profile */ 

get_header(); ?>
	
<div class="ajax_replaceable" id="content">

  	<section class="header header_sub header_sub_about">
        <header>
            <nav>
                <?php html5blank_nav('about_submenu'); ?>
            </nav>
        </header>
    </section>
  
	  <section role="main" id="main_section">
  	
      	<?php if (have_posts()): while (have_posts()) : the_post(); ?>
      	
        		<article id="post-<?php the_ID(); ?>" class="<?=implode(' ', get_post_class('article_profile'))?>">
        		
                <!-- h1><?php the_title(); ?></h1 -->
    	
          			<?php the_content(); ?>
        			
        		</article>
        		
        		<article id="about_clients">
        		
                <h2>Select Clients</h2>
        		    <?php the_block('clients') ?>
        		</article>
      		
      	<?php endwhile; endif; ?>
  	
  	</section>

</div>
	
<?php get_footer(); ?>