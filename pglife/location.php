<?php
include 'config.php';
session_start();

if (!isset($_SESSION['usermail'])) {
    header("location: index.php");
    exit();
}

if (isset($_POST['submit_location']) && isset($_POST['location'])) {
    $_SESSION['location'] = $_POST['location'];
    header("Location: home.php");
    exit();
}

$city_query = "SELECT city FROM locations";
$city_result = mysqli_query($conn, $city_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Select Location</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    html, body {
      height: 100%;
      font-family: 'Segoe UI', sans-serif;
    }

    .main-container {
      display: flex;
      height: 100vh;
    }

    .left-side {
      flex: 1;
      background: url('./image/romantic-hotels.jpg') no-repeat center center/cover;
    }

    .right-side {
      flex: 1;
      background: #f4f4f4;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 40px 20px;
    }

    .content-box {
      width: 100%;
      max-width: 500px;
      text-align: center;
    }

    .location-title {
      font-size: 30px;
      font-weight: bold;
      color: #333;
      margin-bottom: 30px;
    }

    .card-container {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 20px;
      margin-bottom: 30px;
    }

    .city-card {
      position: relative;
      width: 150px;
      height: 100px;
      border-radius: 10px;
      overflow: hidden;
      cursor: pointer;
      border: 3px solid transparent;
      transition: all 0.3s ease;
    }

    .city-card:hover,
    .city-card.selected {
      border-color: #007bff;
      box-shadow: 0 6px 12px rgba(0,123,255,0.3);
    }

    .city-card img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      filter: brightness(70%);
    }

    .city-name {
      position: absolute;
      bottom: 10px;
      width: 100%;
      text-align: center;
      color: white;
      font-size: 18px;
      font-weight: bold;
      text-shadow: 1px 1px 3px rgba(0,0,0,0.8);
    }

    .search-btn {
      background-color: #28a745;
      color: white;
      padding: 12px 30px;
      border: none;
      border-radius: 10px;
      font-size: 16px;
      font-weight: bold;
      transition: background-color 0.3s ease;
    }

    .search-btn:hover {
      background-color: #1e7e34;
    }

    @media (max-width: 768px) {
      .main-container {
        flex-direction: column;
      }

      .left-side {
        height: 35vh;
      }

      .right-side {
        height: auto;
      }

      .city-card {
        width: 120px;
        height: 80px;
      }
    }
    .left-side {
  flex: 1;
  position: relative;
  overflow: hidden;
}

.slideshow {
  width: 100%;
  height: 100%;
  position: relative;
}

.slide {
  position: absolute;
  width: 100%;
  height: 100%;
  object-fit: cover;
  opacity: 0;
  transition: opacity 1s ease-in-out;
}

.slide.active {
  opacity: 1;
}

  </style>
</head>
<body>

<div class="main-container">
  <!-- Left Side swipe Image -->
  <div class="left-side">
  <div class="slideshow">
    <img src="image/romantic-hotels1.jpg" class="slide active" />
    <img src="image/romantic-hotels2.jpg" class="slide" />
  </div>
</div>


  <!-- Right Side Selection -->
  <div class="right-side">
    <div class="content-box">
      <h2 class="location-title">Choose Your City</h2>
      <form method="POST">
        <input type="hidden" name="location" id="selectedLocation">
        <div class="card-container">
          <?php
          $imageMap = [
              'Bangalore' => 'bangalore.jpg',
              'Chennai' => 'chennai.jpg',
              'Delhi' => 'delhi.jpg',
              'Mumbai' => 'mumbai.jpg',
              'Kolkata' => 'kolkata.jpg',
              'Pune' => 'pune.jpg',
          ];

          if ($city_result && mysqli_num_rows($city_result) > 0) {
              while ($row = mysqli_fetch_assoc($city_result)) {
                  $city = htmlspecialchars($row['city']);
                  $img = isset($imageMap[$city]) ? $imageMap[$city] : 'default.jpg';
                  echo "
                  <div class='city-card' onclick=\"selectCity(this, '$city')\">
                      <img src='image/$img' alt='$city'>
                      <div class='city-name'>$city</div>
                  </div>";
              }
          } else {
              echo "<p>No cities available</p>";
          }
          ?>
        </div>
        <button type="submit" name="submit_location" class="search-btn">Search</button>
      </form>
    </div>
  </div>
</div>

<script>
  function selectCity(element, cityName) {
    document.querySelectorAll('.city-card').forEach(card => card.classList.remove('selected'));
    element.classList.add('selected');
    document.getElementById('selectedLocation').value = cityName;
  }
</script>
<script>
  let currentIndex = 0;
  const slides = document.querySelectorAll(".slide");

  setInterval(() => {
    slides[currentIndex].classList.remove("active");
    currentIndex = (currentIndex + 1) % slides.length;
    slides[currentIndex].classList.add("active");
  }, 2000); // 2 seconds
</script>

</body>
</html>
