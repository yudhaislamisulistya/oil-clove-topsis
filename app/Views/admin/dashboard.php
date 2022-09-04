<?= $this->extend('layouts/page-layout') ?>

<?= $this->section('content') ?>
<div class="container-fluid dashboard-default-sec">
  <div class="row">
    <div class="col-xl-12 box-col-12 des-xl-100">
      <div class="row">
        <div class="col-xl-12 col-md-6 box-col-6 des-xl-50">
          <div class="card profile-greeting">
            <div class="card-body text-center p-t-0">
              <h3 class="font-light">Selamat Datang, Akun Admin!!</h3>
              <p>Sistem Pendukung Keputusan Penentuan Harga Jual Minyak Cengkeh Dengan Metode Topsis 🥳</p>
            </div>
          </div>
        </div>
        <div class="row mt-3 mb-3">
          <div class="col-md-3">
            <div class="card h-100">
              <div class="card-body text-center">
                <div class="avatar mx-auto mb-2">
                  <span class="avatar-initial rounded-circle bg-label-success"><i class="bx bx-blanket fs-4"></i></span>
                </div>
                <span class="d-block text-nowrap">Data Kriteria</span>
                <h2 class="mb-0"><?= count(get_kriteria()) ?></h2>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card h-100">
              <div class="card-body text-center">
                <div class="avatar mx-auto mb-2">
                  <span class="avatar-initial rounded-circle bg-label-primary"><i class="bx bx-purchase-tag fs-4"></i></span>
                </div>
                <span class="d-block text-nowrap">Data sub Kriteria</span>
                <h2 class="mb-0"><?= count(get_sub_kriteria()) ?></h2>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card h-100">
              <div class="card-body text-center">
                <div class="avatar mx-auto mb-2">
                  <span class="avatar-initial rounded-circle bg-label-danger"><i class="bx bx-body fs-4"></i></span>
                </div>
                <span class="d-block text-nowrap">Data Alternatif</span>
                <h2 class="mb-0"><?= count(get_alternatif()) ?></h2>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card h-100">
              <div class="card-body text-center">
                <div class="avatar mx-auto mb-2">
                  <span class="avatar-initial rounded-circle bg-label-warning"><i class="bx bx-braille fs-4"></i></span>
                </div>
                <span class="d-block text-nowrap">Data Hasil Perhitungan</span>
                <h2 class="mb-0"><?= count(get_seleksi()) ?></h2>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-12 box-col-12 des-xl-100">
      <div class="card">
        <div class="card-body">
          <div class="table-responsive">
            <h5>Perhitungan Terbaru</h5>
            <table class="table table-bordernone">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Kode</th>
                  <th>Urutan</th>
                  <th>Rekomendasi</th>
                  <th>Tanggal</th>
                  <th>Aksi</th>
                  <th>
                    <div class="setting-list">
                      <ul class="list-unstyled setting-option">
                        <li>
                          <div class="setting-primary"><i class="icon-settings"> </i></div>
                        </li>
                        <li><i class="icofont icofont-maximize full-card font-primary"></i></li>
                        <li><i class="icofont icofont-minus minimize-card font-primary"></i></li>
                        <li><i class="icofont icofont-refresh reload-card font-primary"></i></li>
                        <li><i class="icofont icofont-error close-card font-primary"></i></li>
                      </ul>
                    </div>
                  </th>
                </tr>
              </thead>
              <tbody>
              <?php foreach (get_seleksi_by_limit_5() as $key => $value) { ?>
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
                                <a class="btn btn-iconsolid btn-sm" href="<?= route_to('perhitungan_topsis_admin_detail', $value->kode_seleksi) ?>"><i class="icon-pencil">Detail Perhitungan</i></a>
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
<!-- Container-fluid Ends-->
<?= $this->endSection() ?>