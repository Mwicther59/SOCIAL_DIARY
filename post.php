
<?php
session_start();
?>




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
  <link rel="stylesheet" href="Css/post.css">
  <link rel="stylesheet" href="Css/aside.css">
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


</head>


<body>
   

<img src="imgs/Background.png" class="background" alt="">


 
<?php
      // fetching posts
      $id = $_GET['post_id'];
      $sql = "SELECT * FROM `post` WHERE post_id=$id";
      $result = mysqli_query($conn, $sql);
      $postHai = false;
      if($result)
        $postHai = true;
      else
        $postHai = false;
      if($postHai)
      {
        
        while ($row = mysqli_fetch_assoc($result)) {
          $post_desc=$row['post_desc'];
          $post_id=$row['post_id'];
         $post_img=$row['post_img'];
         $post_user_by=$row['post_user_by'];
         $post_user_img=$row['post_user_img'];
         $timestamp = $row['timestamp'];
      $year = substr($timestamp,0,4);
      $month = substr($timestamp,5,2);
      $day = substr($timestamp,8,2);
          
      // TIME OF POSTED
      $time = $day."/".$month."/".$year;
        
          echo '
          <div class="post container">
      <!-- POST HEADING -->
      <div class="comment-post-head">
        <div class="comment-icon">
        <img src="data:image/jpeg;base64,' . base64_encode($post_user_img) . '" alt="" height="60em" />
        </div>
        <div class="comment-name">
          <h1>'.$post_user_by.'</h1>
          <p>'.$post_desc.'</p>
        </div>
  
      </div>
  
      <!-- video  -->
      <div class="videos" style="display:flex;
      justify-content:center;
      align-items:center";>
     
      <img src="data:image/jpeg;base64,'. base64_encode($post_img) .'" alt=""/>
      </div>
      <div class="icons">
      <i class="fa fa-share-square-o share" aria-hidden="true" data-bs-toggle="modal" data-bs-target="#exampleModal"></i>
        <p class="comment" data-bs-toggle="modal" data-bs-target="#exampleModal">Add a comment</p>
  
        <p class="posted">Posted On '.$time.'</p>
        </div>
        ';
      }
    }
      else
      {
        echo "No Posts";
      } 
?>
 
<?php
// MAKE A COMMENT
  $id = $_GET['post_id'];
  $method = $_SERVER['REQUEST_METHOD'];
  if ($method == 'POST' && isset($_SESSION['loggedin']) ) {
    $desc = $_POST['desc'];
    $comment_BY = $_SESSION['user_email'];
    $comment_BY_img = $_SESSION['user_img'];
    
      
    if($desc == null )
    {
      echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
              <strong>Please Enter the description To Make a Comment.
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
    }
    else
    {
      // Use prepared statement to avoid SQL injection
      $sql = "INSERT INTO `comments` (`comment_content`, `post_id`, `comment_time`, `comment_by`,`comment_by_img`) 
              VALUES (?, ?, current_timestamp(), ?, ?)";
      $stmt = $conn->prepare($sql);
  
      // Bind parameters
      $stmt->bind_param("ssss", $desc, $id, $comment_BY, $comment_BY_img);
  
      // Execute the statement
      $stmt->execute();

    }

}
else if(!isset($_SESSION['loggedin']))
{
  echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Please Login to your account To Make a Comment.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}
?>


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Type your comment</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body ">
          <form action="<?php $_SERVER['REQUEST_URI']?>" method="post">
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">DESCRIPTION</label>
                <input type="text" class="form-control" id="desc" name="desc">
              </div>
              <button type="submit" class="btn btn-primary">Post</button>
            </form>
          </div>
        </div>
      </div>
    </div>


    <!-- SHOW COMMENTS -->
    <div class="comments">
        <h5 id="thecomment">Comments</h1>
        <div class="outer-comment" id="outer-comment">
      <?php
        
  
      $id=$_GET['post_id'];
      $sql = "SELECT * FROM `comments` WHERE post_id=$id";
      $result = mysqli_query($conn, $sql);
      $comments = false;
      if($result)
        $comments = true;
      else
        $comments = false;
      if($comments)
      {
        while ($row = mysqli_fetch_assoc($result)) {
          echo '
                  <hr>
                    <div class="comment-post-head2">
                    <div class="comment-self">
                      <div class="comment-icon">
                      <img src="data:image/jpeg;base64,' . base64_encode($row['comment_by_img']) . '" alt="" height="60em" />
                      <span><strong>'. $row['comment_by'] .'</strong></span>
                      </div>
                      <div class="comment-name">
                        <p>'. $row['comment_content'] .'</p>
                      </div>
                      </div>
                      </div>
                ';
        
        }
      }
      else
      {
        echo "No Comments Yet !";
      }
        ?>
         </div>
        </div>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>



</html>