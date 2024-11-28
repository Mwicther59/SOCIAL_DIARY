 <!-- SEARCH RESULTS -->
 <div class="container my-3">

<h1 class="my-3">Search Results <?php echo $_GET['search'] ?></h1>
<?php
$noResults = true;
$searchresult = $_GET['search'];
$sql = "SELECT * FROM `post` WHERE MATCH (`post_desc`) AGAINST ('$searchresult' WITH QUERY EXPANSION)";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    $desc = $row['post_desc'];
    $post_img=$row['post_img'];
    $id = $row['post_id'];
    $url = "post.php?post_id=".$id;
    $noResults = false;
    echo '
        <div class="post container">
    <!-- POST HEADING -->
    <div class="comment-post-head">
      <div class="comment-icon">
     <img src="imgs/Ellipse 3.png" alt="" height="50em" />
      </div>
      <div class="comment-name">
        <h1>Tony Bhai</h1>
        <p>'.$desc.'</p>
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

      <p class="posted">Posted 4h ago</p>
      </div>
      ';       
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