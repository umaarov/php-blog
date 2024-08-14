<?php
$title = "Blog";
require "includes/header.php";
require 'database.php';

$statement = $pdo->prepare("SELECT * FROM posts");
$statement->execute();

$posts = $statement->fetchAll();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['DEL'])) {

    // var_dump($_POST);

    $post_id = $_POST['post_id'];

    $statement = $pdo->prepare("DELETE FROM posts WHERE id = ?");
    $statement->execute([$post_id]);

    $_SESSION['post-deleted'] = 'Post Successfully Deleted';

    header("Location: blog.php");
    exit;
}
// var_dump($posts[0]);
// if (isset($_SESSION["post-created"])) {
// $message = $_SESSION["post-created"];
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

        <?php if (isset($_SESSION["post-deleted"])): ?>
            <div class="alert alert-danger" role="alert">
                <?= $_SESSION["post-deleted"] ?>
                <?php unset($_SESSION["post-deleted"]) ?>
            </div>
        <?php endif; ?>

        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            <?php foreach ($posts as $post): ?>
                <div class="col">
                    <div class="card shadow-sm">
                        <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false">
                            <title>Placeholder</title>
                            <rect width="100%" height="100%" fill="#55595c" /><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text>
                        </svg>
                        <div class="card-body">

                            <a href="post.php?id=<?= $post['id'] ?>">
                                <h5 class="card-text"><?= $post["title"]; ?></h5>
                            </a>

                            <p class="card-text"><?= $post["body"]; ?></p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>

                                    <form method="POST">
                                        <input type="hidden" name="post_id" value="<?= $post['id'] ?>">
                                        <input type="hidden" name="DEL">
                                        <button type="submit" class="btn btn-sm btn-outline-secondary">Delete</button>
                                    </form>
                                </div>
                                <small class="text-body-secondary"><?= $post["created_at"]; ?></small>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>
    </div>
</div>


<?php require "includes/footer.php" ?>