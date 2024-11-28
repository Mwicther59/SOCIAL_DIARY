<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=
    , initial-scale=1.0">
    <title>City</title>
    <link rel="stylesheet" href="Css/city.css">
</head>
<body>
    <!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Explore</title>
	<link rel="stylesheet" href="Css/aside.css" />
</head>
<body>

<img src="imgs/Background.png" class="background" alt="">
    <?php
      include "partials/dbconnect.php";
      
      
    include 'partials/asidebar.php'
    ?>
   
	<div class="main">
	
    
    <!-- FETCING THE BANNER OF CITY -->
    <?php
   
      $id=$_GET['city_id'];
      $sql = "SELECT * FROM `cities` WHERE city_id=$id";
      $result = mysqli_query($conn, $sql);
      $citiesbhai = false;
      if($result)
        $citiesbhai = true;
      else
        $citiesbhai = false;
      if($citiesbhai)
      {
        while ($row = mysqli_fetch_assoc($result)) {
            
          $image_data = $row['Big-Img'];
          $base64_image = base64_encode($image_data);
  
          echo '<div class="city-banner">
          <img src="data:image/jpeg;base64,'. $base64_image .'" alt="">
          </div>';
        }
      }
      else
      {
        echo "No cites bro";
      }
       ?>
         
      
        <div class="addPostBtn">
              <button data-bs-target="#exampleModal2" data-bs-toggle="modal">Create POST</button>
        </div>


        <!-- POSTING IMAGES -->
   
<?php
$method = $_SERVER['REQUEST_METHOD'];
if(isset($_SESSION['loggedin']))
{
  if ($method == 'POST') {
    if (isset($_POST['description']) && !empty($_POST['description'])) 
    {
      $ps_desc = $_POST['description'];
      $post_by = $_SESSION['user_email'];
      $post_by_img = $_SESSION['user_img'];


      if (isset($_FILES['img']) && $_FILES['img']['error'] == UPLOAD_ERR_OK) 
      {

        $file = $_FILES['img'];
        $tmp_name = $file['tmp_name'];
        $fp = fopen($tmp_name, 'rb');
        $dataP = '';
        while (!feof($fp)) {
            $chunk = fread($fp, 8192);
            $dataP .= $chunk;
        }
        fclose($fp);

          $sql = "INSERT INTO `post` (`post_desc`, `post_user_by`, `post_cat_id`, `post_img`, `post_user_img`, `timestamp`) 
                  VALUES (?, ?, ?, ?, ?,current_timestamp())";
          $stmt = $conn->prepare($sql);
          $stmt->bind_param("sssss", $ps_desc, $post_by, $id,$dataP,$post_by_img);
          $stmt->execute();
          $stmt->close();
      }
    }
      else
    {
      echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
      <strong>Please Select a Post to upload.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    }
    }
}
?>

		<?php
        include 'posting.php'
        ?>
		</div>
	</div>


    <!-- Modal -->
    <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Post</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body ">

            <form action="<?php $_SERVER['REQUEST_URI']?>" method="post" enctype="multipart/form-data">
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">DESCRIPTION</label>
                <input type="text" name="description" class="form-control" id="description" aria-describedby="emailHelp">
              </div>
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">UPLOAD MEDIA</label>
                <input type="file" name="img" class="form-control-file" id="img">
    </div>
              <button type="submit" class="btn btn-primary">POST</button>
            </form>
          </div>
        </div>
      </div>
    </div>

</body>
</html>
</body>
</html>