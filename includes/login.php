<?php include "db.php";?>
<?php session_start(); ?>

<?php 
if (isset($_POST['login'])) {
   $username = $_POST['user_name'];
   $password = $_POST['user_password'];
$username = mysqli_real_escape_string($conn,$username);
$password = mysqli_real_escape_string($conn,$password);

$query ="SELECT * from users where user_name = '$username'";
$select_user = mysqli_query($conn, $query);



}
while ($row = mysqli_fetch_array($select_user)) {
    $db_id = $row['user_id'];
    $db_name = $row['user_name'];
    $db_password = $row['user_password'];
    $db_firstname = $row['user_firstname'];
    $db_lastname = $row['user_lastname'];
    $db_role = $row['user_role'];
}

// $password = crypt($password,$db_password);

if (password_verify($password,$db_password)) {
    $_SESSION['user_name'] = $db_name;
    $_SESSION['user_firstname'] = $db_firstname;
    $_SESSION['user_lastname'] = $db_lastname;
    $_SESSION['user_role'] = $db_role;
    
    header("Location: ../admin");
}   
else {
    header("Location: ../index.php");
}




?>