<?php
      include "partials/dbconnect.php";
      include "partials/asidebar.php";
    ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>POST</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
  <link rel="stylesheet" href="Css/aside.css" />
  <link rel="stylesheet" href="Css/posting.css" />
  <link rel="stylesheet" href="Css/post.css">
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>


<body>
   

<img src="imgs/Background.png" class="background" alt="">


<div class="container my-3">

<?php
$noResults = true;
$searchresult = $_GET['search'];
$sql = "SELECT * FROM `post` WHERE MATCH (`post_desc`) AGAINST ('$searchresult' WITH QUERY EXPANSION)";
$result = mysqli_query($conn, $sql);
if($result)
{
  $noResults = false;
}
else
{
  $noResults = true;
}
if(!$noResults)
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
if($noResults){
    echo '
    <div class="p-4 mb-4 bg-light rounded-3">
    <div class="container-fluid py-5">
      <h1 class="display-7 fw-bold">No Results Found</h1>
      <p class="col-md-8 fs-4">
      Suggestions: <ul>
      <li> Make sure that all words are spelled correctly. </li>
      <li> Try different keywords. </li>
      <li> Try more general keywords. </li>
      <li> Try fewer keywords.</li>
      </p>
    </div>
  </div>
   '; 
}
?>
</div>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>


</html>
