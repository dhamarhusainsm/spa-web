<?php
require_once 'configuration.php';

$nama = $_POST['nama'];
$kelas = $_POST['kelas'];

$con->query("INSERT INTO siswa (nama, kelas) VALUES('$nama', '$kelas')");

?>
