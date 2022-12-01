<?php
    @include 'config.php';
    session_start();
    // Check if the user is logged in, if not
if (!isset($_SESSION["login"]) || $_SESSION["login"] !== true) {
    $href = 'login.php';
    $href1 = 'login.php';
    $text = 'Login';
    $style = 'display: none';
    $class = 'nav-link';
}   else {
    $href1 = 'login.php';
    $text = htmlspecialchars($_SESSION["username"]);
    $dt = "dropdown";
    $class = 'nav-link dropdown-toggle';
}
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
$sqlTag = "SELECT * FROM tag";
$allTag = mysqli_query($conn , $sqlTag);
$id = $_SESSION["id"];
if (isset($_POST['save_search'])) {
    $tagID = mysqli_real_escape_string($conn , $_POST['post_tag']);
    $avaID = mysqli_real_escape_string($conn , $_POST['ava']);
    $time = $_POST['post_time'];
    $savedTime = date('Y-m-d', strtotime($time));
    if ($tagID == 0 && $avaID == -1 && empty($time)) { 
        $searchSQL = "SELECT * FROM post where user_id != '$id' and status = 1";
    }
    else {
    $searchSQL = "SELECT * FROM post  INNER JOIN post_tag on post.id = post_tag.post_id INNER JOIN tag on post_tag.tag_id = tag.id where post.status = '$avaID' and post.post_time < '$savedTime' and post_tag.tag_id 
    = '$tagID' ";   
    } 
} else {
    $searchSQL = "SELECT * FROM post where user_id != '$id' and status = 1";
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


        <!-- Header End -->
        <div class="container-xxl py-5 bg-dark page-header mb-5">
            <div class="container my-5 pt-5 pb-4">
                <h1 class="display-3 text-white mb-3 animated slideInDown">All Posts</h1>
            </div>
        </div>
        <!-- Header End -->





        <!-- Jobs Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <h1 class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">All Posts</h1>


                <!-- Search Start -->
    <form action = 
        "<?php
            echo 
            htmlspecialchars($_SERVER["PHP_SELF"]);
         ?>" 
         method = "POST">
        <div class="container-fluid bg-light mb-5 wow fadeIn" data-wow-delay="0.1s" style="padding: 35px;">
            <div class="container">
                <div class="row g-2">
                    <div class="col-md-10">
                        <div class="row g-2">
                            <div class="col-md-4">
                                <select class="form-select border-0" name = "post_tag" >
                                    <option value = 0>None</option>
                                    <?php
                                    while ($tags = mysqli_fetch_array(
                                    $allTag , MYSQLI_ASSOC)):;
                                    ?>
                                    <option 
                                    value="<?php 
                                    echo $tags["id"];
                                    ?>"
                                    >
                    
                                    <?php 
                                    echo $tags["title"];
                                    ?>
                                    </option>
                
                                    <?php
                                    endwhile;
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <select class="form-select border-0" name = "ava">
                                    <option value = -1>None</option>
                                    <option value="0">Close</option>
                                    <option value="1">Open</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                        <input type="date"  class="form-control" style="width: 100;" name="post_time" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <button class="btn btn-dark border-0 w-100" name = "save_search">Search</button>
                    </div>

                </div>
            </div>
        </div>
    </form>
        <!-- Search End -->





                <div class="tab-class text-center wow fadeInUp" data-wow-delay="0.3s">
                    <div class="tab-content">
                        <div id="tab-1" class="tab-pane fade show p-0 active">
                            <div class="job-item p-4 mb-4">

<?php
         $select = mysqli_query($conn , $searchSQL);

         while ($row = mysqli_fetch_assoc($select)) {
        
?>

                                <div class="row g-4">
                                    <div class="col-sm-12 col-md-8 d-flex align-items-center">
                                        <img class="flex-shrink-0 img-fluid border rounded" src="img/com-logo-1.jpg" alt="" style="width: 80px; height: 80px;">
                                    <div class="text-start ps-4">
                                        <a href = "post-detail.php?post=
                                            <?php echo $row['id'];?>">
                                            <h5 class="mb-3">
                                                <?php echo $row['title'];?>
                                            </h5>
                                        </a>
                                            <span class="text-truncate me-3"><?php echo $row['address'];?></span>
                                            <span class="text-truncate me-3"><i class="far fa-clock text-primary me-2"></i>Full Time</span>
                                    </div>
                                </div>

                                    <div class="col-sm-12 col-md-4 d-flex flex-column align-items-start align-items-md-end justify-content-center">
                                        <div class="d-flex mb-3">
                                            <a class="btn btn-primary" href="addlist.php?index=<?php echo $row['id'];?>">Apply Now</a>
                                        </div>
                                        <small class="text-truncate"><i class="far fa-calendar-alt text-primary me-2"></i>Date Line: <?php echo $row['post_time'];?></small>
                                    </div>
                                </div>



<?php
        };
    ?>
                                
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Jobs End -->


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


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
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