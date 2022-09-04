<?= $this->extend('layouts/page-layout') ?>

<?= $this->section('content')?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 mx-auto">
            <?php if(isset($validation)) : ?>
            <div class=col-12>
                <div class="alert alert-danger alert-dismissable alert-style-1">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-hidden="true">&times;</button>
                    <i class="zmdi zmdi-block"></i><?= $validation->listErrors() ?>
                </div>
            </div>
            <?php endif; ?>
            <?php if(session()->getFlashData('status') == "success"){ ?>
            <div class="alert alert-success alert-dismissable alert-style-1">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-hidden="true">&times;</button>
                <i class="zmdi zmdi-check"></i>Proses Berhasil
            </div>
            <?php }else if(session()->getFlashData('status') == "failed"){ ?>
            <div class="alert alert-danger alert-dismissable alert-style-1">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-hidden="true">&times;</button>
                <i class="zmdi zmdi-info-outline"></i>Proses Gagal
            </div>
            <?php }?>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Data Pengepul</h4>
                    <a class="btn btn-primary btn-sm" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#addModal">Tambah Pengepul</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Password</th>
                                    <th>Nomor Handphone</th>
                                    <th>Alamat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data as $key => $value) { ?>
                                <tr>
                                    <td><?= ++$key; ?></td>
                                    <td><?= $value->nama_lengkap; ?></td>
                                    <td><?= $value->email; ?></td>
                                    <td>*****</td>
                                    <td><?= $value->nohp ?></td>
                                    <td><?= $value->alamat ?></td>
                                    <td>
                                        <a class="btn btn-iconsolid btn-sm btn-edit"
                                        data-nama-lengkap="<?= $value->nama_lengkap ?>"
                                        data-email="<?= $value->email ?>"
                                        data-password="<?= $value->password ?>"
                                        data-nohp="<?= $value->nohp ?>"
                                        data-alamat="<?= $value->alamat ?>">
                                            <i class="icon-pencil"></i>
                                        </a>
                                        <a class="btn btn-iconsolid btn-danger btn-sm btn-delete" data-id="<?= $value->id_user ?>">
                                            <i class="bx bx-trash text-white"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Add Data Pengepul-->
<form action="<?= route_to('pengepul_admin_save') ?>" method="post">
    <?= csrf_field()?>
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Pengepul</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input type="text" class="form-control" name="nama_lengkap" placeholder="Nama Lengkap">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label>Nomor Handphone</label>
                        <input type="text" class="form-control" name="nohp" placeholder="Nomor Handphone">
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <input type="text" class="form-control" name="alamat" placeholder="Alamat">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- End Modal Add Data Pengepul-->

<!-- Modal Edit Data Pengepul-->
<form action="<?= route_to('pengepul_admin_update') ?>" method="post">
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ubah Pengepul</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input type="text" class="form-control nama_lengap" name="nama_lengkap" placeholder="Nama Lengkap">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control email" name="email" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control password" name="password" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label>Nomor Handphone</label>
                        <input type="text" class="form-control nohp" name="nohp" placeholder="Nomor Handphone">
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <input type="text" class="form-control alamat" name="alamat" placeholder="Alamat">
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id_user" class="id_user">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- End Modal Edit Data Pengepul-->

<!-- Modal Delete Pengepul-->
<form action="<?= route_to('pengepul_admin_delete') ?>" method="post">
    <?= csrf_field() ?>
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus Pengepul Ini ?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <h4>Apakah Kamu Ingin Pengepul Ini?</h4>

                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id_user" class="id_user">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-primary">Yes</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- End Modal Delete Pengepul-->
<?= $this->endSection() ?>


<?= $this->section('javascript') ?>
<script>
    $(document).ready(function () {
        $('.btn-edit').on('click',function(){
            const id = $(this).data('id');
            const nama_lengkap = $(this).data('kode-alternatif');
            const email = $(this).data('email');
            const password = $(this).data('password');
            const nohp = $(this).data('nohp');
            const alamat = $(this).data('alamat');
            $('.id_user').val(id);
            $('.nama_lengkap').val(nama_lengkap);
            $('.email').val(email);
            $('.password').val(password);
            $('.nphp').val(nohp);
            $('.alamat').val(alamat);
            $('#editModal').modal('show');
        });

        $('.btn-delete').click(function (e) {
            e.preventDefault();
            const id = $(this).data('id');
            $('.id_user').val(id);
            $('#deleteModal').modal('show');
        });
    });
</script>
<?= $this->endSection() ?>