<div class="panel-heading">
	<h3 class="panel-title"><i class="fa fa-user"></i> <?php echo $judul; ?></h3>
</div>

<div class="panel-body">
  <div class="row">
  	<div class="col-lg-12">
	  <?php if($this->session->flashdata('message')){ ?>
	      <?= $this->session->flashdata('message'); ?>
	  <?php } ?>
 <form method="POST" action="<?= site_url('user/profil');?>">
<?php foreach ($user->result() as $row) { ?>
	<center>
		<img src="<?= base_url().'/assets/uploads/img/profil/'.$row->foto; ?>" alt="<?= $row->nama; ?>" class="img-responsive img-circle" height="150px" width="150px">
	</center>      
	  	<label>Email</label>
	  	<input type="hidden" name="id_user" value="<?= $row->id_user;?>">
		<input type="text" class="form-control" id="email" name="email" value="<?= $row->email;?>" readonly>
		<label>Nama Lengkap</label>
		<input type="text" class="form-control" id="nama" name="nama" value="<?= $row->nama;?>">
		<?= form_error('nama','<small class="text-danger">','</small>');?>
	  	<label>Password</label>
		<input type="password" class="form-control" id="password1" name="password1" placeholder="Ketikan password lama atau ubah password">
		<label>Ulangi Password</label>
		<input type="password" class="form-control" id="password2" name="password2" placeholder="ulangi password diatas">
		<?= form_error('password2','<small class="text-danger">','</small>');?>
		<label>Jenis Kelamin</label>
		<select class="form-control" id="gender" name="gender">
			<option value="L">Laki-laki</option>
			<option value="P">Perempuan</option>
		</select>
		<label>Tanggal Lahir</label>
		<input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" value="<?= $row->tgl_lahir;?>">
		<?= form_error('tgl_lahir','<small class="text-danger">','</small>');?>
		<label>Alamat</label>
		<textarea class="form-control" id="alamat" name="alamat"><?= $row->alamat;?></textarea>
		<?= form_error('alamat','<small class="text-danger">','</small>');?>
		<label>Foto</label>
		<input type="file" class="form-control" id="foto" name="foto">
		<br>
		<button type="submit" class="btn btn-success "><i class="fa fa-save"></i> Save</button>
		<button type="button" class="btn btn-default "><i class="fa fa-save"></i> Cancel</button>
<?php } ?>
</form>  	
  	</div>
  </div>
</div>