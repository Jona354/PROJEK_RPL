<?php

namespace App\Http\Controllers;

use App\Models\Notifikasi;

class NotifikasiController extends Controller
{
    public function readAll()
    {
        Notifikasi::where('sudah_dibaca', 0)
            ->update([
                'sudah_dibaca' => 1
            ]);

        return response()->json([
            'success' => true
        ]);
    }
}