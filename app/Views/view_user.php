<?= $this->extend('layout/main.php') ?>

<?= $this->section('content') ?>
<section class="content">
  <div class="container-fluid">
    <div class="col-md-12"> <!--begin::Quick Example-->
      <main class="app-main"> <!--begin::App Content Header-->
        <div class="app-content-header"> <!--begin::Container-->
          <div class="container-fluid"> <!--begin::Row-->
            <div class="row">
              <div class="col-sm-6">
                <h3 class="mb-0"> User </h3>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="<?= site_url('setting_users') ?>">User</a></li>
                  <li class="breadcrumb-item active" aria-current="page">
                    View User
                  </li>
                </ol>
              </div>
            </div> <!--end::Row-->
          </div> <!--end::Container-->
        </div> <!--end::App Content Header--> <!--begin::App Content-->
        <!-- <div class="card card-primary card-outline mb-4"> begin::Header-->
          <div>
            <div class="card card-primary card-outline mb-4"> <!--begin::Header-->
              <div class="card-header">
                <div class="card-title"> View User </div>
              </div> <!--end::Header--> <!--begin::Form-->
                <div class="card-body">

                    <div class="mb-2"> 
                      <label for="nip" class="form-label">NIP</label>
                      <label  class="form-control" id="nip" aria-describedby="nama" readonly><?= esc($user->nip) ?></label>
                    </div>

                    <div class="mb-2">
                      <label for="nama" class="form-label">Nama Pegawai</label>
                      <label class="form-control" id="nama" aria-describedby="nama" readonly><?= esc($user->nama) ?></label>
                    </div>

                    <div class="mb-2">
                      <label for="email" class="form-label">Email </label>
                      <label class="form-control" id="email" aria-describedby="email" readonly><?= esc($user->email) ?></label>
                    </div>

                    <div class="mb-2">
                      <label for="role" class="form-label">Role </label>
                      <label class="form-control" id="role" aria-describedby="role" readonly><?= esc($user->type_user_name) ?></label>
                    </div>

                    <div class="mb-2">
                      <label for="dinas" class="form-label">Dinas </label>
                      <label class="form-control" id="dinas" aria-describedby="dinas" readonly><?= esc($user->namaunkerutamabesar) ?></label>
                    </div>
                    
                </div> <!--end::Quick Example--> <!--begin::Input Group-->
            </div>
        </div>
      </main>
    </div>
  </div>
</section>

<?= $this->endSection() ?>