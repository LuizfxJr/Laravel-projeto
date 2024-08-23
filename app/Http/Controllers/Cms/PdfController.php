<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class PdfController extends Controller
{

    // public $place = ['city' => 'Pokhara', 'country' => 'Nepal'];
    // public $obj = (object) $place;

    public function gerarPdf()
    {
        return view('cms.components.pdf');

        // return redirect(route('cms.components.pdf'));

        // $pdf = PDF::loadView('cms.components.pdf');

        // return $pdf->setPaper('a4')->stream('Teste.pdf');
    }
}
