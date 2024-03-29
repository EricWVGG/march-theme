<?php get_header(); ?>

<div class="ajax_replaceable" id="content">

  	<section role="main">
  	
      	<?php if (have_posts()): the_post(); ?>
      	
        		<h1><?php _e( 'Author Archives for ', 'html5blank' ); echo get_the_author(); ?></h1>
          
          	<?php if ( get_the_author_meta('description')) : ?>
          	
          	<?php echo get_avatar(get_the_author_meta('user_email')); ?>
          	
        		<h2><?php _e( 'About', 'html5blank' ); echo get_the_author() ; ?></h2>
          	
          	<?php the_author_meta('description'); ?>
      	
      	<?php endif; ?>
      	
      	<?php rewind_posts(); while (have_posts()) : the_post(); ?>
      	
        		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        		
          			<?php if ( has_post_thumbnail()) : // Check if Thumbnail exists ?>
            				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
            			      <?php the_post_thumbnail(array(120,120)); // Declare pixel size you need inside the array ?>
                    </a>
          			<?php endif; ?>
          			
          			<h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
    
          			<span class="date"><?php the_time('F j, Y'); ?> <?php the_time('g:i a'); ?></span>
          			<span class="author"><?php _e( 'Published by', 'html5blank' ); ?> <?php the_author_posts_link(); ?></span>
          			<span class="comments"><?php comments_popup_link( __( 'Leave your thoughts', 'html5blank' ), __( '1 Comment', 'html5blank' ), __( '% Comments', 'html5blank' )); ?></span>
          			
          			<?php html5wp_excerpt('html5wp_index'); // Build your custom callback length in functions.php ?>
        			
        		</article>
      		
      	<?php endwhile; endif; ?>
  		
  		<?php get_template_part('pagination'); ?>
  	
  	</section>

</div>

<?php get_footer(); ?>
