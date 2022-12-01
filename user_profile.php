<?php
    @include 'config.php';
    session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>PitchEntry</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Inter:wght@700;800&display=swap" rel="stylesheet">
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-xxl bg-white p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->




        <!-- Navbar Start -->
        <nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
            <a href="index.php" class="navbar-brand d-flex align-items-center text-center py-0 px-4 px-lg-5">
                <h1 class="m-0 text-primary">PitchEntry</h1>
            </a>
            <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto p-4 p-lg-0">
                    <a href="index.php" class="nav-item nav-link active">Home</a>
                    
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Posts</a>
                        <div class="dropdown-menu rounded-0 m-0">
                            <a href="job-list.php" class="dropdown-item">Post List</a>
                            <a href="post.php" class="dropdown-item">Make a post</a>
                            <a href="yourpost.php" class="dropdown-item">Your post</a>
                        </div>
                    </div>

<?php
    $phoneNumber = '';
    $address = '';
    $position = '';
    $sqlPos = "SELECT * FROM positions";
    $allPos = mysqli_query($conn,$sqlPos);
    $id = $_SESSION["id"];

    if (isset($_POST['save_profile'])) {
        $phoneNumber = $_POST['user_phoneNumber'];
        $address = $_POST['user_address'];
        $position = $_POST['user_position'];

        $sql_update = "
            UPDATE user 
                        SET 
                            phone = '$phoneNumber',
                            address = '$address',
                            position_id = '$position'
                        WHERE 
                            id = '$id';
        ";
        
        if(mysqli_query($conn , $sql_update))
        {
            echo '<script>alert("Update Successfully")</script>';
            header("refresh:1; url = login.php");
        } else {
            echo '<script>alert("Update unsuccessful")</script>';
        }
    }

    if (!isset($_SESSION["login"]) || $_SESSION["login"] !== true) {
    $href = 'login.php';
    $href1 = 'login.php';
    $text = 'Login';
    $style = 'display: none';
    $class = 'nav-link';
}   else {
    $href1 = 'post.php';
    $text = htmlspecialchars($_SESSION["username"]);
    $roles = htmlspecialchars($_SESSION["roles"]);
    $phoneNumber = htmlspecialchars($_SESSION["phone"]);
    $address = htmlspecialchars($_SESSION["address"]);
    $position = htmlspecialchars($_SESSION["position"]);
    $rating = htmlspecialchars($_SESSION["rating"]);
    $dt = "dropdown";
    $class = 'nav-link dropdown-toggle';
}
?>
                    <div class="nav-item dropdown">
                        <a href="<?php echo $href; ?>" class= "<?php echo $class; ?>"
                            data-bs-toggle="<?php echo $dt; ?>">
                        <i class="fas fa-user" 
                        style= "
                            margin-right: 7px;
                        "></i><?php echo $text; ?></a>

                        <div class="dropdown-menu rounded-0 m-0" style = "<?php echo $style; ?>">
                            <a href="user_profile.php" class="dropdown-item">Profile</a>
                            <a href="logout.php" class="dropdown-item">LogOut</a>
                        </div>

                    </div>
                </div>
            </div>
        </nav>
        <!-- Navbar End -->

<form
        action = 
        "<?php
            echo 
            htmlspecialchars($_SERVER["PHP_SELF"]);
         ?>" 
         method = "POST">

    <!-- profile start -->
        <div class="container rounded bg-white mt-5 mb-5">
   <div class="row">
      <div class="col-md-3 border-right">
         <div class="d-flex flex-column align-items-center text-center p-3 py-5">
            <img class="rounded-circle mt-5" src="img/messi.jpg">
            <span class="font-weight-bold" style = "margin-top: 10px"><?php echo $text; ?></span>
            <span> </span>
         </div>
      </div>

      


      <div class="col-md-5 border-right">
         <div class="p-3 py-5">
            <div class="d-flex justify-content-between align-items-center mb-3">
               <h4 class="text-right">Profile Settings</h4>
            </div>
            <div class="row mt-3">

                <div class="col-md-12" style = "margin-bottom: 10px;">
                    <label class="labels" style = "margin-bottom: 10px;">Phone Number</label>
                    <input type="text" class="form-control"  value = '<?php echo 
                    $phoneNumber; ?>'
                    name = "user_phoneNumber">
                </div>

                <div class="col-md-12">
                    <label class="labels" style = "margin-bottom: 10px;">Address</label>
                    <input type="text" class="form-control"  value = '<?php echo $address; ?>'
                    name = "user_address">
                    <label class="labels" style = "margin-top: 10px;">Position</label>
                </div>
                <!-- positions can be changed -->
                


            <select 
                style = "margin-bottom: 10px; margin-left: 10px; width : 95%"
                name = "user_position"
                >

                <option 
                    value="<?php 
                        echo $id;
                    ?>"
                    >

                    <?php 
                    echo $position;
                    ?>
                </option>

                    <?php
                        while ($positions = mysqli_fetch_array(
                        $allPos , MYSQLI_ASSOC)):;
                    ?>
                    <option 
                    value="<?php 
                        echo $positions["id"];
                    ?>"
                    >

                    <?php 
                    echo $positions["name"];
                    ?>
                    </option>
                <?php
                endwhile;
                ?>
            </select>





               <!-- roles cannot be changed -->
                <div class="col-md-12" style = "margin-bottom: 10px;">
                    <label class="labels" style = "margin-bottom: 10px;">Roles</label>
                    <input type="text" class="form-control" 
                     value = '<?php echo $roles; ?>'
                     readonly>
                </div>
                <!-- ratings will be updated -->
                <div class="col-md-12" style = "margin-bottom: 10px;">
                    <label class="labels" style = "margin-bottom: 10px;">Ratings</label>
                    <input type="text" class="form-control" placeholder="enter address" value = '<?php echo $rating; ?>'
                    readonly>
                </div>
            </div>
         </div>
      </div>

      <!-- this is for liked posts -->
      <div class="col-md-4">
         <div class="p-3 py-5">
            <div class="d-flex justify-content-between align-items-center experience">
                <span>Lists Applied</span>
                <span class="border px-3 p-1 add-experience"> <a href="job-list.php">
                    <i class="fa fa-plus"></i>&nbsp;Applied</a></span></div>
            <br> 
<?php
        $select = mysqli_query($conn , "SELECT post.* from post INNER JOIN user_choose_post on post.id = user_choose_post.post_id where user_choose_post.user_id = '$id'");

        while ($row = mysqli_fetch_assoc($select)) {

        
        ?>
            
            <div class="col-md-12" style = "margin-bottom: 10px;">
                <span class="border px-3 p-1 add-experience">
                    <a href = "post-detail.php?post=<?php echo $row["id"] ?>" >
                    <?php echo $row["title"] .  "\t" .  $row["post_time"] ?>
                    </a>
                </span>
            </div>
            </a>
            <br> 
        <?php
        };
    ?>

            <div class="col-md-12" style = "margin-top: 20px;">
                <button class="btn btn-primary profile-button" 
                type="submit"
                name = "save_profile">Save Profile</button>
            </div>
         </div>
      </div>


   </div>
</div>
</div>
</div>

</form>
        <!-- profile end -->

       <!-- Footer Start -->
        <div class="container-fluid bg-dark text-white-50 footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
            <div class="container py-5">
                <div class="row g-5">
                    <div class="col-lg-3 col-md-6">
                        <h5 class="text-white mb-4">Company</h5>
                        <a class="btn btn-link text-white-50" href="">About Us</a>
                        <a class="btn btn-link text-white-50" href="">Contact Us</a>
                        <a class="btn btn-link text-white-50" href="">Our Services</a>
                        <a class="btn btn-link text-white-50" href="">Privacy Policy</a>
                        <a class="btn btn-link text-white-50" href="">Terms & Condition</a>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h5 class="text-white mb-4">Quick Links</h5>
                        <a class="btn btn-link text-white-50" href="">About Us</a>
                        <a class="btn btn-link text-white-50" href="">Contact Us</a>
                        <a class="btn btn-link text-white-50" href="">Our Services</a>
                        <a class="btn btn-link text-white-50" href="">Privacy Policy</a>
                        <a class="btn btn-link text-white-50" href="">Terms & Condition</a>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h5 class="text-white mb-4">Contact</h5>
                        <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>123 Street, New York, USA</p>
                        <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+012 345 67890</p>
                        <p class="mb-2"><i class="fa fa-envelope me-3"></i>info@example.com</p>
                        <div class="d-flex pt-2">
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-youtube"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h5 class="text-white mb-4">Newsletter</h5>
                        <p>Dolor amet sit justo amet elitr clita ipsum elitr est.</p>
                        <div class="position-relative mx-auto" style="max-width: 400px;">
                            <input class="form-control bg-transparent w-100 py-3 ps-4 pe-5" type="text" placeholder="Your email">
                            <button type="button" class="btn btn-primary py-2 position-absolute top-0 end-0 mt-2 me-2">SignUp</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="copyright">
                    <div class="row">
                        <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                            &copy; <a class="border-bottom" href="#">Your Site Name</a>, All Right Reserved. 
							
							<!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
							Designed By <a class="border-bottom" href="https://htmlcodex.com">HTML Codex</a>
                        </div>
                        <div class="col-md-6 text-center text-md-end">
                            <div class="footer-menu">
                                <a href="">Home</a>
                                <a href="">Cookies</a>
                                <a href="">Help</a>
                                <a href="">FQAs</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End -->


        
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>