<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class HistoriController extends BaseController
{
    public function index()
    {
        return view('collector/histori');
    }
}
