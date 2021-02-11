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

<table class="table table-bordered table hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Author</th>
                                    <th>Comment</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>In Response to</th>
                                    <th>Date</th>
                                    <th>Approve</th>
                                    <th>Unapprove</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                            <!-- On va afficher les infos contenu dans la table posts -->
                            <?php
                            $query = "SELECT * FROM comments WHERE comment_post_id = " . mysqli_real_escape_string($connexion, $_GET['id']). " ";
                            $select_comments = mysqli_query($connexion, $query);
                            while($row = mysqli_fetch_assoc($select_comments)) {
                        
                                $comment_id = $row['comment_id'];
                                $comment_post_id = $row['comment_post_id'];
                                $comment_author = $row['comment_author'];
                                $comment_content = $row['comment_content'];
                                $comment_email = $row['comment_email'];
                                $comment_status = $row['comment_status'];
                                $comment_date = $row['comment_date'];
                                

                                echo "<tr>";
                                echo "<td> $comment_id </td>";
                                echo "<td> $comment_author </td>";
                                echo "<td> $comment_content </td>";
                                

                                // $query = "SELECT * FROM comments WHERE cat_id = {$post_category_id}";

                                // $select_categories_id = mysqli_query($connexion, $query);
                                // while($row = mysqli_fetch_assoc($select_categories_id)) {

                                //     $cat_id = $row['cat_id'];
                                //     $cat_title = $row['cat_title'];
                                //     echo "<td>{$cat_title}</td>";




                                // }


                                echo "<td> $comment_email </td>";
                                echo "<td>$comment_status </td>";

                                $query = "SELECT * FROM posts where post_id = $comment_post_id ";
                                $select_post_id_query = mysqli_query($connexion, $query);

                                while($row = mysqli_fetch_assoc($select_post_id_query)){
                                    $post_id = $row['post_id'];
                                    $post_title = $row['post_title'];

                                    echo "<td><a href= '../post.php?p_id=$post_id'></a>$post_title</td>";
 
                                }

                                echo "<td> $comment_date </td>";
                                // echo "<td><a href = 'posts.php?source=edit_post&p_id='</a>Approve</td>";
                                echo "<td><a href = 'comments.php?approve={$comment_id}'</a>Approve</td>";
                                echo "<td><a href = 'comments.php?unapprove={$comment_id}'</a>Unapprove</td>";
                                // echo "<td><a href = 'posts.php?source=edit_post&p_id='</a>edit</td>";
                                echo "<td><a href = 'post_comments.php?delete=$comment_id&id=" .$_GET['id']. "'</a>Delete</td>";
                                echo "</tr>";
                                

                            }

                            ?>
                                
                            </tr>
                        </tbody>
                        </table>
                        
                                    <?php

                                    if(isset($_GET['approve'])){
                                        $the_comment_id = $_GET['approve'];
                                        $query = "UPDATE comments SET comment_status = 'approve' WHERE comment_id = $the_comment_id ";
                                        $approve_query = mysqli_query($connexion, $query);
                                        header("Location : comments.php");
                                    }
                                    
                                    if(isset($_GET['unapprove'])){
                                        $the_comment_id = $_GET['unapprove'];
                                        $query = "UPDATE comments SET comment_status = 'unapprove' WHERE comment_id = $the_comment_id ";
                                        $unapprove_query = mysqli_query($connexion, $query);
                                        header("Location : comments.php");
                                    }



                                    if(isset($_GET['delete'])){
                                        $the_delete_comment_id = $_GET['delete'];
                                        $query = "DELETE FROM comments WHERE comment_id = {$the_delete_comment_id} ";
                                        $delete_query = mysqli_query($connexion, $query);
                                        header("Location : post_comments.php");
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