<?php

//cek level user
if($_SESSION['level']!="PPK")
{
    die("Anda bukan Pejabat Pembuat Komitmen");
}
?>