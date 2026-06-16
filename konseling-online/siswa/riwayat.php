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
konseling.status,
MAX(riwayat.catatan)
AS catatan

FROM konseling

LEFT JOIN riwayat

ON
riwayat.id_konseling=
konseling.id

WHERE
konseling.id_siswa='$id'

GROUP BY
konseling.id

ORDER BY
konseling.id DESC

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

Riwayat

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

Riwayat Konseling

</h1>

<table class="table">

<tr>

<th>Judul</th>

<th>Status</th>

<th>Catatan Guru</th>

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

<?= $row['status'] ?>

</td>

<td>

<?= $row['catatan'] ?>

</td>

</tr>

<?php

}

?>

</table>

</div>

</body>

</html>