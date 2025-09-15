<?= $this->extend('layout/main.php') ?>

<?= $this->section('content') ?>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4" style="margin-top: 20px;">
                    <div class="card-header">
                        <h3 class="card-title"><?= $title ?></h3>

                        <?php if (session()->getFlashdata('message')) : ?>
                            <div class="alert alert-success">
                                <?= session()->getFlashdata('message') ?>
                            </div>
                        <?php endif; ?>
                        
                        <?php if (session()->getFlashdata('error')) : ?>
                            <div class="alert alert-danger">
                                <?= session()->getFlashdata('error') ?>
                            </div>
                        <?php endif; ?>
                    </div> <!-- /.card-header -->
                    <div class="card-body">
                        <form method="GET" action="<?= site_url('approval-mutasi') ?>" class="filter-form">
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
                                    <th>NIP</th>
                                    <th>Nama Pegawai</th>
                                    <th>Organisasi</th>
                                    <th>Tanggal Pengajuan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php foreach($mutasi as $row): ?>
                                <tr class="align-middle">
                                    <td><?= $no++ ?></td>
                                    <td> <?= esc($row['nip']) ?> </td>
                                    <td> <?= esc($row['namalengkap']) ?> </td>
                                    <td> <?= esc($row['unker1']) ?> </td>
                                    <td><?= date('d/m/Y H:i', strtotime($row['input_date'])) ?></td>
                                    <td>
                                        <a href="<?= base_url('approval-mutasi/view/' . $row['id']) ?>" class="btn btn-primary btn-sm">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div> <!-- /.card-body -->

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
            </div> <!-- /.col -->
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

<?= $this->endSection(); ?>