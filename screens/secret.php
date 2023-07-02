<?php include '../inc/header.php';
    if (!isset($_SESSION['email'])) {
        header('location: login.php');
  };
?>
<div class="container mx-auto mt-5 secret-page text-center">
    <i class="fas fa-key fa-6x"></i>
    <p class="display-4">You've discovered my secrets.</p>
    <hr />
    <div class="row">
        <div class="col-12">
          <div
            bg="dark"
            class="navbar bg-dark rounded-top p-1"
            expand="sm"
            variant="dark"
          >
            <h4 class="navbar-brand ml-4 mb-0 text-white">Secrets</h4>
            <div class="nav ml-auto">
              <button class="btn btn-light mx-1 rounded" onclick="logout()">
                Logout
              </button>
              <a href="compose.php">
                <button class="btn btn-secondary mx-1 rounded color-btn">
                  Tell a Secret
                </button>
              </a>
            </div>
          </div>
        </div>
        <div class="col-12">
          <?php  
            $sql = "SELECT * FROM secrets";
            $result = mysqli_fetch_all(mysqli_query($conn, $sql), MYSQLI_ASSOC); ?>
            <?php if ($result): ?>
              <?php foreach ($result as $key): ?>
                <div class="secret py-2">
                  <div class="mx-5 text-left">
                    <?php echo $key['secret']; ?>
                  </div>
                </div>
              <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php include '../inc/footer.php' ?>