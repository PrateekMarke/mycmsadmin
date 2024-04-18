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
                    <?php
                    if (isset($_GET['source'])) {
                        $source = $_GET['source'];
                    } else {
                        $source = '';
                    }
                    switch ($source) {
                        case 'add_post':
                            include "ad_includes/add_post.php";
                            break;

                        case 'hello':
                            echo "hello";
                            break;

                        case 'edit_post':
                            include "ad_includes/edit_post.php";
                            break;

                        default:
                            include "ad_includes/view_posts.php";
                            break;
                    }
                    

                    ?>
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