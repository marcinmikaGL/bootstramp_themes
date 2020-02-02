<?php get_header(); ?>

<div class="row-fluid">
	<div id="content">
	    <h1><?php echo $GLOBALS['404_title']; ?></h1>
	    <p><?php echo $GLOBALS['404_conent']; ?></p>
	    <div class="well">
	    	<h2><?php echo $GLOBALS['404_title_form']; ?></h2>
	    	<?php get_search_form(); ?> 
	    </div>

	</div><!--#end content -->
</div>
<?php get_footer(); ?>