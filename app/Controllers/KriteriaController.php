<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KriteriaModel;

class KriteriaController extends BaseController
{
    public function __construct(){
        $this->kriteriaModel = new KriteriaModel();
    }
    public function index(){
        $data = $this->kriteriaModel->get()->getResult();
        return view('admin/data-kriteria', compact('data'));
    }
    public function save(){
        try {
            $data = $this->request->getVar();

            $rules = [
                'kode_kriteria' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Harus Diisi'
                    ]
                ],
                'nama_kriteria' => [
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
            ];
        
            if(!$this->validate($rules)){
                return view('admin/data-kriteria',[
                    'validation' => $this->validator,
                    'data' => $this->data
                ]);
            }else{
                $this->kriteriaModel->insert($data);
                return redirect()->back()->with('status', 'success');
            }
        } catch (\Exception $th) {
            return redirect()->back()->with('status', 'failed');
        }
    }
    public function update(){
        try {
            $data = $this->request->getVar();

            $rules = [
                'kode_kriteria' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Harus Diisi'
                    ]
                ],
                'nama_kriteria' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Harus Diisi'
                    ]
                ],
            ];
        
            if(!$this->validate($rules)){
                return view('admin/data-kriteria',[
                    'validation' => $this->validator,
                    'data' => $this->data
                ]);
            }else{
                $this->kriteriaModel->update($data['id_kriteria'], $data);
                return redirect()->back()->with('status', 'success');
            }
        } catch (\Exception  $th) {
            return redirect()->back()->with('status', 'failed');
        }
    }
    public function delete(){
        try {
            $data = $this->request->getVar();
            $this->kriteriaModel->delete($data['id_kriteria']);
            return redirect()->back()->with('status', 'success');
        } catch (\Exception $th) {
            return redirect()->back()->with('status', 'failed');
        }
    }
}
