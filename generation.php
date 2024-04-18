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

            global $conn;
            if (isset($_GET['p_id'])) {
                $the_post_id = $_GET['p_id'];
                $the_post_generation = $_GET['generation'];
                
            }

            $query = "SELECT * From posts Where post_user = '$the_post_generation'";
            $select_all_post = mysqli_query($conn, $query);

            while ($row = mysqli_fetch_assoc($select_all_post)) {
                $post_title = $row['post_title'];
                $post_generation = $row['post_user'];
                $post_date = $row['post_date'];
                $post_image = $row['post_image'];
                $post_content = $row['post_content'];
            ?>


                <!-- First Blog Post -->
                <h2>
                    <a href="#"> <?php echo $post_title ?></a>
                </h2>
                <p class="lead">
                    from <?php echo $post_generation ?>
                </p>
                <p><span class="glyphicon glyphicon-time"></span><?php echo $post_date ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                <hr>
                <p><?php echo $post_content ?></p>


                <hr>

            <?php } 
            ?>

            </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php include "includes/sidebar.php";  ?>
    </div>
    <!-- /.row -->

    <hr>
    <!-- footer -->
    <?php include "includes/footer.php"; ?>