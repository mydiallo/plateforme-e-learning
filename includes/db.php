<?php

// $db['db_host'] = 'localhost';
// $db['db_user'] = 'root';
// $db['db_pass'] = '';
// $db['db_name'] = 'daeu_ifis';

// foreach($db as $key => $value){
//     define(strtoupper($key), $value);
// }



$connexion = mysqli_connect('localhost', 'root', '', 'daeu_ifis');  
    if(!$connexion) {
        die("pas connecté");
    }



?>