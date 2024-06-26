<?php
include "ad_includes/ad_header.php";
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


                    <div class="col-xs-6">
                        <?php
                        insert_cat();
                        ?>



                        <form action="" method="post">
                            <div class="form-group">
                                <label for="cat-title">Add Category</label>
                                <input type="text" class="form-control" name="cat_title">

                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="submit" value="Add Catergory">
                            </div>

                        </form>
                        <?php // UPDATE AND INCLUDE
                        if (isset($_GET['edit'])) {
                            $cat_id = $_GET['edit'];
                            include "ad_includes/ad_update.php";
                        }
                        ?>

                    </div>
                    <div class="col-xs-6">


                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Category Title</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php // FIND CATEGORIES
                                find_categories();
                                ?>
                                <?php //delete 
                                delete_categories();
                                ?>


                            </tbody>
                        </table>



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