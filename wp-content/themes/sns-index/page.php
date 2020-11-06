<?php get_header(); ?>

<?php
$array=[1, 2, 3, 4, 5];
?>
<div class="container">

    <div class="row head mt-4 pb-3">
        <div class="col-sm-7">
            <h2 class="user-name">市古空</h2>

            <?php if (!$_GET["scope"]): ?>
                <a href="?scope=1">自分に関する投稿すべて表示</a>
            <?php else: ?>
                <a href="?scope=0">自分の投稿のみ表示</a>
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
                <?php foreach ($array as $item): ?>
                    <li class="card"><?php echo $item; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>

        <!--Facebook-->
        <div class="facebook mb-5">
            <h3 class="sns-name mb-4">Facebook</h3>
            <ul class="posts">
                <?php foreach ($array as $item): ?>
                    <li class="card"><?php echo $item; ?></li>
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
