<div class="container-fluid cat_nav bg-white py-3">
    <div class="row">
        <nav class="pn-ProductNav">
            <div class="pn-ProductNav_Contents">
                <a href="store" class="pn-ProductNav_Link" aria-selected="<?php if(!isset($_GET['cat'])){echo 'true';}else{echo 'false';}?>">All</a>
                <?php getCats(); ?>
            </div>
        </nav>
    </div>
</div>


