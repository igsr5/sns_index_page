<?php
get_header();

// 固定ページのPOST_IDから何ページ目か判定する
function get_pagination($id)
{
    $users_page = get_page_by_path("users");
    $users_page_id = $users_page->ID;
    $args = array(
        'post_parent' => $users_page_id,
        'post_status' => 'publish',
        'post_type' => 'page'
    );
    $children_array = get_children($args);
    $i = 0;
    foreach ($children_array as $child) {
        if ($id == $child->ID) {
            return floor($i/3);
        }
        $i++;
    }
}

?>
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
                <?php
                $id = get_the_id();
                $paginate_id = get_pagination($id); //ページネーションの何ページ目か
                ?>
                <a href="<?php echo home_url('/users/?paginate='), $paginate_id; ?>"><?php echo get_the_title(); ?></a>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>検索されたキーワードにマッチする記事はありませんでした</p>
    <?php endif; ?>

    <a href="<?php echo home_url(); ?>">トップページへ</a>
</div>
<?php get_footer(); ?>
