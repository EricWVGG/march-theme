<aside class="ajax_replaceable" id="featured_project" >
  <? if(isset($detail_view_id)) : 
  	$detail_view = new WP_Query(array('post_type' => $content_type, 'p'=> $detail_view_id));
  	if ($detail_view->have_posts()): while ($detail_view->have_posts()) : $detail_view->the_post(); 
      $article_controls = $acs->adjacent_post_ids(array(
        'group_name' => $sort_group, 
        'post_id' => $detail_view_id
      ));
  	?>
  	
    		<!-- ajax content starts here -->
    		<article id="post-<?php the_ID(); ?>" <?php post_class('unloaded'); ?>>
    		
      			<? if($article_controls['previous']): ?>
      			  <a href="<?=get_permalink($article_controls['previous'])?>" class="article_controls ajax_trigger_detail arrow_prev"><span class="arrow">←</span></a>
            <? else: ?>
      			  <a href="<?=get_permalink($article_controls['last'])?>"     class="article_controls ajax_trigger_detail arrow_prev"><span class="arrow">←</span></a>
      			<? endif; ?>
      			<? if($article_controls['next']):     ?>
      			  <a href="<?=get_permalink($article_controls['next'])?>"  class="article_controls ajax_trigger_detail arrow_next"><span class="arrow">→</span></a>
            <? else: ?>
      			  <a href="<?=get_permalink($article_controls['first'])?>" class="article_controls ajax_trigger_detail arrow_next"><span class="arrow">→</span></a>
      			<? endif; ?>

      			<a class="article_close">Close</a>

      			<section class="article_snip">
          			<header>
          			    <h2 class="category"><?php the_category(', '); ?> <?=$article_controls['index']?><span>/<?=$article_controls['count']?></span></h2>
              			<h2 class="snip_title"><a href="<?php the_permalink(); ?>" ><?=get_the_title(); ?></a></h2>
              			<a class="article_snip_btn">+ Image Info</a>
              			<div class="clearfix"></div>
          			</header>
      			</section>

      			<section class="article_info">
          			<header>
          			    <? the_content() ?>
          			    <a class="article_info_btn">Close</a>
          			    <nav class="article_share">
          			        <p>Share:</p>
                            <ul class="social">
                              <li><a class="ss-icon" target="_new" href="https://twitter.com/intent/tweet?original_referer=<?=urlencode(get_permalink())?>&source=tweetbutton&text=Check%20out%20this%20image%20by%20MARCH%20-%20<?=urlencode(get_permalink())?>" target="_blank">Twitter</a></li>
                              <li><a class="ss-icon" target="_new" href="http://www.facebook.com/sharer/sharer.php?u=<?=urlencode(get_permalink())?>&t=<?=rawurlencode(the_title())?>">Facebook</a></li>
                              <li><a class="ss-icon" target="_new" href="mailto:?subject=Check%20out%20this%20image%20by%20MARCH&body=<?=urlencode(get_permalink())?>">Email</a></li>
                            </ul>
          			    </nav>
          			    <div class="clearfix"></div>
          			</header>
      			</section>
      			
      			<?php 
                $images =& get_children('post_type=attachment&post_mime_type=image&order=ASC&orderby=menu_order&post_parent=' . $detail_view_id );
                if($images) foreach( $images AS $img ) {
                  $grid_image = get_post_meta($img->ID, 'grid_image', true);
                  if($grid_image) continue;
                  $image = wp_get_attachment_image_src($img->ID, 'huge'); 
                  $image_large = wp_get_attachment_image_src($img->ID, 'large');
                }
      			?>
      			<div class="overlay_image" ></div>
      			<script type="text/javascript">
      			  $(function() {
                 $('body').addClass('waiting');
                 if($(window).width() < 768) return;
      			     var img = new Image();
      			     img.onload = function() {
                   $('body').removeClass('waiting');
          			   $('.overlay_image').css('background-image', 'url("<?=$image[0]?>")');
          			   $('aside, #featured_project_mask').addClass('overlay_active');
      			     }
      			     img.src = ($(window).width() >= 768) ? '<?=$image[0]?>' : '<?=$image_large[0]?>';
      			  });
      			</script>

    		</article>
    		<!-- end ajax content -->
  		
  	<?php endwhile; endif; ?>
  <? endif; ?>
</aside>
