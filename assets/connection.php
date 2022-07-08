<?php
// menggunakan XAMPP
//$db = new mysqli("localhost","root","","dm_knn");

// online
$db = new mysqli("sql204.ezyro.com","ezyro_32124895","uts2022dmknn","ezyro_32124895_atus");

// cek koneksi
if ($db->connect_error) {
	echo "Gagal menyambungkan ke MySQL : ".$db->connect_error;
	exit();
}
?>