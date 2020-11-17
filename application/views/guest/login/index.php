<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <title>SI Reservasi</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.3/examples/sign-in/">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="<?= base_url ('assets/guest/') ?>css/bootstrap.css">


    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 700px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="<?= base_url ('assets/guest/') ?>css/signin.css">
  </head>
  <body class="text-center">
    <form class="form-signin" method="post" action="<?= base_url('login') ?>">
  <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
  <?php echo form_error('email'); ?>
  <div class="form-group">
    <label for="username" class="sr-only">E-mail</label>
    <input type="text" id="email" class="form-control" placeholder="E-mail" name="email" autofocus>
  </div>
  <input type="hidden" name="level" value='3'>
  <?php echo form_error('password'); ?>
  <div class="form-group">
    <label for="password" class="sr-only">Password</label>
    <input type="password" id="password" class="form-control" placeholder="Password" name="password">
  </div>
  <div class="checkbox mb-3">
    <label>
    <input type="checkbox" value="remember-me" name="remember"> Remember me
    </label>
  </div>
  <button class="btn btn-lg btn-primary btn-block" type="submit" name="login">Sign in</button>
  <a href="register.php" class="btn btn-lg btn-success btn-block">Register</a>
  <p class="mt-5 mb-3 text-muted">Politeknik Negeri Cilacap &copy; 2020</p>
</form>
</body>
</html>