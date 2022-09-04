<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KriteriaModel;
use App\Models\SubKriteriaModel;

class SubKriteriaController extends BaseController
{
    public function __construct(){
        $this->kriteriaModel = new KriteriaModel();
        $this->subKriteriaModel = new SubKriteriaModel();
    }
    public function index(){
        $data = $this->kriteriaModel->get()->getResult();
        return view('admin/data-sub-kriteria', compact('data'));
    }
    public function save(){
        try {
            $data = $this->request->getVar();
            $data['kode_gabungan'] = $data['kode_kriteria'] .'-'. $data['kode_sub_kriteria'];
            $rules = [
                'kode_sub_kriteria' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Harus Diisi'
                    ]
                ],
                'nama_sub_kriteria' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Harus Diisi'
                    ]
                ],
                'bobot' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Harus Diisi'
                    ]
                ],
                'kode_kriteria' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Harus Diisi'
                    ]
                ],
                'keterangan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Harus Diisi'
                    ]
                ],
            ];
        
            if(!$this->validate($rules)){
                return view('admin/data-sub-kriteria',[
                    'validation' => $this->validator,
                    'data' => $data
                ]);
            }else{
                $this->subKriteriaModel->insert($data);
                return redirect()->back()->with('status', 'success');
            }
        } catch (\Exception $th) {
            var_dump($th);
            die();
            return redirect()->back()->with('status', 'failed');
        }
    }
    public function update(){
        try {
            $data = $this->request->getVar();
            $data['kode_gabungan'] = $data['kode_kriteria'] .'-'. $data['kode_sub_kriteria'];
            $rules = [
                'kode_sub_kriteria' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Harus Diisi'
                    ]
                ],
                'nama_sub_kriteria' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Harus Diisi'
                    ]
                ],
                'bobot' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Harus Diisi'
                    ]
                ],
                'kode_kriteria' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Harus Diisi'
                    ]
                ],
                'keterangan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Harus Diisi'
                    ]
                ],
            ];
        
            if(!$this->validate($rules)){
                return view('admin/data-sub-kriteria',[
                    'validation' => $this->validator,
                    'data' => $data
                ]);
            }else{
                $this->subKriteriaModel->update($data['id_sub_kriteria'], $data);
                return redirect()->back()->with('status', 'success');
            }
        } catch (\Exception $th) {
            var_dump($th);
            die();
            return redirect()->back()->with('status', 'failed');
        }
    }
    public function delete(){
        try {
            $data = $this->request->getVar();
            $this->subKriteriaModel->where('id_sub_kriteria', $data['id_sub_kriteria'])->delete();
            return redirect()->back()->with('status', 'success');
        } catch (\Exception $th) {
            return redirect()->back()->with('status', 'failed');
        }
    }
}
