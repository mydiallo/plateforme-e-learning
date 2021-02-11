<?php include "db.php"; ?>
<!--? Preloader Start -->
<div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="preloader-circle"></div>
                <div class="preloader-img pere-text">
                    <img src="assets/img/logo/loder.png" alt="">
                </div>
            </div>
        </div>
    </div>
    <!-- Preloader Start -->
    <header>
        <!-- Header Start -->
        <div class="header-area">
            <div class="main-header ">
                <div class="header-top d-none d-lg-block">
                    <!-- Left Social -->
                    <div class="header-left-social">
                        <ul class="header-social">    
                            <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="https://www.facebook.com/sai4ull"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                            <li> <a href="#"><i class="fab fa-google-plus-g"></i></a></li>
                        </ul>
                    </div>
                    
                    <div class="container">
                        <div class="col-xl-12">
                            <div class="row d-flex justify-content-between align-items-center">
                                <div class="header-info-left">
                                    <ul>     
                                        <li>daeuifis@gmail.com</li>
                                        <li>01 21 34 56 89</li>
                                    </ul>
                                </div>
                                <div class="header-info-right">
                                    <ul>    
                                        <li><a href="login.php"><i class="ti-user"></i>Connexion</a></li>
                                        <li><a href="registration.php"><i class="ti-lock"></i>Inscription</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="header-bottom header-sticky">
                    <!-- Logo -->
                    <div class="logo d-none d-lg-block">
                        <a href="index.html"><img src="assets/img/logo/logo.png" alt=""></a>
                    </div>
                    <div class="container">
                        <div class="menu-wrapper">
                            <!-- Logo -->
                            <div class="logo logo2 d-block d-lg-none">
                                <a href="index.html"><img src="assets/img/logo/logo.png" alt=""></a>
                            </div>
                            <!-- Main-menu -->
                            <div class="main-menu d-none d-lg-block">
                                <nav>
                                    <ul id="navigation">                                                                                          
                                        <li><a href="admin">Admin</a></li>
                                        <li><a href="index.php">Accueil</a></li>
                                        <li><a href="about.php">A propos</a></li>
                                        <!-- <li><a href="professeur.php">Nos professeurs</a></li> -->
                                        <li><a href="cours.php">Nos Cours</a>
                                            <ul class="submenu">
                                            <?php
                                                $query = "SELECT * FROM categories";
                                                $result = mysqli_query($connexion, $query);
                                                if(!$result) {
                                                    die('Query FAILED' . mysqli_error($connexion));
                                                }
                                                while($row = mysqli_fetch_assoc($result)) {

                                                    $cat_title = $row['cat_title'];
                                                    $cat_id = $row['cat_id'];
                                                    echo "<li><a href='/cms/category/{$cat_id}'></a>{$cat_title}</li>";
                                                }
                                            ?>
                                                <!-- <li><a href="blog.html">Blog</a></li>
                                                <li><a href="blog_details.html">Blog Details</a></li>
                                                <li><a href="elements.html">Element</a></li> -->
                                            </ul>
                                        </li>
                                        <li><a href="contact.php">Nous contacter</a></li>
                                        

                                            
                                    </ul>
                                </nav>
                            </div>
                            <!-- Header-btn -->
                            <div class="header-search d-none d-lg-block">
                                <form action="#" class="form-box f-right ">
                                    <input type="text" name="Search" placeholder="recherche">
                                    <div class="search-icon">
                                        <i class="fas fa-search special-tag"></i>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- Mobile Menu -->
                        <div class="col-12">
                            <div class="mobile_menu d-block d-lg-none"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Header End -->
    </header>
