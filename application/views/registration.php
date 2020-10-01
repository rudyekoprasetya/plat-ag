<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="<?php echo base_url()."/assets/"; ?>favicon.ico">

    <title><?php echo $judul; ?></title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url()."/assets/"; ?>css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?php echo base_url()."/assets/"; ?>css/signin.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="<?php echo base_url()."/assets/"; ?>js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="container">

      <form class="form-signin" method="post" action="<?= site_url('auth/register'); ?>">
        <h2 class="form-signin-heading"><?php echo $judul; ?></h2>     
    <label for="nama" class="sr-only">Nama Lengkap</label>
        <input type="text" id="nama" class="form-control" placeholder="Nama Anda" name="nama" value="<?= set_value('nama'); ?>">
        <?= form_error('nama','<small class="text-danger">','</small>');?>
    <label></label>
        <label for="email" class="sr-only">Email</label>
        <input type="text" id="email" class="form-control" placeholder="Email" name="email" value="<?= set_value('email'); ?>">
        <?= form_error('email','<small class="text-danger">','</small>');?>
		<label></label>
        <label for="password" class="sr-only">Password</label>
        <input type="password" id="password1" class="form-control" placeholder="Password" name="password1">
        <?= form_error('password1','<small class="text-danger">','</small>');?>
		<label></label>
    <label for="password2" class="sr-only">Password</label>
        <input type="password" id="password2" class="form-control" placeholder="Ulangi Password" name="password2">
    <label></label>
    <label for="gender" class="sr-only">Jenis Kelamin</label>
        <select id="gender" class="form-control" name="gender">
          <option value="L">Laki-laki</option>
          <option value="P">Perempuan</option>
        </select>
    <label></label>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign Up</button>
      </form>
      <div class="text-center">
        <a href="<?= site_url('auth'); ?>">Already have account</a>
      </div>

    </div> <!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="<?php echo base_url()."/assets/"; ?>js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
