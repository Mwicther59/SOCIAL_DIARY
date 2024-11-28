<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Explore</title>
  <link rel="stylesheet" href="Css/aside.css" />
  <link rel="stylesheet" href="Css/posting.css" />
  <link rel="stylesheet" href="Css/post.css">

</head>
<style>
  .main
  {
    position: absolute;
    right: 4rem;
    top: 6rem;
    width: 70vw;
  }
</style>
<body>
 <img src="imgs/Background.png" class="background" alt="">
  <?php
  include "partials/dbconnect.php";
  include "partials/asidebar.php"; 
  ?>
  <!-- Main Section -->
  <div class="main">
  <?php
  $sql = "SELECT * FROM `post` ";
  $result = mysqli_query($conn, $sql);
  $postbhai = false;
      if($result)
        $postbhai = true;
      else
        $postbhai = false;
      if($postbhai)
      {
        while ($row = mysqli_fetch_assoc($result)) {
          $post_desc = $row['post_desc'];
          $post_id = $row['post_id'];
          $post_img = $row['post_img'];
          $post_by = $row['post_user_by'];
          $post_by_img = $row['post_user_img'];
          
      
          echo '
              <div class="post container">
          <!-- POST HEADING -->
          <div class="comment-post-head">
            <div class="comment-icon">
            
            <img src="'.base64_encode($post_by_img).'" alt="" height="50em">
          
            </div>
            <div class="comment-name">
              <h1>' . $post_by . '</h1>
              <a href="post.php?post_id=' . $post_id . '">
              <p class="post_desc";">' . $post_desc . '</p>
              </a>
            </div>
      
          </div>
      
          <!-- video  -->
          <div class="videos" style="display:flex;
          justify-content:center;
          align-items:center";>
          <a href="post.php?post_id=' . $post_id. '">
          <img src="data:image/jpeg;base64,' . base64_encode($post_img) . '" alt=""/>
          </a>
          </div>
          <div class="icons">
          <a href="post.php?post_id=' . $post_id . '" style="display:flex;">
          <i class="fa fa-share-square-o share" aria-hidden="true" data-bs-toggle="modal" data-bs-target="#exampleModal"></i>
          <p class="comment" data-bs-toggle="modal" data-bs-target="#exampleModal">Add a comment</p>
          </a>
            <p class="posted">Posted 4h ago</p>
            </div>
            </div>
            ';
          }
      }
      else
      {
        echo "No Post HAI BHAI";
      }
  
  ?>
  </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</html>