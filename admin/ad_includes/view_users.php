<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Username</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Role</th>
           
        </tr>
    </thead>
    <tbody>
        <?php
        $query = "SELECT * from users  ";
        $select_users = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_assoc($select_users)) {
            $user_id = $row['user_id'];
            $user_name = $row['user_name'];
            $user_password = $row['user_password'];
            $user_firstname = $row['user_firstname'];
            $user_lastname = $row['user_lastname'];
            $user_email = $row['user_email'];
            $user_image = $row['user_image'];
            $user_role = $row['user_role'];

           
            echo "<tr>";
            echo "<td>{$user_id}</td>";

           
            echo "<td>{$user_name}</td>";
         //   echo "<td>{$user_password}</td>";
            echo "<td>{$user_firstname}</td>";
            echo "<td>{$user_lastname}</td>";
            echo "<td>{$user_email}</td>";
            echo "<td>{$user_role}</td>";
            
            
            // $query = "SELECT * from posts where post_id = $user_post_id";
            // $select_post_id_query = mysqli_query($conn,$query);

            // while ($row = mysqli_fetch_assoc($select_post_id_query)) {
            // $post_id = $row['post_id'];
            // $post_title = $row['post_title'];

            
            // echo "<td><a href= '../post.php?p_id=$post_id'>$post_title</a></td>";
            

            // }

           

            echo "<td><a href= 'users.php?admin=$user_id'>Admin</a></td>";
            echo "<td><a href= 'users.php?subscribe=$user_id'>Subscriber</a></td>";
            echo "<td><a href= 'users.php?source=edit_user&u_id=$user_id'>Edit</a></td>";
            
            echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete');\" href= 'users.php?delete=$user_id'>Delete</a></td>";


            echo "</tr>";
        }

        ?>
    </tbody>
</table>
<?php
if (isset($_GET['admin'])) {
    $admin_user_id = $_GET['admin'];
    $query = "UPDATE users set user_role = 'admin' where user_id = $admin_user_id ";
    $admin_query = mysqli_query($conn, $query);
    header("Location: users.php");
}

if (isset($_GET['subscribe'])) {
    $subscribe_user_id = $_GET['subscribe'];
    $query = "UPDATE users set user_role = 'subscribed' where user_id = $subscribe_user_id ";
    $subscribe_query = mysqli_query($conn, $query);
    header("Location: users.php");
}


if (isset($_GET['delete'])) {
    if (isset($_SESSION['user_role'])) {
        
    if (isset($_SESSION['user_role']) == 'admin') {
        
        $delete_user_id = $_GET['delete'];
        $query = "DELETE from users where user_id = {$delete_user_id}";
        $delete_query = mysqli_query($conn, $query);
        header("Location: users.php");
    }
}
}




?>