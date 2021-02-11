<table class="table table-bordered table hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Username</th>
                                    <th>Firstname</th>
                                    <th>Lastname</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                            <!-- On va afficher les infos contenu dans la table posts -->
                            <?php
                            $query = "SELECT * FROM users";
                            $select_users = mysqli_query($connexion, $query);
                            while($row = mysqli_fetch_assoc($select_users)) {
                        
                                $user_id = $row['user_id'];
                                $username = $row['username'];
                                $user_password = $row['user_password'];
                                $user_firstname = $row['user_firstname'];
                                $user_lastname = $row['user_lastname'];
                                $user_email = $row['user_email'];
                                $user_image = $row['user_image'];
                                $user_role = $row['user_role'];
                                

                                echo "<tr>";
                                echo "<td> $user_id </td>";
                                echo "<td> $username </td>";
                                echo "<td> $user_firstname </td>";
                                

                                // $query = "SELECT * FROM comments WHERE cat_id = {$post_category_id}";

                                // $select_categories_id = mysqli_query($connexion, $query);
                                // while($row = mysqli_fetch_assoc($select_categories_id)) {

                                //     $cat_id = $row['cat_id'];
                                //     $cat_title = $row['cat_title'];
                                //     echo "<td>{$cat_title}</td>";




                                // }


                                echo "<td> $user_lastname </td>";
                                echo "<td>$user_email </td>";
                                echo "<td>$user_role </td>";

                                // $query = "SELECT * FROM posts where post_id = $comment_post_id ";
                                // $select_post_id_query = mysqli_query($connexion, $query);

                                // while($row = mysqli_fetch_assoc($select_post_id_query)){
                                //     $post_id = $row['post_id'];
                                //     $post_title = $row['post_title'];

                                //     echo "<td><a href= '../post.php?p_id=$post_id'></a>$post_title</td>";
 
                                // }

                                
                                echo "<td><a href = 'users.php?change-to-admin={$user_id}'</a>Admin</td>";
                                echo "<td><a href = 'users.php?change-to-sub={$user_id}'</a>Subscriber</td>";
                                // on fait une édition du user_id = {$user_id}, on va dans users.php ensuite
                                // on regarde là où la source=edit_user et enfin on affiche l'id 
                                echo "<td><a href = 'users.php?source=edit_user&edit_user={$user_id}'</a>Edit</td>";
                                echo "<td><a onClick=\"javascript: return confirm('Are you sure you want delete this post')\" bhref = 'users.php?delete={$user_id}'</a>Delete</td>";
                                echo "</tr>";
                                

                            }

                            ?>
                                
                            </tr>
                        </tbody>
                        </table>
                        
                                    <?php

                                    if(isset($_GET['change-to-admin'])){
                                        $the_user_id = $_GET['change-to-admin'];
                                        $query = "UPDATE users SET user_role = 'admin' WHERE user_id = $the_user_id ";
                                        $admin_to_change_query = mysqli_query($connexion, $query);
                                        header("Location : users.php");
                                    }
                                    
                                    if(isset($_GET['change-to-sub'])){
                                        $the_user_id = $_GET['change-to-sub'];
                                        $query = "UPDATE users SET user_role = 'Subscriber' WHERE user_id = $the_user_id ";
                                        $change_to_sub_query = mysqli_query($connexion, $query);
                                        header("Location : users.php");
                                    }



                                    if(isset($_GET['delete'])){

                                        if(isset($_SESSION['user_role'])){
                                            if($_SESSION['user_role'] == 'admin'){
                                        
                                                $the_delete_user_id = $_GET['delete'];
                                                $query = "DELETE FROM users WHERE user_id = {$the_delete_user_id} ";
                                                $delete_query = mysqli_query($connexion, $query);
                                                header("Location : users.php");
                                            }

                                        }

                                    }



                                ?>