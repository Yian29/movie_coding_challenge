<?php include_once('layout/header.php'); ?>

    <div class="col">
        <h1 class="mt-3">Movie - Coding Challenge</h1>
    </div>
    
    <?php require_once('layout/add.php'); ?>

    <?php require_once('layout/edit.php'); ?>

    <?php require_once('layout/delete.php'); ?>

    <div class="col mt-3" id="display_movie">
        <!-- MOVIE DISPLAYED HERE -->
    </div>


<?php include_once('layout/footer.php'); ?>
