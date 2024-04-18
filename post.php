<?php include "includes/header.php" ?>
<!-- navigation -->
<?php include "includes/navigation.php" ?>


<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">
            <h1 class="page-header">
                Posts
            </h1>
            <?php

            global $conn;
            if (isset($_GET['p_id'])) {
                $the_post_id = $_GET['p_id'];
            
            $view_query = "UPDATE posts set post_views_count = post_views_count + 1  where post_id = $the_post_id";
            $send_query = mysqli_query($conn,$view_query);

            if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin' ) {
                $query = "Select * From posts Where post_id = $the_post_id";

            }else {
                $query = "Select * From posts Where post_id = $the_post_id And post_status = 'published'";

            }
            
            $select_all_post = mysqli_query($conn, $query);
        
            if (mysqli_num_rows($select_all_post)< 1) {
                    echo "<h1 class='text-center'>No Posts Available</h1>";
                }else {
                    
            while ($row = mysqli_fetch_assoc($select_all_post)) {
                
                
                $post_title = $row['post_title'];
                $post_generation = $row['post_generation'];
                $post_date = $row['post_date'];
                $post_image = $row['post_image'];
                $post_content = $row['post_content'];
            ?>


                <!-- First Blog Post -->
                <h2>
                    <a href="#"> <?php echo $post_title ?></a>
                </h2>
                <p class="lead">
                    from <a href="index.php"><?php echo $post_generation ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span><?php echo $post_date ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                <hr>
                <p><?php echo $post_content ?></p>


                <hr>

            <?php } 
           
            ?>

            
            <!-- Blog comment -->
            <?php 
            if (isset($_POST['create_comment'])) {
                $the_post_id = $_GET['p_id'];

                $comment_author = $_POST['comment_author'];
                $comment_email = $_POST['comment_email'];
                $comment_content = $_POST['comment_content'];
                if (!empty($comment_author) && !empty($comment_email) &&!empty($comment_content) ) {
                    $query = "INSERT into comments (comment_post_id, comment_author, comment_email, comment_content, comment_status,comment_date) values ($the_post_id , '{$comment_author}', '{$comment_email}', '{$comment_content}','disapproved',now())" ;
                
                $create_comment_query = mysqli_query($conn,$query);

                

                // $query ="UPDATE posts set post_comment_count = post_comment_count + 1 where $the_post_id ";

                // $update_cmt_count = mysqli_query($conn, $query);
                }
            else {
                echo "<script>alert('Fields cannot be empty')</script>";
            }

               

            }
            
            
            // header("Location: /cms/post.php?p_id=$the_post_id")
            
            ?>

            

            <!-- Comments Form -->
            <div class="well">
                <h4>Leave a Comment:</h4>
                <form action="" method="post" role="form">

                    <div class="form-group">
                        <label for="author">Author</label>
                        <input type="text" class="form-control" name="comment_author">
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="comment_email">
                    </div>

                    <div class="form-group">
                        <label for="comment">Comment</label>
                        <textarea name="comment_content" class="form-control" rows="3"></textarea>
                    </div>
                    <button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
                </form>
            </div>

            <hr>

            <!-- Posted Comments -->
            <?php
            $query = "SELECT * from comments where comment_post_id = {$the_post_id} and comment_status = 'approved' order by comment_id desc";
            $select_comment_query = mysqli_query($conn,$query);

            while ($row = mysqli_fetch_assoc($select_comment_query)) {
                $comment_date = $row['comment_date'];
                $comment_content = $row['comment_content'];
                $comment_author = $row['comment_author'];
                ?>
            <!-- Comment -->
            <div class="media">


            
                <a class="pull-left" href="#">
                    <img class="media-object" src="http://placehold.it/64x64" alt="">
                </a>
                <div class="media-body">
                    <h4 class="media-heading"><?php echo $comment_author; ?>
                        <small> <?php echo $comment_date; ?> </small>
                    </h4>
                    <?php echo $comment_content; ?>
                   
                     
                </div>
            </div>







               <?php }  } }
            else {
            header("Location: index.php");
            }?>

           






            

        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php include "includes/sidebar.php";  ?>
    </div>
    <!-- /.row -->

    <hr>
    <!-- footer -->
    <?php include "includes/footer.php"; ?>