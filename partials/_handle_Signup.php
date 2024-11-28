
 <?php
$showError = "false";
$signupSucc = false;
echo "echo";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'dbconnect.php';
    $user_email = $_POST['signup-email'];
    $pass = $_POST['signup-pass'];
    $cpass = $_POST['signup-cpass'];

    
    // CHECK NOT EMPTY INPUTS
    if (empty($user_email)) {
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Please enter a valid Email Id and upload a valid image.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        header("Location: /Social-dairy/Social-dairy/login.php?signupsuccess=false&error=$showError");
        exit(); // Always exit after a header redirect
    } elseif ($pass != $cpass || empty($pass)) {
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Passwords do not match or are empty.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
                header("Location: /Social-dairy/Social-dairy/login.php?signupsuccess=false&error=$showError");
                exit(); // Always exit after a header redirect
            }
            
            
    // Check whether this email exists
    $existSql = "SELECT * FROM `users` WHERE user_email = '$user_email'";
    $result = mysqli_query($conn, $existSql);
    $numRows = mysqli_num_rows($result);
    if ($numRows > 0) {
        $showError = "Email already in use";
        header("Location: /Social-dairy/Social-dairy/login.php?signupsuccess=true&error=$showError");
    }
    elseif($numRows==1 || $numRows == 0)
    {
            $hash = password_hash($pass, PASSWORD_DEFAULT);
            
            if ($result) {
                $showAlert = true;
                
                // Check if a file is uploaded
                if (isset($_FILES['user-img']) && $_FILES['user-img']['size'] > 0) {
                    $file = $_FILES['user-img'];
                    $tmp_name = $file['tmp_name'];
                    $fp = fopen($tmp_name, 'rb');
                    $dataU = '';
                    while (!feof($fp)) {
                        $chunk = fread($fp, 8192);
                        $dataU .= $chunk;
                    }
                    fclose($fp);
                    // Insert image data into the database
                    $sql = "INSERT INTO `users` (`user_email`, `user_pass`,`user_img`, `timestamp`) 
                    VALUES (?, ?, ?, current_timestamp())";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("sss", $user_email, $hash, $dataU);
                    $stmt->execute();
                    $stmt->close();
                    header("Location: /Social-dairy/Social-dairy/explore.php?signupsuccess=true");
                } 
                else{
                    // Use the default image if no file is uploaded
                    $defaultImage = 'default.jpg';
                    $fp = fopen($defaultImage, 'rb');
                    
                    $dataU = '';
                    while (!feof($fp)) {
                        $chunk = fread($fp, 8192);
                        $dataU .= $chunk;
                    }
                    fclose($fp);
                    // Insert image data into the database
                    $sql = "INSERT INTO `users` (`user_email`, `user_pass`,`user_img`, `timestamp`) 
                    VALUES (?, ?, ?, current_timestamp())";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("sss", $user_email, $hash, $dataU);
                    $stmt->execute();
                    $stmt->close();

                    header("Location: /Social-dairy/Social-dairy/explore.php?signupsuccess=trueBUTNO");
                }

            } else {
                echo "Error: " . mysqli_error($conn);
                header("Location: /Social-dairy/Social-dairy/login.php?signupsuccess=false&error=$showError");
                exit(); // Always exit after a header redirect
            }
        }

}
?>


