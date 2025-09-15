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
              <form action="<?= base_url('/approval-mutasi/approval/'. $pengajuan['id']) ?>" method="post" >
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
                  <!-- <div class="mb-3"> <label for="sk" class="form-label">SK Penempatan Terakhir</label>
                    <div class="input-group mb-3">
                      <input type="file" class="form-control" id="inputSK" name="inputSK" accept=".pdf" required >
                      <label class="input-group-text" for="inputSK">
                        Upload
                      </label>
                    </div>
                  </div> -->
                  <!-- <div class="mb-3"> <label for="sk-kp" class="form-label">SK Kenaikan Pangkat Terakhir</label>
                    <div class="input-group mb-3">
                      <input type="file" class="form-control" id="inputSKKP" name="inputSKKP" accept=".pdf" required>
                      <label class="input-group-text" for="inputSKKP">
                        Upload
                      </label>
                    </div>
                  </div> -->
                  <!-- <div class="mb-3"> <label for="skp" class="form-label">SKP tahun pertama</label>
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
                  </div> -->
                  <div class="mb-3">
                    <label for="alasan" class="form-label">Alasan</label>
                    <textarea name="alasan" class="form-control" rows="3" placeholder="Enter ..." readonly><?= $pengajuan['alasan'] ?></textarea>     
                    <!-- <input type="nama" class="form-control" id="alasan" name="alasan" aria-describedby="nama"> -->
                  </div>

                  <div ><strong>Tujuan Mutasi</strong></div>

                  <div class="col-md-12 mb-3"> <label for="tujuanunker1" class="form-label">Dinas</label>
                    <select name="tujuanunker1" id="tujuanunker1" class="form-control" required>
                        <option value="">-- Pilih Dinas --</option>
                        <?php foreach ($unker1 as $option): ?>
                            <option value="<?= esc($option['unker1']) ?>" 
                                <?= ($defaultDinas == $option['unker1']) ? 'selected' : '' ?>>
                                <?= esc($option['unker1']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                  </div>

                  <div class="row g-3 mb-3">  
                    <div class="col-md-6"> <label for="bidangunker2" class="form-label">Bidang</label>
                      <select class="form-control" id="bidangunker2" name="bidangunker2" required>
                          <option value="">Pilih Bidang ...</option>
                      </select>
                    </div>
                    <div class="col-md-6"> <label for="subbidangunker3" class="form-label">Sub Bidang</label>
                      <select class="form-control" id="subbidangunker3" name="subbidangunker3" required>
                          <option value="">Pilih Sub Bidang ...</option>
                      </select>
                    </div>
                  </div>

                  

                  <div class="row g-3 mb-3">  
                    <div class="col-md-6"> <label for="tujuanjabatan" class="form-label">Jabatan</label>
                      <input type="nama" class="form-control" name="tujuanjabatan" id="tujuanjabatan" aria-describedby="tujuanjabatan"
                      value="<?= (old('tujuanjabatan', $pengajuan['jabakhirnama_baru'])) ?>" >
                    </div>
                    
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
                  <a href="<?= base_url('approval-mutasi') ?>" class="btn btn-secondary">
                      <i class="fas fa-arrow-left"></i> Kembali
                  </a>

                  <button type="submit" class="btn btn-info" onclick="return confirmAction('approve')" name="action" value="approve">
                      <i class="fas fa-check"></i> Setujui </button>
                  <button type="submit" class="btn btn-danger" onclick="return confirmAction('reject')" name="action" value="reject">
                      <i class="fas fa-times"></i> Tolak </button> 

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

<script>
$(document).ready(function() {
    var defaultDinas = '<?= $defaultDinas ?>';
    var defaultBidang = '<?= $defaultBidang ?>';
    var defaultSeksi = '<?= $defaultSubBidang ?>';
    
    //console.log('Default Values:', defaultDinas, defaultBidang, defaultSeksi);
    
    // Load bidang berdasarkan dinas default
    if (defaultDinas) {
        loadBidangUnker(defaultDinas, defaultBidang);
    }
    
    // Event change untuk dinas
    $('#tujuanunker1').change(function() {
        var codeunker1 = $(this).val();
        loadBidangUnker(codeunker1, '');
    });
    
    // Event change untuk bidang
    $('#bidangunker2').change(function() {
        var unker2 = $(this).val();
        var codeunker1 = $('#tujuanunker1').val();
        loadSeksiUnker(codeunker1, unker2, '');
    });
});

function loadBidangUnker(codeunker1, defaultValue) {
    if(codeunker1) {
        $.ajax({
            url: '<?= site_url('getUnkerBidangByDinas') ?>/' + codeunker1,
            type: 'GET',
            dataType: 'json',
            beforeSend: function() {
                $('#bidangunker2').html('<option value="">Loading...</option>');
            },
            success: function(data) {
                $('#bidangunker2').empty().append('<option value="">Pilih Bidang</option>');
                
                $.each(data, function(key, value) {
                    var selected = (value.unker2 == defaultValue) ? 'selected' : '';
                    $('#bidangunker2').append(
                        '<option value="'+ value.unker2 +'" '+ selected +'>'+ 
                        value.unker2 + '</option>'
                    );
                });
                
                // Setelah bidang ter-load, load seksi jika ada default value
                if (defaultValue) {
                    setTimeout(function() {
                        loadSeksiUnker(codeunker1, defaultValue, '<?= $defaultSubBidang ?>');
                    }, 100);
                }
            },
            error: function() {
                $('#bidangunker2').html('<option value="">Error loading data</option>');
            }
        });
    } else {
        $('#bidangunker2').empty().append('<option value="">Pilih Bidang</option>');
        $('#subbidangunker3').empty().append('<option value="">Pilih Sub Bidang</option>');
    }
}

function loadSeksiUnker(codeunker1, unker2, defaultValue) {
    if(codeunker1 && unker2) {
        $.ajax({
            url: '<?= site_url('getUnkerSubBidangByBidang') ?>/' + 
                  encodeURIComponent(codeunker1) + '/' + 
                  encodeURIComponent(unker2),
            type: 'GET',
            dataType: 'json',
            beforeSend: function() {
                $('#subbidangunker3').html('<option value="">Loading...</option>');
            },
            success: function(data) {
                $('#subbidangunker3').empty().append('<option value="">Pilih Sub Bidang</option>');
                
                $.each(data, function(key, value) {
                    var selected = (value.unker3 == defaultValue) ? 'selected' : '';
                    $('#subbidangunker3').append(
                        '<option value="'+ value.unker3 +'" '+ selected +'>'+ 
                        value.unker3 + '</option>'
                    );
                });
                
                // Trigger change jika perlu
                $('#subbidangunker3').trigger('change');
            },
            error: function() {
                $('#subbidangunker3').html('<option value="">Error loading data subbidang</option>');
            }
        });
    } else {
        $('#subbidangunker3').empty().append('<option value="">Pilih Sub Bidang</option>');
    }
}

function confirmAction(action) {
    let message = '';
    
    if (action === 'approve') {
        message = 'Apakah Anda yakin ingin menyetujui?';
    } else if (action === 'reject') {
        message = 'Apakah Anda yakin ingin menolak?';
    }
    
    if (confirm(message)) {
        document.getElementById('actionInput').value = action;
        document.getElementById('myForm').submit();
        return true;
    }
    return false;
}
</script>
<?= $this->endSection() ?>

