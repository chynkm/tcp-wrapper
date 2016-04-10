<?php
session_start();
if(isset($_SESSION['logged_in']))
    header("location: index.php");

if($_POST)
{
    if($_POST['email'] == "demo@toptrix.in" && md5($_POST['password']) == "fe01ce2a7fbac8fafaed7c982a04e229")
    {
        $_SESSION['logged_in']= 1;
        header("location: index.php");
    }
    else
        $authentication_failed = 1;
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="TCP Wrapper Editor by Toptrix">
    <meta name="author" content="mail@toptrix.in">
    <link rel="icon" href="favicon.ico">
    <title>TCP Wrapper Editor | TopTrix</title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/signin.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="container">
      <form class="form-signin" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <h2 class="form-signin-heading">TCP Wrapper Editor</h2>
        <?php if($authentication_failed): ?>
          <div class="alert alert-danger" role="alert">
            The email and password you entered don't match.
          </div>
        <?php endif; ?>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email address" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      </form>
    </div> <!-- /container -->
  </body>
</html>