<?php
include "ad_includes/ad_header.php";
?>
<div id="wrapper">

    <!-- Navigation -->
    <?php include "ad_includes/ad_navigation.php"; ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Welcome to comments
                        <small>Author</small>
                    </h1>
<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Author</th>
            <th>Content</th>
            <th>Email</th>
            <th>Status</th>
            <th>Date</th>
            <th>In Response</th>
            <th>Approved</th>
            <th>disapproved</th>
            <th>Delete</th>


            <!-- <th>Image</th>

            <th>Tags</th>
             -->
        </tr>
    </thead>
    <tbody> 
        <?php
        $query = "SELECT * from comments where comment_post_id =". mysqli_real_escape_string($conn,$_GET['id']) ." ";
        $select_comments = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_assoc($select_comments)) {
            $comment_id = $row['comment_id'];
            $comment_post_id = $row['comment_post_id'];
            $comment_author = $row['comment_author'];
            $comment_content = $row['comment_content'];
            $comment_email = $row['comment_email'];
            $comment_status = $row['comment_status'];
            $comment_date = $row['comment_date'];

            // $post_status = $row['post_status'];

            echo "<tr>";
            echo "<td>{$comment_id}</td>";

            // $query = "SELECT * from categories where cat_id = $post_category_id";
            // $select_categories_id = mysqli_query($conn, $query);
            // while ($row = mysqli_fetch_assoc($select_categories_id)) {
            // $cat_id = $row['cat_id'];
            // $cat_title = $row['cat_title'];

            // echo "<td>{$cat_title}</td>";

            // }

            // echo "<td>{$comment_post_id}</td>";
            echo "<td>{$comment_author}</td>";
            echo "<td>{$comment_content}</td>";
            echo "<td>{$comment_email}</td>";
            echo "<td>{$comment_status}</td>";
            echo "<td>{$comment_date}</td>";
            
            $query = "SELECT * from posts where post_id = $comment_post_id";
            $select_post_id_query = mysqli_query($conn,$query);

            while ($row = mysqli_fetch_assoc($select_post_id_query)) {
            $post_id = $row['post_id'];
            $post_title = $row['post_title'];

            
            echo "<td><a href= '../post.php?p_id=$post_id'>$post_title</a></td>";
            

            }

           

            echo "<td><a href= 'post_comments.php?approve=$comment_id&id=".$_GET['id']."'>Approve</a></td>";
            echo "<td><a href= 'post_comments.php?disapprove=$comment_id&id=".$_GET['id']."'>Dispprove</a></td>";
            
            echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete');\" href= 'post_comments.php?delete=$comment_id&id=".$_GET['id']."'>Delete</a></td>";


            echo "</tr>";
        }

        ?>
    </tbody>
</table>
<?php
if (isset($_GET['approve'])) {
    $approve_comment_id = $_GET['approve'];
    $query = "UPDATE comments set comment_status = 'approved' where comment_id = $approve_comment_id ";
    $approve_query = mysqli_query($conn, $query);
    header("Location:  post_comments.php?id=".$_GET['id']."");
}

if (isset($_GET['disapprove'])) {
    $disapprove_comment_id = $_GET['disapprove'];
    $query = "UPDATE comments set comment_status = 'disapproved' where comment_id = $disapprove_comment_id ";
    $disapprove_query = mysqli_query($conn, $query);
    header("Location:  post_comments.php?id=".$_GET['id']."");
}


if (isset($_GET['delete'])) {
    $delete_comment_id = $_GET['delete'];
    $query = "DELETE from comments where comment_id = {$delete_comment_id}";
    $delete_query = mysqli_query($conn, $query);
    header("Location: post_comments.php?id=".$_GET['id']."");
}




?>

</div>
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->
<?php
include "ad_includes/ad_footer.php";
?>