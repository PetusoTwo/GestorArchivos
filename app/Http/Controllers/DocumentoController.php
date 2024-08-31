<?php

namespace App\Http\Controllers;

use App\Models\Archivo;
use Illuminate\Http\Request;

class DocumentoController extends Controller
{
    public function download($id)
    {
        $documento = Archivo::findOrFail($id);
        $filePath = storage_path('app/public/' . $documento->ruta);
        if (!file_exists($filePath)) {
            abort(404);
        }

        return response()->download($filePath);
    }
}
