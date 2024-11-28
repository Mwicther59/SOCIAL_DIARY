<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LOGIN</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="Css/login.css">
</head>
<body>
    <div class="container">
        <img src="imgs/pic3.png" id="pic1" alt="">
        <img src="imgs/pic2.png" id="pic2" alt="">
        <img src="imgs/pic1.png" id="pic3" alt="">
        <img src="imgs/pic4.png" id="pic4" alt="">
    </div>
    <div id="login">
        <img src="imgs/back.png" alt="">
        <div id="loginbox" class="container">
            <img src="imgs/loginLogo.png" class="spinal" alt="">
            <div class="damnlogin" id="damnlogin">
                <form class="form" action="/Social-dairy/Social-dairy/partials/_handle_Login.php" method="post">
                    <div class="mb-3">
                        <label for="" class="form-label fs-5">EMAIL</label>
                        <input type="email" class="form-control inps" id="login-email" name="login-email">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label fs-5">PASSWORD</label>
                        <input type="password" class="form-control inps" id="login-pass" name="login-pass">
                    </div>
                    <div class="buttons ">
                    <button class="login" >LOGIN</button>
                    </div>
                </form>
                <div class="buttons ">
                    OR
                    <button class="signup" onclick="toggleBox()"> GET SIGN-UP </button>
                    <a onclick="toggleBox()" class="link" style="cursor: pointer;" >Don't have a account?</a>
                </div>

            </div>
            <div class="damnsignup" id="damnsignup">
                <form class="form" action=" /Social-dairy/Social-dairy/partials/_handle_Signup.php" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="" class="form-label fs-5">EMAIL</label>
                        <input type="email" class="form-control inps" id="signup-email" name="signup-email">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label fs-5">PASSWORD</label>
                        <input type="password" class="form-control inps" id="signup-pass" name="signup-pass">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label fs-5">CONFIRM PASSWORD</label>
                        <input type="password" class="form-control inps" id="signup-cpass" name="signup-cpass">
                    </div>
                    <div>
                        <label for="" class="form-label fs-5 ">Add Your Image</label>
                        <input type="file" name="user-img" class="form-control-file" id="user-img">
                    </div>
                    
                    <button class="login">SIGN-UP</button>
                </form>
            </div>

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
<script>
    function toggleBox() {
    var signup = document.getElementById("damnsignup");
    var login = document.getElementById("damnlogin");

    if (signup.style.display === "none" && login.style.display === "block") {
      signup.style.display = "block";
      login.style.display = "none";

    } else {
      signup.style.display = "none";
      login.style.display = "block";
    }
    
  }
</script>
</html>