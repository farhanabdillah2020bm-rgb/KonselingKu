<?php

session_start();

function siswaOnly(){

if(

!isset(
$_SESSION['role']
)

||

$_SESSION['role']
!="siswa"

){

header(
"Location:../login.php"
);

exit;

}

}


function guruOnly(){

if(

!isset(
$_SESSION['role']
)

||

$_SESSION['role']
!="guru"

){

header(
"Location:../login.php"
);

exit;

}

}

?>