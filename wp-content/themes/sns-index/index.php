<?php get_header(); ?>

<?php
// 子ページ取得

$users_page = get_page_by_path("users");
$users_page_id = $users_page->ID;
$args = array(
    'post_parent' => $users_page_id,
    'post_status' => 'publish',
    'post_type' => 'page'
);
$children_array = get_children($args);
?>

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
        $i = 0;
        foreach ($children_array as $child):
            $paginate_id= floor($i/3); //ページネーションの何ページ目か
            ?>
            <div>
                <a class="mt-3 d-block lead" href="<?php echo home_url('/users/?paginate='), $paginate_id; ?>"><?php echo $child->post_title ?></a>
            </div>
            <?php
            $i++;
        endforeach;
        ?>

    </div>
<?php get_footer(); ?>