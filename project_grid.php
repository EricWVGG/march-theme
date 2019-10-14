<?php get_header(); ?>
<? if(NOT_AJAX || (!NOT_AJAX && !isset($detail_view_id))) : ?>

<div class="ajax_replaceable projects_page" id="content">
	
    <section class="header header_sub header_sub_projects">
        <header>
            <nav>
                <?php html5blank_nav('project_type_submenu'); ?>
            </nav>
        </header>
    </section>


  	<section role="main" id="main_section" >
  	
      	<?php 
      	$page_content = new WP_Query(array('page_id' => $grid_page_id));
      	if ($page_content->have_posts()): while ($page_content->have_posts()) : $page_content->the_post(); 
      	?>
      	
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <h2><?php the_title(); ?>. &nbsp; </h2>
            <p><?php the_content(); ?></p>
            <div class="clearfix"></div>
            <?php $clients = get_the_block('clients') ?>
        </article>
      		
      	<?php endwhile; endif; ?>

        <article id="featured">
            <ul>
      		    <?php 
        		      $images = get_field($acf_field_name);
        		      if( $images ) foreach ( $images AS $image ) :
            		      $img = $image['image'];
            		      $attch_id = get_post_thumbnail_id( $img->ID );
            		      if(!$attch_id) continue;
                      $photo = wp_get_attachment_image_src($attch_id, 'large'); 
                      $photo[2] = ( 316 * $photo[2] ) / $photo[1];
                      $photo[1] = 316;
                ?>
                    <li>
                        <a class="ajax_trigger_detail" href="<?php the_permalink(); ?>" name="<?php the_title() ?>">
                          <img src="<?php echo($photo[0]) ?>" style="width:<?=$photo[1]?>px; height:<?=$photo[2]?>px; ">
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </article>
        
        <article id="case_studies">
            <div id="case_studies_scroll_target" ></div>
            <h2>Case Studies</h2>
            <ul class="case_studies">
      		    <?php 
                $case_studies = get_field('case_studies');
                if( $case_studies ) : foreach( $case_studies AS $case_study ) :
                    $post = $case_study;
                    setup_postdata($post);
  		            $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'casestudy' );
  		            if( $image && get_post_status($post->ID) != 'publish' ) :
                ?>
                    <li>
                        <a id="case_study_<?=$post->ID?>" class="unit" name="<?php the_title() ?>">
                            <div class="copy">
                                <h3><? the_title(); ?></h3>
                                <p><? $c = get_extended($post->post_content); echo $c['main'];?></p>
                                <span>› Coming Soon</span>
                            </div>
                        </a>
                    </li>
                <? elseif( get_post_status($post->ID) == 'publish' ) : ?>
                    <li>
                        <a id="case_study_<?=$post->ID?>" class="unit ajax_trigger" href="<?php the_permalink(); ?>" name="<?php the_title() ?>">
                            <div class="copy">
                                <h3><? the_title(); ?></h3>
                                <p><? $c = get_extended($post->post_content); echo $c['main'];?></p>
                                <span>› View Case Study</span>
                            </div>
                        </a>
                    </li>
                <? endif; ?>
                    <style type="text/css">
                        #case_study_<?=$post->ID?> {
                            background-image: url('<?=$image[0]?>');
                        }
                    </style>
                <?php endforeach; endif; wp_reset_query();?>
            </ul>
        </article>
        
        <article id="clients">
            <div id="clients_scroll_target" ></div>
            <h2>Select Clients</h2>
            <?=$clients;?>
        </article>
        
        <script type="text/javascript">
          $(function() {
            setTimeout(function() {
              $('#featured li').addClass('loaded');
            }, 2400);
          });
        </script>
  	
  	</section>

<? endif; ?>

<? require_once('project_detail.php'); ?>
<div id="featured_project_mask"></div>

<? if(NOT_AJAX || (!NOT_AJAX && !isset($detail_view_id))) : ?>
</div>
<? endif; ?>

<? get_footer(); ?>