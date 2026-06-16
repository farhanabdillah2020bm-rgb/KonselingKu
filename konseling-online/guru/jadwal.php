<?php

session_start();

include "../config/koneksi.php";

if(
!isset($_SESSION['role'])
||
$_SESSION['role']!="guru"
){

header(
"Location:../login.php"
);

exit;

}


/*
SIMPAN JADWAL
*/

if(
isset($_POST['simpan'])
){

$id=
$_POST['id_konseling'];

$tanggal=
$_POST['tanggal'];

$jam=
$_POST['jam'];

mysqli_query(

$conn,

"

INSERT INTO jadwal
(
id_konseling,
tanggal,
jam
)

VALUES
(
'$id',
'$tanggal',
'$jam'
)

"

);

header(
"Location:jadwal.php"
);

exit;

}



/*
AMBIL DATA
*/

$data=

mysqli_query(

$conn,

"

SELECT

konseling.id,
users.nama,
konseling.judul

FROM konseling

JOIN users

ON

users.id=
konseling.id_siswa

ORDER BY konseling.id DESC

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

Kelola Jadwal

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

Kelola Jadwal

</h1>

<table class="table">

<tr>

<th>Siswa</th>

<th>Judul</th>

<th>Tanggal</th>

<th>Jam</th>

<th></th>

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

<form method="POST">

<td>

<?= $row['nama'] ?>

</td>

<td>

<?= $row['judul'] ?>

</td>

<td>

<input
type="date"
name="tanggal"
required>

</td>

<td>

<input
type="time"
name="jam"
required>

</td>

<td>

<input
type="hidden"
name="id_konseling"
value="<?= $row['id'] ?>">

<button
name="simpan">

Simpan

</button>

</td>

</form>

</tr>

<?php

}

?>

</table>

</div>

</body>

</html>