<div class="pag_block">
    <nav>
        <ul class="pagination">
            <li class="<?php if($page==1){echo 'disabled';}?>">
                <a href="<?= urlConstructor($GET, $location, ['page'=>$page>1?$page-1:1])?>"  aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            <?php
            for($i=1;$i<=$totalPages;$i++){?>
                <li class="<?php if($i==$page){echo 'active';}?>">
                    <a href="<?= urlConstructor($GET, $location, ['page'=>$i])?>"><?= $i?></a>
                </li>
                <?php
                if($i%5===0){
                    echo '</br>';
                }
            }
            ?>
            <li class="<?php echo $page==$totalPages?'disabled':'';?>">
                <a href="<?= urlConstructor($GET, $location, ['page'=>$page==$totalPages?$page:$page+1])?>" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>
</div>