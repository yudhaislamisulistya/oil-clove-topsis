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
                                        <?php if(strpos(get_alternatif_by_kode_alternatif($value->kode_alternatif)['nama_alternatif'], "Minyak Daun") === 0){ ?>
                                            <tr>
                                                <td><?= ++$key ?></td>
                                                <td><?= get_user_by_id_user($value->id_user)['nama_lengkap'] ?> - <?= $value->kode_seleksi ?> (<?= get_user_by_id_user($value->id_user)['role'] == 2 ? "Me" : "Collector" ?>)</td>
                                                <td>
                                                    <ol>
                                                        <?php if(get_rating_by_kode_seleksi_all($value->kode_seleksi)){ ?>
                                                            <?php foreach (get_rating_by_kode_seleksi_all($value->kode_seleksi) as $key2 => $value2) { ?>
                                                                <li><?= get_alternatif_by_kode_alternatif($value2->kode_alternatif)['nama_alternatif'] ?> - (<?= $value2->hasil ?>) - (Ranking ke <?= $value2->ranking ?>)</li>
                                                            <?php } ?>
                                                        <?php }else{?>
                                                            <span class="badge badge-danger text-danger">Urutan Belum Tersedia</span>
                                                        <?php } ?>
                                                    </ol>
                                                </td>
                                                <td>
                                                    <b>
                                                        <?php if(get_rekomendasi_by_kode_seleksi($value->kode_seleksi)){ ?>
                                                            <?= get_alternatif_by_kode_alternatif(get_rekomendasi_by_kode_seleksi($value->kode_seleksi)['kode_alternatif'])['nama_alternatif'] ?>
                                                        <?php }else{?>
                                                            <span class="badge badge-danger text-danger">Rekomendasi Belum Tersedia</span>
                                                        <?php } ?>
                                                    </b>
                                                </td>
                                                <td>
                                                    <?= $value->created_at ?>
                                                </td>
                                                <td>
                                                    <a class="btn btn-primary btn-sm" href="<?= route_to('hasil_panen_collector_detail', $value->kode_seleksi, 'Minyak Daun') ?>"><i class="bx bx-pencil fs-4"></i>Detail Perhitungan</i></a>
                                                </td>
                                            </tr>
                                        <?php }?>

                                        <?php if(strpos(get_alternatif_by_kode_alternatif($value->kode_alternatif)['nama_alternatif'], "Minyak Gagang") === 0){ ?>
                                            <tr>
                                                <td><?= ++$key ?></td>
                                                <td><?= get_user_by_id_user($value->id_user)['nama_lengkap'] ?> - <?= $value->kode_seleksi ?> (<?= get_user_by_id_user($value->id_user)['role'] == 2 ? "Me" : "Collector" ?>)</td>
                                                <td>
                                                    <ol>
                                                        <?php if(get_rating_by_kode_seleksi_all($value->kode_seleksi)){ ?>
                                                            <?php foreach (get_rating_by_kode_seleksi_all($value->kode_seleksi) as $key2 => $value2) { ?>
                                                                <li><?= get_alternatif_by_kode_alternatif($value2->kode_alternatif)['nama_alternatif'] ?> - (<?= $value2->hasil ?>) - (Ranking ke <?= $value2->ranking ?>)</li>
                                                            <?php } ?>
                                                        <?php }else{?>
                                                            <span class="badge badge-danger text-danger">Urutan Belum Tersedia</span>
                                                        <?php } ?>
                                                    </ol>
                                                </td>
                                                <td>
                                                    <b>
                                                        <?php if(get_rekomendasi_by_kode_seleksi($value->kode_seleksi)){ ?>
                                                            <?= get_alternatif_by_kode_alternatif(get_rekomendasi_by_kode_seleksi($value->kode_seleksi)['kode_alternatif'])['nama_alternatif'] ?>
                                                        <?php }else{?>
                                                            <span class="badge badge-danger text-danger">Rekomendasi Belum Tersedia</span>
                                                        <?php } ?>
                                                    </b>
                                                </td>
                                                <td>
                                                    <?= $value->created_at ?>
                                                </td>
                                                <td>
                                                    <a class="btn btn-primary btn-sm" href="<?= route_to('hasil_panen_collector_detail', $value->kode_seleksi, 'Minyak Gagang') ?>"><i class="bx bx-pencil fs-4"></i>Detail Perhitungan</i></a>
                                                </td>
                                            </tr>
                                        <?php }?>
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