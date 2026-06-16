<?php

include "../config/auth.php";

siswaOnly();

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

?>

<!DOCTYPE html>

<html>

<head>

<meta
name="viewport"
content="width=device-width, initial-scale=1.0">

<title>

Dashboard Siswa

</title>

<link
rel="stylesheet"
href="../assets/css/dashboard.css">

</head>

<body>

<?php

include
"../templates/sidebar.php";

?>

<div class="content">

<h1>

Dashboard Siswa

</h1>

<div class="welcome">

<h2>

Halo,
<?= $_SESSION['nama'] ?>

👋

</h2>

<p>

Selamat datang di Sistem Konseling Online.

</p>

</div>

<div class="card-container">

<a
class="card"
href="ajukan.php">

📝 Ajukan Konseling

</a>

<a
class="card"
href="jadwal.php">

📅 Jadwal

</a>

<a
class="card"
href="chat.php">

💬 Chat

</a>

<a
class="card"
href="riwayat.php">

📚 Riwayat

</a>

</div>

</div>

</body>

</html>