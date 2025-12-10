
<?php
include 'config.php';
session_start();

$usermail = "";
$usermail = $_SESSION['usermail'];
if (!$usermail) {
    header("location: location.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PG Life Swipe</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <style>
        html, body {
            height: 100%;
            margin: 0;
            overflow: hidden;
            font-family: Arial, sans-serif;
        }
        .swiper-container {
            width: 100vw;
            height: 100vh;
        }
        .swiper-slide {
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
            background: #f5f5f5;
            flex-direction: column;
        }
        nav {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background: #333;
            color: #fff;
            padding: 10px;
            z-index: 10;
            display: flex;
            justify-content: center;
            gap: 20px;
        }
        nav a {
            color: white;
            text-decoration: none;
            font-size: 18px;
        }
    </style>
</head>
<body>

<nav>
    <a href="#firstsection">Home</a>
    <a href="#secondsection">Rooms</a>
    <a href="#thirdsection">Facilities</a>
    <a href="#contactus">Contact</a>
</nav>

<div class="swiper-container">
    <div class="swiper-wrapper">
        <div class="swiper-slide" id="firstsection">Welcome to PG Life</div>
        <div class="swiper-slide" id="secondsection">Room Details Here</div>
        <div class="swiper-slide" id="thirdsection">Facilities Info Here</div>
        <div class="swiper-slide" id="contactus">Contact Us Form</div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
    const swiper = new Swiper('.swiper-container', {
        direction: 'horizontal',
        slidesPerView: 1,
        keyboard: { enabled: true },
        mousewheel: true,
    });

    // Navigation links to slide index
    const navLinks = document.querySelectorAll('nav a');
    navLinks.forEach((link, index) => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            swiper.slideTo(index);
        });
    });
</script>

</body>
</html>
