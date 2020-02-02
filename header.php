<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php if (have_posts()): while (have_posts()): the_post(); echo strip_tags(get_the_excerpt()); endwhile; endif; ?>" />
    <title><?php if (function_exists('is_tag') && is_tag()) { echo '&quot;'.$tag.'&quot; - '; } elseif (is_archive()) { wp_title(''); echo ' - '; } elseif (is_search()) { echo  $GLOBALS['404_title_form'].'&quot;'.wp_specialchars($s).'&quot; - '; } elseif (!(is_404()) && (is_single()) || (is_page())) { wp_title(''); echo ' - '; } elseif (is_404()) { echo $GLOBALS['404_title']; } if (is_home()) { bloginfo('name'); echo ' - '; bloginfo('description'); } else { bloginfo('name'); } ?></title>
    <link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?> Atom Feed (<?php bloginfo('language'); ?>)" href="<?php bloginfo('atom_url'); ?>" />
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
    <link rel="stylesheet" type="text/css" media="screen" href="<?php bloginfo('template_url'); ?>/gallery/css/lightbox.min.css" />
    <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/bootstrap-responsive.min.css">
    <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/font-awesome.css">
    <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/theme.min.css">
<?php wp_head(); ?>	
</head>
<body <?php body_class(); ?>>
    <header id="header">
        <div class="navbar navbar-fixed-top navbar-inverse">
            <div class="navbar-inner">
                <div class="container">
                 <?php if ( function_exists( 'the_custom_logo' ) ) { ?> <?php the_custom_logo(); } ?> 
                  <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </a>
                  <a class="brand" href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a>
                  <div class="nav-collapse">
                    <?php if (has_nav_menu('primary-menu')): 
                                    wp_nav_menu( array( 'container' => false, 'menu_class' => 'nav', 'theme_location' => 'primary-menu', 'fallback_cb' => 'display_home' ) );
                    else: ?>
                            <ul class="nav">
                                    <li><a href="<?php echo home_url(); ?>/"><?php echo $GLOBALS['menu_home_title']; ?></a></li>
                                    <?php wp_list_pages('title_li=' ); ?>
                        </ul><!-- end .menu -->
                    <?php endif;	?>
                  </div><!--/.nav-collapse -->
                </div>
            </div>
        </div>
    </header>
     <div class="jumbotron">
                <div class="container">
                    <h1 class="display-3"><?php if (function_exists('is_tag') && is_tag()) { echo '&quot;'.$tag.'&quot; - '; } elseif (is_archive()) { wp_title(''); echo ' - '; } elseif (is_search()) { echo  $GLOBALS['404_title_form'].'&quot;'.wp_specialchars($s).'&quot; - '; } elseif (!(is_404()) && (is_single()) || (is_page())) { wp_title(''); echo ' - '; } elseif (is_404()) { echo $GLOBALS['404_title']; } if (is_home()) { bloginfo('name'); echo ' - '; bloginfo('description'); } else { bloginfo('name'); } ?></h1>
                </div>
  </div>
    <div id="wrap">
        <div class="container-fluid">
            