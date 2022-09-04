<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class HasilAkhirController extends BaseController
{
    public function index()
    {
        return view('admin/data-hasil-akhir');
    }
}
