<?php get_header(); ?>
<div class="container">
    <h2 class="user-name">sora さん</h2>

    <?php if(!htmlspecialchars($_GET["tag"])): ?>
    <a href="?tag=1">自分に関する投稿すべて表示</a>
    <?php else: ?>
    <a href="?tag=0">自分の投稿のみ表示</a>
    <?php endif; ?>
</div>
<?php get_footer(); ?>
