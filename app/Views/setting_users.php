<?= $this->extend('layout/main.php') ?>

<?= $this->section('content') ?>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4" style="margin-top: 20px;">
                    <div class="card-header">
                        <h3 class="card-title">List User </h3>
                    </div> <!-- /.card-header -->
                    <div class="d-flex justify-content-end">
                      <a href="<?= base_url('create_user') ?>">
                        <button type="button" class="btn btn-primary mt-3 me-3">Tambah User</button> 
                      </a>
                    </div>
                    <?php if(session()->getFlashdata('success')): ?>
                        <div class="alert alert-success">
                            <?= session()->getFlashdata('success') ?>
                        </div>
                    <?php endif; ?>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIP</th>
                                    <th>Nama</th>
                                    <th>E-Mail</th>
                                    <th>Unit Kerja Utama</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($user_list as $row): ?>
                                <tr class="align-middle">
                                    <td> <?= esc($row['id']) ?> </td>
                                    <td> <?= esc($row['nip']) ?> </td>
                                    <td> <?= esc($row['nama']) ?> </td>
                                    <td> <?= esc($row['email']) ?> </td>
                                    <td> <?= esc($row['namaunkerutamabesar']) ?> </td>
                                    <td>
                                        <a href="<?= site_url('user/view/' . $row['id']) ?>" class="btn btn-sm btn-info" title="Lihat">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="<?= site_url('user/edit/' . $row['id']) ?>" class="btn btn-sm btn-warning" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </td>
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
<?= $this->endSection() ?>