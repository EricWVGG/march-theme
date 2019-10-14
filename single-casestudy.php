<?php get_header(); 

$cats = wp_get_post_categories($post->ID);
$category = get_category($cats[0]);

?>
<? if(NOT_AJAX || (!NOT_AJAX && !isset($detail_view_id))) : ?>

<div class="ajax_replaceable projects_page" id="content">
    <div id="clients_scroll_target" ></div>
	
    <section class="header header_sub header_sub_projects">
        <header>
            <nav>
                <ul>
                    <li id="" class="menu-item menu-item-type-custom menu-item-object-custom "><a class="ajax_trigger" href="/<?=$category->slug?>">Featured</a></li>
                    <li id="" class="menu-item menu-item-type-custom menu-item-object-custom "><a class="ajax_trigger" href="/<?=$category->slug?>#clients_scroll_target">Clients</a></li>
                    <li id="" class="menu-item menu-item-type-custom menu-item-object-custom active_section"><a>Case Studies</a></li>
                </ul>
            </nav>
        </header>
    </section>


  	<section role="main" id="main_section" >
  	
      	<?php while(have_posts()) : the_post(); ?>
      	
            <article id="post-<?php the_ID(); ?>" <?php post_class('case_study_intro'); ?>>
                <h2><?php the_title(); ?></h2>
                <?php the_content(); ?>
                <div class="clearfix"></div>
            </article>
          		
            <article id="case_study">
                <?=get_field('case_study')?>
            </article>
                  	
        <?php endwhile; ?>    
  	</section>

</div>
<script type="text/javascript">
  $(function() {
    setTimeout(function() {
      $('#content_wrapper').removeClass('reloading');
    }, 2400);
  });
</script>

<? endif; ?>

<? get_footer(); ?>