<?php if(session()->get('role') == 2){ ?>
<ul class="menu-inner py-1">
    <li class="menu-header small text-uppercase"><span class="menu-header-text">Umum</span></li>
    <li class="menu-item"><a class="menu-link" href="<?= route_to('dashboard_admin_index') ?>"><i
                class="menu-icon tf-icons bx bx-home"></i><span>Dasboard</span></a></li>
    <li class="menu-item"><a class="menu-link" href="<?= route_to('alternatif_admin_index') ?>"><i
                class="menu-icon tf-icons bx bx-data"></i><span>Data Alternatif</span></a></li>
    <li class="menu-item"><a class="menu-link" href="<?= route_to('kriteria_admin_index') ?>"><i
                class="menu-icon tf-icons bx bx-archive-out"></i><span>Data Kriteria</span></a></li>
    <li class="menu-item"><a class="menu-link" href="<?= route_to('sub_kriteria_admin_index') ?>"><i
                class="menu-icon tf-icons bx bx-git-compare"></i><span>Data Sub Kriteria</span></a></li>
    <li class="menu-item"><a class="menu-link" href="<?= route_to('perhitungan_topsis_minyak_daun_admin_index') ?>"><i
                class="menu-icon tf-icons bx bx-basket"></i><span>Perhitungan TOPSIS Minyak Daun</span></a></li>
    <li class="menu-item"><a class="menu-link" href="<?= route_to('perhitungan_topsis_minyak_gagang_admin_index') ?>"><i
                class="menu-icon tf-icons bx bx-basket"></i><span>Perhitungan TOPSIS Minyak Gagang</span></a></li>
    <li class="menu-item"><a class="menu-link" href="<?= route_to('hasil_akhir_admin_index') ?>"><i
                class="menu-icon tf-icons bx bx-badge-check"></i><span>Data Hasil Akhir</span></a></li>
    <li class="menu-header small text-uppercase"><span class="menu-header-text">Lainnya</span></li>
    <li class="menu-item"><a class="menu-link" href="<?= route_to('pengepul_admin_index') ?>"><i
                class="menu-icon tf-icons bx bx-map-alt"></i><span>Data Pengepul</span></a></li>
</ul>
<?php }else if(session()->get('role') == 1){ ?>
<ul class="menu-inner py-1">
    <li class="menu-header small text-uppercase"><span class="menu-header-text">Umum</span></li>    
    <li class="menu-item"><a class="menu-link" href="<?= route_to('dashboard_collector_index') ?>"><i class="menu-icon tf-icons bx bx-home"></i><span>Dashboard</span></a></li>
    <li class="menu-item"><a class="menu-link" href="<?= route_to('hasil_panen_minyak_daun_collector_index') ?>"><i class="menu-icon tf-icons bx bx-basket"></i><span>Penentuan Hasil Panen Minyak Daun</span></a></li>
    <li class="menu-item"><a class="menu-link" href="<?= route_to('hasil_panen_minyak_gagang_collector_index') ?>"><i class="menu-icon tf-icons bx bx-basket"></i><span>Penentuan Hasil Panen Minyak Gagang</span></a></li>
    <li class="menu-item"><a class="menu-link" href="<?= route_to('histori_collector_index') ?>"><i class="menu-icon tf-icons bx bx-history"></i><span>Histori</span></a></li>
    <li class="menu-header small text-uppercase"><span class="menu-header-text">Lainnya</span></li>
    <li class="menu-item"><a class="menu-link" href="<?= route_to('profil_collector_index') ?>"><i class="menu-icon tf-icons bx bx-map-alt"></i><span>Profil</span></a></li>
</ul>
<?php } ?>