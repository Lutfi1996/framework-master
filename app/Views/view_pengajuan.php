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
                <h3 class="mb-0"><?= $title ?></h3>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">
                    Form Pengajuan
                  </li>
                </ol>
              </div>
            </div> <!--end::Row-->
          </div> <!--end::Container-->
        </div> <!--end::App Content Header--> <!--begin::App Content-->
        
        <div> <!--begin::Header-->
          <div>
            <div class="card card-primary card-outline mb-4"> <!--begin::Header-->
              <div class="card-header">
                <!-- <div class="card-title">Form Pengajuan Mutasi</div> -->
              </div> <!--end::Header--> <!--begin::Form-->
              <?php if (session()->has('errors')): ?>
                  <div class="alert alert-danger">
                      <ul>
                          <?php foreach (session('errors') as $error): ?>
                              <li><?= esc($error) ?></li>
                          <?php endforeach ?>
                      </ul>
                  </div>
              <?php endif ?>
              <form action="<?= base_url('/form_pengajuan/store') ?>" method="post" >
                <?= csrf_field() ?>
                <div class="card-body">

                  <div class="row g-3 mb-3">  
                    <div class="col-md-8"> 
                      <label for="nama" class="form-label">Nama Pegawai</label>
                      <p class="form-control"> 
                        <?= $pengajuan['namalengkap'] ?>
                      </p>
                    </div>
                    <div class="col-md-4"> 
                      <label for="nip" class="form-label">NIP</label>
                      <p class="form-control"> 
                        <?= $pengajuan['nip'] ?>
                      </p>
                    </div>
                  </div>
                  
                  <div class="col-md-12 mb-3"> 
                    <label for="unker1" class="form-label">Dinas</label>
                    <p class="form-control"> 
                        <?= $pegawai->unker1?>
                    </p>
                  </div>

                  <div class="row g-3 mb-3">  
                    <div class="col-md-6"> 
                      <label for="unker2" class="form-label">Bidang</label>
                      <p class="form-control"> 
                        <?= $pegawai->unker2?>
                      </p>
                    </div>
                    <div class="col-md-6"> 
                      <label for="unker3" class="form-label">Sub Bidang</label>
                      <p class="form-control"> 
                        <?= $pegawai->unker3?>
                      </p>
                    </div>
                  </div>

                  <div class="row g-3 mb-3">  
                    <div class="col-md-6"> 
                      <label for="jabatan" class="form-label">Jabatan</label>
                      <p class="form-control"> 
                        <?= $pegawai->jabakhirnama?>
                      </p>
                    </div>
                    <div class="col-md-6"> 
                      <label for="golongan" class="form-label">Golongan</label>
                      <p class="form-control"> 
                        <?= $pegawai->pangkatgol?>
                      </p>
                    </div>
                  </div>

                  <div class="mb-3">
                    <label for="alasan" class="form-label">Alasan</label>
                    <p class="form-control"> 
                      <?= $pengajuan['alasan'] ?>
                    </p>        
                    <!-- <input type="nama" class="form-control" id="alasan" name="alasan" aria-describedby="nama"> -->
                  </div>

                  <div class="row">
                      <div class="col-md-12">
                          <div class="form-group">
                              <label>File Pendukung</label>
                              <?php foreach ($filepdf as $file): ?>
                              <div class="col-md-4 mb-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h6 class="m-0 font-weight-bold text-primary">
                                            <?= strtoupper($file['type_file']) ?> File
                                        </h6>
                                    </div>
                                    <div class="card-body">
                                        <?php if (in_array(pathinfo($file['file_name'], PATHINFO_EXTENSION), ['pdf'])): ?>
                                            <embed 
                                                src="<?= base_url('approval-mutasi/view-pdf/' . $file['id']) ?>" 
                                                type="application/pdf" 
                                                width="100%" 
                                                height="200px">
                                        <?php else: ?>
                                            <div class="text-center py-4">
                                                <i class="fas fa-file-alt fa-3x"></i>
                                                <p class="mt-2"><?= $file['file_name'] ?></p>
                                            </div>
                                        <?php endif; ?>
                                        
                                        <div class="text-center mt-2">
                                            <a href="<?= base_url('approval-mutasi/view-pdf/' . $file['id']) ?>" 
                                               class="btn btn-sm btn-primary" target="_blank">
                                                <i class="fas fa-eye"></i> View
                                            </a>
                                            <!-- <a href="<?= base_url('approval-mutasi/download-file/' . $file['id']) ?>" 
                                               class="btn btn-sm btn-success">
                                                <i class="fas fa-download"></i> Download
                                            </a> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>


                          </div>
                      </div>
                  </div>
                  

                </div> <!--end::Body--> <!--begin::Footer-->
                <div class="card-footer"> 
                  <!-- <button type="submit" class="btn btn-primary">Submit</button>  -->
                  <a href="<?= base_url('list_pengajuan') ?>" class="btn btn-secondary">
                      <i class="fas fa-arrow-left"></i> Kembali
                  </a>
                  
                </div>
                <!--end::Footer-->
              </form> <!--end::Form-->

              
                <?php if (session()->has('message')): ?>
                    <div class="alert alert-success mt-3">
                        <?= session('message') ?>
                    </div>
                <?php endif; ?>

                <?php if (session()->has('errors')): ?>
                    <div class="alert alert-danger mt-3">
                        <ul>
                            <?php foreach (session('errors') as $error): ?>
                                <li><?= $error ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
            </div> <!--end::Quick Example--> <!--begin::Input Group-->
          </div>
        </div>
      </main>
    </div>
  </div>
</section>
<script>
$(function () {
    $("#search_pegawai").autocomplete({
        source: function (request, response) {
            $.ajax({
                url: "<?= site_url('form_pengajuan/suggestion') ?>",
                data: { query: request.term },
                dataType: "json",
                success: function (data) {
                    response(data);
                }
            });
        },
        minLength: 2,
        select: function (event, ui) {
            $("#search_pegawai").val(ui.item.label);
            return false;
        }
    });
});
</script>
<?= $this->endSection() ?>

