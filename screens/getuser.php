
<?php
    include '../config/db.php';
    include 'var.php';
    $q = $_GET['q'];

    
    mysqli_select_db($conn,"ajax_demo");
    $sql="SELECT * FROM users WHERE email = '".$q."'";
    $result = mysqli_fetch_assoc(mysqli_query($conn, $sql));
    // $row = mysqli_fetch_assoc($result);
    if ($result) {
        echo "User already exist";
        $emailErr = "User already exist";
    } else {
        echo 'User does not exist';
    }
    


?>