<?php
    include "../layouts/navbar_side.php";

    include "../../dbconnect.php";
    $sql = "SELECT posts.*, categories.name as c_name, users.name as u_name FROM posts INNER JOIN categories ON posts.category_id = categories.id INNER JOIN users ON posts.user_id = users.id";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $posts = $stmt->fetchAll();
    // var_dump($posts);

?> 

<div class="container my-5">
    <div class="mb-5">
        <h3 class="d-inline">Posts Lists</h3>
        <a href="" class="btn btn-primary float-end">Create Posts</a>
    </div>
    <div class="card">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Author</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $j = 1;
                    foreach($posts as $post){
                ?>
                    <tr>
                        <td><?= $j++ ?></td>
                        <td><?= $post['title'] ?></td>
                        <td><?= $post['c_name'] ?></td>
                        <td><?= $post['u_name'] ?></td>
                        <td>
                            <button class="btn btn-sm btn-warning">Edit</button>
                            <button class="btn btn-sm btn-danger">Delete</button>
                            <a class="btn btn-sm btn-primary" href="../../detail.php?id=<?= $post['id'] ?>" target="_blank">Detail</a>
                        </td>
                    </tr>
                <?php } ?>

            </tbody>
            <tfoot>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Author</th>
                    <th>Action</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<?php
    include "../layouts/footer.php"
?>