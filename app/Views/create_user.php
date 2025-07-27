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
                <h3 class="mb-0"> Setting User </h3>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">
                    Setting Users
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
                <div class="card-title"> Tambah User </div>
              </div> <!--end::Header--> <!--begin::Form-->
                <div class="card-body">
                  <?php if (session()->getFlashdata('error')): ?>
                      <div class="alert alert-danger">
                          <?= esc(session()->getFlashdata('error')) ?>
                          
                          <!-- Untuk debugging di development -->
                          <?php if (ENVIRONMENT !== 'production' && session()->getFlashdata('error_detail')): ?>
                              <pre class="mt-2"><?= esc(print_r(session()->getFlashdata('error_detail'), true)) ?></pre>
                          <?php endif; ?>
                      </div>
                  <?php endif; ?>
                  <form action="<?= base_url('create_user') ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="mb-2"> 
                      <label for="nip" class="form-label">NIP</label>
                      <input name='nip' type="text" class="form-control" id="nip" aria-describedby="nama" required>
                    </div>

                    <div class="mb-2">
                      <label for="nama" class="form-label">Nama Pegawai</label>
                      <input name='nama' type="text" class="form-control" id="nama" aria-describedby="nama" required>
                    </div>
                    
                    <div class="mb-2"> 
                      <label for="email" class="form-label">Email</label>
                      <input name='email' type="email" class="form-control" id="email" aria-describedby="nama" required>
                    </div>

                    <div class="mb-2"> <label for="role" class="form-label">Role</label>
                      <select name="type_user" class="form-select mt-2" id="type_user">
                        <option selected disabled value="">Pilih Role</option>
                        <?php foreach($typeUsers as $row): ?>
                            <option value="<?= $row['id'] ?>"><?= $row['type_user'] ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>

                    <div class="mb-2"> <label for="dinas" class="form-label">Dinas</label>
                      <select class="form-select mt-2" id="kodeunker_utama" name="kodeunker_utama">
                        <option selected disabled value="">Pilih Dinas</option>
                        <?php foreach($dinaslist as $row): ?>
                            <option value="<?= $row['kodeunkerutama'] ?>"><?= $row['namaunkerutamabesar'] ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>

                    <div class="card-footer"> 
                      <button type="submit" class="btn btn-primary">Submit</button> 
                    </div>

                  </form> <!--end::Form-->
                </div> <!--end::Quick Example--> <!--begin::Input Group-->
            </div>
        </div>
      </main>
    </div>
  </div>
</section>
<?= $this->endSection() ?>