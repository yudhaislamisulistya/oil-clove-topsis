<?= $this->extend('layouts/page-layout') ?>

<?= $this->section('content')?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Tahap Pertama : Menentukan Nilai di Setiap Alternatif</h4>
                </div>
                <div class="card-body">
                    <?php if(session()->getFlashData('status') == "success"){ ?>
                        <div class="alert alert-success alert-dismissable alert-style-1">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-hidden="true">&times;</button>
                            <i class="zmdi zmdi-check"></i>Proses Berhasil, Silahkan Cek Hasilnya Disini <a href="<?= route_to('hasil_panen_collector_detail', session()->getFlashdata('kode_seleksi')) ?>" class="btn btn-info btn-sm">CEK</a>
                        </div>
                        <?php }else if(session()->getFlashData('status') == "failed"){ ?>
                        <div class="alert alert-danger alert-dismissable alert-style-1">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-hidden="true">&times;</button>
                            <i class="zmdi zmdi-info-outline"></i>Proses Gagal
                        </div>
                    <?php }?>
                    <form action="<?= route_to('hasil_panen_collector_save') ?>" method="post">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Kode</th>
                                        <th>Alternatif</th>
                                        <?php foreach (get_kriteria() as $key => $value) { ?>
                                        <th><?= $value->nama_kriteria ?></th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach (get_alternatif() as $key => $value) { ?>
                                    <tr>
                                        <td><?= $value->kode_alternatif ?></td>
                                        <td><?= $value->nama_alternatif ?></td>
                                        <?php foreach (get_kriteria() as $key2 => $value2) { ?>
                                        <td>
                                            <select name="sub_kriteria[<?= $key ?>][<?= $key2 ?>]" class="form-control">
                                                <?php foreach (get_sub_kriteria_by_kode_kriteria($value2->kode_kriteria) as $key3 => $value3) { ?>
                                                <option
                                                    value="<?= $value3->bobot ?>-<?= $value3->kode_kriteria ?>-<?= $value3->kode_sub_kriteria ?>">
                                                    <?= $value3->nama_sub_kriteria ?> (<?= $value3->keterangan ?>)</option>
                                                <?php } ?>
                                            </select>
                                        </td>
                                        <?php } ?>
                                        <input type="hidden" name="kode_alternatif[<?= $key ?>]"
                                            value="<?= $value->kode_alternatif ?>">
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <input type="hidden" name="id_user" value="<?= session()->get('id_user') ?>">
                        <button class="btn btn-primary btn-save mt-3">Save</button>
                        <div class="alert alert-warning mt-4" role="alert">
                            <strong>Perhatian! Data Yang Sudah di Submit Akan Tercatat</strong>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-12 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Data Perhitungan Topsis</h4>
                    </div>
                    <div class="card-body">
                        <?php if(session()->getFlashData('status') == "success_delete"){ ?>
                            <div class="alert alert-success alert-dismissable alert-style-1">
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-hidden="true">&times;</button>
                                <i class="zmdi zmdi-check"></i>Proses Berhasil
                            </div>
                            <?php }else if(session()->getFlashData('status') == "failed_delete"){ ?>
                            <div class="alert alert-danger alert-dismissable alert-style-1">
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-hidden="true">&times;</button>
                                <i class="zmdi zmdi-info-outline"></i>Proses Gagal
                            </div>
                        <?php }?>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Seleksi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach (get_seleksi_by_id_user_dan_group_by_kode_seleksi(session()->get('id_user')) as $key => $value) { ?>
                                        <tr>
                                            <td><?= ++$key ?></td>
                                            <td><?= $value->kode_seleksi ?></td>
                                            <td>
                                            <a href="<?= route_to('hasil_panen_collector_detail', $value->kode_seleksi) ?>" class="btn btn-primary btn-sm">Detail Perhitungan</a>
                                            <a href="<?= route_to('hasil_panen_collector_delete', $value->kode_seleksi) ?>" class="btn btn-danger btn-sm">Hapus</a>
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
<?= $this->endSection() ?>