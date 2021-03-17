<?php
$thisPage = '';
include "cekadmin.php";
include "../konfigurasi/koneksi.php";

if (!isset($_SESSION['nama'])) {
    echo '<script language="javascript">alert("Anda harus Login!"); document.location="../index.php";</script>';
}
?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="../assets/img/jabar.png" alt="" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">TaliKuat BimaJabar</span>

    </a>
    <!-- Sidebar -->

    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <?php
                $hasil = $talikuat->get_member();

                foreach ($hasil as $isi) {
                ?>
                    <img src="../assets/img/user/<?php echo $isi['gambar']; ?>" class="img-circle elevation-2" alt="User Image">
                <?php } ?>
            </div>
            <div class="info">
                <!--<a href="#" class="d-block">(<?php echo $_SESSION['nama']; ?>)</a>-->
                <?php
                $hasil = $talikuat->get_member();

                foreach ($hasil as $isi) {
                ?>
                    <a href="edit_user.php" class="d-block"><?php echo $isi['nama_lengkap']; ?></a>
                <?php } ?>
            </div>

        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item has-treeview">
                    <a href="index.php" class="nav-link <?php if ($menu == "Dashboard") {
                                                            echo "active";
                                                        } else {
                                                            echo "";
                                                        } ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Halaman Utama
                        </p>
                    </a>
                </li>

                <!-- <li class="nav-item">
                    <a href="data_absensi.php" class="nav-link">
                    <i class="nav-icon 	fa fa-address-card"></i>
                    <p>
                        Absensi Konsultan
                    </p>
                    </a>
                </li> -->

                <!-- <li class="nav-item">
                    <a href="data_progress_mingguan.php" class="nav-link <?php if ($menu == "Progress Mingguan" || $menu == "Input Progress Mingguan") {
                                                                                echo "active";
                                                                            } ?>">
                        <i class="nav-icon fas fa-edit" aria-hidden="true"></i>
                        <p>
                            Progress Mingguan
                        </p>
                    </a>
                </li> -->

                <li class="nav-item has-treeview <?php if ($menu == "Kontraktor" || $menu == "Edit Kontraktor" || $menu == "Konsultan" || $menu == "Edit Konsultan" || $menu == "PPK" || $menu == "Edit PPK" || $menu == "Jenis Pekerjaan" || $menu == "Edit Jenis Pekerjaan" || $menu == "Pengguna" || $menu == "Edit Pengguna") {
                                                        echo "menu-open";
                                                    } ?>">
                    <a href="#" class="nav-link <?php if ($menu == "Kontraktor" || $menu == "Edit Kontraktor" || $menu == "Konsultan" || $menu == "Edit Konsultan" || $menu == "PPK" || $menu == "Edit PPK" || $menu == "Jenis Pekerjaan" || $menu == "Edit Jenis Pekerjaan" || $menu == "Pengguna" || $menu == "Edit Pengguna") {
                                                    echo "active";
                                                } ?>">
                        <i class="nav-icon fas fa-edit"></i>
                        <p>
                            Data Utama
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="master_kontraktor.php" class="nav-link <?php if ($menu == "Kontraktor" || $menu == "Edit Kontraktor") {
                                                                                echo "active";
                                                                            } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Kontraktor</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="master_konsultan.php" class="nav-link <?php if ($menu == "Konsultan" || $menu == "Edit Konsultan") {
                                                                                echo "active";
                                                                            } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Konsultan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="master_ppk.php" class="nav-link <?php if ($menu == "PPK" || $menu == "Edit PPK") {
                                                                            echo "active";
                                                                        } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>PPK</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="master_jenis_pekerjaan.php" class="nav-link <?php if ($menu == "Jenis Pekerjaan" || $menu == "Edit Jenis Pekerjaan") {
                                                                                        echo "active";
                                                                                    } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Jenis Pekerjaan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="master_pengguna.php" class="nav-link <?php if ($menu == "Pengguna" || $menu == "Edit Pengguna") {
                                                                                echo "active";
                                                                            } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Pengguna Aplikasi</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview <?php if ($menu == "Data Umum" || $menu == "Buat Data Umum" || $menu == "Edit Data Umum" || $menu == "Jadual" || $menu == "Buat Jadual" || $menu == "Edit Jadual" || $menu == "Laporan Harian" || $menu == "Edit Laporan Harian" || $menu == "Buat Laporan Harian" || $menu == "Request" || $menu == "Edit Request" || $menu == "Buat Request") {
                                                        echo "menu-open";
                                                    } ?>">
                    <a href="#" class="nav-link <?php if ($menu == "Data Umum" || $menu == "Buat Data Umum" || $menu == "Edit Data Umum" || $menu == "Jadual" || $menu == "Buat Jadual" || $menu == "Edit Jadual" || $menu == "Laporan Harian" || $menu == "Edit Laporan Harian" || $menu == "Buat Laporan Harian" || $menu == "Request" || $menu == "Edit Request" || $menu == "Buat Request") {
                                                    echo "active";
                                                } ?>">
                        <i class="nav-icon fas fa-tasks"></i>
                        <p>
                            Input Data
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="data_umum.php" class="nav-link <?php if ($menu == "Data Umum" || $menu == "Edit Data Umum" || $menu == "Buat Data Umum" || $menu == "Buat Jadual") {
                                                                        echo "active";
                                                                    } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Umum</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="jadual.php" class="nav-link <?php if ($menu == "Jadual" || $menu == "Edit Jadual" || $menu == "Buat Request") {
                                                                        echo "active";
                                                                    } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Jadual Pekerjaan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="permintaan.php" class="nav-link <?php if ($menu == "Request" || $menu == "Edit Request" || $menu == "Buat Laporan Harian") {
                                                                            echo "active";
                                                                        } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Permintaan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="laporan_harian.php" class="nav-link <?php if ($menu == "Laporan Harian" || $menu == "Edit Laporan Harian") {
                                                                                echo "active";
                                                                            } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Laporan Harian</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Disposisi -->
                <!-- <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-envelope"></i>
                        <p>
                            Disposisi
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="disposisi/kirim_disposisi.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Kirim Disposisi</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="disposisi/disposisi_masuk.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Disposisi Masuk</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="disposisi/disposisi_tindak_lanjut.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Disposisi Tindak Lanjut</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="disposisi/disposisi_instruksi.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Disposisi Instruksi</p>
                            </a>
                        </li>
                    </ul>
                </li> -->

                <li class="nav-item has-treeview <?php if ($menu == "Data Kontrak") {
                                                        echo "menu-open";
                                                    } ?>">
                    <a href="#" class="nav-link <?php if ($menu == "Data Kontrak") {
                                                    echo "active";
                                                } ?>">
                        <i class="nav-icon fas fa-download"></i>
                        <p>
                            Pusat Unduhan
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="data_kontrak.php" class="nav-link <?php if ($menu == "Data Kontrak") {
                                                                            echo "active";
                                                                        } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Kontrak</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview <?php if ($menu == "Progress" || $menu == "Penilaian Kinerja" || $menu == "Perencanaan Konsultan" || $menu == "Laporan Pekerjaan" || $menu == "Progress Mingguan" || $menu == "Input Progress Mingguan") {
                                                        echo "menu-open";
                                                    } ?>">
                    <a href="#" class="nav-link <?php if ($menu == "Progress" || $menu == "Penilaian Kinerja" || $menu == "Perencanaan Konsultan" || $menu == "Laporan Pekerjaan" || $menu == "Progress Mingguan" || $menu == "Input Progress Mingguan") {
                                                    echo "active    ";
                                                } ?>">
                        <i class="nav-icon fas fa-download"></i>
                        <p>
                            Cetak laporan
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <!-- <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="data_progress.php" class="nav-link <?php if ($menu == "Progress") {
                                                                            echo "active";
                                                                        } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Progress</p>
                            </a>
                        </li>
                    </ul> -->
                    <!-- <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="data_progress_mingguan.php" class="nav-link <?php if($menu == "Progress Mingguan" || $menu == "Input Progress Mingguan") { echo "active"; } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Progress Mingguan</p>
                            </a>
                        </li>
                    </ul> -->
                    <!-- <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="" class="nav-link <?php if ($menu == "Laporan Penilaian") {
                                                                                echo "active";
                                                                            } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Laporan Penilaian</p>
                            </a>
                        </li>
                    </ul> -->
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="perencanaan_konsultan.php" class="nav-link <?php if ($menu == "Perencanaan Konsultan") {
                                                                                    echo "active";
                                                                                } ?>">
                                <i class="far fa-circle nav-icon" aria-hidden="true"></i>
                                <p>
                                    Perencanaan Konsultan
                                </p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="laporan_pekerjaan.php" class="nav-link <?php if ($menu == "Laporan Pekerjaan") {
                                                                                echo "active";
                                                                            } ?>">
                                <i class="far fa-circle nav-icon" aria-hidden="true"></i>
                                <p>
                                    Laporan Pekerjaan
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview <?php if ($menu == "Edit User" || $menu == "Catatan Log") {
                                                        echo "menu-open";
                                                    } ?>">
                    <a href="#" class="nav-link <?php if ($menu == "Edit User" || $menu == "Catatan Log") {
                                                    echo "active";
                                                } ?>">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>
                            Pengaturan
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="edit_user.php" class="nav-link <?php if ($menu == "Edit User") {
                                                                        echo "active";
                                                                    } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Pengguna</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="loghistory.php" class="nav-link <?php if ($menu == "Catatan Log") {
                                                                            echo "active";
                                                                        } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Catatan Log</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>