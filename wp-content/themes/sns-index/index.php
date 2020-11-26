<?php get_header(); ?>

<?php
require 'Paginate.php';
require 'Twitter.php';

$twitter_name = get_post_custom(7)['twitter'][0];
$page = get_page(7);


$twitter = new Twitter($twitter_name, $_GET["is_reply"], 35);

$twitter_posts = $twitter->getPosts();

?>

<div class="container">
    <div class="row head mt-4 pb-3">
        <div class="col-sm-7">
            <h2 class="user-name"><?php echo $page->post_title; ?></h2>

            <?php if (!$_GET["is_reply"]): ?>
                <a href="?is_reply=1">自分に関する投稿すべて表示</a>
            <?php else: ?>
                <a href="?is_reply=0">自分の投稿のみ表示</a>
            <?php endif; ?>
        </div>

        <div class="col-sm-5 mt-3">
            <?php get_search_form(); ?>
        </div>
    </div>

    <!--Twitter-->
    <h3 class="sns-name mb-4"><a href="<?php echo home_url('/twitter'),"?user_name=",$twitter_name; ?>">Twitter</a></h3>
    <div class="top-twitter mb-5">
        <ul class="top-posts">
            <?php foreach ($twitter_posts as $item): ?>
                <li class="card">
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
