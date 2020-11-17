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
    <!-- <link rel="stylesheet" href="<?= base_url ('assets/guest/') ?>css/signin.css"> -->
  </head>
  <body class="text-center">
  <div class="container">
  <div class="col-xs-12 col-lg-8 ml-auto mr-auto col-md-8"> <!--//ukuran tampilan layar-->
  
    <form method="post" action="<?= base_url('register/store') ?>">
    <h1 class="mb-3 font-weight-normal">Masukan Data Anda</h1>
    <div class="form-group">
        <label for="username" class="sr-only">Username</label>
        <input type="text" id="username" class="form-control" placeholder="Username" name="username" autofocus>
    </div>
    <?php echo form_error('username'); ?>
    <div class="form-group">
        <label for="password" class="sr-only">Password</label>
        <input type="password" id="password" class="form-control" placeholder="Password" name="password">
    </div>
    <?php echo form_error('password'); ?>
    <div class="form-group">
        <label for="password" class="sr-only">Nama</label>
        <input type="text" id="nama" class="form-control" placeholder="Nama" name="nama" autofocus>
    </div>
    <?php echo form_error('nama'); ?>
    <div class="form-group">
        <label for="password" class="sr-only">Alamat</label>
        <input type="text" id="alamat" class="form-control" placeholder="Alamat" name="alamat" autofocus>
    </div>
    <?php echo form_error('alamat'); ?>
    <div class="form-group">
        <label for="password" class="sr-only">No.Hp</label>
        <input type="text" id="no_hp" class="form-control" placeholder="No.Hp" name="no_hp" autofocus>
    </div>
    <?php echo form_error('no_hp'); ?>
    <div class="form-group">
        <label for="password" class="sr-only">Email</label>
        <input type="text" id="email" class="form-control" placeholder="Email" name="email" autofocus>
    </div>
    <?php echo form_error('email'); ?>
  </div>
  <button class="btn btn-lg btn-primary" type="submit" name="login">Simpan</button>
  <a href="<?= base_url('home') ?>" class="btn btn-lg btn-success">Kembali</a>
  <p class="mt-5 mb-3 text-muted">Politeknik Negeri Cilacap &copy; <?= date('Y') ?></p>
</form>
  
  </div>
</body>
</html>