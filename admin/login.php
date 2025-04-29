<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>Admin Login - Blood Bank</title>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <style>
    body {
      background: url('admin_image/blood-cells.jpg') no-repeat center center fixed;
      background-size: cover;
      height: 100vh;
      margin: 0;
      position: relative;
    }

    body::before {
      content: "";
      position: absolute;
      top: 0;
      left: 0;
      height: 100%;
      width: 100%;
      background-color: rgba(0, 0, 0, 0.6); /* black fade */
      z-index: 0;
    }

    .login-container {
      position: relative;
      z-index: 1;
      height: 100vh;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      color: #fff;
      text-align: center;
    }

    .card {
      background-image: url('admin_image/glossy1.jpg');
      background-size: cover;
      background-position: center;
      padding: 30px;
    }
  </style>
</head>

<body>
  <div class="login-container">
    <h1 style="color: #D2F015;">
      Blood Bank & Management<br>Admin Login Portal
    </h1>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="w-100" style="max-width: 600px;">
      <div class="card">
        <div class="card-body">
          <div class="form-group text-left">
            <label class="font-weight-bold font-italic">Username<span style="color:red">*</span></label>
            <input type="text" name="username" placeholder="Enter your username" class="form-control" required />
          </div>

          <div class="form-group text-left">
            <label class="font-weight-bold font-italic">Password<span style="color:red">*</span></label>
            <input type="password" name="password" placeholder="Enter your Password" class="form-control" required />
          </div>

          <div class="text-center">
            <input type="submit" name="login" class="btn btn-primary" value="LOGIN" style="cursor:pointer" />
          </div>
        </div>
      </div>
    </form>

    <?php
    include 'conn.php';

    if (isset($_POST["login"])) {
      $username = mysqli_real_escape_string($conn, $_POST["username"]);
      $password = mysqli_real_escape_string($conn, $_POST["password"]);

      $sql = "SELECT * FROM admin_info WHERE admin_username='$username' AND admin_password='$password'";
      $result = mysqli_query($conn, $sql) or die("Query failed.");

      if (mysqli_num_rows($result) > 0) {
        session_start();
        $_SESSION['loggedin'] = true;
        $_SESSION["username"] = $username;
        header("Location: dashboard.php");
        exit;
      } else {
        echo '<div class="alert alert-danger mt-3 font-weight-bold"> Username and Password are not matched!</div>';
      }
    }
    ?>
  </div>
</body>

</html>
