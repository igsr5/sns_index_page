<?php get_header(); ?>
    <div class="container">
        <div class="row head mt-4 pb-3">
            <div class="col-sm-7">
                <h2 class="user-name">トップページ</h2>
            </div>

            <div class="col-sm-5 mt-3">
                <?php get_search_form(); ?>
            </div>
        </div>

        <?php
        $posts = get_pages('numberposts=-1');
        foreach ($posts as $post):
        ?>
            <div class="page_link">
                <a href="<?php echo get_page_link($post->id); ?>"><?php echo get_the_title($post->id); ?></a>
            </div>
        <?php endforeach; ?>
    </div>
<?php get_footer(); ?>