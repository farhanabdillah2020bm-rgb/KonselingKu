<?php

include "../config/auth.php";

guruOnly();

include "../config/koneksi.php";

include "../config/helper.php";


$query=

mysqli_query(

$conn,

"

SELECT

id,
nama,
username

FROM users

WHERE role='siswa'

ORDER BY nama ASC

"

);

?>

<!DOCTYPE html>

<html>

<head>

<meta
name="viewport"
content="width=device-width, initial-scale=1.0">

<meta charset="UTF-8">

<title>

Data Siswa

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

Data Siswa

</h1>


<table class="table">

<tr>

<th>

No

</th>

<th>

Nama

</th>

<th>

Username

</th>

</tr>


<?php

$no=1;

while(

$row=
mysqli_fetch_assoc(
$query)

){

?>

<tr>

<td>

<?= $no++ ?>

</td>

<td>

<?= aman(
$row['nama']
) ?>

</td>

<td>

<?= aman(
$row['username']
) ?>

</td>

</tr>

<?php

}

?>

</table>

</div>

</body>

</html>