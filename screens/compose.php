<?php include '../inc/header.php';
    if (!isset($_SESSION['email'])) {
        header('location: login.php');
    };
    $secret = "";
    $secretErr = "";
    if (isset($_POST["submit"])) {
        if (empty(trim($_POST["secret"]))) {
            $secretErr = "Secret is required.";
        } else {
            $secret = filter_input(INPUT_POST, 'secret', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        }
        if( empty($secretErr) ){
            session_start();
            $email = $_SESSION["email"];
            $sql = "INSERT INTO secrets ( email, secret) VALUES ('$email', '$secret')";
            if (mysqli_query($conn, $sql)) {
                header("location: secret.php");
            } else {
                echo 'Error: ' . mysqli_error($conn);
            }
      
        } 
    }
        
?>
<div class="container center compose text-center">
    <i class="fa-solid fa-pen fa-6x"></i>
    <h1>Everybody has a secret</h1>
    <p class="mt-2">Don't keep your secrets, share them anonymously</p>
    <form class="w-45" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
        <div controlId="secret" class="form-group my-2">
          <input
            type="text"
            name="secret"
            placeholder="What's Your Secret"
            class="form-control rounded mt-3 <?php echo $secretErr ? 'is-invalid' : '' ?>"
          />
          <div class="invalid-feedback">
            <?php echo $secretErr ?>
          </div>
        </div>
        <button
          type="submit"
          name="submit"
          class="rounded mt-2 btn btn-primary"
        >
          Submit
        </button>
    </form>
</div>
<?php include '../inc/footer.php' ?>