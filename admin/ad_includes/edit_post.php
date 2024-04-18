<?php
if (isset($_GET['p_id'])) {
    $the_post_id = $_GET['p_id'];
}

$query = "SELECT * from posts where  post_id = $the_post_id ";
$select_posts = mysqli_query($conn, $query);
while ($row = mysqli_fetch_assoc($select_posts)) {
    // $post_id = $row['post_id'];
    $post_category_id = $row['post_category_id'];
    $post_title = $row['post_title'];
    $post_user = $row['post_user'];

    $post_date = $row['post_date'];
    $post_image = $row['post_image'];
    $post_content = $row['post_content'];
    $post_tags = $row['post_tags'];
    $post_comment_count = $row['post_comment_count'];
    $post_status =$row['post_status'];
    // $post_status = $row['post_status'];

}

if (isset($_POST['update_post'])) {
    //$post_id = $_POST['id'];
    $post_category_id = $_POST['post_category'];
    $post_title = $_POST['title'];
    $post_user = $_POST['post_user'];
    

    $post_image = $_FILES ['image']['name'];
    $post_image_temp = $_FILES ['image']['tmp_name'];

    $post_status = $_POST['status'];
    $post_content = $_POST['content'];
    $post_tags = $_POST['tags'];
    $post_comment_count = $_POST['comment_count'];
    move_uploaded_file($post_image_temp, "../images/$post_image");

    if (empty($post_image)) {
        $query = "SELECT * from posts where  post_id = $the_post_id ";
        $select_posts = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_assoc($select_posts)) {
            $post_image = $row['post_image'];
        }
    }


    $query ="UPDATE posts set post_category_id ='{$post_category_id }' ,post_title ='{$post_title}', post_user ='{$post_user}',post_status ='{$post_status}', post_image ='{$post_image}', post_content ='{$post_content}', post_tags ='{$post_tags}', post_comment_count ='{$post_comment_count }' where post_id = '{$the_post_id}' ";

    $update_post = mysqli_query($conn,$query);
    confirm($update_post);
    echo "<p>Post Updated. <a href='../post.php?p_id={$the_post_id}'>View Post</a> or <a href='posts.php?p_id={$the_post_id}'>edit more post..</a> </p>";
    // header("Location: posts.php");
} 





?>


<form action="" method="POST" enctype="multipart/form-data">
    <div class="form-group">
    <label for="category">Categories</label>
    <select name="post_category" id="">
   
    
    <?php 
    $query="SELECT * FROM categories" ; 
    $select_categories = mysqli_query($conn,$query);
    confirm($select_categories); 
    while ($row= mysqli_fetch_assoc($select_categories))
    {
        $cat_id=$row['cat_id'];
        $cat_title = $row['cat_title'];
                
        if ($cat_id == $post_category_id) {
            echo "<option selected value='$cat_id'>$cat_title</option>";

        }
        else {
            echo "<option value='$cat_id'>$cat_title</option>";
        }
        
        

        }
    
        
    ?>
   
    </select>
           
    </div>

    <div class="form-group">
        <label for="title">Post Title:</label>
        <input value="<?php echo $post_title; ?>" type="text" class="form-control" name="title">
    </div>

    <div class="form-group">
    <label for="users">Users</label>
    <select name="post_user" id="">

<?php echo "<option value='$post_user'>$post_user</option>"; ?>

    
    <?php 
    $query="SELECT * FROM users" ; 
    $select_user = mysqli_query($conn,$query);
    confirm($select_user); 
    while ($row= mysqli_fetch_assoc($select_user))
    {
        $user_id=$row['user_id'];
        $user_name = $row['user_name'];

        echo "<option value='{$user_name}'>$user_name</option>";

        }
      
    ?>
    </select>
           
    </div>
    <div class="form-group">
        <label for="status">Status:</label>
        <select name="status" id="">
        <option value="<?php echo $post_status ?>"><?php echo $post_status ?></option> 
        <?php
    if ($post_status == 'published') {
        echo "<option value='draft'>Draft</option>";
    }
    else {
        echo "<option value='published'>Publish</option>";
    }

        ?>
        </select>
    </div>

    <div class="form-group">
        <label for="image">Image:</label>
        <img width="100" src="../images/<?php echo $post_image ?>" alt="">
        <input type="file" class="form-control" id="image" name="image">

    </div>

    <div class="form-group">
        <label for="summernote">Content:</label>
        <textarea id="summernote" class="form-control" name="content" rows="4" cols="50">
        <?php echo str_replace('\r\n','</br>',$post_content) ; ?></textarea>
    </div>

    <div class="form-group">
        <label for="tags">Tags:</label>
        <input value="<?php echo $post_tags; ?>" type="text" class="form-control" id="tags" name="tags">
    </div>

    <div class="form-group">
        <label for="comment_count">Comment Count:</label>
        <input value="<?php echo $post_comment_count; ?>" type="number" class="form-control" id="comment_count" name="comment_count">
    </div>

    <input type="submit" class="btn btn-primary" value="Update" name="update_post">
</form>