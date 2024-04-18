<?php


if (isset($_POST['create_user'])) {
    global $conn;

    $user_name = $_POST['user_name'];
    $user_password = $_POST['user_password'];
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_email = $_POST['user_email'];
    // $user_image = $row['user_image'];
    $user_role = $_POST['user_role'];
    
    // $post_date = date('d-m-y');

    // $post_image = $_FILES ['image']['name'];
    // $post_image_temp = $_FILES ['image']['tmp_name'];

    // move_uploaded_file($post_image_temp, "../images/$post_image");
    $user_password = password_hash($user_password, PASSWORD_BCRYPT , array('cost' => 12 ));

    $query = "INSERT into users (user_name,user_password,user_firstname,user_lastname,user_email,user_role) values ('{$user_name}','{$user_password}','{$user_firstname}','{$user_lastname}','{$user_email}','{$user_role}')";
    $insert_user_query = mysqli_query($conn, $query);
    confirm($insert_user_query);

    echo "User Created:  "." "." <a href= 'users.php' >View Users </a> ";



}

?>






<form action="" method="POST" enctype="multipart/form-data">



    <div class="form-group">
        <label for="user_firstname">First Name:</label>
        <input type="text" class="form-control" name="user_firstname">
    </div>

    <div class="form-group">
        <label for="user_lastname">Last Name:</label>
        <input type="text" class="form-control" name="user_lastname">
    </div>

    <div class="form-group">
        <select name="user_role" id="">
            <option value="#">Select options</option>
            <option value="admin">Admin</option>
            <option value="subscribe">Subscribe</option>
        </select>
    </div>


    <div class="form-group">
        <label for="user_name">Username:</label>
        <input type="text" class="form-control" id="user_name" name="user_name">
    </div>

    <!-- <div class="form-group">
        <label for="image">Image:</label>
        <input type="file" class="form-control" id="image" name="image">
    </div> -->



    <div class="form-group">
        <label for="user_email">Email:</label>
        <input type="text" class="form-control" id="user_email" name="user_email">
    </div>

    <div class="form-group">
        <label for="user_password">Password:</label>
        <input type="password" class="form-control" id="user_password" name="user_password">
    </div>

    <input type="submit" class="btn btn-primary" value="Add Users" name="create_user">
</form>