<?php require_once('assets/connection.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>UTS DM Metode K-NN</title>
	<?php require('config/style.php'); ?>
</head>

<body>
	<div id="wrapper">
		<div class="container">
			<div class="row d-flex justify-content-left">
				<div class="kiri mb-3">
					<h1 class="text-left mt-5 fw-bolder">UTS Data Mining (Metode K-NN)</h1>
				</div>
			</div>
				<h8 class="text-justify mt-4 mb-4">Studi Kasus:  Sebuah Lembaga perbankan ingin mengembangkan system prediksi penerimaan ajuan pinjaman nasabah berdasarkan 2 atribut yaitu umur (data x), credit rating(data y) dengan kategori 'Terima' dan 'Tolak'. </h8>
			
			<!--batas kiri-->
			<!-- data awal -->
			<div class="kiri col-6 mb-3">
				<div class="wrap table-responsive shadow rounded p-3 mt-3 mx-4">
					<h4 class="mb-3 text-center">Data Awal</h4>

					<?php require('komponen/tambah.php'); ?>
					<table class="table table-striped table-bordered responsive-utilities text-center">

						<thead>
							<tr>
								<th scope="col">No</th>
								<th scope="col" class="col-4">data x</th>
								<th scope="col" class="col-4">data y</th>
								<th scope="col" class="col-4">kategori</th>
								<th scope="col" style="min-width: 180px !important;">Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php

							$query= "SELECT * FROM tb_data";
							$result=mysqli_query($db, $query);

							$queryid = "SELECT * FROM tb_data WHERE id IN (SELECT MAX(id) FROM tb_data)";
							$resultid = mysqli_query($db, $queryid);
							$id_desc = mysqli_fetch_assoc($resultid);
							$i=1;

							//foreach
							foreach ($result as $data) { ?>
								<tr>
									<td><?php echo $i++?></td>
									<td><?php echo $data['data_x']?></td>
									<td><?php echo $data['data_y']?></td>
									<td <?php echo ($data['kategori']=="Terima") ? "style='background-color: #ffff; color: #20992C;'" : "style='background-color: #00000; color: #B52030'" ?>><?php echo $data['kategori']?></td>
									
									<td class="kategori">
										<!-- Button trigger modal -->
										<a class="text-decoration-none text-success pe-2" data-bs-toggle="modal" data-target="#EditData<?php echo $data['id'] ?>" href="#EditData<?php echo $data['id'] ?>">Edit</a>
										<?php
										if($data['id']==$id_desc['id']) : ?>
										<a class="text-decoration-none text-danger ps-2" data-bs-toggle="modal" data-target="#HapusData<?php echo $data['id'] ?>" href="#HapusData<?php echo $data['id'] ?>">Hapus</a>
										<?php endif ?>
									</td>

									<?php require('komponen/edit.php'); ?>
									<?php require('komponen/hapus.php'); ?>
								</tr>

							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
			<!-- end batas kiri -->
			
			<div class="col-10"></div>

			<!-- data yang diolah -->
			<!-- batas kanan -->
			<div class="kanan col-6 mb-3">
				<div class="wrap table-responsive shadow rounded p-3 mt-3 mx-4">
					<h4 class="mb-4 text-center">Hitung Data</h4>

					<?php require('komponen/data-test.php'); ?>

					<a class="btn btn-primary mb-3" style="font-size: 14px;" href="index.php">Reset</a>

					<?php
					if(isset($_GET['opsi'])) : 

						if($_GET['opsi']=="hitung") : ?>
							<p>Nilai data x2 = <b><?php echo $_POST['data_x2']?></b> 
							<br>
							   Nilai data y2 = <b><?php echo $_POST['data_y2']?></b> 
							<br>
							   Nilai K  = <b><?php echo $_POST['K']?></b> </p>
							<table class="table table-striped table-bordered responsive-utilities text-center">
								<thead>
									<tr class="color-">
										<th scope="col">Data x</th>
										<th scope="col">Data y</th>
										<th scope="col">Nilai Jarak</th>
									</tr>
								</thead>

								<tbody>
									<?php
									$arraylihat = array();
									$query= "SELECT * FROM tb_data";
									$result=mysqli_query($db, $query);
									$i=1;

									// foreach
									foreach ($result as $dataOlah) { ?>
										<tr>
											<td><?php echo $dataOlah['data_x']?></td>
											<td><?php echo $dataOlah['data_y']?></td>
											<?php 
											$jarak = sqrt(pow($dataOlah['data_x']-$_POST['data_x2'],2)+pow($dataOlah['data_y']-$_POST['data_y2'],2));
											array_push($arraylihat,$jarak);
											$query = "UPDATE tb_data SET hitung = '$jarak' WHERE id = $i";
											$update = mysqli_query($db,$query);
											$i++;
											?>
											<td><?php echo $jarak?></td>
										</tr>

									<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
		
						<!-- end batas kanan -->


						<div class="col-6 mb-4">
						<div class="wrap table-responsive shadow rounded p-3 mt-3 mx-4">
							<h4 class="mb-4 fw-bolder">Hasil Data K= <?php echo $_POST['K']?></h4>
							
							<table class="table table-striped table-bordered responsive-utilities text-center">
								<thead>
									<tr>
										<th scope="col">Data x</th>
										<th scope="col">Data y</th>
										<th scope="col">Nilai Jarak</th>
										<th scope="col" class="col-4">Kategori</th>
									</tr>
								</thead>

								<tbody>
									<?php
									// array class
									$arrayClassTerima = array();
									$arrayClassTolak = array();

									$K = (int)$_POST['K'];
									$query= "SELECT * FROM tb_data ORDER BY hitung ASC LIMIT 0,$K";
									$k= mysqli_query($db, $query);

									// foreach
									foreach ($k as $batasK) { ?>
										<tr>
											<td><?php echo $batasK['data_x']?></td>
											<td><?php echo $batasK['data_y']?></td>
											<td><?php echo $batasK['hitung']?></td>
											<td <?php echo ($batasK['kategori']=="Terima") ? "style='background-color: #ffff; color: #20992C;'" : "style='background-color: #00000; color: #B52030'" ?> > <?php echo $batasK['kategori']?></td>
										</tr>

									<?php
									// tambah isi array
									if($batasK['kategori']=="Terima") :
									array_push($arrayClassTerima, $batasK['kategori']);
									endif;
									if($batasK['kategori']=="Tolak") :
									array_push($arrayClassTolak, $batasK['kategori']);
									endif;
								} ?>
								</tbody>
							</table>

							<?php

							// hasil final
							$jumlahTerima = count($arrayClassTerima);
							$jumlahTolak = count($arrayClassTolak);
							$kategori = ($jumlahTerima>$jumlahTolak) ? "Terima" : "Tolak";
							?>

							<h4 class="fw-bolder" style="margin-top: 60px !important;">Hasil Kategori</h4>
							<table class="table table-striped table-bordered responsive-utilities text-center">
								<thead>
									<tr>
										<th scope="col">data x2</th>
										<th scope="col">data y2</th>
										<th scope="col" class="col-4">kategori</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td><?php echo $_POST['data_x2']?></td>
										<td><?php echo $_POST['data_y2']?></td>
										<td <?php echo ($kategori=="Terima") ? "style='background-color: #ffff; color: #20992C;'" : "style='background-color: #00000; color: #005fee'" ?> ><?php echo $kategori?></td>
									</tr>
								</tbody>

							</div>
						</div>

					<?php endif; 
				endif;
				// hapus semua isi array class
				unset($arrayClassTerima);
				unset($arrayClassTolak); 

				// // jika selesai aksi hitung, atur nilai setiap baris pada kolom hitung jadi 0
				// $query= "SELECT * FROM tb_data";
				// $reset_hitung=mysqli_query($db, $query);
				// $i=1;
				// // foreach
				// foreach ($reset_hitung as $reset) { 
				// 	$query = "UPDATE tb_data SET hitung = '0' WHERE id = $i";
				// 	$update = mysqli_query($db,$query);
				// 	$i++;
				// }
			?>
		</div>
	</div>
</div>
</body>
</html>
<?php require('config/script.php');

// controller
if (isset($_GET['opsi'])) :

$opsi = $_GET['opsi'];

if($opsi=="input"){//opsi input

	if (isset($_POST['data_x'])) { $data_x = $_POST['data_x']; }else{ echo "data x tidak ditemukan"; }
	if (isset($_POST['data_y'])) { $data_y = $_POST['data_y']; }else{ echo "data y tidak ditemukan"; }
	if (isset($_POST['kategori'])) { $kategori = $_POST['kategori']; }else{ echo "kategori tidak ditemukan"; }

	$query = "INSERT INTO tb_data (data_x, data_y, kategori) VALUES ('$data_x', '$data_y', '$kategori')";
	$insert = mysqli_query($db,$query);

	if ($insert == false) {
		?>
		<script type='text/javascript'>
			alert('Gagal Menambah Data');
			window.location.href="index.php";
		</script>
		<?php
	}
	else{
		?>
		<script type='text/javascript'>
			alert('Sukses Menambah Data');
			window.location.href="index.php";
		</script>
		<?php
	}

}elseif($opsi=="edit"){//opsi update

	if (isset($_POST['id'])) {$id = $_POST['id']; } else{echo "id tidak ditemukan"; }
	if (isset($_POST['data_x'])) { $data_x = $_POST['data_x']; }else{ echo "data x tidak ditemukan"; }
	if (isset($_POST['data_y'])) { $data_y = $_POST['data_y']; }else{ echo "data y tidak ditemukan"; }
	if (isset($_POST['kategori'])) { $kategori = $_POST['kategori']; }else{ echo "kategori tidak ditemukan"; }
	$query = "UPDATE tb_data SET data_x='$data_x', data_y='$data_y', kategori='$kategori' WHERE id= '$id'";
	$update = mysqli_query($db,$query);
	
	if ($update == false) {
		?>
		<script type='text/javascript'>
			alert('Gagal Mengubah Data');
			window.location.href="index.php";
		</script>
		<?php
	}
	else{
		?>
		<script type='text/javascript'>
			alert('Sukses Mengubah Data');
			window.location.href="index.php";
		</script>
		<?php
	}	

}elseif($opsi=="delete"){//opsi delete
	if (isset($_GET['id'])) {$id = $_GET['id']; }else{echo "id tidak ditemukan";}

	// hapus data
	$query = "DELETE FROM tb_data WHERE id = $id";
	$delete = mysqli_query($db,$query);

	// panggil data id paling terakhir
	$query = "SELECT id FROM tb_data ORDER BY id DESC";
	$result = mysqli_query($db,$query);
	$id_desc = mysqli_fetch_assoc($result);
	// jumlahkan data id terakhir
	$ai = $id_desc['id']+1;

	// tetapkan auto increment baru agar kembali terurut dari data sembelumnya
	$query = "ALTER TABLE tb_data auto_increment=$ai";
	$alter = mysqli_query($db,$query);

	if ($delete == false) {
		?>
		<script type='text/javascript'>
			alert('Gagal Menghapus Data');
			window.location.href="index.php";
		</script>
		<?php
	}
	else{
		?>
		<script type='text/javascript'>
			alert('Sukses Menghapus Data');
			window.location.href="index.php";
		</script>
		<?php
	}
}

endif;
// end controller
?>