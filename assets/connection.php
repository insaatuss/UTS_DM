<?php
// menggunakan XAMPP
$db = new mysqli("localhost","root","","dm_knn");

// cek koneksi
if ($db->connect_error) {
	echo "Gagal menyambungkan ke MySQL : ".$db->connect_error;
	exit();
}
?>