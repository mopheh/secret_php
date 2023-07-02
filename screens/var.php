<?php 
    $name = $email = $password = $confirmPassword = '';
    $nameErr = $emailErr = $passwordErr = $confirmPasswordErr = '';
    $conn = new mysqli('localhost', 'mofe', '12345678', 'secrets');
    
    if (isset($_POST["name"]) && $_POST["name"] && isset($_POST["email"]) && $_POST["email"] && isset($_POST["password"]) && $_POST["password"]) {
        if (empty(trim($_POST["name"]))) {
            $nameErr = "Name is required.";
        } else {
            $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        }
        if (empty(trim($_POST["email"]))) {
            $emailErr = "Email is required.";
        } else {
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        }
        if (empty(trim($_POST["password"]))) {
            $passwordErr = "Password is required";
        } else {
            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        }
        if (empty(trim($_POST["confirmPassword"]))) {
            $confirmPasswordErr = "Retype Password.";
        } else {
            $confirmPassword = filter_input(INPUT_POST, 'confirmPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            if ($password != $confirmPassword) {
                $confirmPasswordErr = "Passwords do not match!!!";
            }else {
                $passwordHash = password_hash($password, PASSWORD_BCRYPT);
            }
        }
        if( empty($nameErr) && empty($emailErr) && empty($passwordErr) && empty($confirmPasswordErr) ){
            $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$passwordHash')";
            if (mysqli_query($conn, $sql)) {
                session_start();
                $_SESSION['email'] = $email;
                echo json_encode(array('success' => 1));
            } else {
                echo 'Error: ' . mysqli_error($conn);
            }
      
        }        
    }
    
?>