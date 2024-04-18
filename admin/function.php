
<?php
function escape($string){
    global $conn;
    return mysqli_real_escape_string($conn,trim($string));
}



function users_online(){
    if(isset($_GET['onlineusers'])){
        global $conn;
        if(!$conn){
            include("../includes/db.php");
            $session = session_id();
            $time = time();
            $time_out_in_seconds = 30;
            $time_out = $time - $time_out_in_seconds;
            
            $query = "SELECT * FROM users_online WHERE session = '$session' ";
            $send_query = mysqli_query($conn, $query);
            $count = mysqli_num_rows($send_query);
            
            if($count == NULL){
                mysqli_query($conn, "INSERT INTO users_online (session, time) 
            VALUES ('$session','$time')");
        }else{
            mysqli_query($conn, "UPDATE users_online SET time = '$time' 
            WHERE session = '$session' ");
        }
        $users_online_query = mysqli_query($conn, "SELECT * FROM users_online WHERE time > '$time_out' ");
        echo $count_user = mysqli_num_rows($users_online_query);
        
        
    }
}
}
//Calling the function
users_online();



function confirm($result)
{
    global $conn;
    if (!$result) {
        die("Query failed" . mysqli_error($conn));
    }
}

function insert_cat()
{
    if (isset($_POST['submit'])) {
        global $conn;
        $cat_title = $_POST['cat_title'];

        if ($cat_title == "" || empty($cat_title)) {
            echo "This field should not be empty";
        } else {
            $qurey = "insert into categories(cat_title) value('$cat_title');";
            $create_category_query = mysqli_query($conn, $qurey);
            if (!$create_category_query) {
                die('Query failed' . mysqli_error($conn));
            }
        }
    }
}
function find_categories()
{
    global $conn;
    $query = "SELECT * from categories  ";
    $select_categories = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_assoc($select_categories)) {
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];
        echo "<tr>";
        echo "<td>{$cat_id}</td>";
        echo "<td>{$cat_title}</td>";
        echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";
        echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a></td>";
        echo "</tr>";
    }
}
function delete_categories()
{
    global $conn;
    if (isset($_GET['delete'])) {
        global $conn;
        $the_cat_id = $_GET['delete'];
        $query = "DELETE from categories where cat_id = {$the_cat_id} ;";
        $delete_query = mysqli_query($conn, $query);
        header("Location: categories.php");
    }
}




?>