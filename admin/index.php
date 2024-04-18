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
                        <small> <?php echo $_SESSION['user_name'] ?></small>
                       
                    </h1>
                 
                </div>
            </div>
            <!-- /.row -->
            <div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-file-text fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
<?php 
$query ="SELECT * from posts";
$select_posts = mysqli_query($conn,$query);
$post_count = mysqli_num_rows($select_posts);
echo "<div class='huge'>$post_count</div>" ;

?>    
                  
                        <div>Posts</div>
                    </div>
                </div>
            </div>
            <a href="./posts.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-comments fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
<?php 
$query ="SELECT * from comments";
$select_comments = mysqli_query($conn,$query);
$comment_count = mysqli_num_rows($select_comments);
echo "<div class='huge'>$comment_count</div>" ;

?>
                     
                      <div>Comments</div>
                    </div>
                </div>
            </div>
            <a href="comments.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-user fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
<?php 
$query ="SELECT * from users";
$select_users = mysqli_query($conn,$query);
$user_count = mysqli_num_rows($select_users);
echo "<div class='huge'>$user_count</div>" ;

?>


                    
                        <div> Users</div>
                    </div>
                </div>
            </div>
            <a href="users.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-list fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                    <?php 
$query ="SELECT * from categories";
$select_categories = mysqli_query($conn,$query);
$categories_count = mysqli_num_rows($select_categories);
echo "<div class='huge'>$categories_count</div>" ;

?>
                        
                         <div>Categories</div>
                    </div>
                </div>
            </div>
            <a href="categories.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>
                <!-- /.row -->
<?php 

$query ="SELECT * from posts where post_status = 'published'";
$select_published_posts = mysqli_query($conn,$query);
$post_published_count = mysqli_num_rows($select_published_posts );

$query ="SELECT * from posts where post_status = 'draft'";
$select_draft_posts = mysqli_query($conn,$query);
$post_draft_count = mysqli_num_rows($select_draft_posts );

$query ="SELECT * from comments where comment_status = 'disapproved'";
$select_disapproved = mysqli_query($conn,$query);
$comment_disapproved = mysqli_num_rows($select_disapproved );

$query ="SELECT * from users where user_role = 'subscriber'";
$select_subscriber = mysqli_query($conn,$query);
$subscriber_count = mysqli_num_rows($select_subscriber );




?>






                <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Data', 'Count'],
          <?php 
          $element_text = ['All Post','Active Post','Draft Post','Comments','Pending Comments','Users','Subscriber','Categories'];
          $element_count = [$post_count,$post_published_count,$post_draft_count,$comment_count,$comment_disapproved,$user_count,$subscriber_count,$categories_count];

          for ($i=0; $i < 8; $i++) { 
            echo "['{$element_text[$i] }' ".", "."{$element_count[$i]}],";
          }
          
          
          ?>
        

        ]);

        var options = {
          chart: {
            title: '',
            subtitle: '',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
<div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>
        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->
           


                <!-- /.row -->
                


    <?php
    include "ad_includes/ad_footer.php";
    ?>