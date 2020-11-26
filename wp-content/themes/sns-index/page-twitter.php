<?php get_header(); ?>

<?php
require 'Paginate.php';
require 'Twitter.php';

$twitter_name = $_GET['user_name'];
if (!$_GET['paginate']) {
    $twitter = new Twitter($twitter_name, $_GET["is_reply"], 60);
} else {
    $twitter = new Twitter($twitter_name, $_GET["is_reply"], 60);
}
$twitter_posts = $twitter->getPosts();
?>

<div class="container">
    <div class="row head mt-4 pb-3">
        <div class="col-sm-7">
            <h2 class="user-name">@<?php echo $twitter_name; ?></h2>

            <?php if (!$_GET["is_reply"]): ?>
                <a href="?is_reply=1&user_name=<?php echo $twitter_name; ?>">自分に関する投稿すべて表示</a>
            <?php else: ?>
                <a href="?is_reply=0&user_name=<?php echo $twitter_name; ?>">自分の投稿のみ表示</a>
            <?php endif; ?>
            <a class="ml-2" href="<?php echo home_url('/users'); ?>">一覧に戻る</a>
        </div>

        <div class="col-sm-5 mt-3">
            <?php get_search_form(); ?>
        </div>
    </div>


    <!--Twitter-->
    <div class="twitter mb-5">
        <h3 class="sns-name mb-4">Twitter</h3>
        <ul class="posts">
            <?php foreach ($twitter_posts as $item): ?>
                <li class="card mb-5">
                    <article>
                        <a class="text"
                           href="https://twitter.com/<?php echo $item->user->screen_name; ?>/status/<?php echo $item->id; ?>">
                            <?php if ($twitter->is_RT($item->text)) {
                                echo $twitter->add_color_rts($item->text);
                            } else {
                                echo $item->text;
                            }
                            ?>
                        </a>
                        <?php
                        // 引用リツイート
                        if ($item->is_quote_status) {
                            echo "<br>";
                            echo "<a class='text' href='https://twitter.com/", $item->quoted_status->user->screen_name, "/status/", $item->quoted_status->id, "'><span class='rt'>RT @", $item->quoted_status->user->name, ":</span>", $item->quoted_status->text, "</a>";
                        }
                        ?>
                        <img class="post_photo" src="<?php echo $item->entities->media[0]->media_url_https; ?>"
                             alt="">
                        <p class="created_at"><?php echo $item->created_at; ?></p>
                    </article>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

</div>

<?php get_footer(); ?>
