<?php
$sessionStatus = session_status();
$loginError="false";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    include 'dbconnect.php';
    $email = $_POST['login-email'];
    $pass = $_POST['login-pass'];
    
      if($email == null || $pass)
      {
         header("Location: /Social-dairy/Social-dairy/login.php?logins=false");
         echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
              <strong>Please Enter the Email Or Password To Login.
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
      }
    // Check whether this email exists
    $existSqlForImg = "select user_img from `users` where user_email = '$email'";
    $resultForImg = mysqli_query($conn, $existSqlForImg);
    $numRowsForImg = mysqli_num_rows($resultForImg);
    if($numRowsForImg==1)
    {
      $row1 = mysqli_fetch_assoc($resultForImg);
      if ($sessionStatus == PHP_SESSION_DISABLED || $sessionStatus == PHP_SESSION_NONE)
      {
         session_start();
         $_SESSION['user_img'] = $row1['user_img'];
      }
      else
      {
         $_SESSION['user_img'] = $row1['user_img'];
         
      }
    }

    //for Image 
    $existSql = "select * from `users` where user_email = '$email'";
    $result = mysqli_query($conn, $existSql);
    $numRows = mysqli_num_rows($result);

    //for emmail and pass
    if($numRows==1){
       $row = mysqli_fetch_assoc($result);
       if (password_verify($pass, $row['user_pass'])) {
            if($sessionStatus == PHP_SESSION_DISABLED || $sessionStatus == PHP_SESSION_NONE)
            {
               session_start();
               $_SESSION['loggedin']=true;
               $_SESSION['sno'] = $row['sno'];
               $_SESSION['user_email']=$email;
            }

          header("Location: /Social-dairy/Social-dairy/explore.php?logins=true");
         }
        else{
           header("Location: /Social-dairy/Social-dairy/login.php?logins=false");
         }
         
      }
   }  
        
  
  
   
?>
