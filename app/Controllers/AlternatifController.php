<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AlternatifModel;

class AlternatifController extends BaseController
{
    public function __construct(){
        $this->alternatifModel = new AlternatifModel();
    }
    public function index(){
        $data = $this->alternatifModel->get()->getResult();
        return view('admin/data-alternatif', compact('data'));
    }
    public function save(){
        try {
            $data = $this->request->getVar();

            $rules = [
                'kode_alternatif' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Harus Diisi'
                    ]
                ],
                'nama_alternatif' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Harus Diisi'
                    ]
                ],
            ];
        
            if(!$this->validate($rules)){
                return view('admin/data-alternatif',[
                    'validation' => $this->validator,
                    'data' => $this->data
                ]);
            }else{
                $this->alternatifModel->insert($data);
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
                'kode_alternatif' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Harus Diisi'
                    ]
                ],
                'nama_alternatif' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Harus Diisi'
                    ]
                ],
            ];
        
            if(!$this->validate($rules)){
                return view('admin/data-alternatif',[
                    'validation' => $this->validator,
                    'data' => $this->data
                ]);
            }else{
                $this->alternatifModel->update($data['id_alternatif'], $data);
                return redirect()->back()->with('status', 'success');
            }
        } catch (\Exception  $th) {
            return redirect()->back()->with('status', 'failed');
        }
    }
    public function delete(){
        try {
            $data = $this->request->getVar();
            $this->alternatifModel->delete($data['id_alternatif']);
            return redirect()->back()->with('status', 'success');
        } catch (\Exception $th) {
            return redirect()->back()->with('status', 'failed');
        }
    }
}
