<?php get_header(); ?>
<div class="row-fluid">
   
  <div id="wrap" class="container">
        <?php if (have_posts()): while (have_posts()): the_post(); ?>
            <div class="post">
                <div class="post-content">
                    <?php echo the_content(); ?>
                </div>

                <?php if(comments_open()): ?>
                    <div id="comments">
                        <?php comments_template(); ?>
                    </div>
                <?php endif; ?>
                </div><!--#end post-->
        <?php endwhile; endif; ?>
    </div><!--#end container -->
</div><!--.end row-fluid -->
<?php get_footer(); ?>