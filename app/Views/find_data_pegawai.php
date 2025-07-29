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
          <form   action="<?= base_url('form_pengajuan/getdatapegawai') ?>" method="get"> <!--begin::Body-->
            <div class="card-body">
              <div class="input-group mb-3">
                <form class="d-flex" role="search">
                 
                  <input class="form-control me-2" type="text" id="search_pegawai" name="search_pegawai" placeholder="Ketik Nama / NIP " aria-label="Search">
                  <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
              </div>
            </div>
          </form>
        </div> <!--end::Body-->
        
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

