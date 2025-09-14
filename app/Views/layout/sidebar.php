<!-- MENU SIDE BAR -->
    <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark"> <!--begin::Sidebar Brand-->
      <div class="sidebar-brand"> <!--begin::Brand Link--> <a href="./index.html" class="brand-link">
          <!--begin::Brand Image--> <img src="dist/assets/img/AdminLTELogo.png" alt="AdminLTE Logo"
            class="brand-image opacity-75 shadow"> <!--end::Brand Image--> <!--begin::Brand Text--> <span
            class="brand-text fw-light">AdminLTE 4</span> <!--end::Brand Text--> </a> <!--end::Brand Link--> </div>
      <!--end::Sidebar Brand--> <!--begin::Sidebar Wrapper-->
      <div class="sidebar-wrapper">
        <nav class="mt-2"> <!--begin::Sidebar Menu-->
          <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="navigation"
            aria-label="Main navigation" data-accordion="false" id="navigation">
            <?php 
            $userType = session()->get('type_user');
            // Atau cara alternatif:
            $allowedPengajuanMutasi = [3]; // Role yang diizinkan untuk akses pengajuan mutasi'];
            if(in_array($userType, $allowedPengajuanMutasi)): ?>
              <li class="nav-item"> <a href="<?= base_url('form_pengajuan') ?>" class="nav-link"> 
                  <i class="nav-icon bi bi-palette"></i>
                  <p>Form Pengajuan Mutasi</p>
                </a>
              </li>
            <?php endif; ?>
            
            <li class="nav-item"> <a href="<?= base_url('list_pengajuan') ?>" class="nav-link"> 
                <i class="nav-icon bi bi-palette"></i>
                <p>List Pengajuan Mutasi</p>
              </a>
            </li>

            <?php 
              // Atau cara alternatif:
              $allowedPengajuanMutasi = [1,2]; // Role yang diizinkan untuk akses pengajuan mutasi'];
              if(in_array($userType, $allowedPengajuanMutasi)): ?>
              <li class="nav-item"> <a href="<?= base_url('setting_users') ?>" class="nav-link"> 
                  <i class="nav-icon bi bi-palette"></i>
                  <p>Setting User</p>
                </a>
              </li>

              <li class="nav-item"> <a href="<?= base_url('approval-mutasi') ?>" class="nav-link"> 
                  <i class="nav-icon bi bi-palette"></i>
                  <p>Approval Pengajuan Mutasi</p>
                </a>
              </li>
            <?php endif; ?>
          </ul> <!--end::Sidebar Menu-->
        </nav>
      </div> <!--end::Sidebar Wrapper-->
    </aside> <!--end::Sidebar--> <!--begin::App Main-->
    <!-- MENU SIDE BAR END -->