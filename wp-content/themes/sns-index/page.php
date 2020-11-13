<?php get_header(); ?>

<?php
require 'Paginate.php';
require 'Twitter.php';
$twitter_name = get_post_meta(get_the_ID(), 'twitter');
if (!$_GET['paginate']) {
    $twitter = new Twitter($twitter_name, $_GET["is_reply"],4);
}else{
    $twitter = new Twitter($twitter_name, $_GET["is_reply"],4*$_GET["paginate"]);
}
$twitter_posts = $twitter->getPosts();
$post_num = 100;

if (!$_GET['paginate']) { // $_GET['page_id'] はURLに渡された現在のページ数
    $paginate = new Paginate($post_num, 1);
} else {
    $paginate = new Paginate($post_num, $_GET['paginate']);
}
$twitter_posts = $paginate->slice_array($twitter_posts);
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

    <!--paginate-->
    <?php if (!$_GET["is_reply"]): ?>
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item">
                    <?php if ($paginate->is_first()): ?>
                        <a class="page-link" href="#" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Previous</span>
                        </a>
                    <?php else: ?>
                        <a class="page-link" href="?paginate=<?php echo $paginate->now - 1; ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Previous</span>
                        </a>
                    <?php endif; ?>
                </li>
                <?php
                for ($i = 1; $i <= $paginate->max_page; $i++):
                    if ($i == $paginate->now):
                        ?>
                        <li class="page-item"><a class="page-link" href="#"><?php echo $i; ?></a></li>
                    <?php else: ?>
                        <li class="page-item"><a class="page-link"
                                                 href="?paginate=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                    <?php
                    endif;
                endfor;
                ?>
                <li class="page-item">
                    <?php if ($paginate->is_end()): ?>
                        <a class="page-link" href="#" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Next</span>
                        </a>
                    <?php else: ?>
                        <a class="page-link" href="?paginate=<?php echo $paginate->now + 1; ?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Next</span>
                        </a>
                    <?php endif; ?>
                </li>
            </ul>
        </nav>
    <?php else: ?>
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item">
                    <?php if ($paginate->is_first()): ?>
                        <a class="page-link" href="#" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Previous</span>
                        </a>
                    <?php else: ?>
                        <a class="page-link" href="?is_reply=1&paginate=<?php echo $paginate->now - 1; ?>"
                           aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Previous</span>
                        </a>
                    <?php endif; ?>
                </li>
                <?php
                for ($i = 1; $i <= $paginate->max_page; $i++):
                    if ($i == $paginate->now):
                        ?>
                        <li class="page-item"><a class="page-link" href="#"><?php echo $i; ?></a></li>
                    <?php else: ?>
                        <li class="page-item"><a class="page-link"
                                                 href="?is_reply=1&paginate=<?php echo $i; ?>"><?php echo $i; ?></a>
                        </li>
                    <?php
                    endif;
                endfor;
                ?>
                <li class="page-item">
                    <?php if ($paginate->is_end()): ?>
                        <a class="page-link" href="#" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Next</span>
                        </a>
                    <?php else: ?>
                        <a class="page-link" href="?is_reply=1&paginate=<?php echo $paginate->now + 1; ?>"
                           aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Next</span>
                        </a>
                    <?php endif; ?>
                </li>
            </ul>
        </nav>
    <?php endif; ?>

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

<!--paginate-->
<?php if (!$_GET["is_reply"]): ?>
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item">
                <?php if ($paginate->is_first()): ?>
                    <a class="page-link" href="#" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                        <span class="sr-only">Previous</span>
                    </a>
                <?php else: ?>
                    <a class="page-link" href="?paginate=<?php echo $paginate->now - 1; ?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                        <span class="sr-only">Previous</span>
                    </a>
                <?php endif; ?>
            </li>
            <?php
            for ($i = 1; $i <= $paginate->max_page; $i++):
                if ($i == $paginate->now):
                    ?>
                    <li class="page-item"><a class="page-link" href="#"><?php echo $i; ?></a></li>
                <?php else: ?>
                    <li class="page-item"><a class="page-link"
                                             href="?paginate=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                <?php
                endif;
            endfor;
            ?>
            <li class="page-item">
                <?php if ($paginate->is_end()): ?>
                    <a class="page-link" href="#" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                        <span class="sr-only">Next</span>
                    </a>
                <?php else: ?>
                    <a class="page-link" href="?paginate=<?php echo $paginate->now + 1; ?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                        <span class="sr-only">Next</span>
                    </a>
                <?php endif; ?>
            </li>
        </ul>
    </nav>
<?php else: ?>
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item">
                <?php if ($paginate->is_first()): ?>
                    <a class="page-link" href="#" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                        <span class="sr-only">Previous</span>
                    </a>
                <?php else: ?>
                    <a class="page-link" href="?is_reply=1&paginate=<?php echo $paginate->now - 1; ?>"
                       aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                        <span class="sr-only">Previous</span>
                    </a>
                <?php endif; ?>
            </li>
            <?php
            for ($i = 1; $i <= $paginate->max_page; $i++):
                if ($i == $paginate->now):
                    ?>
                    <li class="page-item"><a class="page-link" href="#"><?php echo $i; ?></a></li>
                <?php else: ?>
                    <li class="page-item"><a class="page-link"
                                             href="?is_reply=1&paginate=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                <?php
                endif;
            endfor;
            ?>
            <li class="page-item">
                <?php if ($paginate->is_end()): ?>
                    <a class="page-link" href="#" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                        <span class="sr-only">Next</span>
                    </a>
                <?php else: ?>
                    <a class="page-link" href="?is_reply=1&paginate=<?php echo $paginate->now + 1; ?>"
                       aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                        <span class="sr-only">Next</span>
                    </a>
                <?php endif; ?>
            </li>
        </ul>
    </nav>
<?php endif; ?>
<?php get_footer(); ?>
