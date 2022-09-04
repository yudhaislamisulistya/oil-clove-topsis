<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\RatingModel;
use App\Models\RekomendasiModel;
use App\Models\SeleksiModel;

class HasilPanenController extends BaseController
{
    public function __construct(){
        $this->ratingModel = new RatingModel();
        $this->seleksiModel = new SeleksiModel();
        $this->rekomendasiModel = new RekomendasiModel();
    }
    public function index(){
        return view('collector/hasil-panen');
    }
    public function save(){
        try {
            $data = $this->request->getVar();
            $kode_seleksi = random_string('alnum', 16);
            for ($i=0; $i < count($data['sub_kriteria']); $i++) { 
                for ($j=0; $j < count($data['sub_kriteria'][$i]); $j++) { 
                    $split = explode("-", $data['sub_kriteria'][$i][$j]);
                    $bobot = $split[0];
                    $kode_kriteria = $split[1];
                    $kode_sub_kriteria = $split[2];
                    $this->seleksiModel->insert([
                        'id_user' => $data['id_user'],
                        'kode_seleksi' => $kode_seleksi,
                        'kode_kriteria' => $kode_kriteria,
                        'kode_sub_kriteria' => $kode_sub_kriteria,
                        'kode_alternatif' => $data['kode_alternatif'][$i],
                        'kode_gabungan' => $data['kode_alternatif'][$i] . '-' .$kode_kriteria . '-' . $kode_sub_kriteria,
                        'bobot' => $bobot
                    ]);
                }
            }
            session()->setFlashdata('kode_seleksi', $kode_seleksi);
            return redirect()->to(base_url('collector/hasil-panen'))->with('status', 'success');
        } catch (\Exception $th) {
            var_dump($th);
            die();
            return redirect()->to(base_url('collector/hasil-panen'))->with('status', 'failed');
        }
    }
    public function delete($kode_seleksi){
        try {
            $this->seleksiModel->where('kode_seleksi', $kode_seleksi)->delete();
            return redirect()->to(base_url('collector/hasil-panen'))->with('status', 'success_delete');
        } catch (\Exception $th) {
            return redirect()->to(base_url('collector/hasil-panen'))->with('status', 'failed_delete');
        }
    }
    public function detail($kode_seleksi){
        return view('collector/detail-hasil-panen', compact('kode_seleksi'));
    }
    public function save_rating(){
        try {
            $data = $this->request->getVar();
            for ($i=0; $i < count($data['kode_alternatif']); $i++) { 
                $this->ratingModel->ignore(true)->insert([
                    'kode_seleksi' => $data['kode_seleksi'],
                    'kode_alternatif' => $data['kode_alternatif'][$i],
                    'hasil' => $data['hasil'][$i],
                    'ranking' => $data['ranking'][$i]
                ]);
            }
            return redirect()->back()->with('status', 'success');
        } catch (\Exception $th) {
            var_dump($th);
            die();
            return redirect()->back()->with('status', 'failed');
        }
    }
    public function rekomendasikan($kode_seleksi, $kode_alternatif){
        try {
            $this->rekomendasiModel->insert([
                'kode_seleksi' => $kode_seleksi,
                'kode_alternatif' => $kode_alternatif
            ]);
            return redirect()->to(base_url('collector/hasil-panen/detail/'.$kode_seleksi))->with('status', 'succes');
        } catch (\Exception $th) {
            return redirect()->to(base_url('collector/hasil-panen/detail/'.$kode_seleksi))->with('status', 'failed');
        }
    }
}
