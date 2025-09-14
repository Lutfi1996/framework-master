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
                <h3 class="mb-0"> Ubah Password </h3>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">
                    Ubah Password
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
                <div class="card-title"> Ubah Password</div>
              </div> <!--end::Header--> <!--begin::Form-->
                <div class="card-body">
                    <?php if(session()->getFlashdata('success')): ?>
                        <div class="alert alert-success">
                            <?= session()->getFlashdata('success') ?>
                        </div>
                    <?php endif; ?>

                    <?php if(session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger">
                            <?= session()->getFlashdata('error') ?>
                        </div>
                    <?php endif; ?>
                        

                        <?php if(isset($validation)): ?>
                            <div class="alert alert-danger"><?= $validation->listErrors() ?></div>
                        <?php endif; ?>
                        
                        
                        <?php if(isset($success)): ?>
                            <div class="alert alert-success"><?= $success ?></div>
                        <?php endif; ?>
                        
                        <?php if (session()->getFlashdata('error')): ?>
                                <!-- Untuk debugging di development -->
                                <?php if (ENVIRONMENT !== 'production' && session()->getFlashdata('error_detail')): ?>
                                    <pre class="mt-2"><?= esc(print_r(session()->getFlashdata('error_detail'), true)) ?></pre>
                                <?php endif; ?>
                            
                        <?php endif; ?>
                    
                  <form action="<?= base_url('ubah-password') ?>" method="post">
                    <?= csrf_field() ?>
                    

                    <div class="mb-3">
                        <label for="current_password" class="form-label">Password Saat Ini</label>
                        <input type="password" class="form-control" id="current_password" name="current_password" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="new_password" class="form-label">Password Baru</label>
                        <input type="password" class="form-control" id="new_password" name="new_password" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="confirm_password" class="form-label">Konfirmasi Password Baru</label>
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
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