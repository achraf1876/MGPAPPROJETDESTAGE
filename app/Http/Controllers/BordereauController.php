<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bordereau;
use App\Models\Demande;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class BordereauController extends Controller
{
    // Générer un bordereau (avec possibilité de supprimer les demandes après génération)
    public function generer(Request $request)
    {
        // Validation des demandes sélectionnées
        $request->validate([
            'demandes' => 'required|array',
        ]);

        $user = Auth::user();
        $date = Carbon::now()->format('Y-m-d');
        $todayCount = Bordereau::whereDate('created_at', $date)->count();
        $id = 'BD_' . $date . '_' . ($todayCount + 1);

        $date_reception = Carbon::now();
        $date_depot = Carbon::now()->addDays(2);

        DB::beginTransaction();

        try {
            // Création du bordereau
            $bordereau = Bordereau::create([
                'id' => $id,
                'user_id' => $user->id,
                'date_reception' => $date_reception,
                'date_depot' => $date_depot,
                'demandes_ids' => json_encode($request->demandes),
            ]);

            // Supprimer les demandes après génération
            Demande::whereIn('id', $request->demandes)->delete();

            DB::commit();

            return redirect()->route('bordereau.historique')->with('success', 'Bordereau généré avec succès.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Erreur lors de la génération du bordereau.');
        }
    }

    // Afficher l'historique des bordereaux
   

    // Afficher les détails d'un bordereau spécifique
    public function show($id)
    {
        $bordereau = Bordereau::findOrFail($id);

        // Récupérer les demandes liés au bordereau
        $demandes = [];
        if ($bordereau->demandes_ids) {
            $demandesIds = json_decode($bordereau->demandes_ids, true);
            $demandes = Demande::with(['agent', 'entite'])->whereIn('id', $demandesIds)->get();
        }

        return view('bordereau.show', compact('bordereau', 'demandes'));
    }
    public function historique()
    {
        // Fetch the demande data (replace with your actual logic)
        $demande = Demande::find(1); // Example: Retrieve a specific demande, adjust as needed
    
        // Pass the demande to the view
        return view('bordereau.historique', compact('demande'));
    }
}