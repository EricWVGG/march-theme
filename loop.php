<?php if (have_posts()): while (have_posts()) : the_post(); ?>
	
	<article id="post-<?php the_ID(); ?>" class="<?=implode(' ', get_post_class('article_news'))?>">
	
		<?php if ( has_post_thumbnail()) : // Check if thumbnail exists ?>
			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
				<?php the_post_thumbnail(array(120,120)); // Declare pixel size you need inside the array ?>
			</a>
		<?php endif; ?>
		
		<h2><?php the_title(); ?></h2>
		<h3><span class="date_posted">Posted</span><?php the_time("m.d.y", $var); ?></h3>
		
		<?php the_content(); ?>
		
	</article>
	
<?php endwhile; endif; ?>