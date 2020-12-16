<?php
global $twitter_name;
global $twitter_posts;
global $twitter
?>

<a href="<?php echo home_url('/twitter'), "?user_name=", $twitter_name; ?>">
    <h3 class="sns-name mb-4">Twitter</h3>
</a>
<div class="top-twitter mb-5">
    <ul class="top-posts">
        <?php foreach ($twitter_posts as $item): ?>
            <li class="card" style="overflow: scroll;">
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
