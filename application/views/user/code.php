<div class="panel-heading">
	<h3 class="panel-title"><i class="fa fa-code"></i> <?php echo $judul; ?></h3>
</div>

<div class="panel-body">
 <div class="row">
 	<div class="col-lg-12">
 		<h2>Panduan Code</h2>
 		<ul class="nav nav-tabs nav-justified">
		  <li role="presentation"><a href="#" onclick="Showdevice()" class="active">Device</a></li>
		  <li role="presentation"><a href="#" onclick="Showrestapi()">Rest API</a></li>
		</ul>
 	</div>
 </div>

 <div class="row" style="margin: 20px">
 	<div class="col-lg-12" id="perangkat"> 
 		<h3>Konfigurasi Device</h3>
 		<p class="text-justify">PlatAG membutuhkan library yang harus terinstall dalam Arduino IDE Anda. Dimana nanti yang akan digunakan untuk berkomunikasi antara perangkat IoT dengan Server</p>
 		<h4 style="margin-top: 15px; "><a href="#" onclick="showInstall()"><i class="fa fa-arrow-right"></i> Installasi Library Plat AG di Arduino IDE</a></h4>
 		<ol id="list_install" style="display: none">
 			<li>Silahkan download library Plat AG yang ada di <a href="<https://github.com/rudyekoprasetya/plat-ag" target="_blank">Github Plat AG</a>.</li>
 			<li>Silahkan anda Download file <b>Arduino_JSON.zip</b> dan <b>plat_ag.zip</b> pada folder library arduni IDE</li>
 			<img src="<?= base_url(); ?>/assets/img/panduan/github.png" class="img-responsive">
 			<li>Buka Arduino IDE Anda, jika belum ada silahkan download di <a href="https://www.arduino.cc/en/Main/Software" target="_blank">https://www.arduino.cc/en/Main/Software</a> </li>
 			<li>Klik Menu <b>Sketch</b>, selanjutnya <b>include library</b> kemudian <b>Add .ZIP library</b></li>
 			<img src="<?= base_url(); ?>/assets/img/panduan/add lib.png" class="img-responsive">
 			<li>Masukan dua file yang sudah didownload tadi, yaitu <b>Arduino_JSON.zip</b> dan <b>plat_ag.zip</b></li>
 			<li>Restart Arduino IDE Anda dan coba cek di menu <b>Sketch</b> di sub menu <b>include library</b>, pastikan library Arduino JSON dan plat_ag sudah ada</li>
 			<img src="<?= base_url(); ?>/assets/img/panduan/include_lib.png" class="img-responsive">
 			<li>Jika anda gagal import dengan cara diatas, Anda bisa langsung memasukan ke folder library Arduino IDE (bisanya di <b>C:\Users\User\Documents\Arduino\libraries</b>) Anda, dengan cara extract kedua file tadi dan copykan semuanya</li>
 			<img src="<?= base_url(); ?>/assets/img/panduan/lib_folder.png" class="img-responsive">
 		</ol>
 		<h4 style="margin-top: 15px; "><a href="#" onclick="showKoneksi()"><i class="fa fa-arrow-right"></i> Membuat Projects dan Channels</a></h4>
 		<div id="koneksi" style="display: none;">
	 		<p class="text-justify">Platform Plat AG ada 2 metode komunikasi data antara Perangkat IoT dengan Server PlatAG</p>
	 		<ul>
	 			<li><b>Read Data</b> - Metode dimana Perangkat IoT kita mengirimkan data ke platform PlatAG</li>
	 			<img src="<?= base_url(); ?>/assets/img/panduan/ReadData_arsitektur.png" class="img-responsive" style="margin-top: 15px; margin-bottom: 15px;">
	 			<li><b>Write Data</b> - Metode dimana perangkat IoT kita membaca data/perintah dari platform PlatAG</li>
	 			<img src="<?= base_url(); ?>/assets/img/panduan/WriteData_arsitektur.png" class="img-responsive" style="margin-top: 15px; margin-bottom: 15px;">

	 		</ul>
	 		<p class="text-justify">Sebelumnya kita buat project baru, silahkan buat akun di platAG dan masuk ke menu <b>Projects</b></p>
	 		<p class="text-justify">Klik tombol <a href="#" class="btn btn-success btn-big"><i class="fa fa-plus"></i> Add</a> , kemudian masukan Nama Project, jenis mikrokontrollernya digunakan, atau jika ada bisa dimasukan pula koordinat(Longitude, Latitude) dari perangkat IoT kita. Tekan Tombol <a href="#" class="btn btn-primary btn-big"><i class="fa fa-save"></i> Save</a> untuk simpan. Anda bisa jua melakukan Edit atau hapus project yang sudah dibuat sebelumnya. </p>
	 		<img src="<?= base_url(); ?>/assets/img/panduan/add_project.png" class="img-responsive" style="margin-top: 15px; margin-bottom: 15px;">
	 		<p class="text-justify">Selanjutnya kita buat <b>Channel</b>, Channel adalah sensor atau modul yang dipasang ke mikrokontroller kita. Dimana data dari modul tersebut yang akan dioleh oleh platAG. Untuk Menambah Channel klik icon <a class="btn btn-small btn-info" href="#"><i class="fa fa-hdd-o"></i> </a> pada project yang sudah dibuat.</p> 
	 		<img src="<?= base_url(); ?>/assets/img/panduan/add_channel.png" class="img-responsive" style="margin-top: 15px; margin-bottom: 15px;">
	 		<p class="text-justify">Selanjutnya klik tombol <a href="#" class="btn btn-success btn-big"><i class="fa fa-plus"></i> Add</a> Untuk tambah data</p>
	 		<img src="<?= base_url(); ?>/assets/img/panduan/modal_channel.png" class="img-responsive" style="margin-top: 15px; margin-bottom: 15px;">
	 		<p class="text-justify">Silahkan isi naman channel atau sensor yang digunakan, kemudian tipenya apakah Read Data atau Write Data. Sebagai contoh disini saya akan mengontrol Led dengan PlatAG, maka tipenya adalah <b>Write Data</b>. Data Tekan Tombol <a href="#" class="btn btn-primary btn-big"><i class="fa fa-save"></i> Save</a> untuk simpan. Yang perlu dicatat disini adalah <b>ID Channel</b>, karena ini digunakan saat kita coding di Arduino IDE</p>.
	 		<img src="<?= base_url(); ?>/assets/img/panduan/id_channel.png" class="img-responsive" style="margin-top: 15px; margin-bottom: 15px;">
 		</div>
 		<h4 style="margin-top: 15px; "><a href="#" onclick="showCoding()"><i class="fa fa-arrow-right"></i> Coding di Arduino IDE</a></h4>
 		<div id="list_coding" style="display: none;"> 			
	 		<p class="text-justify">library PlatAG sudah menyediakan contoh atau example code dari masing-masing metode diatas, berikut panduannya</p>
	 		<ol>
	 			<li>Buka Arduino IDE yang sudah terinstall library. Buka menu <b>File</b>, masuk submenu <b>Examples</b> geser kebawah, carilah <b>plat_ag</b></li>
	 			<li>Disitu disediakan contoh coding untuk Read data dan Write Data</li>
	 			<img src="<?= base_url(); ?>/assets/img/panduan/add_example.png" class="img-responsive" style="margin-top: 15px; margin-bottom: 15px;">
	 			<li>Sebagai contoh disini saya gunakan <b>Write data</b>, untuk mengontrol channel Led yang sudah dibuat sebelumnya, berikut adalah contoh codingnya</li>
	 			<pre>
//library WiFi
#include WiFi.h
//library platAG
#include plat_ag.h

//Akses Ke Wifi
const char* ssid     = "SSID";
const char* password = "wifi_pass";

//url Server PlatAG
String serverName = "http://www.domain.com[ip_address]/plat-ag/";

//API Key User Anda
String api_key = "xxxxxxxxxxxxxxx";

//Untuk Channel ID Project Anda
String channelID = "CHxxxxxxxxx";

//batas min waktu
unsigned long lastTime = 0;

//rentan waktu komunikasi ke server (2000/ 2 detik)
unsigned long timerDelay = 2000;

//pin LED
int led = 12;

void setup() {
  Serial.begin(9600);
  //koneksi ke WiFi
  delay(10);
  Serial.println();
  Serial.println();
  Serial.print("Connecting to ");
  Serial.println(ssid);

  WiFi.begin(ssid, password);

  while (WiFi.status() != WL_CONNECTED) {
      delay(500);
      Serial.print(".");
  }

  Serial.println("");
  Serial.println("Terkoneksi ke WiFi");
  Serial.println("IP address Anda: ");
  Serial.println(WiFi.localIP());

  //config led
  pinMode(led, OUTPUT); 

}

void loop() {
  if ((millis() - lastTime) > timerDelay) {
    /*cek wifi status*/
     if(WiFi.status()== WL_CONNECTED){
        //ambil data dari server dan masukan ke variable perintah
        int perintah = writeData(serverName,api_key,channelID);       
          
        Serial.println(perintah);
        
        //berikan nilai ke led
        digitalWrite(led, perintah);
     } else {
      //jika koneksi terputus
      Serial.println("WiFi Terputus");
     }

   lastTime = millis();
  }
}
	 			</pre>
	 			<li>Silahkan lakukan penyesuaian dengan password dan ssid dari WiFi yang digunakan, Disini saya menggunakan ESP32 sebegai mikrokontroller. jika anda menggunakan ethernet shield fungsi WiFi bisa dihapus dan diganti dengan library dan coding ethernet shield. </li>
	 			<li>Diatas yang pasangkan LED dengan Pinout 12, anda bisa menyesuikan sendiri sesuai dengan rangkaian anda.</li>
	 			<li>Untuk coding <pre>String serverName = "http://www.domain.com[ip_address]/plat-ag/";</pre> Disesuaikan dengan lokasi atau tempat platAG terinstall, jika anda menggunakan server lokal bisa diganti dengan IP Address sebagai berikut <pre>String serverName = "http://192.168.1.1/plat-ag/";</pre> atau jika anda upload ke VPS atau hosting bisa diganti dengan nama domain anda</li>
	 			<li>Untuk coding <pre>String api_key = "xxxxxxxxxxxxxxx";</pre> silahkan anda masukan API KEY anda, itu bisa dilihat di menu <b>User Menu</b>, Masukke submenu <b>profile</b></li>
	 			<img src="<?= base_url(); ?>/assets/img/panduan/api_key.png" class="img-responsive" style="margin-top: 15px; margin-bottom: 15px;">
	 			<li>Untuk coding <pre>String channelID = "CHxxxxxxxxx";</pre> silahkan isi dengan channel ID yang sudah dibuat sebelumnya, sebagai contoh channel ID dari project led merah tadi</li>
	 			<img src="<?= base_url(); ?>/assets/img/panduan/id_channel.png" class="img-responsive" style="margin-top: 15px; margin-bottom: 15px;">
	 			<li>Untuk <pre>int perintah = writeData(serverName,api_key,channelID); </pre> digunakan untuk mengambil data dari PlatAG dan dimasukan ke perangkat IoT kita, hal ini bisa dilihat bahwa perintah itu digunakan untuk mengontrol LED yang terpasang di rangkaian project kita</li>
	 			<li>Untuk Parameter lain bisa disesuaikan dengan kebutuhan dan project yang akan dibuat.</li>
	 			<li>Untuk Write data anda bisa buka example nya dan bisa menyesuaikan parameter-paramter yang dikehendaki, berikut adalah contohnya</li>
	 			<pre>
//library WiFi
#include WiFi.h
//library platAG
#include plat_ag.h

//Akses Ke Wifi
const char* ssid     = "SSID";
const char* password = "wifi_pass";

//url Server PlatAG
String serverName = "http://www.domain.com[ip_address]/plat-ag/";

//API Key User Anda
String api_key = "xxxxxxxxxxxxxxx";

//Untuk Channel ID Project Anda
String channelID = "CHxxxxxxxxx";

//batas min waktu
unsigned long lastTime = 0;

//rentan waktu komunikasi ke server (2000 / 2 detik)
unsigned long timerDelay = 2000;

//pin sensor Cahaya LDR semisal PIN 34
int sensor = 34;

void setup() {
  Serial.begin(9600);
  //koneksi ke WiFi
  delay(10);
  Serial.println();
  Serial.println();
  Serial.print("Connecting to ");
  Serial.println(ssid);

  WiFi.begin(ssid, password);

  while (WiFi.status() != WL_CONNECTED) {
      delay(500);
      Serial.print(".");
  }

  Serial.println("");
  Serial.println("Terkoneksi ke WiFi");
  Serial.println("IP address Anda: ");
  Serial.println(WiFi.localIP());

  //config sensor pin
  pinMode(sensor, INPUT); 

}

void loop() {
  if ((millis() - lastTime) > timerDelay) {
    /*cek wifi status*/
     if(WiFi.status()== WL_CONNECTED){
      
      //membaca hasil sensor
      float hasil = analogRead(sensor);   
      Serial.println(hasil);

      //kirim hasil ke platAG
      String GetResult = readData(serverName,api_key,channelID,hasil);
      Serial.println(GetResult);
      
     } else {
      //jika koneksi terputus
      Serial.println("WiFi Terputus");
     }

   lastTime = millis();
  }
}
	 			</pre>
	 			<li>Diatas adalah contoh untuk mengirimkan data hasil pembacaan sensor LDR/Cahaya ke platAG.</li>
	 			<li>Lakukan upload sketch ke mikrokontroller anda. Untuk cek hasil anda bisa membuka serial monitor yang ada pada menu <b>Tools</b>, masuk ke <b>Serial Monitor</b> atau dengan cara menekan tombol <b>CTRL+SHIFT+M</b></li>
	 			<li>Jika berhasil terkoneksi maka akan muncul respon code <pre>HTTP Response code: 200</pre> pada serial monitor diikut dengan hasil request ke server PlatAG</li>
	 			<li>Anda bisa mengelola hasil data di menu <b>Reports</b> seperti dibawah ini</li>
	 			<img src="<?= base_url(); ?>/assets/img/panduan/reports.png" class="img-responsive" style="margin-top: 15px; margin-bottom: 15px;">

	 		</ol>
 		</div>
 	</div>
 	<div class="col-lg-12" id="restapi" style="display: none;"> 
 		<h3>Referensi Rest API</h3>
 		<p class="text-justify">Jika anda ingin mengembangkan aplikasi sendiri untuk mengakses data dari PlatAG. Berikut adalah referensi REST API sebagai berikut</p>
 		<br><br>
 		<h4>Read Data</h4>
 		<pre>GET http://URL Server PlatAG/api/read?api_key=xxxxxxxxxxxx&ch=CHxxxxxxxxx&val=xxx</pre>
 		<p class="text-justify">
 			<table class="table">
 				<thead> 					
	 				<tr>
	 					<th>Option</th>
	 					<th>Deskripsi</th>
	 				</tr>
 				</thead>
 				<tbody> 					
	 				<tr>
	 					<td><b>api</b></td>
	 					<td>Diisi dengan API KEY akun anda</td>
	 				</tr>					
	 				<tr>
	 					<td><b>ch</b></td>
	 					<td>Diisi dengan CHANNEL ID dari project anda</td>
	 				</tr>					
	 				<tr>
	 					<td><b>val</b></td>
	 					<td>untuk nilai/value yang akan disimpan ke Server PlatAG</td>
	 				</tr>
 				</tbody>
 			</table>
 		</p>
 		<p class="text-justify">Berikut contoh hasilnya</p>
 		<pre>
{
    "status": 200,
    "message": "Connected to PlatAG"
}
 		</pre>
 		<h4>Write Data</h4>
 		<pre>GET http://URL Server PlatAG/api/write?api_key=xxxxxxxxxxxx&ch=CHxxxxxxxxx&val=xxx</pre>
 		<p class="text-justify">
 			<table class="table">
 				<thead> 					
	 				<tr>
	 					<th>Option</th>
	 					<th>Deskripsi</th>
	 				</tr>
 				</thead>
 				<tbody> 					
	 				<tr>
	 					<td><b>api</b></td>
	 					<td>Diisi dengan API KEY akun anda</td>
	 				</tr>					
	 				<tr>
	 					<td><b>ch</b></td>
	 					<td>Diisi dengan CHANNEL ID dari project anda</td>
	 				</tr>					
	 				<tr>
	 					<td><b>val</b></td>
	 					<td>untuk nilai/value yang akan disimpan ke Server PlatAG</td>
	 				</tr>
 				</tbody>
 			</table>
 		</p>
 		<p class="text-justify">Berikut contoh hasilnya</p>
 		<pre>
{
    "status": 200,
    "data": 0,
    "message": "Saved to PlatAG"
}
 		</pre>

 		<h4>Show Data</h4>
 		<pre>GET http://URL Server PlatAG/api/show?api_key=xxxxxxxxxxxx&ch=CHxxxxxxxxx&limit=50&start=yyyy-mm-dd&finish=yyyy-mm-dd</pre>
 		<p class="text-justify">
 			<table class="table">
 				<thead> 					
	 				<tr>
	 					<th>Option</th>
	 					<th>Deskripsi</th>
	 				</tr>
 				</thead>
 				<tbody> 					
	 				<tr>
	 					<td><b>api</b></td>
	 					<td>Diisi dengan API KEY akun anda</td>
	 				</tr>					
	 				<tr>
	 					<td><b>ch</b></td>
	 					<td>Diisi dengan CHANNEL ID dari project anda</td>
	 				</tr>					
	 				<tr>
	 					<td><b>limit (optional)</b></td>
	 					<td>banyak data yang ditampilkan, jika tidak menggunakan limit, maka data yang ditampilkan maks 50 data</td>
	 				</tr>					
	 				<tr>
	 					<td><b>start (optional)</b></td>
	 					<td>Untuk ambil data dimulai dari tanggal yang dikehendakan, format <b>yyyy-mm-dd</b></td>
	 				</tr>					
	 				<tr>
	 					<td><b>finish (optional)</b></td>
	 					<td>Untuk ambil data sampai tanggal yang dikehendakan, format <b>yyyy-mm-dd</b></td>
	 				</tr>
 				</tbody>
 			</table>
 		</p>
 		<p class="text-justify">Berikut contoh hasilnya</p>
 		<pre>
{
    "status": 200,
    "data": [        
        {
            "value": "553",
            "created_at": "2020-10-03 14:54:38"
        },
        {
            "value": "560",
            "created_at": "2020-10-03 14:54:36"
        },
        {
            "value": "557",
            "created_at": "2020-10-03 14:54:34"
        },
        {
            "value": "589",
            "created_at": "2020-10-03 14:54:32"
        },
        {
            "value": "592",
            "created_at": "2020-10-03 14:54:29"
        },
        {
            "value": "568",
            "created_at": "2020-10-03 14:54:27"
        }
    ]
}
 		</pre>

 	</div>
 </div>

</div>

<script type="text/javascript">
	function showInstall() {
		$('#list_install').toggle(300);
	}

	function showKoneksi() {
		$('#koneksi').toggle(300);
	}

	function showCoding() {
		$('#list_coding').toggle(300);
	}

	function Showdevice() {
		$('#perangkat').addClass('active');
		$('#restapi').removeClass('active');
		$('#perangkat').fadeIn(500);
		$('#restapi').hide();
	}

	function Showrestapi() {
		$('#perangkat').removeClass('active');
		$('#restapi').addClass('active');
		$('#perangkat').hide();
		$('#restapi').fadeIn(500);
	}
</script>