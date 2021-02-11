
<?php
//  on définit une variable the_get_post_id qu'on affecte à $_GET['p_id']
// ensuite grâce au $query, on relit p_id à post_id.
// 
if(isset($_GET['p_id'])){
    $the_get_post_id = $_GET['p_id'];

}

$query = "SELECT * FROM posts where post_id = $the_get_post_id";
$select_posts_by_id = mysqli_query($connexion, $query);
while($row = mysqli_fetch_assoc($select_posts_by_id)){
    // dans ce qui suit on affecte chaque variable à une colonne de la table post.
                                
$post_id = $row['post_id'];
$post_user = $row['post_user'];
$post_title = $row['post_title'];
$post_category_id = $row['post_category_id'];
$post_status = $row['post_status'];
$post_image = $row['post_image'];
$post_content = $row['post_content'];
$post_tags = $row['post_tags'];
$post_comment_count = $row['post_comment_count'];
$post_date  = $row['post_date'];
}

// On fait une mise à jour des posts avec $_POST['update_post']
if(isset($_POST['update_post'])){
    $post_user = $_POST['post_user'];
    $post_title = $_POST['post_title'];
    $post_category_id = $_POST['post_category'];
    $post_status = $_POST['post_status'];
    $post_image = $_FILES['image']['name'];
    $post_image_temp = $_FILES['image']['tmp_name'];
    $post_content = $_POST['post_content'];
    $post_tags = $_POST['post_tags'];


    if(empty($post_image)){
        $query = "SELECT * FROM posts WHERE post_id = $the_get_post_id";
        $select_image = mysqli_query($connexion, $query);

        while($row = mysqli_fetch_array($select_image)){

            $post_image = $row['post_image'];
        }
    }

    move_uploaded_file($post_image_temp, "../images/$post_image");

    $query = "UPDATE posts SET ";
    $query .= "post_title = '{$post_title}', ";
    $query .= "post_category_id = '{$post_category_id}', ";
    $query .= "post_status = '{$post_status}', ";
    $query .= "post_date = now(), ";
    $query .= "post_user = '{$post_user}', ";
    $query .= "post_tags = '{$post_tags}', ";
    $query .= "post_content = '{$post_content}', ";
    $query .= "post_image = '{$post_image}' ";
    $query .= "WHERE post_id = '{$the_get_post_id}' ";

    $update_post = mysqli_query($connexion, $query);
    comfirmQuery($update_post);

    echo "<p class = 'bg-success'>Post Updated. <a href = '../post.php?p_id={$the_get_post_id}'>View Post</a> or <a href='posts.php'>Edit More Posts</a> </p>";
}
?>


<!-- la partie php permet de creer des lignes dans la table post directement dans notre base de données -->

<?php
if(isset($_POST['create_post'])){

    $post_title = $_POST['title'];
    $post_user = $_POST['user'];
    $post_category_id = $_POST['post_category_id'];
    $post_status = $_POST['post_status'];


    $post_image = $_FILES['image']['name'];
    $post_image_temp = $_FILES['image']['tmp_name'];

    $post_tags = $_POST['post_tags'];
    $post_content = $_POST['post_content'];
    $post_date = date('d-m-y');
    $post_comment_count = 4;

    move_uploaded_file($post_image_temp, "../images/$post_image");

    // la fonction qui nous permet d'inserer nos données dans la base de données
    $query = "INSERT INTO posts (post_category_id, post_title, post_user, post_date, post_image, post_content, post_tags, post_comment_count,post_status)";
    $query .= "VALUES({$post_category_id}, '{$post_title}','{$post_user}',now() ,'{$post_image}','{$post_content}','{$post_tags}',{$post_comment_count},'{$post_status}')";
    $create_post_query = mysqli_query($connexion, $query);
    

    // on utilise cette fonction pour afficher les erreurs s'il y en a (voir dans le fichier functions.php)
    comfirmQuery($create_post_query);
   
}
?>

<!-- On cree le formulaire nous permettant de d'envoyer des données par la methode "post" dans la table post -->
<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="post_title" value="<?php echo $post_title; ?>">
    </div>
    <div class="form-group">
        <label for="cartegory">Categories</label>
        <select name="post_category" id="">

        <?php
            $query = "SELECT * FROM categories ";
            $select_categories = mysqli_query($connexion, $query);

            comfirmQuery($select_categories);

            while($row = mysqli_fetch_assoc($select_categories)){

                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];

                echo "<option value = '$cat_id'>{$cat_title}</option>";
            }
        ?>

        </select>
    </div>
    <!-- <div class="form-group">
        <label for="title">Post Author</label>
        <input type="text" class="form-control" name="post_author" value="<?php echo $post_author; ?>">
    </div> -->

    <div class="form-group">
        <label for="users">Users</label>
        <select name="post_user" id="">
            <?php echo "<option value = '{$post_user}'>{$post_user}</option>";?>

        <?php
            $users_query = "SELECT * FROM users ";
            $select_users = mysqli_query($connexion, $users_query);

            comfirmQuery($select_users);

            while($row = mysqli_fetch_assoc($select_users)){

                $user_id = $row['user_id'];
                $username = $row['username'];

                echo "<option value = '{$username}'>{$username}</option>";
            }
        ?>
        </select>
    </div>
    
    <div class="form-group">
    <select name="post_status" id="">
        <option value='<?php $post_status ;?>'><?php echo $post_status ;?></option>

        <?php
            if($post_status == 'published' ){
                echo "<option value = 'draft'>Draft</option>";

            }else{
                echo "<option value = 'published'>Publish</option>";
            }
        ?>
    </select>
    </div>

    <!-- <div class="form-group">
        <label for="post_status">Post Status</label>
        <input type="text" class="form-control" name="post_status" value="<?php echo $post_status; ?>">
    </div> -->
    <div class="form-group">
        <img width = "100" src="../images/<?php echo $post_image; ?>" alt="">
        <input type="file" class="form-control" name="image">
    </div>
    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name="post_tags" value="<?php echo $post_tags; ?>">
    </div>
    <div class="form-group">
        <label for="post_content">Post Contents</label>
        <textarea class="form-control" name="post_content" id="body" cols="30" rows="10"><?php echo $post_content; ?></textarea>
    </div>
    
    <div class="form-group">
        <input class="btn btn-primary" type = "submit" name="update_post" value="Update Post">
    </div>
    



</form>