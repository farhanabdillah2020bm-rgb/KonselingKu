<?php

include "../config/auth.php";
siswaOnly();

include "../config/koneksi.php";
include "../config/helper.php";

$id=$_SESSION['id'];


/*
AMBIL GURU
*/

$guru=

mysqli_query(

$conn,

"

SELECT
id,
nama

FROM users

WHERE role='guru'

ORDER BY nama

"

);


/*
PILIH GURU
*/

$tujuan=
$_GET['guru']
?? null;


/*
KIRIM
*/

if(
isset($_POST['kirim'])
){

$pesan=
trim(
$_POST['pesan']
);

if($pesan!=""){

$stmt=

mysqli_prepare(

$conn,

"

INSERT INTO chat
(
pengirim,
penerima,
pesan
)

VALUES
(
?,
?,
?
)

"

);

mysqli_stmt_bind_param(

$stmt,

"iis",

$id,

$tujuan,

$pesan

);

mysqli_stmt_execute(
$stmt
);

}

header(
"Location:chat.php?guru=$tujuan"
);

exit;

}



$chat=[];

if($tujuan){

$stmt=

mysqli_prepare(

$conn,

"

SELECT *

FROM chat

WHERE

(
pengirim=?
AND penerima=?
)

OR

(
pengirim=?
AND penerima=?
)

ORDER BY waktu

"

);

mysqli_stmt_bind_param(

$stmt,

"iiii",

$id,

$tujuan,

$tujuan,

$id

);

mysqli_stmt_execute(
$stmt);

$chat=
mysqli_stmt_get_result(
$stmt
);

}

?>

<!DOCTYPE html>

<html>

<head>

<meta
name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Chat</title>

<link rel="stylesheet"
href="../assets/css/dashboard.css">

<link rel="stylesheet"
href="../assets/css/form.css">

</head>

<body>

<?php
include "../templates/sidebar.php";
?>

<div class="content">

<h1>Chat Guru BK</h1>

<form method="GET">

<select
name="guru"
onchange="this.form.submit()">

<option>

Pilih Guru

</option>

<?php
while(
$row=
mysqli_fetch_assoc(
$guru
)
){
?>

<option
value="<?= $row['id'] ?>">

<?= aman($row['nama']) ?>

</option>

<?php
}
?>

</select>

</form>


<div class="chat-box">

<?php

if($tujuan){

while(
$row=
mysqli_fetch_assoc(
$chat
)
){

?>

<div
class="bubble <?= $row['pengirim']==$id ? 'me':'other' ?>">

<?= aman(
$row['pesan']
) ?>

</div>

<?php

}

}

?>

</div>


<?php
if($tujuan){
?>

<form method="POST" class="chat-form">

<input
type="text"
name="pesan"
required>

<button
name="kirim">

Kirim

</button>

</form>

<?php
}
?>

</div>

</body>

</html>