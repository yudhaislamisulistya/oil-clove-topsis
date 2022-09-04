<?php

use App\Models\AlternatifModel;
use App\Models\KriteriaModel;
use App\Models\RatingModel;
use App\Models\RekomendasiModel;
use App\Models\SeleksiModel;
use App\Models\SubKriteriaModel;
use App\Models\UserModel;


function get_user_by_id_user($id_user){
    $userModel = new UserModel();
    $data = $userModel->find($id_user);
    return $data;
}
function get_sub_kriteria_by_kode_kriteria($kode_kriteria){
    $subKriteriaModel = new SubKriteriaModel();
    $data = $subKriteriaModel->where('kode_kriteria', $kode_kriteria)->get()->getResult();
    return $data;
}

function get_kriteria_by_kode_kriteria($kode_kriteria){
    $kriteriaModel = new KriteriaModel();
    $data = $kriteriaModel->where('kode_kriteria', $kode_kriteria)->first();
    return $data;
}

function get_kriteria(){
    $kriteriaModel = new KriteriaModel();
    $data = $kriteriaModel->get()->getResult();
    return $data;
}

function get_sub_kriteria(){
    $subKriteriaModel = new SubKriteriaModel();
    $data = $subKriteriaModel->get()->getResult();
    return $data;
}

function get_alternatif(){
    $alternatifModel = new AlternatifModel();
    $data = $alternatifModel->get()->getResult();
    return $data;
}

function get_seleksi_by_id_user_dan_group_by_kode_seleksi($id_user){
    $seleksiModel = new SeleksiModel();
    $data = $seleksiModel->where('id_user', $id_user)->groupBy('kode_seleksi')->get()->getResult();
    return $data;
}

function get_bobot_by_kode_seleksi_dan_kode_gabungan($kode_seleksi, $kode_gabungan){
    $seleksiModel = new SeleksiModel();
    $data = $seleksiModel->where('kode_seleksi', $kode_seleksi)->where('kode_gabungan', $kode_gabungan)->first();
    return $data;
}

function get_sub_kriteria_by_kode_gabungan($kode_gabungan){
    $subKriteriaModel = new SubKriteriaModel();
    $data = $subKriteriaModel->where('kode_gabungan', $kode_gabungan)->first();
    return $data;
}

function get_rating_by_kode_seleksi($kode_seleksi){
    $ratingModel = new RatingModel();
    $data = $ratingModel
        ->where('kode_seleksi', $kode_seleksi)
        ->orderBy('ranking', 'asc')
        ->first();
    return $data;
}

function get_rating_by_kode_seleksi_all($kode_seleksi){
    $ratingModel = new RatingModel();
    $data = $ratingModel
        ->where('kode_seleksi', $kode_seleksi)
        ->orderBy('ranking', 'asc')
        ->get()
        ->getResult();
    return $data;
}

function get_alternatif_by_kode_alternatif($kode_alternatif){
    $alternatifModel = new AlternatifModel();
    $data = $alternatifModel->where('kode_alternatif', $kode_alternatif)->first();
    return $data;
}

function get_rekomendasi_by_kode_seleksi($kode_seleksi){
    $rekomendasiModel = new RekomendasiModel();
    $data = $rekomendasiModel
        ->where('kode_seleksi', $kode_seleksi)
        ->first();
    return $data;
}

function get_seleksi_by_id_user($id_user){
    $seleksiModel = new SeleksiModel();
    $data = $seleksiModel->where('id_user', $id_user)->groupBy('kode_seleksi')->get()->getResult();
    return $data;
}

function get_seleksi_by_id_user_dan_limit_5($id_user){
    $seleksiModel = new SeleksiModel();
    $data = $seleksiModel->where('id_user', $id_user)->groupBy('kode_seleksi')->limit(5)->get()->getResult();
    return $data;
}

function get_seleksi_by_limit_5(){
    $seleksiModel = new SeleksiModel();
    $data = $seleksiModel->groupBy('kode_seleksi')->limit(5)->get()->getResult();
    return $data;
}

function get_seleksi(){
    $seleksiModel = new SeleksiModel();
    $data = $seleksiModel->groupBy('kode_seleksi')->get()->getResult();
    return $data;
}


?>