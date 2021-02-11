<!-- $]LI043pu<+83QFt
demo_cms_db
demo_user -->



<?php
// la fonction escape permet de cacher mes données aux hackers

function escape($string){

    global $connexion;
    mysqli_real_escape_string($connexion, trim($string));
}





function users_oneline() {
    if(isset($_GET['onlineusers'])){
        //  get request isset()
        global $connexion;

        if(!$connexion){

            session_start();

            include("../includes/db.php");
            $session = session_id();
            $time = time();
            $time_out_in_seconds = 05;
            $time_out = $time - $time_out_in_seconds;

            $query = "SELECT * FROM users_online WHERE session = '$session' ";
            $send_query = mysqli_query($connexion, $query);
            $count = mysqli_num_rows($send_query);

                if($count == NULL){
                    mysqli_query($connexion, "INSERT INTO users_online(session, time) VALUES('$session', '$time') ");

                }else {
                    mysqli_query($connexion, " UPDATE users_online SET time = '$time' WHERE session = '$session' ");

                }    

            $users_online_query = mysqli_query($connexion, "SELECT * FROM users_online WHERE time > '$time_out' ");
            echo $count_user = mysqli_num_rows($users_online_query);

         } 

    } 


}

users_oneline();


function comfirmQuery($result){

    global $connexion;

    if(!$result){
    die("QUERY FAILED ." . mysqli_error($connexion));

    }
}


function insert_categories(){

    //  la super fonction "global" est à utiliser lorsqu'on utilise une fonction
    global $connexion;

    
    if(isset($_POST['submit'])){
        $cat_title = $_POST['cat_title'];
        if($cat_title == "" || empty($cat_title)){
            echo "this field should not be empty";

        }else{
            $query = "INSERT INTO categories(cat_title)";
            $query .= "VALUE('{$cat_title}')";
            $create_category_query = mysqli_query($connexion, $query);

            if(!$create_category_query){
                die('QUERY FAILED' .mysqli_error($connexion));
            }

        }
    }

function findAllCategories(){
    global $connexion;
    $query = "SELECT * FROM categories";
    $select_categories = mysqli_query($connexion, $query);
    while($row = mysqli_fetch_assoc($select_categories)) {

        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];

        echo "<tr>";
        echo "<td>{$cat_id}</td>";
        echo "<td>{$cat_title}</td>";
        echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";
        echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a></td>";
        echo "</tr>";
    }
                       

}


function DeleteCategories(){

    global $connexion;
    if (isset($_GET['delete'])){

        $the_cat_id = $_GET['delete'];
        $query = "DELETE FROM categories WHERE cat_id = {$the_cat_id}";
        $delete_query = mysqli_query($connexion, $query);
        header("Location: categories.php");
        
    }
}

}

?>

