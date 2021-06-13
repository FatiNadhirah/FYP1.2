<?php
//  echo md5("staff");
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="Fatin Nadhirah">
  <title>Login</title>

  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css" integrity="sha512-Ez0cGzNzHR1tYAv56860NLspgUGuQw16GiOOp/I2LuTmpSK9xDXlgJz3XN4cnpXWDmkNBKXR/VDMTCnAaEooxA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- Custom styles for this template -->
  <link rel="stylesheet" href="signin.css" />
</head>

<body class="text-center">
  <main class="form-signin">
    <form action = "check_login.php" method = "post" >
      <img class="mb-4 img-fluid rounded mx-auto d-block" src="logo.png" alt="University of Malaya">
      <h1 class="h1 mb-4 fw-normal"><strong>Personality<br />Assessment</strong></h1>
       <?php if (isset($_GET['error'])) { ?>
      <div class="alert alert-danger" role="alert">
          <?=$_GET['error'] ?>
      </div>
      <?php } ?>
      <div class="mt-4 card">
        <div class="card-header">
          Please enter your UMMail account
        </div>
        <div class="card-body">
          <div class="form-floating mt-2 mb-2">
            <input type="email" name="username" class="form-control" id="floatingInput" placeholder="Username" required>
            <label for="floatingInput">Username</label>
          </div>
          <div class="form-floating mt-2 mb-2">
            <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password" required>
            <label for="floatingPassword">Password</label>
          </div>
          <div class="input-group mt-2 mb-2">
            <label class="input-group-text" for="role">Select User Type:</label>
            <select class="form-select" name = "role" id="role" aria-label="role" required>
              <option selected></option>
              <option value="admin">Admin</option>
              <option value="staff">Staff</option>
              <option value="student">Student</option>
            </select>
          </div>
          <button class="w-100 mt-4 btn btn-lg btn-primary" type="submit">Sign in</button>
        </div>
      </div>

      <p class="mt-5 mb-3 text-muted">New student? <a href="register.php">Sign Up</a> | <a href="menu.php">Forgot Password</a></p>
    </form>
  </main>

  


</body>

</html>