<?php /* Template Name: Home */ ?>

<?php get_header(); ?>
	
<div class="ajax_replaceable" id="content">

  	<section role="main" id="main_section" class="home" >
  	
    		<!-- <h1><?php // the_title(); ?></h1> -->
    	
      	<?php 
          query_posts(array('orderby' => 'rand', 'showposts' => 1, 'post_type' => 'slogan'));
      	  if (have_posts()): while (have_posts()) : the_post(); 
        ?>
      	    
      		<article class="display_text" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
      		
        			<span><p><?php the_title(); ?></p></span>
      			
      		</article>
      		
      	<?php endwhile; endif; ?>
  	
  	</section>
  	
</div>
	
<?php get_footer(); ?>