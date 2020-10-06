<div class="panel-heading">
	<h3 class="panel-title"><i class="fa fa-users"></i> <?php echo $judul; ?></h3>
</div>

<div class="panel-body">
 <div class="row">
  	<div class="col-lg-12">
  		<?php 
  			if($this->session->flashdata('message')){
  				echo $this->session->flashdata('message');
  			}
  		?>
  		<div class="table-responsive">
          <table class="table table-hover table-striped">
          	<thead>
          		<tr>
          			<th>No</th>
          			<th>Email</th>
          			<th>Nama</th>
                	<th>Jenis Kelamin</th>
          			<th>Aktif?</th>
          		</tr>
          	</thead>
          	<tbody>
<?php 
$no=0;
foreach ($user->result() as $row) {
$no++;
?>
          		<tr>
          			<td><?= $no ?></td>
          			<td><?= $row->email; ?></td>
          			<td><?= $row->nama; ?></td>
          			<td><?= $row->gender; ?></td>
          			<td>
          				<?php if($row->is_aktif=='no') { ?>
          				<a href="<?= site_url('admin/aktifuser/'.$row->id_user.'/yes'); ?>" class="btn btn-danger btn-small" onclick="return confirm('Aktifkan Akun ini?')"><i class="fa fa-ban"></i></a>
          				<?php } else { ?>
          				<a href="<?= site_url('admin/aktifuser/'.$row->id_user.'/no'); ?>" class="btn btn-success btn-small" onclick="return confirm('Nonaktifkan Akun ini?')"><i class="fa fa-check"></i></a>

          				<?php } ?></td>
          		</tr>
<?php } ?>
          	</tbody>
          </table>
        </div>
  	</div>
 </div>
</div>