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
                <h3 class="mb-0">Form Pengajuan</h3>
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
                <div class="card-title">Form Pengajuan Mutasi</div>
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
              <form action="<?= base_url('/form_pengajuan/store') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="card-body">

                  <div class="row g-3 mb-3">  
                    <div class="col-md-8"> <label for="nama" class="form-label">Nama Pegawai</label>
                      <input type="nama" class="form-control" name="namalengkap" readonly
                       id="nama" aria-describedby="nama" value="<?= old('namalengkap', $pegawai->namalengkap ?? '') ?>">
                    </div>
                    <div class="col-md-4"> <label for="nip" class="form-label">NIP</label>
                      <input type="nip" class="form-control" name="nip"  id="nip" aria-describedby="nama" readonly
                      value="<?= old('nip', $pegawai->nip ?? '') ?>">
                    </div>
                  </div>
                  
                  <div class="col-md-12 mb-3"> <label for="unker1" class="form-label">Dinas</label>
                      <input type="nip" class="form-control" name="unker1"  id="unker1" aria-describedby="unker1"
                      value="<?= old('unker1', $pegawai->unker1 ?? '') ?>" readonly>
                  </div>

                  <div class="row g-3 mb-3">  
                    <div class="col-md-6"> <label for="unker2" class="form-label">Bidang</label>
                      <input type="nama" class="form-control" name="unker2" id="unker2" aria-describedby="unker2"
                      value="<?= old('unker2', $pegawai->unker2 ?? '') ?>" readonly>
                    </div>
                    <div class="col-md-6"> <label for="unker3" class="form-label">Sub Bidang</label>
                      <input type="nip" class="form-control" name="unker3"  id="unker3" aria-describedby="unker3"
                      value="<?= old('unker3', $pegawai->unker3 ?? '') ?>" readonly>
                    </div>
                  </div>

                  <div class="row g-3 mb-3">  
                    <div class="col-md-6"> <label for="jabatan" class="form-label">Jabatan</label>
                      <input type="nama" class="form-control" name="jabatan" id="jabatan" aria-describedby="jabatan"
                      value="<?= old('jabatan', $pegawai->jabakhirnama ?? '') ?>" readonly>
                    </div>
                    <div class="col-md-6"> <label for="golongan" class="form-label">Golongan</label>
                      <input type="nip" class="form-control" name="golongan"  id="golongan" aria-describedby="golongan"
                      value="<?= old('golongan', $pegawai->pangkatgol ?? '') ?>" readonly>
                    </div>
                  </div>

                  <!-- <div class="row g-3 mb-3">
                    <div class="col-md-6"> <label for="validationCustom01" class="form-label">Golongan</label>
                      <input type="text" class="form-control"  id="pnskodegol" name="pnskodegol"  value="Mark" required>
                    </div> end::Colbegin::Col
                    <div class="col-md-6"> <label for="validationCustom02" class="form-label">Unit Kerja</label>
                      <input type="text" class="form-control" id="kodeunker" name="kodeunker" value="Otto" required>
                    </div> end::Col--> <!--begin::Col
                  </div> -->

                  <!-- <div class="row g-3 mb-3">
                    <div class="col-md-6"> <label for="validationCustom02" class="form-label">Jabatan Lama</label>
                      <input type="text" class="form-control" id="jabatan_lama" name="jabatan_lama" value="Otto" required>
                    </div> end::Col begin::Col -->
                    <!-- <div class="col-md-6"> <label for="validationCustom02" class="form-label">Jabatan Baru</label>
                        <input type="text" class="form-control" id="jabatan_baru" name="jabatan_baru" value="Otto" required>
                    </div> end::Col begin::Col -->
                  <!-- </div> -->

                  <!-- <div class="mb-3"> <label for="jenis_mutasi" class="form-label">Jenis Mutasi</label>
                    <input type="nama" class="form-control" id="nama" aria-describedby="nama">
                  </div> -->
                  <div class="mb-3"> <label for="sk" class="form-label">SK Penempatan Terakhir</label>
                    <div class="input-group mb-3">
                      <input type="file" class="form-control" id="inputSK" name="inputSK" accept=".pdf" required >
                      <label class="input-group-text" for="inputSK">
                        Upload
                      </label>
                    </div>
                  </div>
                  <div class="mb-3"> <label for="sk-kp" class="form-label">SK Kenaikan Pangkat Terakhir</label>
                    <div class="input-group mb-3">
                      <input type="file" class="form-control" id="inputSKKP" name="inputSKKP" accept=".pdf" required>
                      <label class="input-group-text" for="inputSKKP">
                        Upload
                      </label>
                    </div>
                  </div>
                  <div class="mb-3"> <label for="skp" class="form-label">SKP tahun pertama</label>
                    <div class="input-group mb-3">
                      <input type="file" class="form-control" id="inputSKP1" name="inputSKP1" accept=".pdf" required>
                      <label class="input-group-text" for="inputSKP1">
                        Upload
                      </label>
                    </div>
                  </div>
                  <div class="mb-3"> <label for="skp" class="form-label">SKP tahun kedua</label>
                    <div class="input-group mb-3">
                      <input type="file" class="form-control" id="inputSKP2" name="inputSKP2" accept=".pdf" required>
                      <label class="input-group-text" for="inputSKP2">
                        Upload
                      </label>
                    </div>
                  </div>
                  
                  <div class="mb-3"> <label for="suratopd" class="form-label">Surat Persetujuan Kepala OPD</label>
                    <div class="input-group mb-3">
                      <input type="file" class="form-control" id="suratopd" name="suratopd" accept=".pdf" required>
                      <label class="input-group-text" for="suratopd">
                        Upload
                      </label>
                    </div>
                  </div>
                  <div class="mb-3"> <label for="alasan" class="form-label">Alasan</label>
                    <input type="nama" class="form-control" id="alasan" name="alasan" aria-describedby="nama">
                  </div>

                </div> <!--end::Body--> <!--begin::Footer-->
                <div class="card-footer"> <button type="submit" class="btn btn-primary">Submit</button> </div>
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

