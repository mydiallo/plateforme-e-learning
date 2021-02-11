 <!-- include ('includes/db.php'); -->

<?php include "includes/db.php"; ?>
<?php session_start(); ?>
<?php  include "includes/header.php"; ?>
<?php include "includes/navigation.php"; ?>
<?php

if(isset($_POST['login'])){
   $username = $_POST['username'];
   $password = $_POST['password'];

// pour nettoyer notre formulaire une fois que les données sont envoyées
    $username = mysqli_real_escape_string($connexion, $username);
    $password = mysqli_real_escape_string($connexion, $password);

    $query = "SELECT * FROM users WHERE username = '{$username}'";
    $select_user_query = mysqli_query($connexion, $query);

    if(!$select_user_query){
        die ("query failed" . mysqli_error($connexion));
    }
    while($row = mysqli_fetch_array($select_user_query)){
        $db_id = $row['user_id'];
        $db_username = $row['username'];
        $db_user_password = $row['user_password'];
        $db_user_firstname = $row['user_firstname'];
        $db_user_lastname = $row['user_lastname'];
        $db_user_role = $row['user_role'];
    }


    
    //  on utilise $db_user_password pour faire correspondre le mot de passe cryté à ce qu'on a taper lors de notre register
    // $password = crypt($password, $db_user_password);


// les === veut dire identique 
    // if($username === $db_username && $password === $db_user_password){
    //     $_SESSION['username'] = $db_username;
    //     $_SESSION['firstname'] = $db_user_firstname;
    //     $_SESSION['lastname'] = $db_user_lastname;
    //     $_SESSION['user_role'] = $db_user_role;

    //     header("Location: ../admin");

    // on verifie si le password de l'utilisateur correspond à  celui qui se trouve dans notre base de données

    if(password_verify($password, $db_user_password)){
        $_SESSION['username'] = $db_username;
        $_SESSION['firstname'] = $db_user_firstname;
        $_SESSION['lastname'] = $db_user_lastname;
        $_SESSION['user_role'] = $db_user_role;

        header("Location: daeu/admin");
        
    }else{
        header("Location: daeu/index.php");
    }

}

?>
<!-- Login -->

    

    <div class="container">
        <div class="row ">
            <div class="col-xs-6 col-xs-offset-3 pt-5">
                <div class="form-wrap ">
                <h1>Login</h1>
                    <form action="login.php" method="post">
                    <div class="form-group">
                        <input  name="username" type="text" class="form-control" placeholder="Enter Username">
                    </div>
                    <div class="input-group pb-5">
                        <input  name="password" type="password" class="form-control" placeholder="Enter Password">
                    </div>
                    <span class="input-group-btn">
                            <button class="btn btn-primary" name="login" type="submit">Submit</button>
                    </span>
                    </form> <!--login form -->
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->


                <hr>
        <hr>
        <hr>
        <hr>
        <hr>
        <br>
        <br>
        <br>

<?php include "includes/footer_bis.php"; ?>
