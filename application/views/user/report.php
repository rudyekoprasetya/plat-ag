<div class="panel-heading">
	<h3 class="panel-title"><i class="fa fa-tasks"></i> <?php echo $judul; ?></h3>
</div>

<div class="panel-body">
 <div class="row">
 	<div class="col-lg-6"> 
 		<label>Select Project</label>
 		<select name="project_id" class="form-control" id="project_id" onchange="selectProject()">
 			<option>--Pilih Project--</option>
 			<?php foreach($project->result() as $row) { ?>
 			<option value="<?= $row->project_id; ?>"><?= $row->mikrokontroller; ?></option>
	 		<?php } ?>
 		</select>
 	</div>
 	<div class="col-lg-6"> 
 		<label>Select Channel</label>
 		<select name="channel_id" class="form-control" id="channel_id">
 			<option>-Pilih Project Dulu-</option>
 		</select>
 	</div>
 </div>
 <div class="row" style="margin-top: 20px"> 	
 	<div class="col-lg-3">
 		<button class="btn btn-block btn-success" onclick="showTable()"><i class="fa fa-file"></i> Data</button>
 	</div>
 	<div class="col-lg-3">
 		<button class="btn btn-block btn-danger" onclick="showGraph()"><i class="fa fa-fa fa-bar-chart-o"></i> Graph</button>
 	</div>
 	<div class="col-lg-3">
 		<button class="btn btn-block btn-primary" onclick="showGauge()"><i class="fa fa-dashboard"></i> Gauge</button>
 	</div>
 	<div class="col-lg-3">
 		<button class="btn btn-block btn-warning" onclick="showInput()"><i class="fa fa-sign-in"></i> Input Data</button>
 	</div>
 </div>

 <div class="row">
 	<div class="col-lg-12">
 		<!-- untuk grafik -->
 		<!-- import highchart -->
 		<script src="<?= base_url(); ?>/assets/highcharts/code/highcharts.js"></script>
 		<script src="<?= base_url(); ?>/assets/highcharts/code/highcharts-more.js"></script>
		<script src="<?= base_url(); ?>/assets/highcharts/code/modules/series-label.js"></script>
		<script src="<?= base_url(); ?>/assets/highcharts/code/modules/exporting.js"></script>
		<script src="<?= base_url(); ?>/assets/highcharts/code/modules/export-data.js"></script>
		<script src="<?php echo base_url()."/assets/"; ?>js/jquery-1.10.2.js"></script>
		<script>
function showGraph() {	
	$('#grafik').show();
	$('#gauge').hide();
	$('#data_table').hide();
	$('#input_data').hide();
		let channel_id=$('#channel_id').val();
		function getData() {
			let chartData=[];		
			$.ajax({
				type: 'POST',
				url: '<?= site_url("report/getchart") ?>',
				data: 'channel_id='+channel_id,
				dataType: 'json',
				success: function(data) {
					Highcharts.each(data, function(item){
						chartData.push(item);
					});
					chart.series[0].setData(chartData);				
				}
			});
		}

		// js untuk highchart
		var chart = Highcharts.chart('container_grafik', {

		    title: {
		        text: 'Graph Report'
		    },

		    subtitle: {
		        text: 'Channel ID '+channel_id
		    },

		    series: [{	        
		        name: 'Hasil Sensor',
		        data: []
		    }],

		    responsive: {
		        rules: [{
		            condition: {
		                maxWidth: 500
		            },
		            chartOptions: {
		                legend: {
		                    layout: 'horizontal',
		                    align: 'center',
		                    verticalAlign: 'bottom'
		                }
		            }
		        }]
		    }
		});

		setInterval(getData,1000);
}
		</script>
 		<div id="grafik" style="margin-top: 20px; display: none;">
 			<h3>Graph Report</h3>
 			<div id="container_grafik"></div>
 			
 		</div>
 		<!-- untuk grafik -->

<!-- untuk gauge -->
<script>
	function showGauge() {
		$('#grafik').hide();
		$('#gauge').show();
		$('#data_table').hide();
		$('#input_data').hide();
		let channel_id=$('#channel_id').val();

		var gauge = Highcharts.chart('container_gauge', {

		    chart: {
		        type: 'gauge',
		        plotBackgroundColor: null,
		        plotBackgroundImage: null,
		        plotBorderWidth: 0,
		        plotShadow: false
		    },

		    title: {
		        text: 'Gauge Report'
		    },

		    subtitle: {
		        text: 'Channel ID '+channel_id
		    },

		    pane: {
		        startAngle: -150,
		        endAngle: 150,
		        background: [{
		            backgroundColor: {
		                linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
		                stops: [
		                    [0, '#FFF'],
		                    [1, '#333']
		                ]
		            },
		            borderWidth: 0,
		            outerRadius: '109%'
		        }, {
		            backgroundColor: {
		                linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
		                stops: [
		                    [0, '#333'],
		                    [1, '#FFF']
		                ]
		            },
		            borderWidth: 1,
		            outerRadius: '107%'
		        }, {
		            // default background
		        }, {
		            backgroundColor: '#DDD',
		            borderWidth: 0,
		            outerRadius: '105%',
		            innerRadius: '103%'
		        }]
		    },

		    // the value axis
		    yAxis: {
		        min: 0,
		        max: 5000,

		        minorTickInterval: 'auto',
		        minorTickWidth: 1,
		        minorTickLength: 10,
		        minorTickPosition: 'inside',
		        minorTickColor: '#666',

		        tickPixelInterval: 30,
		        tickWidth: 2,
		        tickPosition: 'inside',
		        tickLength: 10,
		        tickColor: '#666',
		        labels: {
		            step: 2,
		            rotation: 'auto'
		        },
		        title: {
		            text: 'value'
		        },
		        plotBands: [{
		            from: 0,
		            to: 2000,
		            color: '#55BF3B' // green
		        }, {
		            from: 2000,
		            to: 4000,
		            color: '#DDDF0D' // yellow
		        }, {
		            from: 4000,
		            to: 5000,
		            color: '#DF5353' // red
		        }]
		    },

		    series: [{
		        name: 'Result',
		        data: [0],
		        tooltip: {
		            valueSuffix: ' points'
		        }
		    }]

		},
		// Add some life
		function (chart) {
		    if (!chart.renderer.forExport) {
		        setInterval(function () {
		        	let chartData=[];		
					$.ajax({
						type: 'POST',
						url: '<?= site_url("report/getgauge") ?>',
						data: 'channel_id='+channel_id,
						dataType: 'json',
						success: function(data) {
							// console.log(data);
							let point = chart.series[0].points[0];	
							point.update(data);			
						}
					});
		        }, 1000);
		    }
		});
	}
</script>
 		<div id="gauge" style="margin-top: 20px; display: none;">
 			<h3>Gauge Report</h3>
 			<div id="container_gauge"></div>
 			
 		</div>
<!-- untuk gauge -->

 		<!-- untuk table -->
 		<div id="data_table" style="margin-top: 20px; display: none;">
 			<h3>Data Channel</h3>
 		 <div class="table-responsive">
          	<table class="table table-hover table-striped">
          		<thead>
          			<tr>
	          			<th>No</th>
	          			<th>Created At</th>
	          			<th>Value</th>
          			</tr>
          		</thead>
          		<tbody id="tempat_data">
          			<tr>
          				<td>-</td>
          				<td>-</td>
          				<td>-</td>
          			</tr>
          		</tbody>
          	</table>
 		 </div>
 		</div>
 		<!-- untuk table -->

 		<!-- untuk input data -->
 		<div id="input_data" style="margin-top: 20px; display: none;">
 			<h3>Input Data</h3>
 			<div class="col-md-6"> 				
	 			<div class="input-group">
			      <input type="text" class="form-control" placeholder="Masukan Value..." name="value" id="value">
			      <span class="input-group-btn">
			        <button class="btn btn-primary" type="button" onclick="sendData($('#value').val())">Send</button>
			      </span>
			    </div>
 			</div>
 			<div class="col-md-6"> 	
	 			<a href="#" class="btn btn-success btn-block" onclick="sendData(1)">ON</a>
	 			<a href="#" class="btn btn-danger btn-block" onclick="sendData(0)">OFF</a>
 			</div>
 		</div>
 		<!-- untuk input data -->

 	</div>
 </div>

</div>

<script type="text/javascript">
	function selectProject() {
		let project_id=$('#project_id').val();
		$.ajax({
			type: 'POST',
			url: '<?= site_url("report/getChannel") ?>',
			data: 'project_id='+project_id,
			success: function(data) {
				$('#channel_id').html(data);
			}
		});
	}

	function showTable() {
		$('#grafik').hide();
		$('#gauge').hide();
		$('#data_table').show();
		$('#input_data').hide();
		let channel_id=$('#channel_id').val();
			$.ajax({
				type: 'POST',
				url: '<?= site_url("report/gettabel") ?>',
				data: 'channel_id='+channel_id,
				success: function(data) {
					// console.log(data);
					$('#tempat_data').html(data);
				}
			});
		// setInterval(showTable,1000);
	}

	function showInput() {
		$('#grafik').hide();
		$('#gauge').hide();
		$('#data_table').hide();
		$('#input_data').show();
	}

	function sendData(val) {
		let channel_id=$('#channel_id').val();
		$.ajax({
			type: 'POST',
			url: '<?= site_url('report/kirim_data');?>',
			data: 'channel_id='+channel_id+'&value='+val,
			success: function (data) {
				// console.log(data);
				alert(data);
				$('#value').val('');
			}
		});
	}
</script>