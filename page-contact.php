<?php /* Template Name: Contact */ 

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
      	
        		<article id="post-<?php the_ID(); ?>" class="<?=implode(' ', get_post_class('article_contact'))?>">
        		
                <!-- h1><?php the_title(); ?></h1 -->
    	
          			<?php the_content(); ?>
        			
        		</article>
        		
        		<aside class="aside_contact">
        		    
          			<?php if ( has_post_thumbnail()) : // Check if Thumbnail exists 
              			$img = wp_get_attachment_image_src( get_post_thumbnail_id(), 'fullsize');
          			?>
            		    <div class="contact_map" ><img src="<?=$img[0]?>"></div>
          			<?php endif; ?>
        		
        		</aside>
        		
        		<div class="clearfix"></div>
      		
      	<?php endwhile; endif; ?>
  	
  	</section>

</div>
	
<?php get_footer(); ?>