<?= $this->extend('layouts/page-layout') ?>

<?= $this->section('content')?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Data Hasil Akhir</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode</th>
                                        <th>Urutan</th>
                                        <th>Rekomendasi</th>
                                        <th>Tanggal</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach (get_seleksi_by_id_user(session()->get('id_user')) as $key => $value) { ?>
                                        <tr>
                                            <td><?=  ++$key ?></td>
                                            <td><?=$value->kode_seleksi ?></td>
                                            <td>
                                                <ol>
                                                    <?php if(get_rating_by_kode_seleksi_all($value->kode_seleksi)){ ?>
                                                        <?php foreach (get_rating_by_kode_seleksi_all($value->kode_seleksi) as $key2 => $value2) { ?>
                                                            <li><?= get_alternatif_by_kode_alternatif($value2->kode_alternatif)['nama_alternatif'] ?> - (<?= $value2->hasil ?>) - (Ranking ke <?= $value2->ranking ?>)</li>
                                                        <?php } ?>
                                                    <?php }else{?>
                                                        <span class="badge badge-danger">Urutan Belum Tersedia</span>
                                                    <?php } ?>
                                                </ol>
                                            </td>
                                            <td>
                                                <b>
                                                    <?php if(get_rekomendasi_by_kode_seleksi($value->kode_seleksi)){ ?>
                                                        <?= get_alternatif_by_kode_alternatif(get_rekomendasi_by_kode_seleksi($value->kode_seleksi)['kode_alternatif'])['nama_alternatif'] ?>
                                                    <?php }else{?>
                                                        <span class="badge badge-danger">Rekomendasi Belum Tersedia</span>
                                                    <?php } ?>
                                                </b>
                                            </td>
                                            <td>
                                                <?= $value->created_at ?>
                                            </td>
                                            <td>
                                                <a class="btn btn-iconsolid btn-sm" href="<?= route_to('hasil_panen_collector_detail', $value->kode_seleksi) ?>"><i class="icon-pencil">Detail Perhitungan</i></a>
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