<?php include "includes/admin_header.php"; ?>

    <div id="wrapper">

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
                                Welcome 
                                <small><?php echo $_SESSION['username']; ?></small>
                        </h1>
<!-- Ici on créé une table qui permet de recceuil toutes informations sur les posts à partir de la base de données -->

                       <?php

                        if(isset($_GET['source'])){
                            $source = $_GET['source'];
                        }else{
                            $source = '';
                        }

                            switch($source){
                                case 'add_posts';
                                include "includes/add_posts.php";
                                break;

                                case 'edit_post';
                                include "includes/edit_post.php";
                                break;

                                case '190';
                                echo "Nice 190";
                                break;
                                default;

                                include "includes/view_all_comments.php";

                                break;
                            }
                       

                       ?>
                        

                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php
    include "includes/admin_footer.php";
?>