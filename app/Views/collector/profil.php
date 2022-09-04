<?= $this->extend('layouts/page-layout') ?>

<?= $this->section('content')?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Profil</h4>
                </div>
                <div class="card-body">
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
                    <?php if(session()->getFlashData('status') == "success_password"){ ?>
                        <div class="alert alert-success alert-dismissable alert-style-1">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-hidden="true">&times;</button>
                            <i class="zmdi zmdi-check"></i>Proses Ubah Password Berhasil
                        </div>
                        <?php }else if(session()->getFlashData('status') == "failed_password"){ ?>
                        <div class="alert alert-danger alert-dismissable alert-style-1">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-hidden="true">&times;</button>
                            <i class="zmdi zmdi-info-outline"></i>Proses Ubah Password  Gagal
                        </div>
                    <?php }?>
                    <form action="<?= route_to('profil_collector_edit') ?>" class="mb-5" method="POST">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control" readonly value="<?= session()->get('email') ?>">
                        </div>
                        <div class="form-group">
                            <label for="nama_lengkap">Nama Lengkap</label>
                            <input type="text" name="nama_lengkap" id="nama_lengkap" class="form-control" value="<?= get_user_by_id_user(session()->get('id_user'))['nama_lengkap'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="nohp">Nomor Handphone</label>
                            <input type="text" name="nohp" id="nohp" class="form-control" value="<?= get_user_by_id_user(session()->get('id_user'))['nohp'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <input type="text" name="alamat" id="alamat" class="form-control" value="<?= get_user_by_id_user(session()->get('id_user'))['alamat'] ?>">
                        </div>
                        <button class="btn btn-primary">Ubah Profil</button>
                    </form>
                    <form action="<?= route_to('profil_collector_edit_password') ?>" class="mb-5" method="POST">
                        <div class="form-group">
                            <label for="password">Password Baru</label>
                            <input type="password" name="password" id="password" class="form-control">
                        </div>
                        <button class="btn btn-primary">Ubah Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>