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
                    Update Password User
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
                <div class="card-title"> Update Password User </div>
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
                  <form action="<?= site_url('user/update/' . $user['id']) ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="mb-2"> 
                      <label for="nip" class="form-label">NIP</label>
                      <label  class="form-control" id="nip" aria-describedby="nama" readonly><?= esc($user['nip']) ?></label>
                    </div>

                    <div class="mb-2">
                      <label for="nama" class="form-label">Nama </label>
                      <label class="form-control" id="nama" aria-describedby="nama" readonly><?= esc($user['nama']) ?></label>
                    </div>

                    <div class="mb-2">
                      <label for="email" class="form-label">Email </label>
                      <label class="form-control" id="email" aria-describedby="email" readonly><?= esc($user['email']) ?></label>
                    </div>

                    <div class="mb-2">
                      <label for="password" class="form-label">Password Baru </label>
                      <input class="form-control" type="password" id="new_password"
                         name="new_password" required onkeyup="checkPasswordStrength()" >
                        <div class="password-strength">
                            <div class="strength-meter" id="passwordStrength"></div>
                        </div>
                        <?php if (isset($validation) && $validation->hasError('new_password')): ?>
                            <div class="error-message"><?= $validation->getError('new_password') ?></div>
                        <?php endif; ?>
                        
                        <span class="show-password-btn" id="showPasswordBtn">
                            <i class="fas fa-eye"></i>
                        </span>
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
<script>
    const passwordInput = document.getElementById('new_password');
    const showPasswordBtn = document.getElementById('showPasswordBtn');
    const eyeIcon = showPasswordBtn.querySelector('i');

    showPasswordBtn.addEventListener('click', function() {
        // Memeriksa tipe input saat ini
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        
        // Mengubah tipe input
        passwordInput.setAttribute('type', type);
        
        // Mengubah ikon mata
        if (type === 'password') {
            eyeIcon.classList.remove('fa-eye-slash');
            eyeIcon.classList.add('fa-eye');
        } else {
            eyeIcon.classList.remove('fa-eye');
            eyeIcon.classList.add('fa-eye-slash');
        }
    });
    </script>
<?= $this->endSection() ?>