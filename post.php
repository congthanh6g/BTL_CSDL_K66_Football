<?php
    @include 'config.php';
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
                            <a href="<?php echo $href1 ?>" class="dropdown-item">Make a post</a>
                        </div>
                    </div>
<?php
session_start();

    $sqlTag = "SELECT * FROM tag";
    $allTag = mysqli_query($conn , $sqlTag);
    $id = $_SESSION["id"];

    if (isset($_POST['save_post'])) {
        $title = $_POST['post_title']; 
        $content = $_POST['post_content'];
        $description = $_POST['post_description'];
        $time = $_POST['post_time'];
        $address = $_POST['post_address'];

        $savedTime = date('Y-m-d', strtotime($time));

        $sqlPosIns = "INSERT INTO post
        (id , user_id, title, content, description, status, created_at, updated_at , post_time, address)
        values
        ('','$id' , '$title' , '$content' , '$description' , 1 , now() , now() , 
            '$savedTime'  , '$address')";
    
        if ($conn -> query($sqlPosIns) == true) {
            $postid =  $conn -> insert_id;;

            echo '<script>alert("Create Post Successfully")</script>';

            if (isset($_POST["post_tag"])) {
                foreach($_POST['post_tag'] as $selected) {
                    $sqlPosTagIns = "INSERT INTO 
                    post_tag(post_id , tag_id , created_at,updated_at) 
                    values ( $postid , $selected ,now() ,now())";
                    if ($conn -> query($sqlPosTagIns) === true) {
                        echo '<script>alert("Create Post_tag Successfully")</script>';
                    } else {
                        echo 'loi' . $conn -> error;
                    }
                }
            }
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

        <!-- post need  title , content , description, status , tags-->

        <div class="container">
    <div class="row">
        
        <div class="col-md-8 col-md-offset-2">
            
            <h2 style = "margin-top: 20px;">Create post</h2>
            
            <form action = 
        "<?php
            echo 
            htmlspecialchars($_SERVER["PHP_SELF"]);
         ?>" 
         method = "POST">
                
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" style="margin-bottom:10px" class="form-control" name="post_title" required />
                </div>

                <div class="form-group">
                    <label for="title">Content</label>
                    <input type="text" style="margin-bottom:10px" class="form-control" name="post_content" required />
                </div>

                <div class="form-group">
                    <label for="title">Time</label>
                    <input type="date" style="margin-bottom:10px" class="form-control" name="post_time" required />
                </div>

                <div class="form-group">
                    <label for="title">Address</label>
                    <input type="text" style="margin-bottom:10px" class="form-control" name="post_address" required />
                </div>
                
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea style="margin-bottom: 15px;" rows="5" class="form-control" name="post_description" required></textarea>
                    <label for="description" style="margin-bottom:15px;">Tags</label>
                </div>



                <select class="form-group" style="margin-bottom:15px;" 
                multiple = "multiple" name = "post_tag[]">
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

                <div class="form-group">
                    <button type="submit" class="btn btn-primary" name = "save_post">
                        Create
                    </button>
                </div>
                
            </form>
        </div>
        
    </div>
</div>











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