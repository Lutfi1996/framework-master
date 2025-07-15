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
        <div class="card card-primary card-outline mb-4"> <!--begin::Header-->
          <div class="card-header">
            <div class="card-title">Pencarian</div>
          </div> <!--end::Header--> <!--begin::Form-->
          <form> <!--begin::Body-->
            <div class="card-body">
              <div class="input-group mb-3">
                <form class="d-flex" role="search">
                  <input class="form-control me-2" type="search" id="autocomplete-nama" placeholder="Cari Nama Pegawai" aria-label="Search">
                  <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
              </div>
            </div>
          </form>
        </div> <!--end::Body-->
        <div class="card card-primary card-outline mb-4"> <!--begin::Header-->
          <div>
            <div class="card card-primary card-outline mb-4"> <!--begin::Header-->
              <div class="card-header">
                <div class="card-title">Quick Example</div>
              </div> <!--end::Header--> <!--begin::Form-->
              <form> <!--begin::Body-->
                <div class="card-body">

                  <div class="mb-3"> <label for="nama" class="form-label">Nama Pegawai</label>
                    <input type="nama" class="form-control" id="nama" aria-describedby="nama">
                  </div>
                  <div class="mb-3"> <label for="nip" class="form-label">NIP</label>
                    <input type="nip" class="form-control" id="nip" aria-describedby="nama">
                  </div>
                  <div class="row g-3 mb-3">
                    <div class="col-md-6"> <label for="validationCustom01" class="form-label">Golongan</label>
                      <input type="text" class="form-control" id="validationCustom01" value="Mark" required>
                    </div> <!--end::Col--> <!--begin::Col-->
                    <div class="col-md-6"> <label for="validationCustom02" class="form-label">Unit Kerja</label>
                      <input type="text" class="form-control" id="validationCustom02" value="Otto" required>
                    </div> <!--end::Col--> <!--begin::Col-->
                  </div>
                  <div class="mb-3"> <label for="sk" class="form-label">SK Penepatan Terakhir</label>
                    <div class="input-group mb-3">
                      <input type="file" class="form-control" id="inputSK">
                      <label class="input-group-text" for="inputSK">
                        Upload
                      </label>
                    </div>
                  </div>
                  <div class="mb-3"> <label for="sk-kp" class="form-label">SK Kenaikan Pangkat Terakhir</label>
                    <div class="input-group mb-3">
                      <input type="file" class="form-control" id="inputSK-KP">
                      <label class="input-group-text" for="inputSK-KP">
                        Upload
                      </label>
                    </div>
                  </div>
                  <div class="mb-3"> <label for="skp" class="form-label">SKP 2 tahun terakhir</label>
                    <div class="input-group mb-3">
                      <input type="file" class="form-control" id="inputSKP">
                      <label class="input-group-text" for="inputSKP">
                        Upload
                      </label>
                    </div>
                  </div>
                  <div class="mb-3"> <label for="surat-opd" class="form-label">Surat Persetujuan Kepala OPD</label>
                    <div class="input-group mb-3">
                      <input type="file" class="form-control" id="surat-opd">
                      <label class="input-group-text" for="surat-opd">
                        Upload
                      </label>
                    </div>
                  </div>
                  <div class="mb-3"> <label for="alasan" class="form-label">Alasan</label>
                    <input type="nama" class="form-control" id="alasan" aria-describedby="nama">
                  </div>

                </div> <!--end::Body--> <!--begin::Footer-->
                <div class="card-footer"> <button type="submit" class="btn btn-primary">Submit</button> </div>
                <!--end::Footer-->
              </form> <!--end::Form-->
            </div> <!--end::Quick Example--> <!--begin::Input Group-->
          </div>
        </div>
      </main>
    </div>
  </div>
</section>
<?= $this->endSection() ?>

<script>
$(function() {
    $("#autocomplete-nama").autocomplete({
        source: "/autocomplete", // arahkan ke controller yang tadi kamu buat
        minLength: 2
    });
});
</script>