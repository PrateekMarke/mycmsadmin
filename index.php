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
            $per_post = 2; // how many post will show in 1 page
            if (isset($_GET['page'])) {
                $page = $_GET['page'];
            } else {
                $page = "";
            }
            if ($page == "" || $page == 1) {
                $page_1 = 0; //1st page
            } else {
                $page_1 = ($page * $per_post) - $per_post; // formula to set which post no. will start from next page
            }
            if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin' ) {
                $post_query_count = "SELECT * from posts";

            }else {
                $post_query_count = "SELECT * from posts where post_status = 'published' ";

            }

            //counting posts
            
            $find_count = mysqli_query($conn, $post_query_count);
            $count = mysqli_num_rows($find_count);
            if ($count < 1) {
               echo "<h1 class='text-center'>No Posts Available</h1>
               ";
            }else {
                
            


            $count = ceil($count / $per_post);




            $qurey = "Select * From posts limit $page_1 , $per_post ";
            $select_all_post = mysqli_query($conn, $qurey);

            while ($row = mysqli_fetch_assoc($select_all_post)) {
                $post_id = $row['post_id'];
                $post_title = $row['post_title'];
                $post_generation = $row['post_user'];
                $post_date = $row['post_date'];
                $post_image = $row['post_image'];
                $post_content = substr($row['post_content'], 0, 100);
                $post_status = $row['post_status'];
               
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
                        <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                    </a>

                    <hr>
                    <p><?php echo $post_content ?></p>
                    <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                    <hr>
            <?php
                }
                
            }


            ?>


            <!-- First Blog Post -->



        </div>





        <!-- Blog Sidebar Widgets Column -->
        <?php include "includes/sidebar.php";  ?>
    </div>
    <!-- /.row -->

    <hr>
    <ul class="pager">
        <?php
        if($page != 1 && $page != ""){

            $prev_page = $page - 1;
            
            echo "<li><a href='index.php?page={$prev_page}'>PREV</a></li>";
            
            }
            
            for($i = 1; $i <= $count ; $i++){
            
            if($i == $page || ($i == 1 && $page == null)){
            
            echo "<li><a class='active_link' href='index.php?page={$i}'>{$i}</a></li>";
            
            } else {
            
            echo "<li><a href='index.php?page={$i}'>{$i}</a></li>";
            
            }
            
            }
            
            if($page != $count && $page != ""){
            
            $next_page = $page + 1;
            
            echo "<li><a href='index.php?page={$next_page}'>NEXT</a></li>";
            
            }
      

        ?>

    </ul>

    <!-- footer -->
    <?php include "includes/footer.php"; ?>