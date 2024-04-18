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
                $qurey = "Select * From posts";
                $select_all_post = mysqli_query($conn,$qurey);
                
                while ($row = mysqli_fetch_assoc($select_all_post )) {
                $post_id = $row['post_id'];
                $post_title = $row['post_title'];
                $post_generation = $row['post_generation'];
                $post_date = $row['post_date'];
                $post_image = $row['post_image'];
                $post_content = substr($row['post_content'],0,100);
                $post_status = $row['post_status'];
                if ($post_status == 'published') {
                  ?>
                      <h2>
                    <a href="post.php?p_id=<?php echo $post_id ?>"> <?php echo $post_title ?></a>
                </h2>
                <p class="lead">
                    from <a href="generation.php?generation=<?php echo $post_generation ?>&p_id=<?php echo $post_id ?>"><?php echo $post_generation ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span><?php echo $post_date ?></p>
                <hr>
                <a href="post.php?p_id=<?php echo $post_id ?>">
                <img class="img-responsive" src="images/<?php echo $post_image ; ?>" alt="">
                </a>

                <hr>
                <p><?php echo $post_content ?></p>
                <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>
                <?php
                } }
               
               
                ?>
                

                <!-- First Blog Post -->
            
            

            </div>
              

               


            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php";  ?>
        </div>
        <!-- /.row -->

        <hr>
    <!-- footer -->
     <?php include "includes/footer.php"; ?>
