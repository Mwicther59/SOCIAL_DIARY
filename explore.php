<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Explore</title>
  <link rel="stylesheet" href="Css/aside.css" />

</head>

<body>
 <img src="imgs/Background.png" class="background" alt="">
  <?php
  include "partials/dbconnect.php";
  include "partials/asidebar.php";  

  $existSql1 = "SELECT * FROM `users` WHERE user_email = ''";
      $result1 = mysqli_query($conn, $existSql1);
      $num1Rows1 = mysqli_num_rows($result1);

      if($num1Rows1 > 0)
      {
        $existSql2 = "DELETE FROM `users` WHERE user_email = ''";
            $result2 = mysqli_query($conn, $existSql2);
        
      }
  ?>
  <!-- Main Section -->
  <div class="main">
    <div class="explore">
      <img id="explore_img" src="imgs/Explore.png" alt="" />
    </div>

    <div class="city">
      <?php
      $sql = "SELECT * FROM `cities`";
      $result = mysqli_query($conn, $sql);
      $citesbro = false;
      if($result)
        $citesbro = true;
      else
        $citesbro = false;
      if($citesbro)
      {
        while ($row = mysqli_fetch_assoc($result)) {
        $city_name = $row['city_name'];
          $city_id = $row['city_id'];
          
          $image_data = $row['city_img'];
          $base64_image = base64_encode($image_data);
  
          echo '<div class="cities">
          <a href="city.php?city_id='.$city_id.'">
          <img src="data:image/jpeg;base64,'. $base64_image .'" alt="Image">
     <h1>'.$city_name.'</h1> </a>
   </div>';
        }
      }
      else
      {
        echo "No cites bro";
      }
      ?>
    </div>

    
    
  </div>
</body>

</html>