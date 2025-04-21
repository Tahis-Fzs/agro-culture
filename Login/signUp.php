<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require '../db.php';

    // Sanitize and retrieve form data
    $name = dataFilter($_POST['name']);
    $mobile = dataFilter($_POST['mobile']);
    $user = dataFilter($_POST['uname']);
    $email = dataFilter($_POST['email']);
    $pass = dataFilter(password_hash($_POST['pass'], PASSWORD_BCRYPT));
    $hash = dataFilter(md5(rand(0, 1000)));
    $category = (int)dataFilter($_POST['category']); // Ensure it's an integer
    $addr = dataFilter($_POST['addr']);

    // Save to session (optional)
    $_SESSION['Email'] = $email;
    $_SESSION['Name'] = $name;
    $_SESSION['Password'] = $pass;
    $_SESSION['Username'] = $user;
    $_SESSION['Mobile'] = $mobile;
    $_SESSION['Category'] = $category;
    $_SESSION['Hash'] = $hash;
    $_SESSION['Addr'] = $addr;
    $_SESSION['Rating'] = 0;

    // Validate mobile number length
    $length = strlen($mobile);
    if ($length != 10) {
        $_SESSION['message'] = "Invalid Mobile Number!";
        header("location: error.php");
        exit();
    }

    // Check and Insert based on category (1 = Farmer, 0 = Buyer)
    if ($category === 1) { // Farmer Registration
        $sql = "SELECT * FROM farmer WHERE femail='$email'";
        $result = mysqli_query($conn, $sql);

        if ($result->num_rows > 0) {
            $_SESSION['message'] = "User with this email already exists!";
            header("location: error.php");
        } else {
            $sql = "INSERT INTO farmer (fname, fusername, fpassword, fhash, fmobile, femail, faddress) 
                    VALUES ('$name', '$user', '$pass', '$hash', '$mobile', '$email', '$addr')";

            if (mysqli_query($conn, $sql)) {
                setupUserSession('farmer', $user);
                $_SESSION['message'] = "Confirmation link has been sent to $email. Please verify your account!";
                header("location: profile.php");
            } else {
                $_SESSION['message'] = "Registration failed! " . mysqli_error($conn);
                header("location: error.php");
            }
        }
    } elseif ($category === 0) { // Buyer Registration
        $sql = "SELECT * FROM buyer WHERE bemail='$email'";
        $result = mysqli_query($conn, $sql);

        if ($result->num_rows > 0) {
            $_SESSION['message'] = "User with this email already exists!";
            header("location: error.php");
        } else {
            $sql = "INSERT INTO buyer (bname, busername, bpassword, bhash, bmobile, bemail, baddress) 
                    VALUES ('$name', '$user', '$pass', '$hash', '$mobile', '$email', '$addr')";

            if (mysqli_query($conn, $sql)) {
                setupUserSession('buyer', $user);
                $_SESSION['message'] = "Confirmation link has been sent to $email. Please verify your account!";
                header("location: profile.php");
            } else {
                $_SESSION['message'] = "Registration failed! " . mysqli_error($conn);
                header("location: error.php");
            }
        }
    } else {
        $_SESSION['message'] = "Invalid Category Selected!";
        header("location: error.php");
    }
}

// Utility function to sanitize input
function dataFilter($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Function to set up session for the user after successful registration
function setupUserSession($table, $username) {
    global $conn;

    $sql = "SELECT * FROM $table WHERE " . ($table === 'farmer' ? 'fusername' : 'busername') . "='$username'";
    $result = mysqli_query($conn, $sql);
    $User = $result->fetch_assoc();

    $_SESSION['id'] = ($table === 'farmer') ? $User['fid'] : $User['bid'];
    $_SESSION['Active'] = 0;
    $_SESSION['logged_in'] = true;

    // Set profile picture placeholder
    if ($_SESSION['picStatus'] == 0) {
        $_SESSION['picId'] = 0;
        $_SESSION['picName'] = "profile0.png";
    } else {
        $_SESSION['picId'] = $_SESSION['id'];
        $_SESSION['picName'] = "profile" . $_SESSION['picId'] . "." . $_SESSION['picExt'];
    }
}
?>

