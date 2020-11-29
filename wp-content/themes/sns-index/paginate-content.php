<?php
global $page_id;
global $max_page;
?>
<nav aria-label="Page navigation example">
    <ul class="pagination">
        <?php if ($page_id <= 0): ?>
            <li class="page-item"><a class="page-link" href="#">Previous</a></li>
        <?php else: ?>
            <li class="page-item"><a class="page-link" href="?paginate=<?php echo $page_id - 1; ?>">Previous</a>
            </li>
        <?php endif; ?>

        <?php if ($page_id >= $max_page): ?>
            <li class="page-item"><a class="page-link" href="#">Next</a></li>
        <?php else: ?>
            <li class="page-item"><a class="page-link" href="?paginate=<?php echo $page_id + 1; ?>">Next</a>
            </li>
        <?php endif; ?>
    </ul>
</nav>