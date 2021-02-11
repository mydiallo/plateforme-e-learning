<?php include "includes/admin_header.php"; ?>

    <div id="wrapper">

    <?php if($connexion) {
        
        }
        ?>

<?php   






?>

        <!-- Navigation -->
        <?php
            include "includes/admin_navigation.php";
        ?>
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to admin
                            <small><?php echo $_SESSION['username']; ?></small>
                        </h1>
                        
                        
                    </div>
                </div>
                <!-- /.row -->
                       
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
                        <!-- on séléctionnne tout les postes que nous avons -->
                        <?php
                        $quey = "SELECT * FROM posts ";
                        $select_all_post = mysqli_query($connexion, $quey);
                        $post_count = mysqli_num_rows($select_all_post);
                        echo "<div class='huge'>{$post_count}</div>";

                        ?>
                        
                        <div>Posts</div>
                    </div>
                </div>
            </div>
            <a href="posts.php">
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
                        $quey = "SELECT * FROM comments ";
                        $select_all_comment = mysqli_query($connexion, $quey);
                        $comment_count = mysqli_num_rows($select_all_comment);
                        echo "<div class='huge'>{$comment_count}</div>";

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
                        $quey = "SELECT * FROM users ";
                        $select_all_users = mysqli_query($connexion, $quey);
                        $users_count = mysqli_num_rows($select_all_users);
                        echo "<div class='huge'>{$users_count}</div>";

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
                        $quey = "SELECT * FROM categories ";
                        $select_all_category = mysqli_query($connexion, $quey);
                        $category_count = mysqli_num_rows($select_all_category);
                        echo "<div class='huge'>{$category_count}</div>";

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


<?php
$quey = "SELECT * FROM posts WHERE post_status = 'published'";
$select_all_published_post = mysqli_query($connexion, $quey);
$post_published_count = mysqli_num_rows($select_all_published_post);
?>
<?php
$quey = "SELECT * FROM posts WHERE post_status = 'draft'";
$select_all_draft_post = mysqli_query($connexion, $quey);
$post_draft_count = mysqli_num_rows($select_all_draft_post);
?>
<?php
$quey = "SELECT * FROM comments WHERE comment_status = 'unapproved'";
$unapproved_comment_query = mysqli_query($connexion, $quey);
$unapproved_comment_count = mysqli_num_rows($unapproved_comment_query);
?>
<?php
$quey = "SELECT * FROM users WHERE user_role = 'Subscriber'";
$select_all_subscribers = mysqli_query($connexion, $quey);
$subscriber_count = mysqli_num_rows($select_all_subscribers);
?>

<!-- ce script vient de google charts, la première ligne est mise dans le header de admin_header.php -->
<div class="row">
<script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Data', 'Count'],
        //   on affiche de manière dynamique les données obtenues
          <?php
          $element_text = ['All Posts','Active Posts', 'Draft Posts','Comments','Pending Comments', 'Users', 'Subscribers','Categories'];
          $element_count = [$post_count, $post_published_count, $post_draft_count, $comment_count, $unapproved_comment_count, $users_count, $subscriber_count, $category_count];

          for($i = 0; $i < 8; $i++){
              echo "['{$element_text[$i]}'" . "," . "{$element_count[$i]}],";

          }

          ?>
        //   ['Posts', 1000],
          
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



                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php
    include "includes/admin_footer.php";
?>