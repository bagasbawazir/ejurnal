<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Jurnal;

class cJurnalAdmin extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $jurnals=Jurnal::with('dosen')->get([
            'id','id_dosen','title',
            'versi','kategori','status',
            'doc','cover',
            ])->toArray();
        // dd($jurnals);
        return view('JurnalAdmin.index', compact('jurnals'));
    }
}
