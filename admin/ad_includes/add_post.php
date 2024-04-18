
<?php 


if (isset($_POST['create_post'])) {
    global $conn;


        $post_category_id = $_POST['post_category'];
        $post_title = $_POST['title'];
        $post_user = $_POST['post_user'];
        $post_date = date('d-m-y');
        
        $post_image = $_FILES ['image']['name'];
        $post_image_temp = $_FILES ['image']['tmp_name'];
        
        $post_content = $_POST['content'];
        $post_tags = $_POST['tags'];
       // $post_comment_count = $_POST['comment_count'];
        $post_status = $_POST['status'];
        
        move_uploaded_file($post_image_temp, "../images/$post_image");

        $query = "INSERT into posts (post_category_id,post_title,post_user,post_date,post_image,post_content,post_tags,post_status) values ('{$post_category_id}','{$post_title}','{$post_user}',now(),'{$post_image}','{$post_content}','{$post_tags}','{$post_status}')";
        $insert_post_query = mysqli_query($conn,$query);

        confirm($insert_post_query);

        $the_post_id = mysqli_insert_id($conn);

        echo "Post Created:  "." "." <a href='../post.php?p_id={$the_post_id}'>View Post</a> or <a href= 'posts.php' >View other Posts </a> ";    

        
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
                
        
        
        echo "<option value='$cat_id'>$cat_title</option>";

        }
      
    ?>
    </select>
           
    </div>

    <div class="form-group">
        <label for="title">Post Title:</label>
        <input type="text" class="form-control" name="title">
    </div>

    <!-- <div class="form-group">
        <label for="user">user:</label>
        <input type="text" class="form-control" id="user" name="user">
    </div> -->
    <div class="form-group">
    <label for="users">Users</label>
    <select name="post_user" id="">

    
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
    <label for="image">Status:</label>
        <select name="status" id="">
            <option value="#">Select options</option>
            <option value="published">Publish</option>
            <option value="draft">Draft</option>
        </select>
    </div>

    <div class="form-group">
        <label for="image">Image:</label>
        <input type="file" class="form-control" id="image" name="image">
    </div>

    <div class="form-group">
        <label for="summernote">Content:</label>
        <textarea id="summernote" class="form-control" name="content" rows="4" cols="50"></textarea>
    </div>

    <div class="form-group">
        <label for="tags">Tags:</label>
        <input type="text" class="form-control" id="tags" name="tags">
    </div>

    <div class="form-group">
        <label for="comment_count">Comment Count:</label>
        <input type="number" class="form-control" id="comment_count" name="comment_count">
    </div>

    <input type="submit" class="btn btn-primary" value="Submit" name="create_post">
</form>