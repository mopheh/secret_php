<?php 
    include '../inc/header.php';
    include 'var.php';
    if (isset($_SESSION['email'])) {
        header('location: secret.php');
    }
    
    
 ?>
    <div id="root">
        <div class="container center">
        <form class="w-40 mx-auto" id="register" action="var.php" method="POST">
          <h1 class="text-center">Sign Up</h1>
          
          <div controlId="email" class="my-2 form-group">
            <input
              type="text"
              name="name"
              id="name"
              placeholder="Fullname"
              class="rounded form-control <?php echo $nameErr ? 'is-invalid' : null ?>"
              autoComplete="off"
            />
            <div class="invalid-feedback name">
                <?php echo $nameErr; ?>
            </div>
          </div>
          <div controlId="email" class="my-2 form-group">
            <input
              type="email"
              name="email"
              id="email"
              placeholder="Email"
              class="rounded form-control <?php echo $emailErr ? "is-invalid" : null ?>"
              
              autoComplete="off"
            />
            <div class="invalid-feedback email" id="emailFeedback">
                 <?php echo $emailErr; ?>
            </div>
          </div>
          <div controlId="password" class="form-group my-2">
            <input
              type="password"
              placeholder="Password"
              name="password"
              id="password"
              class="rounded form-control pwd <?php echo $passwordErr ? "is-invalid" : null ?>"
             />
              <div class="invalid-feedback password">
                <?php echo $passwordErr; ?>
            </div>
          </div>
          <div controlId="password" class="form-group my-2">
            <input
              type="password"
              id="confirmPassword"
              placeholder="Confirm Password"
              name="confirmPassword"
              class="rounded form-control cpwd <?php echo $confirmPasswordErr ? "is-invalid" : null ?>"
              
             />
              <div class="invalid-feedback confirmPassword" id="cpwd">
                <?php echo $confirmPasswordErr; ?>
            </div>
          </div>
          <button
            type="submit"
            name="submit"
            id="submit"
            class="rounded btn btn-primary mt-2"
          >
            Register
          </button>
          <div class="row py-3">
            <div class="col">
              Have an Account? <a href="login.php">Sign In instead</a>
            </Col>
          </Row>
    
        </form>
</div>
    </div>
<?php include '../inc/footer.php' ?>
 