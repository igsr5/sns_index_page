<?php get_header(); ?>
<div class="container">
    <div class="row head mt-4 pb-3">
        <div class="col-sm-7">
            <?php if (isset($_GET['s']) && empty($_GET['s'])): ?>
                <h2 class="user-name">検索キーワード未入力</h2>
            <?php else: ?>
                <h2 class="user-name"><?php echo $_GET['s']; ?>の検索結果</h2>
            <?php endif; ?>
        </div>

        <div class="col-sm-5 mt-3">
            <?php get_search_form(); ?>
        </div>
    </div>

    <?php if (have_posts()): ?>
        <?php while (have_posts()): the_post(); ?>
            <div class="page_link">
                <a href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?></a>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>検索されたキーワードにマッチする記事はありませんでした</p>
    <?php endif; ?>

    <a href="<?php echo home_url(); ?>">トップページへ</a>
</div>
<?php get_footer(); ?>
