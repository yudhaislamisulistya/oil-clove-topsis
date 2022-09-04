<?= $this->extend('layouts/page-layout') ?>

<?= $this->section('content')?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Tahap Kedua : Menentukan Nilai Dari Seriap Alternatif</h4>
                </div>
                <div class="card-body">
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
                                <?php 
                                    $a_nilai_setiap_alternatif = array()
                                ?>
                                <?php foreach (get_alternatif() as $key => $value) { ?>
                                    <tr>
                                        <td><?= $value->kode_alternatif ?></td>
                                        <td><?= $value->nama_alternatif ?></td>
                                        <?php foreach (get_kriteria() as $key2 => $value2) { ?>
                                            <td>
                                                <?php foreach (get_sub_kriteria_by_kode_kriteria($value2->kode_kriteria) as $key3 => $value3) { ?>
                                                    <?php
                                                        if(get_bobot_by_kode_seleksi_dan_kode_gabungan($kode_seleksi, $value->kode_alternatif . '-' . $value2->kode_kriteria . '-' . $value3->kode_sub_kriteria)){
                                                            $bobot = get_bobot_by_kode_seleksi_dan_kode_gabungan($kode_seleksi, $value->kode_alternatif . '-' . $value2->kode_kriteria . '-' . $value3->kode_sub_kriteria)['bobot'];
                                                            $kode_kriteria = get_bobot_by_kode_seleksi_dan_kode_gabungan($kode_seleksi, $value->kode_alternatif . '-' . $value2->kode_kriteria . '-' . $value3->kode_sub_kriteria)['kode_kriteria'];
                                                            $kode_sub_kriteria = get_bobot_by_kode_seleksi_dan_kode_gabungan($kode_seleksi, $value->kode_alternatif . '-' . $value2->kode_kriteria . '-' . $value3->kode_sub_kriteria)['kode_sub_kriteria'];
                                                            $kode_gabungan = $kode_kriteria . '-' . $kode_sub_kriteria;
                                                            $nama_sub_kriteria = get_sub_kriteria_by_kode_gabungan($kode_gabungan)['nama_sub_kriteria'];
                                                            array_push($a_nilai_setiap_alternatif, $bobot);
                                                            echo $bobot . ' / ' . $nama_sub_kriteria;
                                                        }
                                                    ?>
                                                <?php } ?>
                                            </td>
                                        <?php } ?>
                                    </tr>
                                <?php } ?>
                                <?php
                                    $a_nilai_setiap_sub_kriteria = array();
                                    for ($i=0; $i < count(get_kriteria()); $i++) { 
                                        for ($j=$i; $j < count(get_alternatif())*count(get_kriteria()); $j+=count(get_kriteria())) {
                                            $a_nilai_setiap_sub_kriteria[$i][$j] = $a_nilai_setiap_alternatif[$j];
                                        }
                                    }
                                ?>
                                <tr>
                                    <td colspan="2">Pembagi</td>
                                    <?php foreach (get_kriteria() as $key => $value) { ?>
                                        <td>
                                            <?php
                                                $pembagi = 0;
                                                foreach ($a_nilai_setiap_sub_kriteria[$key] as $key2 => $value2) {
                                                    $pembagi += pow($value2, 2);
                                                }
                                                echo '<b>'.sqrt($pembagi).'</b>';
                                            ?>
                                        </td>
                                    <?php  } ?>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Tahap Ketiga : Membuat Matriks Bobot Keputusan Yang Ternirmalisasi</h4>
                </div>
                <div class="card-body">
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
                                <?php 
                                    $a_nilai_setiap_alternatif = array()
                                ?>
                                <?php foreach (get_alternatif() as $key => $value) { ?>
                                    <?php foreach (get_kriteria() as $key2 => $value2) { ?>
                                        <?php foreach (get_sub_kriteria_by_kode_kriteria($value2->kode_kriteria) as $key3 => $value3) { ?>
                                            <?php
                                                if(get_bobot_by_kode_seleksi_dan_kode_gabungan($kode_seleksi, $value->kode_alternatif . '-' . $value2->kode_kriteria . '-' . $value3->kode_sub_kriteria)){
                                                    $bobot = get_bobot_by_kode_seleksi_dan_kode_gabungan($kode_seleksi, $value->kode_alternatif . '-' . $value2->kode_kriteria . '-' . $value3->kode_sub_kriteria)['bobot'];
                                                    $kode_kriteria = get_bobot_by_kode_seleksi_dan_kode_gabungan($kode_seleksi, $value->kode_alternatif . '-' . $value2->kode_kriteria . '-' . $value3->kode_sub_kriteria)['kode_kriteria'];
                                                    $kode_sub_kriteria = get_bobot_by_kode_seleksi_dan_kode_gabungan($kode_seleksi, $value->kode_alternatif . '-' . $value2->kode_kriteria . '-' . $value3->kode_sub_kriteria)['kode_sub_kriteria'];
                                                    $kode_gabungan = $kode_kriteria . '-' . $kode_sub_kriteria;
                                                    $nama_sub_kriteria = get_sub_kriteria_by_kode_gabungan($kode_gabungan)['nama_sub_kriteria'];
                                                    array_push($a_nilai_setiap_alternatif, $bobot);
                                                }
                                            ?>
                                        <?php } ?>
                                    <?php } ?>
                                <?php } ?>
                                <?php
                                    $a_nilai_setiap_sub_kriteria = array();
                                    for ($i=0; $i < count(get_kriteria()); $i++) { 
                                        for ($j=$i; $j < count(get_alternatif())*count(get_kriteria()); $j+=count(get_kriteria())) {
                                            $a_nilai_setiap_sub_kriteria[$i][$j] = $a_nilai_setiap_alternatif[$j];
                                        }
                                    }
                                ?>
                                <?php
                                    $a_nilai_pembagi = array();
                                ?>
                                <?php foreach (get_kriteria() as $key => $value) { ?>
                                    <?php
                                        $pembagi = 0;
                                        foreach ($a_nilai_setiap_sub_kriteria[$key] as $key2 => $value2) {
                                            $pembagi += pow($value2, 2);
                                        }
                                        array_push($a_nilai_pembagi, sqrt($pembagi));
                                    ?>
                                <?php  }  ?>
                                <?php foreach (get_alternatif() as $key => $value) { ?>
                                    <tr>
                                        <td><?= $value->kode_alternatif ?></td>
                                        <td><?= $value->nama_alternatif ?></td>
                                        <?php foreach (get_kriteria() as $key2 => $value2) { ?>
                                            <td>
                                                <?php foreach (get_sub_kriteria_by_kode_kriteria($value2->kode_kriteria) as $key3 => $value3) { ?>
                                                    <?php
                                                        if(get_bobot_by_kode_seleksi_dan_kode_gabungan($kode_seleksi, $value->kode_alternatif . '-' . $value2->kode_kriteria . '-' . $value3->kode_sub_kriteria)){
                                                            $bobot = get_bobot_by_kode_seleksi_dan_kode_gabungan($kode_seleksi, $value->kode_alternatif . '-' . $value2->kode_kriteria . '-' . $value3->kode_sub_kriteria)['bobot'];
                                                            $kode_kriteria = get_bobot_by_kode_seleksi_dan_kode_gabungan($kode_seleksi, $value->kode_alternatif . '-' . $value2->kode_kriteria . '-' . $value3->kode_sub_kriteria)['kode_kriteria'];
                                                            $kode_sub_kriteria = get_bobot_by_kode_seleksi_dan_kode_gabungan($kode_seleksi, $value->kode_alternatif . '-' . $value2->kode_kriteria . '-' . $value3->kode_sub_kriteria)['kode_sub_kriteria'];
                                                            $kode_gabungan = $kode_kriteria . '-' . $kode_sub_kriteria;
                                                            $nama_sub_kriteria = get_sub_kriteria_by_kode_gabungan($kode_gabungan)['nama_sub_kriteria'];
                                                            echo $bobot/$a_nilai_pembagi[$key2];
                                                        }
                                                    ?>
                                                <?php } ?>
                                            </td>
                                        <?php } ?>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Tahap Keempat : Membuat Matriks Keputusan Ternormalisasi Terbobot</h4>
                </div>
                <div class="card-body">
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
                                <?php 
                                    $a_nilai_setiap_alternatif = array()
                                ?>
                                <?php foreach (get_alternatif() as $key => $value) { ?>
                                    <?php foreach (get_kriteria() as $key2 => $value2) { ?>
                                        <?php foreach (get_sub_kriteria_by_kode_kriteria($value2->kode_kriteria) as $key3 => $value3) { ?>
                                            <?php
                                                if(get_bobot_by_kode_seleksi_dan_kode_gabungan($kode_seleksi, $value->kode_alternatif . '-' . $value2->kode_kriteria . '-' . $value3->kode_sub_kriteria)){
                                                    $bobot = get_bobot_by_kode_seleksi_dan_kode_gabungan($kode_seleksi, $value->kode_alternatif . '-' . $value2->kode_kriteria . '-' . $value3->kode_sub_kriteria)['bobot'];
                                                    $kode_kriteria = get_bobot_by_kode_seleksi_dan_kode_gabungan($kode_seleksi, $value->kode_alternatif . '-' . $value2->kode_kriteria . '-' . $value3->kode_sub_kriteria)['kode_kriteria'];
                                                    $kode_sub_kriteria = get_bobot_by_kode_seleksi_dan_kode_gabungan($kode_seleksi, $value->kode_alternatif . '-' . $value2->kode_kriteria . '-' . $value3->kode_sub_kriteria)['kode_sub_kriteria'];
                                                    $kode_gabungan = $kode_kriteria . '-' . $kode_sub_kriteria;
                                                    $nama_sub_kriteria = get_sub_kriteria_by_kode_gabungan($kode_gabungan)['nama_sub_kriteria'];
                                                    array_push($a_nilai_setiap_alternatif, $bobot);
                                                }
                                            ?>
                                        <?php } ?>
                                    <?php } ?>
                                <?php } ?>
                                <?php
                                    $a_nilai_setiap_sub_kriteria = array();
                                    for ($i=0; $i < count(get_kriteria()); $i++) { 
                                        for ($j=$i; $j < count(get_alternatif())*count(get_kriteria()); $j+=count(get_kriteria())) {
                                            $a_nilai_setiap_sub_kriteria[$i][$j] = $a_nilai_setiap_alternatif[$j];
                                        }
                                    }
                                ?>
                                <?php
                                    $a_nilai_pembagi = array();
                                ?>
                                <?php foreach (get_kriteria() as $key => $value) { ?>
                                    <?php
                                        $pembagi = 0;
                                        foreach ($a_nilai_setiap_sub_kriteria[$key] as $key2 => $value2) {
                                            $pembagi += pow($value2, 2);
                                        }
                                        array_push($a_nilai_pembagi, sqrt($pembagi));
                                    ?>
                                <?php  }  ?>
                                <?php foreach (get_alternatif() as $key => $value) { ?>
                                    <tr>
                                        <td><?= $value->kode_alternatif ?></td>
                                        <td><?= $value->nama_alternatif ?></td>
                                        <?php foreach (get_kriteria() as $key2 => $value2) { ?>
                                            <td>
                                                <?php foreach (get_sub_kriteria_by_kode_kriteria($value2->kode_kriteria) as $key3 => $value3) { ?>
                                                    <?php
                                                        if(get_bobot_by_kode_seleksi_dan_kode_gabungan($kode_seleksi, $value->kode_alternatif . '-' . $value2->kode_kriteria . '-' . $value3->kode_sub_kriteria)){
                                                            $bobot = get_bobot_by_kode_seleksi_dan_kode_gabungan($kode_seleksi, $value->kode_alternatif . '-' . $value2->kode_kriteria . '-' . $value3->kode_sub_kriteria)['bobot'];
                                                            $kode_kriteria = get_bobot_by_kode_seleksi_dan_kode_gabungan($kode_seleksi, $value->kode_alternatif . '-' . $value2->kode_kriteria . '-' . $value3->kode_sub_kriteria)['kode_kriteria'];
                                                            $kode_sub_kriteria = get_bobot_by_kode_seleksi_dan_kode_gabungan($kode_seleksi, $value->kode_alternatif . '-' . $value2->kode_kriteria . '-' . $value3->kode_sub_kriteria)['kode_sub_kriteria'];
                                                            $kode_gabungan = $kode_kriteria . '-' . $kode_sub_kriteria;
                                                            $nama_sub_kriteria = get_sub_kriteria_by_kode_gabungan($kode_gabungan)['nama_sub_kriteria'];
                                                            echo ($bobot/$a_nilai_pembagi[$key2]) * $value2->bobot;
                                                        }
                                                    ?>
                                                <?php } ?>
                                            </td>
                                        <?php } ?>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Tahap Kelima : Menentukan Solusi Ideal Positif Dan Solusi Ideal Negatif</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Status</th>
                                    <?php foreach (get_kriteria() as $key => $value) { ?>
                                        <th><?= $value->nama_kriteria ?></th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $a_nilai_setiap_alternatif = array()
                                ?>
                                <?php foreach (get_alternatif() as $key => $value) { ?>
                                    <?php foreach (get_kriteria() as $key2 => $value2) { ?>
                                        <?php foreach (get_sub_kriteria_by_kode_kriteria($value2->kode_kriteria) as $key3 => $value3) { ?>
                                            <?php
                                                if(get_bobot_by_kode_seleksi_dan_kode_gabungan($kode_seleksi, $value->kode_alternatif . '-' . $value2->kode_kriteria . '-' . $value3->kode_sub_kriteria)){
                                                    $bobot = get_bobot_by_kode_seleksi_dan_kode_gabungan($kode_seleksi, $value->kode_alternatif . '-' . $value2->kode_kriteria . '-' . $value3->kode_sub_kriteria)['bobot'];
                                                    $kode_kriteria = get_bobot_by_kode_seleksi_dan_kode_gabungan($kode_seleksi, $value->kode_alternatif . '-' . $value2->kode_kriteria . '-' . $value3->kode_sub_kriteria)['kode_kriteria'];
                                                    $kode_sub_kriteria = get_bobot_by_kode_seleksi_dan_kode_gabungan($kode_seleksi, $value->kode_alternatif . '-' . $value2->kode_kriteria . '-' . $value3->kode_sub_kriteria)['kode_sub_kriteria'];
                                                    $kode_gabungan = $kode_kriteria . '-' . $kode_sub_kriteria;
                                                    $nama_sub_kriteria = get_sub_kriteria_by_kode_gabungan($kode_gabungan)['nama_sub_kriteria'];
                                                    array_push($a_nilai_setiap_alternatif, $bobot);
                                                }
                                            ?>
                                        <?php } ?>
                                    <?php } ?>
                                <?php } ?>
                                <?php
                                    $a_nilai_setiap_sub_kriteria = array();
                                    for ($i=0; $i < count(get_kriteria()); $i++) { 
                                        for ($j=$i; $j < count(get_alternatif())*count(get_kriteria()); $j+=count(get_kriteria())) {
                                            $a_nilai_setiap_sub_kriteria[$i][$j] = $a_nilai_setiap_alternatif[$j];
                                        }
                                    }
                                ?>
                                <?php
                                    $a_nilai_pembagi = array();
                                ?>
                                <?php foreach (get_kriteria() as $key => $value) { ?>
                                    <?php
                                        $pembagi = 0;
                                        foreach ($a_nilai_setiap_sub_kriteria[$key] as $key2 => $value2) {
                                            $pembagi += pow($value2, 2);
                                        }
                                        array_push($a_nilai_pembagi, sqrt($pembagi));
                                    ?>
                                <?php  }  ?>
                                <?php
                                    $a_nilai_solusi_positif_negatif = array();
                                ?>
                                <?php foreach (get_alternatif() as $key => $value) { ?>
                                    <?php foreach (get_kriteria() as $key2 => $value2) { ?>
                                            <?php foreach (get_sub_kriteria_by_kode_kriteria($value2->kode_kriteria) as $key3 => $value3) { ?>
                                                <?php
                                                    if(get_bobot_by_kode_seleksi_dan_kode_gabungan($kode_seleksi, $value->kode_alternatif . '-' . $value2->kode_kriteria . '-' . $value3->kode_sub_kriteria)){
                                                        $bobot = get_bobot_by_kode_seleksi_dan_kode_gabungan($kode_seleksi, $value->kode_alternatif . '-' . $value2->kode_kriteria . '-' . $value3->kode_sub_kriteria)['bobot'];
                                                        $kode_kriteria = get_bobot_by_kode_seleksi_dan_kode_gabungan($kode_seleksi, $value->kode_alternatif . '-' . $value2->kode_kriteria . '-' . $value3->kode_sub_kriteria)['kode_kriteria'];
                                                        $kode_sub_kriteria = get_bobot_by_kode_seleksi_dan_kode_gabungan($kode_seleksi, $value->kode_alternatif . '-' . $value2->kode_kriteria . '-' . $value3->kode_sub_kriteria)['kode_sub_kriteria'];
                                                        $kode_gabungan = $kode_kriteria . '-' . $kode_sub_kriteria;
                                                        $nama_sub_kriteria = get_sub_kriteria_by_kode_gabungan($kode_gabungan)['nama_sub_kriteria'];
                                                        array_push($a_nilai_solusi_positif_negatif, ($bobot/$a_nilai_pembagi[$key2]) * $value2->bobot);
                                                    }
                                                ?>
                                            <?php } ?>
                                    <?php } ?>
                                <?php } ?>
                                <?php
                                    $a_nilai_setiap_sub_kriteria = array();
                                    for ($i=0; $i < count(get_kriteria()); $i++) { 
                                        for ($j=$i; $j < count(get_alternatif())*count(get_kriteria()); $j+=count(get_kriteria())) {
                                            $a_nilai_setiap_sub_kriteria[$i][$j] = $a_nilai_solusi_positif_negatif[$j];
                                        }
                                    }
                                ?>
                                <tr>
                                    <td>Positif</td>
                                    <?php foreach (get_kriteria() as $key2 => $value2) { ?>
                                        <td>
                                            <?php
                                                echo max($a_nilai_setiap_sub_kriteria[$key2]);
                                            ?>
                                        </td>
                                    <?php } ?>
                                </tr>
                                <tr>
                                    <td>Negatif</td>
                                    <?php foreach (get_kriteria() as $key2 => $value2) { ?>
                                        <td>
                                            <?php
                                                echo min($a_nilai_setiap_sub_kriteria[$key2]);
                                            ?>
                                        </td>
                                    <?php } ?>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Tahap Keenam : Menentukan Jarak Alternatif Dengan Solusi Ideal Positif Dan Solusi Ideal Negatif</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Alternatif</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $a_nilai_setiap_alternatif = array()
                                        ?>
                                        <?php foreach (get_alternatif() as $key => $value) { ?>
                                            <?php foreach (get_kriteria() as $key2 => $value2) { ?>
                                                <?php foreach (get_sub_kriteria_by_kode_kriteria($value2->kode_kriteria) as $key3 => $value3) { ?>
                                                    <?php
                                                        if(get_bobot_by_kode_seleksi_dan_kode_gabungan($kode_seleksi, $value->kode_alternatif . '-' . $value2->kode_kriteria . '-' . $value3->kode_sub_kriteria)){
                                                            $bobot = get_bobot_by_kode_seleksi_dan_kode_gabungan($kode_seleksi, $value->kode_alternatif . '-' . $value2->kode_kriteria . '-' . $value3->kode_sub_kriteria)['bobot'];
                                                            $kode_kriteria = get_bobot_by_kode_seleksi_dan_kode_gabungan($kode_seleksi, $value->kode_alternatif . '-' . $value2->kode_kriteria . '-' . $value3->kode_sub_kriteria)['kode_kriteria'];
                                                            $kode_sub_kriteria = get_bobot_by_kode_seleksi_dan_kode_gabungan($kode_seleksi, $value->kode_alternatif . '-' . $value2->kode_kriteria . '-' . $value3->kode_sub_kriteria)['kode_sub_kriteria'];
                                                            $kode_gabungan = $kode_kriteria . '-' . $kode_sub_kriteria;
                                                            $nama_sub_kriteria = get_sub_kriteria_by_kode_gabungan($kode_gabungan)['nama_sub_kriteria'];
                                                            array_push($a_nilai_setiap_alternatif, $bobot);
                                                        }
                                                    ?>
                                                <?php } ?>
                                            <?php } ?>
                                        <?php } ?>
                                        <?php
                                            $a_nilai_setiap_sub_kriteria = array();
                                            for ($i=0; $i < count(get_kriteria()); $i++) { 
                                                for ($j=$i; $j < count(get_alternatif())*count(get_kriteria()); $j+=count(get_kriteria())) {
                                                    $a_nilai_setiap_sub_kriteria[$i][$j] = $a_nilai_setiap_alternatif[$j];
                                                }
                                            }
                                        ?>
                                        <?php
                                            $a_nilai_pembagi = array();
                                        ?>
                                        <?php foreach (get_kriteria() as $key => $value) { ?>
                                            <?php
                                                $pembagi = 0;
                                                foreach ($a_nilai_setiap_sub_kriteria[$key] as $key2 => $value2) {
                                                    $pembagi += pow($value2, 2);
                                                }
                                                array_push($a_nilai_pembagi, sqrt($pembagi));
                                            ?>
                                        <?php  }  ?>
                                        <?php
                                            $a_nilai_solusi_positif_negatif = array();
                                        ?>
                                        <?php foreach (get_alternatif() as $key => $value) { ?>
                                            <?php foreach (get_kriteria() as $key2 => $value2) { ?>
                                                    <?php foreach (get_sub_kriteria_by_kode_kriteria($value2->kode_kriteria) as $key3 => $value3) { ?>
                                                        <?php
                                                            if(get_bobot_by_kode_seleksi_dan_kode_gabungan($kode_seleksi, $value->kode_alternatif . '-' . $value2->kode_kriteria . '-' . $value3->kode_sub_kriteria)){
                                                                $bobot = get_bobot_by_kode_seleksi_dan_kode_gabungan($kode_seleksi, $value->kode_alternatif . '-' . $value2->kode_kriteria . '-' . $value3->kode_sub_kriteria)['bobot'];
                                                                $kode_kriteria = get_bobot_by_kode_seleksi_dan_kode_gabungan($kode_seleksi, $value->kode_alternatif . '-' . $value2->kode_kriteria . '-' . $value3->kode_sub_kriteria)['kode_kriteria'];
                                                                $kode_sub_kriteria = get_bobot_by_kode_seleksi_dan_kode_gabungan($kode_seleksi, $value->kode_alternatif . '-' . $value2->kode_kriteria . '-' . $value3->kode_sub_kriteria)['kode_sub_kriteria'];
                                                                $kode_gabungan = $kode_kriteria . '-' . $kode_sub_kriteria;
                                                                $nama_sub_kriteria = get_sub_kriteria_by_kode_gabungan($kode_gabungan)['nama_sub_kriteria'];
                                                                array_push($a_nilai_solusi_positif_negatif, ($bobot/$a_nilai_pembagi[$key2]) * $value2->bobot);
                                                            }
                                                        ?>
                                                    <?php } ?>
                                            <?php } ?>
                                        <?php } ?>
                                        <?php
                                            $a_nilai_setiap_sub_kriteria = array();
                                            for ($i=0; $i < count(get_kriteria()); $i++) { 
                                                $jj = 0;
                                                for ($j=$i; $j < count(get_alternatif())*count(get_kriteria()); $j+=count(get_kriteria())) {
                                                    $a_nilai_setiap_sub_kriteria[$i][$jj] = $a_nilai_solusi_positif_negatif[$j];
                                                    $jj++;
                                                }
                                            }
                                        ?>
                                        <?php foreach (get_alternatif() as $key2 => $value2) { ?>
                                            <tr>
                                                <?php
                                                    if($key2 == 0){
                                                        echo '<td rowspan="5" style="text-align:center; vertical-align: middle; font-size: 20px; font-weight: bold">D+</td>';
                                                    } 
                                                ?>
                                                <td>
                                                    <?php
                                                        $d_plus_alternatif = 0; 
                                                    ?>
                                                    <?php foreach (get_kriteria() as $key3 => $value3) {
                                                        $d_plus_alternatif += pow((max($a_nilai_setiap_sub_kriteria[$key3])-$a_nilai_setiap_sub_kriteria[$key3][$key2]), 2);
                                                    } ?>
                                                    <?php
                                                        $d_plus_alternatif = sqrt($d_plus_alternatif);
                                                        echo $d_plus_alternatif;
                                                    ?>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Alternatif</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $a_nilai_setiap_alternatif = array()
                                        ?>
                                        <?php foreach (get_alternatif() as $key => $value) { ?>
                                            <?php foreach (get_kriteria() as $key2 => $value2) { ?>
                                                <?php foreach (get_sub_kriteria_by_kode_kriteria($value2->kode_kriteria) as $key3 => $value3) { ?>
                                                    <?php
                                                        if(get_bobot_by_kode_seleksi_dan_kode_gabungan($kode_seleksi, $value->kode_alternatif . '-' . $value2->kode_kriteria . '-' . $value3->kode_sub_kriteria)){
                                                            $bobot = get_bobot_by_kode_seleksi_dan_kode_gabungan($kode_seleksi, $value->kode_alternatif . '-' . $value2->kode_kriteria . '-' . $value3->kode_sub_kriteria)['bobot'];
                                                            $kode_kriteria = get_bobot_by_kode_seleksi_dan_kode_gabungan($kode_seleksi, $value->kode_alternatif . '-' . $value2->kode_kriteria . '-' . $value3->kode_sub_kriteria)['kode_kriteria'];
                                                            $kode_sub_kriteria = get_bobot_by_kode_seleksi_dan_kode_gabungan($kode_seleksi, $value->kode_alternatif . '-' . $value2->kode_kriteria . '-' . $value3->kode_sub_kriteria)['kode_sub_kriteria'];
                                                            $kode_gabungan = $kode_kriteria . '-' . $kode_sub_kriteria;
                                                            $nama_sub_kriteria = get_sub_kriteria_by_kode_gabungan($kode_gabungan)['nama_sub_kriteria'];
                                                            array_push($a_nilai_setiap_alternatif, $bobot);
                                                        }
                                                    ?>
                                                <?php } ?>
                                            <?php } ?>
                                        <?php } ?>
                                        <?php
                                            $a_nilai_setiap_sub_kriteria = array();
                                            for ($i=0; $i < count(get_kriteria()); $i++) { 
                                                for ($j=$i; $j < count(get_alternatif())*count(get_kriteria()); $j+=count(get_kriteria())) {
                                                    $a_nilai_setiap_sub_kriteria[$i][$j] = $a_nilai_setiap_alternatif[$j];
                                                }
                                            }
                                        ?>
                                        <?php
                                            $a_nilai_pembagi = array();
                                        ?>
                                        <?php foreach (get_kriteria() as $key => $value) { ?>
                                            <?php
                                                $pembagi = 0;
                                                foreach ($a_nilai_setiap_sub_kriteria[$key] as $key2 => $value2) {
                                                    $pembagi += pow($value2, 2);
                                                }
                                                array_push($a_nilai_pembagi, sqrt($pembagi));
                                            ?>
                                        <?php  }  ?>
                                        <?php
                                            $a_nilai_solusi_positif_negatif = array();
                                        ?>
                                        <?php foreach (get_alternatif() as $key => $value) { ?>
                                            <?php foreach (get_kriteria() as $key2 => $value2) { ?>
                                                    <?php foreach (get_sub_kriteria_by_kode_kriteria($value2->kode_kriteria) as $key3 => $value3) { ?>
                                                        <?php
                                                            if(get_bobot_by_kode_seleksi_dan_kode_gabungan($kode_seleksi, $value->kode_alternatif . '-' . $value2->kode_kriteria . '-' . $value3->kode_sub_kriteria)){
                                                                $bobot = get_bobot_by_kode_seleksi_dan_kode_gabungan($kode_seleksi, $value->kode_alternatif . '-' . $value2->kode_kriteria . '-' . $value3->kode_sub_kriteria)['bobot'];
                                                                $kode_kriteria = get_bobot_by_kode_seleksi_dan_kode_gabungan($kode_seleksi, $value->kode_alternatif . '-' . $value2->kode_kriteria . '-' . $value3->kode_sub_kriteria)['kode_kriteria'];
                                                                $kode_sub_kriteria = get_bobot_by_kode_seleksi_dan_kode_gabungan($kode_seleksi, $value->kode_alternatif . '-' . $value2->kode_kriteria . '-' . $value3->kode_sub_kriteria)['kode_sub_kriteria'];
                                                                $kode_gabungan = $kode_kriteria . '-' . $kode_sub_kriteria;
                                                                $nama_sub_kriteria = get_sub_kriteria_by_kode_gabungan($kode_gabungan)['nama_sub_kriteria'];
                                                                array_push($a_nilai_solusi_positif_negatif, ($bobot/$a_nilai_pembagi[$key2]) * $value2->bobot);
                                                            }
                                                        ?>
                                                    <?php } ?>
                                            <?php } ?>
                                        <?php } ?>
                                        <?php
                                            $a_nilai_setiap_sub_kriteria = array();
                                            for ($i=0; $i < count(get_kriteria()); $i++) { 
                                                $jj = 0;
                                                for ($j=$i; $j < count(get_alternatif())*count(get_kriteria()); $j+=count(get_kriteria())) {
                                                    $a_nilai_setiap_sub_kriteria[$i][$jj] = $a_nilai_solusi_positif_negatif[$j];
                                                    $jj++;
                                                }
                                            }
                                        ?>
                                        <?php foreach (get_alternatif() as $key2 => $value2) { ?>
                                            <tr>
                                                <?php
                                                    if($key2 == 0){
                                                        echo '<td rowspan="5" style="text-align:center; vertical-align: middle; font-size: 20px; font-weight: bold">D-</td>';
                                                    } 
                                                ?>
                                                <td>
                                                    <?php
                                                        $d_plus_alternatif = 0; 
                                                    ?>
                                                    <?php foreach (get_kriteria() as $key3 => $value3) {
                                                        $d_plus_alternatif += pow((min($a_nilai_setiap_sub_kriteria[$key3])-$a_nilai_setiap_sub_kriteria[$key3][$key2]), 2);
                                                    } ?>
                                                    <?php
                                                        $d_plus_alternatif = sqrt($d_plus_alternatif);
                                                        echo $d_plus_alternatif;
                                                    ?>
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
        <div class="col-md-12 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Tahap Ketujuh : Menentukan Nilai Preferensi untuk setiap alternatif</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>Alternatif</th>
                                            <th>Preferensi</th>
                                            <th>Ranking</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $a_nilai_setiap_alternatif = array()
                                        ?>
                                        <?php foreach (get_alternatif() as $key => $value) { ?>
                                            <?php foreach (get_kriteria() as $key2 => $value2) { ?>
                                                <?php foreach (get_sub_kriteria_by_kode_kriteria($value2->kode_kriteria) as $key3 => $value3) { ?>
                                                    <?php
                                                        if(get_bobot_by_kode_seleksi_dan_kode_gabungan($kode_seleksi, $value->kode_alternatif . '-' . $value2->kode_kriteria . '-' . $value3->kode_sub_kriteria)){
                                                            $bobot = get_bobot_by_kode_seleksi_dan_kode_gabungan($kode_seleksi, $value->kode_alternatif . '-' . $value2->kode_kriteria . '-' . $value3->kode_sub_kriteria)['bobot'];
                                                            $kode_kriteria = get_bobot_by_kode_seleksi_dan_kode_gabungan($kode_seleksi, $value->kode_alternatif . '-' . $value2->kode_kriteria . '-' . $value3->kode_sub_kriteria)['kode_kriteria'];
                                                            $kode_sub_kriteria = get_bobot_by_kode_seleksi_dan_kode_gabungan($kode_seleksi, $value->kode_alternatif . '-' . $value2->kode_kriteria . '-' . $value3->kode_sub_kriteria)['kode_sub_kriteria'];
                                                            $kode_gabungan = $kode_kriteria . '-' . $kode_sub_kriteria;
                                                            $nama_sub_kriteria = get_sub_kriteria_by_kode_gabungan($kode_gabungan)['nama_sub_kriteria'];
                                                            array_push($a_nilai_setiap_alternatif, $bobot);
                                                        }
                                                    ?>
                                                <?php } ?>
                                            <?php } ?>
                                        <?php } ?>
                                        <?php
                                            $a_nilai_setiap_sub_kriteria = array();
                                            for ($i=0; $i < count(get_kriteria()); $i++) { 
                                                for ($j=$i; $j < count(get_alternatif())*count(get_kriteria()); $j+=count(get_kriteria())) {
                                                    $a_nilai_setiap_sub_kriteria[$i][$j] = $a_nilai_setiap_alternatif[$j];
                                                }
                                            }
                                        ?>
                                        <?php
                                            $a_nilai_pembagi = array();
                                        ?>
                                        <?php foreach (get_kriteria() as $key => $value) { ?>
                                            <?php
                                                $pembagi = 0;
                                                foreach ($a_nilai_setiap_sub_kriteria[$key] as $key2 => $value2) {
                                                    $pembagi += pow($value2, 2);
                                                }
                                                array_push($a_nilai_pembagi, sqrt($pembagi));
                                            ?>
                                        <?php  }  ?>
                                        <?php
                                            $a_nilai_solusi_positif_negatif = array();
                                        ?>
                                        <?php foreach (get_alternatif() as $key => $value) { ?>
                                            <?php foreach (get_kriteria() as $key2 => $value2) { ?>
                                                    <?php foreach (get_sub_kriteria_by_kode_kriteria($value2->kode_kriteria) as $key3 => $value3) { ?>
                                                        <?php
                                                            if(get_bobot_by_kode_seleksi_dan_kode_gabungan($kode_seleksi, $value->kode_alternatif . '-' . $value2->kode_kriteria . '-' . $value3->kode_sub_kriteria)){
                                                                $bobot = get_bobot_by_kode_seleksi_dan_kode_gabungan($kode_seleksi, $value->kode_alternatif . '-' . $value2->kode_kriteria . '-' . $value3->kode_sub_kriteria)['bobot'];
                                                                $kode_kriteria = get_bobot_by_kode_seleksi_dan_kode_gabungan($kode_seleksi, $value->kode_alternatif . '-' . $value2->kode_kriteria . '-' . $value3->kode_sub_kriteria)['kode_kriteria'];
                                                                $kode_sub_kriteria = get_bobot_by_kode_seleksi_dan_kode_gabungan($kode_seleksi, $value->kode_alternatif . '-' . $value2->kode_kriteria . '-' . $value3->kode_sub_kriteria)['kode_sub_kriteria'];
                                                                $kode_gabungan = $kode_kriteria . '-' . $kode_sub_kriteria;
                                                                $nama_sub_kriteria = get_sub_kriteria_by_kode_gabungan($kode_gabungan)['nama_sub_kriteria'];
                                                                array_push($a_nilai_solusi_positif_negatif, ($bobot/$a_nilai_pembagi[$key2]) * $value2->bobot);
                                                            }
                                                        ?>
                                                    <?php } ?>
                                            <?php } ?>
                                        <?php } ?>
                                        <?php
                                            $a_nilai_setiap_sub_kriteria = array();
                                            for ($i=0; $i < count(get_kriteria()); $i++) { 
                                                $jj = 0;
                                                for ($j=$i; $j < count(get_alternatif())*count(get_kriteria()); $j+=count(get_kriteria())) {
                                                    $a_nilai_setiap_sub_kriteria[$i][$jj] = $a_nilai_solusi_positif_negatif[$j];
                                                    $jj++;
                                                }
                                            }
                                        ?>
                                        <?php
                                            $a_d_plus_alternatif = array();
                                            $a_d_mines_alternatif = array();
                                        ?>
                                        <?php foreach (get_alternatif() as $key2 => $value2) { ?>
                                            <?php
                                                $d_plus_alternatif = 0; 
                                            ?>
                                            <?php foreach (get_kriteria() as $key3 => $value3) {
                                                $d_plus_alternatif += pow((max($a_nilai_setiap_sub_kriteria[$key3])-$a_nilai_setiap_sub_kriteria[$key3][$key2]), 2);
                                            } ?>
                                            <?php
                                                $d_plus_alternatif = sqrt($d_plus_alternatif);
                                                array_push($a_d_plus_alternatif, $d_plus_alternatif);
                                            ?>
                                        <?php } ?>
                                        <?php foreach (get_alternatif() as $key2 => $value2) { ?>
                                            <?php
                                                $d_mines_alternatif = 0; 
                                            ?>
                                            <?php foreach (get_kriteria() as $key3 => $value3) {
                                                $d_mines_alternatif += pow((min($a_nilai_setiap_sub_kriteria[$key3])-$a_nilai_setiap_sub_kriteria[$key3][$key2]), 2);
                                            } ?>
                                            <?php
                                                $d_mines_alternatif = sqrt($d_mines_alternatif);
                                                array_push($a_d_mines_alternatif, $d_mines_alternatif);
                                            ?>
                                        <?php } ?>
                                        <?php
                                            $rank_result = array();
                                        ?>
                                        <?php foreach (get_alternatif() as $key2 => $value2) { ?>
                                                <?php 
                                                    $hasil_final[$key2] = $a_d_mines_alternatif[$key2] / ($a_d_mines_alternatif[$key2]+$a_d_plus_alternatif[$key2]);
                                                ?>
                                                <?php
                                                    $arr  = $hasil_final;
                                                    $rank = $arr;
                                                    rsort($rank);
                                                    foreach($arr as $key55 => $sort) {
                                                        $rank_result[$key55] = (array_search($sort, $rank) + 1);
                                                    }
                                                ?>
                                        <?php } ?>
                                        <form action="<?= route_to('perhitungan_topsis_admin_save_rating') ?>" method="post">
                                            <?php foreach (get_alternatif() as $key2 => $value2) { ?>
                                                <tr>
                                                    <td><?= $value2->kode_alternatif ?> - <?= $value2->nama_alternatif ?></td>
                                                    <td><?php 
                                                        $hasil_final[$key2] = $a_d_mines_alternatif[$key2] / ($a_d_mines_alternatif[$key2]+$a_d_plus_alternatif[$key2]);
                                                        echo $hasil_final[$key2];
                                                    ?></td>
                                                    <td>Ranking Ke - <?= $rank_result[$key2]?></td>
                                                </tr>
                                                <input type="hidden" name="kode_alternatif[<?=$key2?>]" value="<?= $value2->kode_alternatif ?>">
                                                <input type="hidden" name="hasil[<?=$key2?>]" value="<?= $hasil_final[$key2] ?>">
                                                <input type="hidden" name="ranking[<?=$key2?>]" value="<?= $rank_result[$key2] ?>">
                                            <?php } ?>
                                            <input type="hidden" name="kode_seleksi" value="<?= $kode_seleksi ?>">
                                            <?php if(get_rating_by_kode_seleksi($kode_seleksi)) { ?>
                                                <div class="alert alert-warning" role="alert">
                                                    Rekomendasi Yang Dihasilkan Adalah : <?= get_rating_by_kode_seleksi($kode_seleksi)['kode_alternatif'] ?> atau <span style="font-weight: bold;"><?= get_alternatif_by_kode_alternatif(get_rating_by_kode_seleksi($kode_seleksi)['kode_alternatif'])['nama_alternatif'] ?></span>
                                                </div>
                                                <?php if(!get_rekomendasi_by_kode_seleksi($kode_seleksi)){ ?>
                                                    <a href="<?= route_to('perhitungan_topsis_admin_rekomendasikan', $kode_seleksi, get_rating_by_kode_seleksi($kode_seleksi)['kode_alternatif']) ?>" class="btn btn-primary mb-4">Approve (Rekomendasikan)</a>
                                                <?php } ?>
                                            <?php }else{ ?>
                                                <button class="btn btn-primary mb-4">Cek Rekomendasi</button>
                                            <?php } ?>
                                        </form>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>