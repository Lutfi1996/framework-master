<?= $this->extend('layout/main.php') ?>

<?= $this->section('content') ?>
<section class="content">
    <div class="container-fluid">
        <div class="col-md-12"> <!--begin::Quick Example-->
            <main class="app-main"> <!--begin::App Content Header-->
                <div class="card card-primary card-outline mb-4" style="margin-top: 20px;">
                    <div class="card-header">
                        <h3 class="card-title">List Pengajuan Mutasi</h3>
                    </div> <!-- /.card-header -->
                    <div class="card-body">
                        <form method="GET" action="<?= site_url('list_pengajuan') ?>" class="filter-form">
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="start_date">Dari Tanggal:</label>
                                    <input type="date" id="start_date" name="start_date" 
                                        value="<?= old('start_date', $start_date ?? date('Y-m-01')) ?>">
                                </div>

                                <div class="form-group">
                                    <label for="end_date">Sampai Tanggal:</label>
                                    <input type="date" id="end_date" name="end_date" 
                                        value="<?= old('end_date', $end_date ?? date('Y-m-t')) ?>">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="status">Status:</label>
                                    <select id="status" name="status">
                                        <option value="">Semua Status</option>
                                        <option value="0" <?= (isset($status) && $status == '0') ? 'selected' : '' ?>>Pengajuan</option>
                                        <option value="1" <?= (isset($status) && $status == '1') ? 'selected' : '' ?>>Disetujui</option>
                                        <option value="2" <?= (isset($status) && $status == '2') ? 'selected' : '' ?>>Perlu perbaikan</option>
                                        <option value="3" <?= (isset($status) && $status == '3') ? 'selected' : '' ?>>Pengajuan (perbaikan)</option>
                                        <option value="4" <?= (isset($status) && $status == '4') ? 'selected' : '' ?>>Ditolak</option>
                                    </select>
                                </div>
                            </div>

                            <button type="submit" class="btn-submit">
                                <i class="fas fa-filter"></i> Terapkan Filter
                            </button>
                            <button type="button" onclick="resetFilter()" class="btn-reset">
                                <i class="fas fa-times"></i> Reset Filter
                            </button>
                        </form>



                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Lengkap</th>
                                    <th>NIP</th>
                                    <th>Tempat/Tanggal Lahir</th>
                                    <th>Pangkat/Golongan</th>
                                    <th>Jabatan Lama</th>
                                    <th>Jabatan Baru</th>
                                    <th>Tanggal Pengajuan</th>
                                    <!-- <th>Jabatan/Golongan Lama</th>
                                    <th>Jabatan/Golongan Baru</th> -->
                                    <th>Status</th>
                                    <th>View</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php foreach($mutasi as $row): ?>
                                <tr class="align-middle">
                                    <td> <?= $no++ ?> </td>
                                    <td> <?= esc($row['namalengkap']) ?> </td>
                                    <td> <?= esc($row['nip']) ?> </td>
                                    <td> <?= esc($row['tempatlahir']) ?> / <?= esc(formatTanggalLahir($row['tgllahir'])) ?> </td>
                                    <td> <?= esc($row['pangkatgol']) ?> </td>
                                    <td> <?= esc($row['unker3_lama'] . ' PADA ' . $row['unker2_lama'] . ' PADA ' . $row['unker1_lama']) ?> </td>
                                    <td> <?= esc($row['unker3_baru'] . ' PADA ' . $row['unker2_baru'] . ' PADA ' . $row['unker1_baru']) ?> </td>
                                    <td> <?= date('d/m/Y H:i', strtotime($row['input_date'])) ?></td>
                                    <td> <?= $row['status_label'] ?> </td>
                                    <td>
                                        <a href="<?= base_url('list_pengajuan/view/' . $row['id']) ?>" class="btn btn-primary btn-sm">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div> <!-- /.card-body -->

                    <!-- Pagination Links -->
                    <!-- Pagination Links dengan pengecekan -->
                    <!-- Test manual -->
                    <!-- <nav aria-label="Page navigation">
                        <ul class="pagination">
                            <li class="page-item"><a class="page-link" href="?page=1">1</a></li>
                            <li class="page-item"><a class="page-link" href="?page=2">2</a></li>
                        </ul>
                    </nav> -->

                    
                    <div class="card-footer clearfix">
                        <ul class="pagination pagination-sm m-0 float-end">
                            
                            <!-- Page Numbers -->
                            <?php for ($i = 1; $i <= $pager->getPageCount(); $i++) : ?>
                                <li class="page-item <?= $i == $pager->getCurrentPage() ? 'active' : '' ?>">
                                    <a class="page-link" href="<?= $pager->getPageURI($i) ?>"><?= $i ?></a>
                                </li>
                            <?php endfor ?>


                        </ul>
                    </div>
                    <!-- Atau dengan custom style Bootstrap -->
                    <!-- <div class="card-footer clearfix">
                        <ul class="pagination pagination-sm m-0 float-end">
                            <li class="page-item"> <a class="page-link" href="#">&laquo;</a> </li>
                            <li class="page-item"> <a class="page-link" href="#">1</a> </li>
                            <li class="page-item"> <a class="page-link" href="#">2</a> </li>
                            <li class="page-item"> <a class="page-link" href="#">3</a> </li>
                            <li class="page-item"> <a class="page-link" href="#">&raquo;</a> </li>
                        </ul>
                    </div> -->
                </div> <!-- /.card -->
            </main> <!--end::App Content Header-->
        </div> <!--end::Row-->
    </div> <!--end::Container-->
</section>

<script>
    $(function(){
        $('#tabelMutasi').DataTable();
    });

    function resetFilter() {
        // Reset ke default bulan ini
        const today = new Date();
        const firstDay = new Date(today.getFullYear(), today.getMonth(), 1);
        const lastDay = new Date(today.getFullYear(), today.getMonth() + 1, 0);
        
        document.getElementById('start_date').value = formatDate(firstDay);
        document.getElementById('end_date').value = formatDate(lastDay);
        document.getElementById('status').value = '';
        document.getElementById('category').value = '';
        
        // Submit form
        document.querySelector('.filter-form').submit();
    }

    function formatDate(date) {
        const year = date.getFullYear();
        const month = String(date.getMonth() + 1).padStart(2, '0');
        const day = String(date.getDate()).padStart(2, '0');
        return `${year}-${month}-${day}`;
    }
</script>

<?php
function formatTanggalLahir($tgl) {
    if (strlen($tgl) == 8) {
        return substr($tgl, 6, 2) . '-' . substr($tgl, 4, 2) . '-' . substr($tgl, 0, 4);
    }
    return $tgl; // fallback kalau format tidak sesuai
}
?>

<style>
    table {
        font-size: 13px;
    }
</style>

<?= $this->endSection(); ?>