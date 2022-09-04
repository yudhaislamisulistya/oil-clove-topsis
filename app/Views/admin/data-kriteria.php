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
                        <h4 class="card-title">Data Kriteria</h4>
                        <a class="btn btn-primary btn-sm" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#addModal">Tambah Kriteria</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode</th>
                                        <th>Nama Kriteria</th>
                                        <th>Bobot</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($data as $key => $value) { ?>
                                        <tr>
                                            <td><?= ++$key ?></td>
                                            <td><?= $value->kode_kriteria ?></td>
                                            <td><?= $value->nama_kriteria ?></td>
                                            <td><?= $value->bobot ?></td>
                                            <td>
                                                <a href="#" class="btn btn-info btn-sm btn-edit"
                                                        data-id="<?= $value->id_kriteria;?>"
                                                        data-kode-kriteria="<?= $value->kode_kriteria?>"
                                                        data-bobot="<?= $value->bobot?>"
                                                        data-nama-kriteria="<?= $value->nama_kriteria?>">Edit</a>
                                                <a href=" #" class="btn btn-danger btn-sm btn-delete"
                                                        data-id="<?= $value->id_kriteria?>">Delete</a>
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

        <!-- Modal Add Data Kriteria-->
        <form action="<?= route_to('kriteria_admin_save') ?>" method="post">
        <?= csrf_field()?>
        <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Kriteria</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Kode Kriteria</label>
                            <input type="text" class="form-control" name="kode_kriteria"
                                placeholder="Kode Kriteria">
                        </div>
                        <div class="form-group">
                            <label>Nama Kriteria</label>
                            <input type="text" class="form-control" name="nama_kriteria"
                                placeholder="Nama Kriteria">
                        </div>
                        <div class="form-group">
                            <label>Bobot</label>
                            <input type="text" class="form-control" name="bobot"
                                placeholder="Bobot">
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
    <!-- End Modal Add Data Kriteria-->

    <!-- Modal Edit Data Kriteria-->
        <form action="<?= route_to('kriteria_admin_update') ?>" method="post">
        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ubah Kriteria</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Kode Kriteria</label>
                            <input type="text" class="form-control kode_kriteria" name="kode_kriteria"
                                placeholder="Nama Barang">
                        </div>
                        <div class="form-group">
                            <label>Nama Kriteria</label>
                            <input type="text" class="form-control nama_kriteria" name="nama_kriteria"
                                placeholder="Nama Kriteria">
                        </div>
                        <div class="form-group">
                            <label>Bobot</label>
                            <input type="text" class="form-control bobot" name="bobot"
                                placeholder="Bobot">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="id_kriteria" class="id_kriteria">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- End Modal Edit Data Kriteria-->

    <!-- Modal Delete Category-->
        <form action="<?= route_to('kriteria_admin_delete') ?>" method="post">
        <?= csrf_field() ?>
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Hapus Kriteria Ini ?</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <h4>Apakah Kamu Ingin Kriteria Ini?</h4>

                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="id_kriteria" class="id_kriteria">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                        <button type="submit" class="btn btn-primary">Yes</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- End Modal Delete Category-->
<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
<script>
    $(document).ready(function () {
        $('.btn-edit').on('click',function(){
            const id = $(this).data('id');
            const kode_kriteria = $(this).data('kode-kriteria');
            const nama_kriteria = $(this).data('nama-kriteria');
            const bobot = $(this).data('bobot');
            $('.id_kriteria').val(id);
            $('.kode_kriteria').val(kode_kriteria);
            $('.nama_kriteria').val(nama_kriteria);
            $('.bobot').val(bobot);
            $('#editModal').modal('show');
        });

        $('.btn-delete').click(function (e) {
            e.preventDefault();
            const id = $(this).data('id');
            $('.id_kriteria').val(id);
            $('#deleteModal').modal('show');
        });
    });
</script>
<?= $this->endSection() ?>