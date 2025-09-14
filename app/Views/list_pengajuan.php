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
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIP</th>
                                    <th>Nama Legkap</th>
                                    <th>Dinas</th>
                                    <th>Tanggal Pengajuan</th>
                                    <!-- <th>Jabatan/Golongan Lama</th>
                                    <th>Jabatan/Golongan Baru</th> -->
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php foreach($mutasi as $row): ?>
                                <tr class="align-middle">
                                    <td> <?= $no++ ?> </td>
                                    <td> <?= esc($row['nip']) ?> </td>
                                    <td> <?= esc($row['namalengkap']) ?> </td>
                                    <td> <?= esc($row['unker1']) ?> </td>
                                    <td> <?= date('d/m/Y H:i', strtotime($row['input_date'])) ?></td>
                                    <td> <?= $row['status_label'] ?> </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div> <!-- /.card-body -->
                    <div class="card-footer clearfix">
                        <ul class="pagination pagination-sm m-0 float-end">
                            <li class="page-item"> <a class="page-link" href="#">&laquo;</a> </li>
                            <li class="page-item"> <a class="page-link" href="#">1</a> </li>
                            <li class="page-item"> <a class="page-link" href="#">2</a> </li>
                            <li class="page-item"> <a class="page-link" href="#">3</a> </li>
                            <li class="page-item"> <a class="page-link" href="#">&raquo;</a> </li>
                        </ul>
                    </div>
                </div> <!-- /.card -->
            </main> <!--end::App Content Header-->
        </div> <!--end::Row-->
    </div> <!--end::Container-->
</section>

<script>
    $(function(){
        $('#tabelMutasi').DataTable();
    });
</script>

<?= $this->endSection(); ?>