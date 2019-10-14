<?php get_header(); ?>
	
<div class="ajax_replaceable" id="content">

  	<section role="main" class="ajax_replaceable" id="main_section">
  	
      	<?php if (have_posts()): while (have_posts()) : the_post(); ?>
      	
        		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        		
          			<?php if ( has_post_thumbnail()) : // Check if Thumbnail exists ?>
            				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
              					<?php the_post_thumbnail(); // Fullsize image for the single post ?>
            				</a>
          			<?php endif; ?>
          
          			<h1><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h1>
          			
          			<?php the_content(); // Dynamic Content ?>
          			
          			<?php the_tags( __( 'Tags: ', 'html5blank' ), ', ', '<br>'); // Separated by commas with a line break at the end ?>
          			
          			<p><?php _e( 'Categorised in: ', 'html5blank' ); the_category(', '); // Separated by commas ?></p>
        			
        		</article>
      		
      	<?php endwhile; endif; ?>
  	
  	</section>

</div>
	
<?php get_footer(); ?>