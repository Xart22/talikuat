<?php

//cek level user
if($_SESSION['level']!="ADMINISTRATOR")
{
    die("Anda bukan admin");
}
?>