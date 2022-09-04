<?= $this->extend('layouts/page-layout') ?>

<?= $this->section('content')?>

    <div class="container-fluid">
        <div class="row">
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
            <?php foreach ($data as $key_1 => $value_1) { ?>
                <div class="col-md-12 mx-auto">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title"><?= $value_1->nama_kriteria ?> (<?= $value_1->kode_kriteria ?>)</h4>
                            <a class="btn btn-primary btn-sm btn-add" href="javascript:void(0);" data-kode-kriteria="<?= $value_1->kode_kriteria ?>" data-nama-kriteria="<?= get_kriteria_by_kode_kriteria($value_1->kode_kriteria)['nama_kriteria'] ?>">Tambah Sub Sub Kriteria</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode</th>
                                            <th>Nama Sub Sub Kriteria</th>
                                            <th>Bobot</th>
                                            <th>Keterangan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach (get_sub_kriteria_by_kode_kriteria($value_1->kode_kriteria) as $key_2 => $value_2) { ?>
                                            <tr>
                                                <td><?= ++$key_2 ?></td>
                                                <td><?= $value_2->kode_sub_kriteria ?></td>
                                                <td><?= $value_2->nama_sub_kriteria ?></td>
                                                <td><?= $value_2->bobot ?></td>
                                                <td><?= $value_2->keterangan ?></td>
                                                <td>
                                                    <button class="btn btn-iconsolid btn-sm btn-edit"
                                                        data-id="<?= $value_2->id_sub_kriteria ?>"
                                                        data-nama-kriteria="<?= $value_1->nama_kriteria ?>"
                                                        data-kode-kriteria="<?= $value_1->kode_kriteria?>"
                                                        data-nama-sub-kriteria="<?= $value_2->nama_sub_kriteria ?>"
                                                        data-kode-sub-kriteria="<?= $value_2->kode_sub_kriteria ?>"
                                                        data-bobot="<?= $value_2->bobot ?>"
                                                        data-keterangan="<?= $value_2->keterangan ?>"
                                                        >
                                                        <i class="icon-pencil"></i>
                                                    </button>
                                                    <button class="btn btn-iconsolid btn-danger btn-sm btn-delete" data-id="<?= $value_2->id_sub_kriteria ?>">
                                                        <i class="icon-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        <?php }?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

    <!-- Modal Add Data Sub Kriteria-->
    <form action="<?= route_to('sub_kriteria_admin_save') ?>" method="post">
        <?= csrf_field()?>
        <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Sub Kriteria</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Kode Sub Kriteria</label>
                            <input type="text" class="form-control" name="kode_sub_kriteria"
                                placeholder="Kode Sub Kriteria">
                        </div>
                        <div class="form-group">
                            <label>Nama Sub Kriteria</label>
                            <input type="text" class="form-control" name="nama_sub_kriteria"
                                placeholder="Nama Sub Kriteria">
                        </div>
                        <div class="form-group">
                            <label>Bobot</label>
                            <input type="text" class="form-control" name="bobot"
                                placeholder="Bobot">
                        </div>
                        <div class="form-group">
                            <label>Nama Kriteria</label>
                            <input readonly type="text" class="form-control nama_kriteria" name="nama_kriteria"
                                placeholder="Kode Kriteria">
                        </div>
                        <div class="form-group">
                            <label>Keterangan</label>
                            <input type="text" class="form-control keterangan" name="keterangan"
                                placeholder="Keterangan">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="kode_kriteria" class="kode_kriteria">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- End Modal Add Data Sub Kriteria-->

    <!-- Modal Edit Data Sub Kriteria-->
        <form action="<?= route_to('sub_kriteria_admin_update') ?>" method="post">
        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ubah Sub Kriteria</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Kode Sub Kriteria</label>
                            <input type="text" class="form-control kode_sub_kriteria" name="kode_sub_kriteria"
                                placeholder="Nama Barang">
                        </div>
                        <div class="form-group">
                            <label>Nama Sub Kriteria</label>
                            <input type="text" class="form-control nama_sub_kriteria" name="nama_sub_kriteria"
                                placeholder="Nama Sub Kriteria">
                        </div>
                        <div class="form-group">
                            <label>Bobot</label>
                            <input type="text" class="form-control bobot" name="bobot"
                                placeholder="Bobot">
                        </div>
                        <div class="form-group">
                            <label>Nama Kriteria</label>
                            <input readonly type="text" class="form-control nama_kriteria" name="nama_kriteria"
                                placeholder="Kode Kriteria">
                        </div>
                        <div class="form-group">
                            <label>Keterangan</label>
                            <input type="text" class="form-control keterangan" name="keterangan"
                                placeholder="Keterangan">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="kode_kriteria" class="kode_kriteria">
                        <input type="hidden" name="id_sub_kriteria" class="id_sub_kriteria">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- End Modal Edit Data Sub Kriteria-->

    <!-- Modal Delete Category-->
        <form action="<?= route_to('sub_kriteria_admin_delete') ?>" method="post">
        <?= csrf_field() ?>
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Hapus Sub Kriteria Ini ?</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <h4>Apakah Kamu Ingin Sub Kriteria Ini?</h4>

                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="id_sub_kriteria" class="id_sub_kriteria">
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
        $('.btn-add').click(function (e) { 
            e.preventDefault();
            const kode_kriteria = $(this).data('kode-kriteria');
            const nama_kriteria = $(this).data('nama-kriteria');
            $('.kode_kriteria').val(kode_kriteria);
            $('.nama_kriteria').val(nama_kriteria);
            $('#addModal').modal('show');
        });
        $('.btn-edit').on('click',function(){
            const id = $(this).data('id');
            const kode_sub_kriteria = $(this).data('kode-sub-kriteria');
            const nama_sub_kriteria = $(this).data('nama-sub-kriteria');
            const kode_kriteria = $(this).data('kode-kriteria');
            const nama_kriteria = $(this).data('nama-kriteria');
            const bobot = $(this).data('bobot');
            const keterangan = $(this).data('keterangan');
            $('.id_sub_kriteria').val(id);
            $('.kode_sub_kriteria').val(kode_sub_kriteria);
            $('.nama_sub_kriteria').val(nama_sub_kriteria);
            $('.bobot').val(bobot);
            $('.keterangan').val(keterangan);
            $('.kode_kriteria').val(kode_kriteria);
            $('.nama_kriteria').val(nama_kriteria);
            $('#editModal').modal('show');
        });

        $('.btn-delete').click(function (e) {
            e.preventDefault();
            const id = $(this).data('id');
            $('.id_sub_kriteria').val(id);
            $('#deleteModal').modal('show');
        });
    });
</script>
<?= $this->endSection() ?>