<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class PengepulController extends BaseController
{
    public function __construct(){
        $this->userModel = new UserModel();
    }
    public function index(){
        $data = $this->userModel->where('role', 1)->get()->getResult();
        return view('admin/data-pengepul', compact('data'));
    }
    public function save(){
        try {
            $data = $this->request->getVar();
            $data['plain_password'] = $data['password'];
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
            $rules = [
                'nama_lengkap' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Harus Diisi'
                    ]
                ],
                'email' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Harus Diisi'
                    ]
                ],
                'password' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Harus Diisi'
                    ]
                ],
                'nohp' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Harus Diisi'
                    ]
                ],
                'alamat' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Harus Diisi'
                    ]
                ],
            ];
        
            if(!$this->validate($rules)){
                return view('admin/data-pengepul',[
                    'validation' => $this->validator,
                    'data' => $data
                ]);
            }else{
                $this->userModel->insert($data);
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
                'kode_pengepul' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Harus Diisi'
                    ]
                ],
                'nama_pengepul' => [
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
                $this->alternatifModel->update($data['id_pengepul'], $data);
                return redirect()->back()->with('status', 'success');
            }
        } catch (\Exception  $th) {
            return redirect()->back()->with('status', 'failed');
        }
    }
    public function delete(){
        try {
            $data = $this->request->getVar();
            $this->userModel->delete($data['id_user']);
            return redirect()->back()->with('status', 'success');
        } catch (\Exception $th) {
            return redirect()->back()->with('status', 'failed');
        }
    }
}
