<!-- la partie php permet de creer des lignes dans la table post directement dans notre base de données -->

<?php
if(isset($_GET['edit_user'])){

    $the_user_id = $_GET['edit_user'];

    $query = "SELECT * FROM users WHERE user_id = $the_user_id ";
    $select_users_query = mysqli_query($connexion, $query);
        while($row = mysqli_fetch_assoc($select_users_query)) {
        $user_id = $row['user_id'];
        $username = $row['username'];
        $user_password = $row['user_password'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_image = $row['user_image'];
        $user_role = $row['user_role'];
  }
     

}

if(isset($_POST['edit_user'])){

    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_role = $_POST['user_role'];


    // $post_image = $_FILES['image']['name'];
    // $post_image_temp = $_FILES['image']['tmp_name'];

    $username = $_POST['username'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
    $post_date = date('d-m-y');
    // $post_comment_count = 4;

    // move_uploaded_file($post_image_temp, "../images/$post_image");


//  Si la variable $user_password n'est pas vide on fait ce qui suit.
    if(!empty($user_password)){
        // On séléctionne la colonne user_password où user_id = $the_user_id. Ensuite on envoi la requête avec mysqli_query
        $query_password = "SELECT user_password FROM users WHERE user_id = $the_user_id ";
        $the_user_query = mysqli_query($connexion, $query_password);

        // on forme une ligne où il y a tout les attributs de la table basée sur notre requêtte.    
        $row = mysqli_fetch_array($the_user_query);

        // On dit que notre variable $db_user_password correspond aux données qui se trouve à la colonne où on a user_password
        $db_user_password = $row['user_password'];

        if($db_user_password != $user_password){

            $hashed_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 12));
        }
    
        // upload le user 
        $query = "UPDATE users SET ";
        $query .= "user_firstname = '{$user_firstname}', ";
        $query .= "user_lastname = '{$user_lastname}', ";
        $query .= "user_role = '{$user_role}', ";
        $query .= "username = '{$username}', ";
        $query .= "user_email = '{$user_email}', ";
        $query .= "user_password = '{$hashed_password}' ";
        $query .= "WHERE user_id = '{$the_user_id}' ";
    
        $edit_user_query = mysqli_query($connexion, $query);
        comfirmQuery($edit_user_query);

    }


    // // la fonction qui nous permet d'inserer nos données dans la base de données
    // $query = "INSERT INTO users (user_firstname, user_lastname, user_role, username, user_email, user_password) ";
    // $query .= "VALUES('{$user_firstname}','{$user_lastname}','{$user_role}', '{$username}', '{$user_email}','{$user_password}') ";
    // $create_user = mysqli_query($connexion, $query);
    

    // on utilise cette fonction pour afficher les erreurs s'il y en a (voir dans le fichier functions.php)
    // comfirmQuery($create_user);
   
}else{
    header("LOCATION: index.php");
}




?>

<!-- On cree le formulaire nous permettant de d'envoyer des données par la methode "post -->
<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="title">Firstname</label>
        <input type="text" value="<?php echo $user_firstname ;?>" class="form-control" name="user_firstname">
    </div>
    <div class="form-group">
        <label for="post_status">Lastname</label>
        <input type="text" value="<?php echo $user_lastname; ?>" class="form-control" name="user_lastname">
    </div>
    <div class="form-group">
        <select name="user_role" id="">
            <option value="<?php echo $user_role; ?>"><?php echo $user_role; ?></option>

            <?php
            if ($user_role == 'admin'){

                echo "<option value= 'Subscriber'>Subscriber</option>";
                
            }else{
                echo "<option value='admin'>Admin</option>";
            }

            ?>
            
        </select>
    </div>
    
    <!-- <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" class="form-control" name="image">
    </div> -->

    <div class="form-group">
        <label for="post_tags">Username</label>
        <input type="text" value="<?php echo $username; ?>" class="form-control" name="username">
    </div>
    <div class="form-group">
        <label for="post_tags">Email</label>
        <input type="text" value="<?php echo $user_email; ?>" class="form-control" name="user_email">
    </div>
    <div class="form-group">
        <label for="post_tags">Password</label>
        <input autocomplete="off" type="password"  class="form-control" name="user_password">
    </div>
    <!-- <div class="form-group">
        <label for="post_content">Password</label>
        <textarea class="form-control" name="post_content" id="" cols="30" rows="10"></textarea>
    </div> -->
    <div class="form-group">
        <input class="btn btn-primary" type = "submit" name="edit_user" value="Update User">
    </div>
    



</form>