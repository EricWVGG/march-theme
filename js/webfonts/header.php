<? if(NOT_AJAX): ?><!doctype html>
<html <?php language_attributes(); ?> class="no-js">
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' :'; } ?> <?php bloginfo('name'); ?></title>
		
		<!-- dns prefetch -->
		<link href="//www.google-analytics.com" rel="dns-prefetch">
		
		<!-- meta -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width,initial-scale=1.0">
		<meta name="description" content="<?php bloginfo('description'); ?>">
		<meta name="apple-mobile-web-app-capable" content="yes">
		
		<!-- icons -->
		<link href="<?php echo get_template_directory_uri(); ?>/img/icons/favicon.png" rel="shortcut icon">
		<link href="<?php echo get_template_directory_uri(); ?>/img/icons/touch.png" rel="apple-touch-icon-precomposed">
			
		<!-- css + javascript -->
		<?php wp_head(); ?>
		
		<script>
		!function(){
			// configure legacy, retina, touch requirements @ conditionizr.com
			conditionizr()
		}()
		</script>
	</head>
	<body <?php body_class(); ?>>
	
  	<script type="text/javascript">
        <? // random background image
          $images =& get_children('post_type=attachment&post_mime_type=image&order=ASC&orderby=menu_order&post_parent=26');
          shuffle($images);
          $image = wp_get_attachment_image_src($images[0]->ID, 'fullsize');
        ?>
        $(function() {
            load_background_image('<?=$image[0]?>'); 
        });
  	</script>

		<div id="top"></div>
		
		<div class="wrapper">
		
		    <section class="header header_main initial_load">
		        <header>
    		        <a class="ajax_trigger header_logo" href="<?php echo home_url(); ?>" title="March Logo">March</a>
    		        <nav>
    		            <?php html5blank_nav('header-menu'); ?>
    		        </nav>
		        </header>
		    </section>
		    
		    <div id="content_wrapper">

<? else: ?>
  <div>
    <div id="wp-ajax-title" style="display:none !important"><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' :'; } ?> <?php bloginfo('name'); ?></div>
    <div id="wp-ajax-body-classes" <?php body_class(); ?>></div>
<?php endif; /* NOT_AJAX */ ?>