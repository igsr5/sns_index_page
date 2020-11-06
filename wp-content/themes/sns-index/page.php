<?php get_header(); ?>
<div class="container">
    <div class="row head">
        <div class="col-sm-7">
            <h2 class="user-name">sora さん</h2>

            <?php if (!htmlspecialchars($_GET["scope"])): ?>
                <a href="?scope=1">自分に関する投稿すべて表示</a>
            <?php else: ?>
                <a href="?scope=0">自分の投稿のみ表示</a>
            <?php endif; ?>
        </div>
        <div class="col-sm-5 user-search">
            <form class="row" action="">
                <input class="form-control col-5 offset-1" type="text" name="user_name" placeholder="username">
                <input class="btn btn-primary col-3 ml-2" type="submit" value="検索">
            </form>
        </div>
    </div>


</div>
<?php get_footer(); ?>
