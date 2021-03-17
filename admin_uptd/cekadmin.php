<?php

//cek level user
if($_SESSION['level']!="ADMIN-UPTD")
{
    die("Anda bukan Admin UPTD");
}
?>