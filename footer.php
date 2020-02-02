</div>
<!--#end .container -->
</div>
<!--#end #wrap -->

<footer class="page-footer">
    <div class="container">
        <div class="row">
            <div class="col-md-12 py-5">
                 <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-sidebar') ) : 
           endif; ?>

                </div>
            </div>
        </div>
    </div>
    <div class="footer-copyright text-center py-3"> <?php echo $GLOBALS['footer_title']; ?> </div>

</footer>
<!-- #Footer -->




<div class="hide">
	<?php wp_footer(); ?>
</div>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/gallery/js/lightbox.js"></script>
</body>
</html>