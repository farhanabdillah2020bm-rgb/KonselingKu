<?php

session_start();

include 'config/koneksi.php';

if(isset($_POST['login'])){

$username=$_POST['username'];

$password=$_POST['password'];

$query=

mysqli_query(

$conn,

"SELECT *
FROM users
WHERE username='$username'"

);

$stmt=

mysqli_prepare(

$conn,

"

SELECT *

FROM users

WHERE username=?

"

);

mysqli_stmt_bind_param(

$stmt,

"s",

$username

);

mysqli_stmt_execute(
$stmt);

$result=

mysqli_stmt_get_result(
$stmt
);

$user=

mysqli_fetch_assoc(
$result
);



if(

$user
&&

password_verify(

$password,

$user['password']

)

){

session_regenerate_id(
true
);

$_SESSION['id']=
$user['id'];

$_SESSION['nama']=
$user['nama'];

$_SESSION['role']=
$user['role'];

}

if(

$user &&
password_verify(
$password,
$user['password']
)

){

$_SESSION['id']=$user['id'];

$_SESSION['nama']=$user['nama'];

$_SESSION['role']=$user['role'];

if(
$user['role']=="siswa"
){

header(
"Location:siswa/dashboard.php"
);

}

if(
$user['role']=="guru"
){

header(
"Location:guru/dashboard.php"
);

}

exit;

}

}

?>

<!DOCTYPE html>

<html>

<head>

<title>Login</title>

<link
rel="stylesheet"
href="assets/css/login.css">

</head>

<body>

<div class="container">

<form method="POST">

<h1>Login</h1>

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

<button
type="submit"
name="login">

Masuk

</button>

<p>

Belum punya akun?

<a href="register.php">

Daftar

</a>

</p>

</form>

</div>

</body>

</html>