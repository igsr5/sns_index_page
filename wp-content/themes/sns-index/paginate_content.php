<?php
global $paginate;
if (!$_GET["is_reply"]):
    ?>
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