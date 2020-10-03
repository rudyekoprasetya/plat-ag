<div class="panel-heading">
	<h3 class="panel-title"><i class="fa fa-globe"></i> <?php echo $judul; ?></h3>
</div>

<div class="panel-body">
  <div class="row">
  	<div class="col-lg-12">
  		<div class="jumbotron">
		  <h1>Selamat Datang !</h1>
		  <p>PlatAG (Platform Arduino Gabungan), Memudahkan Anda dalam mengelola data dari perangkat IoT secara terpusat dan berbasiskan Cloud</p>
		</div>
  	</div>  	
  </div>

  <div class="row">
  	

  	<div class="col-lg-3">
  		<div class="panel panel-primary">
		  <div class="panel-heading">
		    <h3 class="panel-title"><i class="fa fa-user-md"></i> Users</h3>
		  </div>
		  <div class="panel-body">
		    <h2><a href="<?= site_url('user/profil') ?>"> Profile</a></h2>
		  </div>
		</div>
  	</div>

  	<div class="col-lg-3">
  		<div class="panel panel-primary">
		  <div class="panel-heading">
		    <h3 class="panel-title"><i class="fa fa-rocket"></i> Projects</h3>
		  </div>
		  <div class="panel-body">
		    <h2><a href="<?= site_url('project'); ?>"><?= $project; ?> Projects</a></h2>
		  </div>
		</div>
  	</div>

  	<div class="col-lg-3">
  		<div class="panel panel-primary">
		  <div class="panel-heading">
		    <h3 class="panel-title"><i class="fa fa-tasks"></i> Channels</h3>
		  </div>
		  <div class="panel-body">
		    <h2><a href="#"><?= $channel; ?> Channels</a></h2>
		  </div>
		</div>
  	</div>

  	<div class="col-lg-3">
  		<div class="panel panel-primary">
		  <div class="panel-heading">
		    <h3 class="panel-title"><i class="fa fa-gears"></i> Setting</h3>
		  </div>
		  <div class="panel-body">
		    <h2><a href="<?= site_url('code'); ?>"> Configuration</a></h2> 
		  </div>
		</div>
  	</div>

  </div>
</div>