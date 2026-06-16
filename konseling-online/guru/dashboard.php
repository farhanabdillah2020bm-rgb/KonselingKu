<?php

include "../config/auth.php";

guruOnly();

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

?>

<!DOCTYPE html>

<html>

<head>

<meta
name="viewport"
content="width=device-width, initial-scale=1.0">

<title>

Dashboard Guru BK

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

Dashboard Guru BK

</h1>

<div class="welcome">

<h2>

Halo,
<?= $_SESSION['nama'] ?>

👋

</h2>

<p>

Kelola layanan konseling di sini.

</p>

</div>

<div class="card-container">

<a
class="card"
href="data_siswa.php">

👨‍🎓 Data Siswa

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
href="konseling.php">

📄 Konseling

</a>

</div>

</div>

</div>

</body>

</html>