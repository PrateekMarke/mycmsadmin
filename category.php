<?php include "includes/header.php" ?>
<!-- navigation -->
<?php include "includes/navigation.php" ?>
   

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
            <h1 class="page-header">
                    Pokemon
                    <small>Catch them all</small>
                </h1>
                <?php
                if (isset($_GET['category'])) {
                   $post_catergory_id = $_GET['category'];
                if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin' ) {
                    $qurey = "SELECT * From posts where post_category_id = $post_catergory_id ";
    
                }else {
                    $qurey = "SELECT * From posts where post_category_id = $post_catergory_id And post_status = 'published';";
    
                }
                

                
                $select_all_post = mysqli_query($conn,$qurey);
                if (mysqli_num_rows($select_all_post)< 1) {
                    echo "<h1 class='text-center'>No Posts Available</h1>
               ";
                }else {
                    
                
                while ($row = mysqli_fetch_assoc($select_all_post )) {
                $post_id = $row['post_id'];
                $post_title = $row['post_title'];
                $post_generation = $row['post_generation'];
                $post_date = $row['post_date'];
                $post_image = $row['post_image'];
                $post_content = substr($row['post_content'],0,100);
                ?>
                

                <!-- First Blog Post -->
                <h2>
                    <a href="post.php?p_id=<?php echo $post_id ?>"> <?php echo $post_title ?></a>
                </h2>
                <p class="lead">
                    from <a href="index.php"><?php echo $post_generation ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span><?php echo $post_date ?></p>
                <hr>
                
                <img class="img-responsive" src="images/<?php echo $post_image ; ?>" alt="">
                <hr>
                <p><?php echo $post_content ?></p>
                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>
            <?php } }} else {
                header("Location: index.php");
            }
                ?>

              

               

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php";  ?>
        </div>
        <!-- /.row -->

        <hr>
    <!-- footer -->
     <?php include "includes/footer.php"; ?>
