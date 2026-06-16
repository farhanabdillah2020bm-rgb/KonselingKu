<?php

include 'config/koneksi.php';

if(isset($_POST['register'])){

$nama=$_POST['nama'];

$username=$_POST['username'];

$password=password_hash(
$_POST['password'],
PASSWORD_DEFAULT
);

$role=$_POST['role'];

$nama=
trim(
$nama
);

$username=
trim(
$username
);

if(

strlen(
$nama
)<3

){

exit(
"Nama terlalu pendek"
);

}

$stmt=

mysqli_prepare(

$conn,

"

INSERT INTO users
(
nama,
username,
password,
role
)

VALUES
(
?,
?,
?,
?
)

"

);

mysqli_stmt_bind_param(

$stmt,

"ssss",

$nama,

$username,

$password,

$role

);

mysqli_stmt_execute(
$stmt);

header(
"Location:login.php"
);

exit;

}

?>

<!DOCTYPE html>

<html>

<head>

<title>Register</title>

<link
rel="stylesheet"
href="assets/css/login.css">

</head>

<body>

<div class="container">

<form method="POST">

<h1>Register</h1>

<input
type="text"
name="nama"
placeholder="Nama"
required>

<input
type="text"
name="username"
placeholder="Username"
required>

<input
type="password"
name="password"
placeholder="Password"
required>

<select
name="role"
required>

<option value="">

Pilih Role

</option>

<option value="siswa">

Siswa

</option>

<option value="guru">

Guru BK

</option>

</select>

<button
type="submit"
name="register">

Daftar

</button>

<p>

Sudah punya akun?

<a href="login.php">

Login

</a>

</p>

</form>

</div>

</body>

</html>