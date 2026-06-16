<?php

include "../config/auth.php";

guruOnly();

include "../config/koneksi.php";

include "../config/helper.php";


/*
UBAH STATUS
*/

if(isset($_POST['ubah'])){

$id=$_POST['id'];

$status=$_POST['status'];


/*
CEK STATUS LAMA
*/

$q=

mysqli_query(

$conn,

"

SELECT status

FROM konseling

WHERE id='$id'

"

);

$lama=
mysqli_fetch_assoc($q);

$boleh=false;


/*
VALIDASI ALUR
*/

if(
$lama['status']=="Menunggu"
&&
$status=="Diterima"
){

$boleh=true;

}

if(
$lama['status']=="Diterima"
&&
$status=="Selesai"
){

$boleh=true;

}


if($boleh){

mysqli_query(

$conn,

"

UPDATE konseling

SET status='$status'

WHERE id='$id'

"

);

}

header(
"Location:konseling.php"
);

exit;

}



/*
SIMPAN CATATAN
*/

if(
isset($_POST['catatan'])
){

$id=
$_POST['id'];

$isi=
trim(
$_POST['isi']
);


/*
STATUS HARUS SELESAI
*/

$cek=

mysqli_query(

$conn,

"

SELECT status

FROM konseling

WHERE id='$id'

"

);

$status=
mysqli_fetch_assoc(
$cek
);

if(
$status['status']=="Selesai"
){

/*
JANGAN DUPLIKAT
*/

$ada=

mysqli_query(

$conn,

"

SELECT *

FROM riwayat

WHERE id_konseling='$id'

"

);

if(
mysqli_num_rows(
$ada
)==0
){

mysqli_query(

$conn,

"

INSERT INTO riwayat
(
id_konseling,
catatan
)

VALUES
(
'$id',
'$isi'
)

"

);

}

}

header(
"Location:konseling.php"
);

exit;

}



/*
DATA
*/

$data=

mysqli_query(

$conn,

"

SELECT

konseling.*,
users.nama

FROM konseling

JOIN users

ON users.id=
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

Kelola Konseling

</h1>

<div class="table-wrapper">

<table class="table">

<tr>

<th>Siswa</th>

<th>Judul</th>

<th>Keluhan</th>

<th>Status</th>

<th>Catatan</th>

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

<?= aman($row['nama']) ?>

</td>

<td>

<?= aman($row['judul']) ?>

</td>

<td class="keluhan-box">

<?= nl2br(
aman(
$row['keluhan']
)
) ?>

</td>

<td>

<?= aman($row['status']) ?>

<br><br>

<form method="POST">

<input
type="hidden"
name="id"
value="<?= $row['id'] ?>">

<select
name="status">

<option>

Diterima

</option>

<option>

Selesai

</option>

</select>

<button
name="ubah">

Update

</button>

</form>

</td>

<td>

<?php

if(
$row['status']=="Selesai"
){

?>

<form method="POST">

<input
type="hidden"
name="id"
value="<?= $row['id'] ?>">

<textarea
name="isi"
required>

</textarea>

<button
name="catatan">

Simpan

</button>

</form>

<?php

}

?>

</td>

</tr>

<?php

}

?>

</table>

</div>

</div>

</body>

</html>