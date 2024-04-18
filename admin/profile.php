<?php
include "ad_includes/ad_header.php";
?>
<?php
if (isset($_SESSION['user_name'])) {
    $user_name = $_SESSION['user_name'];
    $query = "SELECT * from users where user_name = '{$user_name}'";
    $select_profile = mysqli_query($conn,$query);
    while ($row = mysqli_fetch_assoc($select_profile)) {
        
        $user_id = $row['user_id'];
        $user_name = $row['user_name'];
        $user_password = $row['user_password'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        // $user_image = $row['user_image'];
        $user_role = $row['user_role'];
    
    }

}
if (isset($_POST['Update_User'])) {
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
    $user_name = $_POST['user_name'];
    $user_password = $_POST['user_password'];
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_email = $_POST['user_email'];
    // $user_image = $row['user_image'];
    $user_role = $_POST['user_role'];


    $query ="UPDATE users set user_name ='{$user_name }' ,user_password ='{$user_password }',user_firstname ='{$user_firstname }' ,user_lastname ='{$user_lastname}', user_email ='{$user_email}',user_role ='{$user_role}' where user_name = '{$user_name}' ";

    $update_user = mysqli_query($conn,$query);
    confirm($update_user);
    header("Location: users.php");
} 

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
                        Welcome to admin
                        <small>Author</small>
                    </h1>

                    <?php ?>



                    <form action="" method="POST" enctype="multipart/form-data">



    <div class="form-group">
        <label for="user_firstname">First Name:</label>
        <input value="<?php echo $user_firstname ?>" type="text" class="form-control" name="user_firstname">
    </div>

    <div class="form-group">
        <label for="user_lastname">Last Name:</label>
        <input value="<?php echo $user_lastname ?>" type="text" class="form-control" name="user_lastname">
    </div>

    <!-- <div class="input-group mb-3">
        <label for="title">Role: </label>
        <select class="form-control" name="user_role" id="">
            <option value="subscriber"><?php //echo $user_role ?></option>
            <?php 
            // if ($user_role == "admin") {
            //    echo " <option value='subscriber'>Subscriber</option>";
            // }
            // else {
            //     echo "<option value='admin'>Admin</option>";
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
        <input value="<?php echo $user_email?>" type="text" class="form-control" id="user_email" name="user_email">
    </div>

    <div class="form-group">
        <label for="user_password">Password:</label>
        <input autocomplete="off" type="password" class="form-control" id="user_password" name="user_password">
    </div>

    <input type="submit" class="btn btn-primary" value="Update Profile" name="Update_User">
</form>
                </div>



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