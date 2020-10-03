<div class="panel-heading">
	<h3 class="panel-title"><i class="fa fa-hdd-o"></i> <?php echo $judul; ?></h3>
</div>

<div class="panel-body">
 <div class="row">
  	<div class="col-lg-12">
  		<?php 
  			if($this->session->flashdata('message')){
  				echo $this->session->flashdata('message');
  			}
  		?>
      <a href="<?= site_url('project'); ?>" class="btn btn-big btn-info"><i class="fa fa-arrow-left"></i> Back</a>
  		<button class="btn btn-big btn-success" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i> Add</button>
  		<div class="table-responsive">
          <table class="table table-hover table-striped">
          	<thead>
          		<tr>
          			<th>No</th>
          			<th>ID Channel</th>
          			<th>Channel Name</th>
                <th>Tipe</th>
          			<th>Aktif</th>
          			<th></th>	
          		</tr>
          	</thead>
          	<tbody>
<?php 
$no=0;
foreach ($channel->result() as $row) {
$no++;
?>
          		<tr>
          			<td><?= $no;?></td>
          			<td><?= $row->channel_id;?></td>
                <td><?= $row->channel_name;?></td>
          			<td><?= $row->tipe;?></td>
          			<td><?= $row->is_aktif;?></td>
          			<td>
          				<button class="btn btn-small btn-warning" data-toggle="modal" data-target="#myModalEdit" onclick="edit('<?= $row->id_channel; ?>')" ><i class="fa fa-pencil"></i> </button> 
          				<a href="<?= site_url('channel/delete/').base64_encode($row->project_id).'/'.$row->id_channel; ?>" class="btn btn-small btn-danger" onclick="return confirm('Yakin Akan Hapus?')"><i class="fa fa-times"></i> </a>
          				<button class="btn btn-small btn-primary" data-toggle="modal" data-target="#myModalData" onclick="showData('<?= $row->channel_id; ?>')"><i class="fa fa-tasks"></i> </button> 
                  <a class="btn btn-small btn-default" href="<?= site_url('channel/cleardata/').base64_encode($row->project_id).'/'.$row->channel_id; ?>" onclick="return confirm('Yakin akan Hapus Semua Data Channel ini?')"><i class="fa fa-trash-o"></i> </a> 
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
      <form method="POST" action="<?= site_url('channel/add'); ?>">
        <input type="hidden" name="project_id" value="<?= base64_decode($this->uri->segment(3)); ?>">
      	<label>Nama Channel</label>
      	<input type="text" name="channel_name" class="form-control" required="required">        
        <label>Tipe</label>
        <select class="form-control" name="tipe">
          <option value="read">Read Data</option>
          <option value="write">Write Data</option>
        </select>
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

<!-- Modal Data -->
<div class="modal fade" id="myModalData" tabindex="-1" role="dialog" aria-labelledby="myModalInfoLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalInfoLabel">Data Channel</h4>
      </div>
      <div class="modal-body">
        <pre id="tempat_json"></pre>
      
      </div>
      <div class='modal-footer'>
        <button type='submit' class='btn btn-success'><i class="fa fa-print"></i> Export</button>
        <button type='button' class='btn btn-default' data-dismiss='modal'><i class="fa fa-times"></i> Close</button>
      </div>
     
    </div>
  </div>
</div>
<!-- Modal Data -->

<script type="text/javascript">
	function edit(id) {
		$.ajax({
			type: 'POST',
			url: '<?= site_url("channel/edit") ?>',
			data: 'id_channel='+id,
			success: function(data) {
				$('#tempat_edit').html(data);
			}
		});
	}

  function showData(id) {
    $.ajax({
      type: 'POST',
      url: '<?= site_url("channel/show_data") ?>',
      data: 'channel_id='+id,
      dataType: 'json',
      success: function(data) {
        $('#tempat_json').html(JSON.stringify(data,undefined,2));
      }
    });
  }
</script>