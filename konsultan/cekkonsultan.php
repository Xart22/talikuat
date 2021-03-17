<?php

//cek level user
if($_SESSION['level']!="KONSULTAN")
{
    die("Anda bukan Konsultan");
}
?>