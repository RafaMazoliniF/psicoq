<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DownloadController extends Controller
{
    public function downloadDocxAtestado()
    {
        $file = storage_path('encaminhamento/atestado-medico.docx'); // Caminho correto para o arquivo DOCX

        return response()->download($file, 'atestado-medico.docx');
    }
    public function downloadDocxEncaminhamento()
    {
        $file = storage_path('encaminhamento/encaminhamento-medico.docx'); // Caminho correto para o arquivo DOCX

        return response()->download($file, 'encaminhamento-medico.docx');
    }

}
