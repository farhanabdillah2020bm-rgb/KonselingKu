<?php

function aman(
$text
){

return htmlspecialchars(

$text,

ENT_QUOTES,

'UTF-8'

);

}

?>