<?php

namespace App\Http\Controllers;

use App\Models\Historique;
use App\Models\Demande;
use Illuminate\Http\Request;
use Carbon\Carbon;

class HistoriqueController extends Controller
{
    public function store(Request $request)
    {
        $demandeIds = collect($request->input('demandes'))->pluck('id');

        foreach ($demandeIds as $id) {
            // جلب الطلب مباشرة من قاعدة البيانات
            $demande = Demande::find($id);

                // حذف الطلب من جدول demandes
                $demande->delete();
            
        }

        return response()->json(['success' => true]);
    }
}
