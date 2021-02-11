<!-- la partie php permet de creer des lignes dans la table post directement dans notre base de données -->

<?php
if(isset($_POST['create_user'])){

    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_role = $_POST['user_role'];


    // $post_image = $_FILES['image']['name'];
    // $post_image_temp = $_FILES['image']['tmp_name'];

    $username = $_POST['username'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
    // $post_date = date('d-m-y');
    // $post_comment_count = 4;

    // move_uploaded_file($post_image_temp, "../images/$post_image");

// On crypt le mot de passe dans add_user
    $user_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 10));




    // // la fonction qui nous permet d'inserer nos données dans la base de données
    $query = "INSERT INTO users (user_firstname, user_lastname, user_role, username, user_email, user_password) ";
    $query .= "VALUES('{$user_firstname}','{$user_lastname}','{$user_role}', '{$username}', '{$user_email}','{$user_password}') ";
    $create_user = mysqli_query($connexion, $query);
    

    // on utilise cette fonction pour afficher les erreurs s'il y en a (voir dans le fichier functions.php)
    comfirmQuery($create_user);
    
// pour afficher que l'utilisateur a été crée.
    echo "User Created: " . "" . "<a href='users.php'>View Users</a>";
   
}
?>

<!-- On cree le formulaire nous permettant de d'envoyer des données par la methode "post -->
<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="title">Firstname</label>
        <input type="text" class="form-control" name="user_firstname">
    </div>
    <div class="form-group">
        <label for="post_status">Lastname</label>
        <input type="text" class="form-control" name="user_lastname">
    </div>
    <div class="form-group">
        <select name="user_role" id="">
            <option value="Subscriber">Select Option</option>
            <option value="admin">Admin</option>
            <option value="Subscriber">Subscriber</option>
        </select>
    </div>
    
    <!-- <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" class="form-control" name="image">
    </div> -->

    <div class="form-group">
        <label for="post_tags">Username</label>
        <input type="text" class="form-control" name="username">
    </div>
    <div class="form-group">
        <label for="post_tags">Email</label>
        <input type="text" class="form-control" name="user_email">
    </div>
    <div class="form-group">
        <label for="post_tags">Password</label>
        <input type="password" class="form-control" name="user_password">
    </div>
    <!-- <div class="form-group">
        <label for="post_content">Password</label>
        <textarea class="form-control" name="post_content" id="" cols="30" rows="10"></textarea>
    </div> -->
    <div class="form-group">
        <input class="btn btn-primary" type = "submit" name="create_user" value="Add User">
    </div>
    



</form>