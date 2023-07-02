<?php 
  include '../inc/header.php'; 
  include '../data.php';
  if (isset($_SESSION['email'])) {
    header('location: secret.php');
  }

?>
    <div id="root">
        <div class="container center">
        <form class="w-40 mx-auto" id="login" action="../data.php" method="POST">
          <h1 class="text-center">Log In</h1>
          
          <div controlId="email" class="my-2 form-group">
            <input
              type="email"
              name="email"
              id="email"
              placeholder="Email"
              class="rounded form-control <?php echo $emailErr ? 'is-invalid' : "" ?>"
              autoComplete="off"
            />
            <div class="invalid-feedback email">
              <?php echo $emailErr ?>
            </div>
          </div>
          <div controlId="password" class="form-group my-2">
            <input
              type="password"
              placeholder="Password"
              id="password"
              name="password"
              class="rounded form-control <?php echo $passwordErr ? 'is-invalid' : "" ?>"
              autocomplete="off"
             />
             <div class="invalid-feedback password">
              <?php echo $passwordErr ?>
             </div>
          </div>
          <button
            type="submit"
            name="submit"
            class="rounded btn btn-primary mt-2"
          >
            Log In
          </button>
          <div class="row py-3">
            <div class="col">
              Don't have an Account? <a href="register.php">Register</a>
            </Col>
          </Row>
    
        </form>
</div>
    </div>
<?php include '../inc/footer.php' ?>
 