<?php
$title = "Blog";
require "includes/header.php";
// if (isset($_SESSION["post-created"])) {
//     $message = $_SESSION["post-created"];
// }

?>


<section class="py-5 text-center container">
    <div class="row py-lg-5">
        <div class="col-lg-6 col-md-8 mx-auto">
            <h1 class="fw-light">Our Blog</h1>
            <p class="lead text-body-secondary">Something short and leading about the collection below—its contents, the creator, etc. Make it short and sweet, but not too short so folks don’t simply skip over it entirely.</p>
            <p>
                <a href="post-create.php" class="btn btn-primary my-2">Create post</a>
                <a href="#" class="btn btn-secondary my-2">Home</a>
            </p>
        </div>
    </div>
</section>

<div class="album py-5 bg-body-tertiary">
    <div class="container">


        <?php if (isset($_SESSION["post-created"])): ?>
            <div class="alert alert-success" role="alert">
                <?= $_SESSION["post-created"] ?>
                <?php unset($_SESSION["post-created"]) ?>
            </div>
        <?php endif; ?>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">

        </div>
    </div>
</div>


<?php require "includes/footer.php" ?>