<?php 
    $conn = new mysqli('localhost', 'mofe', '12345678', 'secrets');
    $email = $password = "";
    $emailErr = $passwordErr = "";

    if (isset($_POST['email']) && $_POST['email'] && isset($_POST['password']) && $_POST['password']) {
        if (empty(trim($_POST['email']))) {
        $emailErr = "Email is required.";
        } else {
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_SPECIAL_CHARS);
        }
        if (empty(trim($_POST['password']))) {
        $passwordErr = "Password is required.";
        } else {
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);
        }

        if (empty($emailErr) && empty($passwordErr)) {
        $sql = "SELECT * FROM users WHERE email= '".$email."'";
        $result = mysqli_fetch_assoc(mysqli_query($conn, $sql));
        if ($result) {
            if(password_verify($password, $result['password'])){
                session_start();
                $_SESSION['email'] = $result['email'];
                echo json_encode(array('success' => 1));
            } else {
                $passwordErr = "Incorrrect Password.";
                echo json_encode(array('message' => $passwordErr));
            }
        } else {
            $emailErr = "User does not exist.";
            echo json_encode(array('message' => $emailErr));
        }
        }
    }
?>