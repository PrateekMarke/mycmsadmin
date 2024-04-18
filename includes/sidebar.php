<?php include "includes/db.php"; ?>
<div class="col-md-4">

    <!-- Blog Search Well -->
    <div class="well">
        <h4>Blog Search</h4>
        <form action="search.php" method="post">
        <div class="input-group">
            <input name = "search"  type="text" class="form-control">
            <span class="input-group-btn">
                <button name="submit" class="btn btn-default" type="submit">
                    <span class="glyphicon glyphicon-search"></span>
                </button>
            </span>
        </div>
        </form>
        <!-- /.input-group -->
    </div>

    <!-- Login-->
    <div class="well">

        <?php if (isset($_SESSION['user_role'])): ?>
            <h4>Logged in as <?php echo $_SESSION['user_name'] ?></h4>
            <a href="includes/logout.php" class="btn btn-primary">Logout</a>
        <?php else: ?>
            <h4>Login</h4>
            <form action="includes/login.php" method="post">
            <div class="form-group">
                <input name = "user_name"  type="text" class="form-control" placeholder="Enter username">
            </div>
            <div class="input-group">
                <input name = "user_password"  type="password" class="form-control" placeholder="Enter password">
                <span class="input-group-btn">
                    <button name="login" class="btn btn-primary" type="submit">Submit
                        
                    </button>
                </span>
            </div>
            </div>
            </form>
            <!-- /.input-group -->

        <?php endif; ?>

    </div>

    <!-- Blog Categories Well -->
    


    <div class="form">
    <?php 
      $qurey = "select * from categories  ;";
      $select_categories_sidebar = mysqli_query($conn,$qurey);
    ?>



    

        <h4 style="text-align: center;">Blog Categories</h4>
        <div class="form">
            <div style="text-align: center;">
                <ul class="list-unstyled" style="display: inline-block; padding-left: 0;">
                <?php 
                 while ($row = mysqli_fetch_assoc($select_categories_sidebar)) {
                    $cat_id= $row['cat_id'];
                    $cat_title = $row['cat_title'];
                    echo "<li><a href='category.php?category=$cat_id'>{$cat_title}</a></li>";
                   }
                ?>
                </ul>
            </div>
        </div>
        <!-- /.row -->
    </div>

    <!-- Side Widget Well -->
</div>
<?php include "widget.php"; ?>