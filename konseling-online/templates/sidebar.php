<div
class="burger-btn"
id="burger"
onclick="toggleSidebar()">

☰

</div>

<aside
class="sidebar"
id="sidebar">

<div class="logo">

KonselingKu

</div>

<div class="menu">

<?php

if($_SESSION['role']=="siswa"){

?>

<a href="dashboard.php">

Dashboard

</a>

<a href="ajukan.php">

Ajukan Konseling

</a>

<a href="jadwal.php">

Jadwal

</a>

<a href="chat.php">

Chat

</a>

<a href="riwayat.php">

Riwayat

</a>

<?php

}

?>

<?php

if($_SESSION['role']=="guru"){

?>

<a href="dashboard.php">

Dashboard

</a>

<a href="data_siswa.php">

Data Siswa

</a>

<a href="jadwal.php">

Jadwal

</a>

<a href="chat.php">

Chat

</a>

<a href="konseling.php">

Konseling

</a>

<?php

}

?>

<a href="../logout.php">

Logout

</a>

</div>

</aside>

<script
src="../assets/js/sidebar.js">

</script>