<?php if (have_posts()): ?>
    <?php
    if (isset($_GET['s']) && empty($_GET['s'])) {
        echo '検索キーワード未入力'; // 検索キーワードが未入力の場合のテキストを指定
    } else {
        echo '“'.$_GET['s'] .'”の検索結果：'; // 検索キーワードと該当件数を表示
    }
    ?>
    <ul>
        <?php while(have_posts()): the_post(); ?>
            <li>
                <a href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?></a>
            </li>
        <?php endwhile; ?>
    </ul>
<?php else: ?>
    検索されたキーワードにマッチする記事はありませんでした
<?php endif; ?>