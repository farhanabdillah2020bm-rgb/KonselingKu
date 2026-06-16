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

$id=
$_SESSION['id'];

$data=

mysqli_query(

$conn,

"

SELECT

konseling.judul,
jadwal.tanggal,
jadwal.jam

FROM jadwal

JOIN konseling

ON

jadwal.id_konseling=
konseling.id

WHERE

konseling.id_siswa='$id'

ORDER BY tanggal DESC

"

);

?>

<!DOCTYPE html>

<html>

<head>

<meta
name="viewport"
content="width=device-width, initial-scale=1.0">

<title>

Jadwal Konseling

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

<div class="content">

<h1>

Jadwal Konseling

</h1>

<table class="table">

<tr>

<th>Judul</th>

<th>Tanggal</th>

<th>Jam</th>

</tr>

<?php

while(
$row=
mysqli_fetch_assoc(
$data
)
){

?>

<tr>

<td>

<?= $row['judul'] ?>

</td>

<td>

<?= $row['tanggal'] ?>

</td>

<td>

<?= $row['jam'] ?>

</td>

</tr>

<?php

}

?>

</table>

</div>

</body>

</html>