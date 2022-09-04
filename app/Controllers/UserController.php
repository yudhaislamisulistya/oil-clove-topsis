<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class UserController extends BaseController
{
    public function __construct(){
        $this->userModel = new UserModel();    
    }
    public function dashboard_admin(){
        return view('admin/dashboard');
    }
    public function dashboard_collector(){
        return view('collector/dashboard');
    }

    public function profil(){
        return view('collector/profil');
    }
    public function edit(){
        try {
            $data = $this->request->getVar();
            $this->userModel->update(session()->get('id_user'), [
                'nama_lengkap' => $data['nama_lengkap'],
                'nohp' => $data['nohp'],
                'alamat' => $data['alamat'],
            ]);
            return redirect()->back()->with('status', 'success');
        } catch (\Exception $e) {
            var_dump($e);
            die();
            return redirect()->back()->with('status', 'failed');
        } 
    }
    public function edit_password(){
        try {
            $data = $this->request->getVar();
            $data['plain_password'] = $data['password'];
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
            $this->userModel->update(session()->get('id_user'), [
                'password' => $data['password'],
                'plain_password' => $data['plain_password'],
            ]);
            return redirect()->back()->with('status', 'success_password');
        } catch (\Exception $e) {
            var_dump($e);
            die();
            return redirect()->back()->with('status', 'failed_password');
        } 
    }
}
