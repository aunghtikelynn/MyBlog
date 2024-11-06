<?php
    include "layouts/navbar.php";
    include "dbconnect.php";


    if(isset($_GET['category_id'])){
        $category_id = $_GET['category_id'];
        $sql = "SELECT * FROM posts WHERE posts.category_id = :categoryID ORDER BY id DESC";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':categoryID',$category_id);
        $stmt->execute();
        $posts = $stmt->fetchAll();
    }else{
        // 18446744073709551615 သည် MySQL ရဲ့ အကြီးဆုံး Value
        $sql = "SELECT * FROM posts ORDER BY id DESC LIMIT 18446744073709551615 OFFSET 1";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $posts = $stmt->fetchAll();

        $sql = "SELECT * FROM posts ORDER BY id DESC LIMIT 1";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $latest_post = $stmt->fetch();
    }
    // var_dump($posts);
?>

<!-- Page header with logo and tagline-->
<header class="py-5 bg-light border-bottom mb-4">
    <div class="container">
        <div class="text-center my-5">
            <h1 class="fw-bolder">Welcome to Lynn's Blog!</h1>
            <p class="lead mb-0">I learn for me. I share for you.</p>
        </div>
    </div>
</header>
<!-- Page content-->
<div class="container">
    <div class="row">
        <!-- Blog entries-->
        <div class="col-lg-8">
            <?php
                if(isset($_GET['category_id'])){

                }else{
            ?>
                <!-- Featured blog post-->
                <div class="card mb-4">
                    <a href="#!"><img class="card-img-top" src="admin/<?= $latest_post['image'] ?>" alt="..." /></a>
                    <div class="card-body">
                        <div class="small text-muted"><?= date('F d, Y',strtotime($latest_post['create_at'])) ?></div>
                        <h2 class="card-title"><?= $latest_post['title'] ?></h2>
                        <p class="card-text"><?= substr(strip_tags($latest_post['description']),0,150) ?>.....</p>
                        <a class="btn btn-primary" href="detail.php?id=<?= $latest_post['id'] ?>">Read more →</a>
                    </div>
                </div>
            <?php } ?>
            <!-- Nested row for non-featured blog posts-->
            <div class="row">
            <?php
                foreach($posts as $post){
            ?>
                <div class="col-lg-6">
                    <!-- Blog post-->
                     <!-- substr(string, start, number) -->
                    <div class="card mb-4">
                        <a href="#!"><img class="card-img-top" src="admin/<?= $post['image']?>" alt="..." /></a>
                        <div class="card-body">
                            <div class="small text-muted"><?= date('F d, Y',strtotime($post['create_at']))?></div>
                            <h2 class="card-title h4"><?= $post['title']?></h2>
                            <p class="card-text"><?= substr(strip_tags($post['description']),0,150) ?></p>
                            <a class="btn btn-primary" href="detail.php?id=<?= $post['id'] ?>">Read more →</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
            </div>
            
        </div>
        
<?php
    include "layouts/footer.php"
?>
