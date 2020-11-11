<?php get_header(); ?>

<?php
require 'Twitter.php';
$twitter_name = get_post_meta(get_the_ID(), 'twitter');
$twitter = new Twitter($twitter_name, $_GET["is_reply"]);
$twitter_posts = $twitter->getPosts();
?>
<div class="container">
    <div class="row head mt-4 pb-3">
        <div class="col-sm-7">
            <h2 class="user-name"><?php the_title(); ?></h2>

            <?php if (!$_GET["is_reply"]): ?>
                <a href="?is_reply=1">自分に関する投稿すべて表示</a>
            <?php else: ?>
                <a href="?is_reply=0">自分の投稿のみ表示</a>
            <?php endif; ?>
        </div>

        <div class="col-sm-5 mt-3">
            <form class="row" action="">
                <input class="form-control col-5 offset-1" type="text" name="user_name" placeholder="username">
                <input class="btn btn-primary col-3 ml-2" type="submit" value="検索">
            </form>
        </div>
    </div>


    <div class="sns-content mt-5">
        <nav aria-label="...">
            <ul class="pagination">
                <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1"><</a>
                </li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item active">
                    <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                </li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                    <a class="page-link" href="#">></a>
                </li>
            </ul>
        </nav>
        <!--Twitter-->
        <div class="twitter mb-5">
            <h3 class="sns-name mb-4">Twitter</h3>
            <ul class="posts">
                <?php foreach ($twitter_posts as $item): ?>
                    <li class="card">
                        <article>
                            <a class="text"
                               href="https://twitter.com/<?php echo $item->user->screen_name; ?>/status/<?php echo $item->id; ?>">
                                <?php if ($twitter->is_RT($item->text)) {

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

        <!--Facebook-->
        <div class="facebook mb-5">
            <h3 class="sns-name mb-4">Facebook</h3>
            <ul class="posts">
                <?php foreach ([0, 1, 2, 3] as $item): ?>
                    <li class="card"></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>

    <nav aria-label="..." class="text-align-right">
        <ul class="pagination">
            <li class="page-item disabled">
                <a class="page-link" href="#" tabindex="-1"><</a>
            </li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item active">
                <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
            </li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
                <a class="page-link" href="#">></a>
            </li>
        </ul>
    </nav>
</div>
<?php get_footer(); ?>
