<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>

<!-- Navigation -->
<?php include "includes/navigation.php"; ?>

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
            if(isset($_POST['submit'])){
                global $conn;
                $search =  $_POST['search'];
                $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%'";
            
                $search_query= mysqli_query($conn,$query);
            
            
                if(!$search_query){
                    die("Query Failed". mysqli_error($conn));
                }
            
                $count = mysqli_num_rows($search_query);
            
                if($count == 0){
                    echo "<h2> No Result</h2>";
                }
                else {
            
            
            
            while ($row = mysqli_fetch_assoc($search_query)) {


                $post_title = $row['post_title'];
                $post_generation= $row['post_generation'];
                $post_date = $row['post_date'];
                $post_image = $row['post_image'];
                $post_content = $row['post_content'];


            ?>





                

                <!-- First Blog Post -->
                <h2>
                    <a href="#"><?php echo $post_title ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_generation ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span><?php echo $post_date ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image?>" alt="">
                <hr>
                <p><?php echo $post_content ?></p>
                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>


            <?php
            }


            
                }
            
            }
            ?>
            



         




        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php include "includes/sidebar.php" ?>

    </div>
    <!-- /.row -->

    <hr>



    <?php include "includes/footer.php" ?>