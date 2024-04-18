<?php
if (isset($_GET['u_id'])) {
    $the_user_id = $_GET['u_id'];


$query = "SELECT * from users where  user_id = $the_user_id ";
$select_user = mysqli_query($conn, $query);
while ($row = mysqli_fetch_assoc($select_user)) {
    $user_name = $row['user_name'];
    $user_password = $row['user_password'];
    $user_firstname = $row['user_firstname'];
    $user_lastname = $row['user_lastname'];
    $user_email = $row['user_email'];
    // $user_image = $row['user_image'];
    $user_role = $row['user_role'];

   
}


if (isset($_POST['Edit_User'])) {
    // $user_image = $_FILES ['image']['name'];
    // $post_image_temp = $_FILES ['image']['tmp_name'];
    // move_uploaded_file($post_image_temp, "../images/$post_image");
    // if (empty($post_image)) {
    //     $query = "SELECT * from posts where  post_id = $the_post_id ";
    //     $select_posts = mysqli_query($conn, $query);
    //     while ($row = mysqli_fetch_assoc($select_posts)) {
    //         $post_image = $row['post_image'];
    //     }
    // }
    ?>
    
    
    <h5>User Updated <a href="users.php">View users</a></h5>
    
    <?php
    
    $user_name = $_POST['user_name'];
    $user_password = $_POST['user_password'];
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_email = $_POST['user_email'];
    // $user_image = $row['user_image'];
    $user_role = $_POST['user_role'];



if (!empty($user_password)) {
    $query_password = "SELECT user_password FROM users WHERE user_id = $the_user_id";
    $get_user = mysqli_query($conn, $query_password);

    $row = mysqli_fetch_array($get_user);

    $db_user_password = $row['user_password'];

    if ($db_user_password != $user_password) {
        $hashed_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 12));
    }


    $query = "UPDATE users set user_name = '$user_name' , user_password ='{$hashed_password}', user_firstname ='{$user_firstname}', user_lastname ='{$user_lastname}', user_email ='{$user_email}', user_role ='{$user_role}'  WHERE user_id = '{$the_user_id}' ";

    $update_user = mysqli_query($conn, $query);
    
    // header("Location: users.php");
}}}
else{

header("Location: index.php");
}




?>


<form action="" method="POST" enctype="multipart/form-data">



    <div class="form-group">
        <label for="user_firstname">First Name:</label>
        <input value="<?php echo $user_firstname ?>" type="text" class="form-control" name="user_firstname">
    </div>

    <div class="form-group">
        <label for="user_lastname">Last Name:</label>
        <input value="<?php echo $user_lastname ?>" type="text" class="form-control" name="user_lastname">
    </div>

    <div class="input-group mb-3">
        <label for="title">Role: </label>
        <select class="form-control" name="user_role" id="">
            <option value="subscriber"><?php echo $user_role ?></option>
            <?php
            if ($user_role == "admin") {
                echo " <option value='subscriber'>Subscriber</option>";
            } else {
                echo "<option value='admin'>Admin</option>";
            }





            ?>
        </select>
    </div>


    <div class="form-group">
        <label for="user_name">Username:</label>
        <input value="<?php echo $user_name ?>" type="text" class="form-control" id="user_name" name="user_name">
    </div>

    <!-- <div class="form-group">
        <label for="image">Image:</label>
        <input type="file" class="form-control" id="image" name="image">
    </div> -->



    <div class="form-group">
        <label for="user_email">Email:</label>
        <input value="<?php echo $user_email ?>" type="text" class="form-control" id="user_email" name="user_email">
    </div>

    <div class="form-group">
        <label for="user_password">Password:</label>
        <input autocomplete="off" type="password" class="form-control" id="user_password" name="user_password">
    </div>

    <input type="submit" class="btn btn-primary" value="Update Users" name="Edit_User">
</form>