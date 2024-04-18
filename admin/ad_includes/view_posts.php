<?php 
include("delete_modal.php");
if (isset($_POST['checkBoxArray'])) {
    foreach ($_POST['checkBoxArray'] as $checkBoxValue) {
    $options = $_POST['options'];

      switch ($options) {
        case 'published':
            $query = "UPDATE posts set post_status = '$options' where post_id = {$checkBoxValue}";
            $update_publish = mysqli_query($conn,$query);
            break;
        case 'draft':
            $query = "UPDATE posts set post_status = '$options' where post_id = {$checkBoxValue}";
            $update_draft = mysqli_query($conn,$query);
            break;
        case 'delete':
            $query = "DELETE from posts  where post_id = {$checkBoxValue}";
            $update_delete = mysqli_query($conn,$query);
            
            break;
        case 'clone':
            $query = "SELECT * FROM posts WHERE post_id = '{$checkBoxValue}' ";
            $select_post_query = mysqli_query($conn, $query);
            while($row = mysqli_fetch_array($select_post_query)) {
            $post_id = $row['post_id'];
            $post_title = $row['post_title'];
            $post_category_id = $row['post_category_id'];
            $post_date = $row['post_date'];
            $post_genration = $row['post_generation'];
            $post_user = $row['post_user'];
            $post_status = $row['post_status'];
            $post_image = $row['post_image'];
            $post_tags = $row['post_tags'];
            $post_content = $row['post_content'];
            
            $query = "INSERT INTO posts(post_category_id, post_title, post_generation,post_user, post_date, post_image, post_content, post_tags, post_status) ";
            $query .= "VALUES({$post_category_id}, '{$post_title}', '{$post_genration}','{$post_user}' , now(), '{$post_image}', '{$post_content}', '{$post_tags}', '{$post_status}') ";
            }
            $copy_query = mysqli_query($conn, $query);
            if(!$copy_query) {
                die("QUERY FAILED"  . mysqli_error($conn));
            }
            
            break;
        
       
      }

    }
}


?>


<form action="" method="post">
<table class="table table-bordered table-hover">
   <div class="row">
    <div id="bulkOptionContainer" class="col-xs-4">
    <select class="form-control" name="options" id="">
    <option value="">Select Option</option>
    <option value="published">Publish</option>
    <option value="draft">Draft</option>
    <option value="delete">Delete</option>
    <option value="clone">Clone</option>
    
    </select>
    </div>
    <input onclick="return confirm('Are you sure');" type="submit" name="submit" class="btn btn-success" value="Apply">
    <a class="btn btn-primary" href="posts.php?source=add_post">Add New</a>
    </div>
    <thead>
        <tr>

            <th><input id="selectAllBoxes" type="checkbox"></th>
            <th>Id</th>
            <th>Categories</th>
            <th>Title</th>
            <th>Users</th>
            <th>Date</th>
            <th>Status</th>

            <th>Image</th>

            <th>Content</th>
            <th>Tags</th>
            <th>Comments</th>
            <th>View post</th>
            <th>Edit</th>
            <th>Delete</th>

            <!-- <th>Status</th> -->
        </tr>
    </thead>
    <tbody>
        <?php
        $query = "SELECT * from posts order by post_id desc ";
        $select_posts = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_assoc($select_posts)) {
            $post_id = $row['post_id'];
            $post_category_id = $row['post_category_id'];
            $post_title = $row['post_title'];
            $post_genration = $row['post_generation'];
            $post_user = $row['post_user'];
            $post_date = $row['post_date'];
            $post_status = $row['post_status'];
            $post_image = $row['post_image'];
            $post_content = $row['post_content'];
            $post_tags = $row['post_tags'];
            $post_comment_count = $row['post_comment_count'];
            $post_views_count = $row['post_views_count'];

            echo "<tr>";
            ?>
            <td><input class="checkBoxes" type="checkbox" name="checkBoxArray[]" value="<?php echo $post_id; ?>"></td>
            <?php
            echo "<td>{$post_id}</td>";

            $query = "SELECT * from categories where cat_id = $post_category_id";
            $select_categories_id = mysqli_query($conn, $query);
            while ($row = mysqli_fetch_assoc($select_categories_id)) {
            $cat_id = $row['cat_id'];
            $cat_title = $row['cat_title'];
                                
            echo "<td>{$cat_title}</td>";

            }

            echo "<td>{$post_title}</td>";
            if(!empty($post_genration)){

                echo "<td>{$post_genration}</td>";
            }elseif(!empty($post_user)){
            
                echo "<td>{$post_user}</td>";
            }

            echo "<td>{$post_date}</td>";
            echo "<td>{$post_status}</td>";
            echo "<td><img height ='100' ,width='100'src ='../images/$post_image' alt='image'></td>";
            echo "<td>{$post_content}</td>";
            echo "<td>{$post_tags}</td>";

            $query = "SELECT * from comments where comment_post_id = $post_id";
            $send_comment_query = mysqli_query($conn , $query);
            $row = mysqli_fetch_array($send_comment_query);
            if(!empty($row)){
                $comment_id = $row['comment_id'];
                $count_comments = mysqli_num_rows($send_comment_query);
                echo "<td><a href='post_comments.php?id=$post_id'>$count_comments</a></td>";
                } else { 
                    $count_comments = 0;
                echo "<td></td>";
                }
            // $comment_id = $row['comment_id'];
            // $count_comments = mysqli_num_rows($send_comment_query);

            // echo "<td><a href='post_comments.php?id=$post_id'>$count_comments</a></td>";
            

            echo "<td><a href='../post.php?p_id={$post_id}'>View post</></td>";
            echo "<td><a href= 'posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";
            // echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete');\" href= 'posts.php?delete={$post_id}'>Delete</a></td>";
            echo "<td><a rel ='$post_id' href= 'javascript:void(0)'class='delete_link' >Delete</a></td>";
            
            echo "<td><a href='posts.php?reset={$post_id}'>{$post_views_count}</a></td>";
            echo "</tr>";
        }

        ?>
    </tbody>
</table>
</form>
<?php 
if (isset($_GET['delete'])) {
    $delete_id =$_GET['delete'];
    $query = "DELETE from posts where post_id = {$delete_id}";
    $delete_query = mysqli_query($conn,$query);
    header("Location: posts.php");
}
if (isset($_GET['reset'])) {
    $reset_id =$_GET['reset'];
    $query = "UPDATE posts set post_views_count = 0 where post_id =".mysqli_real_escape_string($conn,$_GET['reset'])."";
    $reset_query = mysqli_query($conn,$query);
    header("Location: posts.php");
}




?>
<script>

$(document).ready(function(){

    $(".delete_link").on('click', function(){
       var id = $(this).attr("rel");
       var delete_url ="posts.php?delete="+ id+"";

       $(".modal_delete_link").attr("href" ,delete_url);

       $("#exampleModal").modal('show');
    });
});



</script>
