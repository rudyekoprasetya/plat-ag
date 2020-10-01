<div class="panel-heading">
	<h3 class="panel-title"><i class="fa fa-rocket"></i> <?php echo $judul; ?></h3>
</div>

<div class="panel-body">
 <div class="row">
  	<div class="col-lg-12">
  		<?php 
  			if($this->session->flashdata('message')){
  				echo $this->session->flashdata('message');
  			}
  		?>
  		<button class="btn btn-big btn-success" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i> Add</button>
  		<div class="table-responsive">
          <table class="table table-hover table-striped">
          	<thead>
          		<tr>
          			<th>No</th>
          			<th>ID Project</th>
          			<th>Mikrokontroller</th>
          			<th>Aktif</th>
          			<th></th>	
          		</tr>
          	</thead>
          	<tbody>
<?php 
$no=0;
foreach ($project->result() as $row) {
$no++;
?>
          		<tr>
          			<td><?= $no;?></td>
          			<td><?= $row->project_id;?></td>
          			<td><?= $row->mikrokontroller;?></td>
          			<td><?= $row->is_aktif;?></td>
          			<td>
          				<button class="btn btn-small btn-warning" data-toggle="modal" data-target="#myModalEdit" onclick="edit('<?= $row->id_project; ?>')" ><i class="fa fa-pencil"></i> </button> 
          				<a href="<?= site_url('project/delete/'.$row->id_project); ?>" class="btn btn-small btn-danger" onclick="return confirm('Yakin Akan Hapus?')"><i class="fa fa-times"></i> </a> 
          				<button class="btn btn-small btn-info"><i class="fa fa-tags"></i> </button> 
          			</td>
          		</tr>
<?php } ?>
          	</tbody>
          </table>
        </div>
    </div>    
 </div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalInfoLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalInfoLabel">Tambah Data</h4>
      </div>
      <div class="modal-body">
      <form method="POST" action="<?= site_url('project/add'); ?>">
      	<label>Jenis Mikrokontroller</label>
      	<input type="text" name="mikrokontroller" class="form-control" required="required">
      	<label>Deskripsi</label>
      	<textarea class="form-control" name="deskripsi" required="required"></textarea>
      	<label>Longitude</label>
      	<input type="text" name="longitude" class="form-control">
      	<label>Latitude</label>
      	<input type="text" name="latitude" class="form-control">
      	<label>Aktif</label>
      	<select class="form-control" name="is_aktif">
      		<option value="yes">yes</option>
      		<option value="no">no</option>
      	</select>
      </div>
      <div class='modal-footer'>
        <button type='submit' class='btn btn-primary'><i class="fa fa-save"></i> Save</button>
        <button type='button' class='btn btn-default' data-dismiss='modal'><i class="fa fa-times"></i> Cancel</button>
       </form>
      </div>
     
    </div>
  </div>
</div>
<!--END Modal  -->

<!-- Modal Edit-->
<div class="modal fade" id="myModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalInfoLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalInfoLabel">Edit Data</h4>
      </div>
      <div class="modal-body" id="tempat_edit">
      

      </div>     
    </div>
  </div>
</div>
<!--END Modal Edit -->
<script type="text/javascript">
	function edit(id) {
		$.ajax({
			type: 'POST',
			url: '<?= site_url("project/edit") ?>',
			data: 'id_project='+id,
			success: function(data) {
				$('#tempat_edit').html(data);
			}
		});
	}
</script>