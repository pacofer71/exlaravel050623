<?php

namespace App\Http\Controllers;

use App\Models\Foto;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class FotoController extends Controller
{
   

    /**
     * Display the specified resource.
     */
    public function detalle(Foto $foto)
    {
        $this->authorize('view', $foto);
        return view('fotos.detalle', compact('foto'));
    }

  
}
