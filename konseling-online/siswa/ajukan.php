<?php

session_start();

include "../config/koneksi.php";

if(
!isset($_SESSION['role'])
||
$_SESSION['role']!="siswa"
){

header(
"Location:../login.php"
);

exit;

}


if(
isset($_POST['kirim'])
){

$id=
$_SESSION['id'];

$judul=
$_POST['judul'];

$keluhan=
$_POST['keluhan'];

$query=

"

INSERT INTO konseling
(
id_siswa,
judul,
keluhan,
status
)

VALUES
(
'$id',
'$judul',
'$keluhan',
'Menunggu'
)

";

mysqli_query(
$conn,
$query
);

header(
"Location:riwayat.php"
);

exit;

}

?>

<!DOCTYPE html>

<html>

<head>

<meta
name="viewport"
content="width=device-width, initial-scale=1.0">

<title>

Ajukan Konseling

</title>

<link
rel="stylesheet"
href="../assets/css/dashboard.css">

<link
rel="stylesheet"
href="../assets/css/form.css">

</head>

<body>

<?php
include "../templates/sidebar.php";
?>

<div class="content content-ajukan">

<div class="form-box">

<h1>

Ajukan Konseling

</h1>

<form method="POST">

<input
type="text"
name="judul"
placeholder="Contoh: Kesulitan Belajar"
required>

<textarea
name="keluhan"
placeholder="Jelaskan kondisi atau permasalahan yang ingin dikonsultasikan"
required>

</textarea>

<button
name="kirim">

Kirim Pengajuan

</button>

</form>

</div>

</div>

</body>

</html>