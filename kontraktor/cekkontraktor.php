<?php

//cek level user
if($_SESSION['level']!="KONTRAKTOR")
{
    die("Anda bukan Penyedia Jasa");
}
?>