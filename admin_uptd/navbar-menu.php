<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="../assets/img/jabar.png" alt="" class="brand-image img-circle elevation-3"
           style="opacity: .8">
	  <span class="brand-text font-weight-light">TaliKuat BimaJabar</span>   

    </a>
    <!-- Sidebar -->

    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
				  				<?php 
									$hasil = $talikuat -> get_member();
									
									foreach($hasil as $isi){
								?>
          <img src="../assets/img/user/<?php echo $isi['gambar'];?>" class="img-circle elevation-2" alt="User Image">
								<?php }?>
		</div>
        <div class="info">
          <!--<a href="#" class="d-block">(<?php echo $_SESSION['nama'] ; ?>)</a>-->
		  						<?php 
									$hasil = $talikuat -> get_member();
									
									foreach($hasil as $isi){
								?>
		  <a href="#" class="d-block"><?php echo $isi['nama_lengkap'];?></a>
									<?php }?>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview <?php if ($menu == "Dashboard") {
                                                            echo "menu-open";
                                                        } else {
                                                            echo "";
                                                        } ?>">
            <a href="index.php" class="nav-link <?php if ($menu == "Dashboard") {
                                                            echo "active";
                                                        } else {
                                                            echo "";
                                                        } ?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Halaman Utama
                <!--<i class="right fas fa-angle-left"></i>-->
              </p>
            </a>
          </li>
		  
		 <li class="nav-item has-treeview <?php if ($menu == "Kontraktor" || $menu == "Edit Kontraktor" || $menu == "Konsultan" || $menu == "Edit Konsultan" || $menu == "PPK" || $menu == "Edit PPK" || $menu == "Jenis Pekerjaan" || $menu == "Edit Jenis Pekerjaan") {
                                                        echo "menu-open";
                                                    } ?>">
            <a href="#" class="nav-link <?php if ($menu == "Kontraktor" || $menu == "Edit Kontraktor" || $menu == "Konsultan" || $menu == "Edit Konsultan" || $menu == "PPK" || $menu == "Edit PPK" || $menu == "Jenis Pekerjaan" || $menu == "Edit Jenis Pekerjaan") {
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
			  <!--
              <li class="nav-item">
                <a href="master_pengguna.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Pengguna Aplikasi</p>
                </a>
              </li>	
			  -->		  			  
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
                  <p>laporan Harian</p>
                </a>
              </li>	  			  
            </ul>
          </li>

		 <li class="nav-item has-treeview <?php if ($menu == "Data Kontrak" || $menu == "Laporan Penilaian") {
                                                        echo "menu-open";
                                                    } ?>">
            <a href="#" class="nav-link <?php if ($menu == "Data Kontrak" || $menu == "Laporan Penilaian") {
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
            </ul>
          </li>
		  
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>