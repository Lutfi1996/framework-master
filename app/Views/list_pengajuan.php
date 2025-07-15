<?= $this->extend('layout/main.php') ?>

<?= $this->section('content') ?>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <h3 class="card-title">List Pengajuan </h3>
                    </div> <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>NIP</th>
                                    <th>Nama Legkap</th>
                                    <th>Organisasi</th>
                                    <th>Jabatan/Golongan Lama</th>
                                    <th>Jabatan/Golongan Baru</th>
                                    <th>Label</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($mutasi as $row): ?>
                                <tr class="align-middle">
                                    <td> <?= esc($row['nip']) ?> </td>
                                    <td> <?= esc($row['namalengkap']) ?> </td>
                                    <td> <?= esc($row['unker1']) ?> </td>
                                    <td> <?= esc($row['jabatan_lama']) ?> </td>
                                    <td> <?= esc($row['jabatan_baru']) ?> </td>
                                    <td><span class="badge text-bg-danger">55%</span></td>
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
            </div> <!-- /.col -->
        </div> <!--end::Row-->
    </div> <!--end::Container-->
</section>

<script>
    $(function(){
        $('#tabelMutasi').DataTable();
    });
</script>

<?= $this->endSection(); ?>