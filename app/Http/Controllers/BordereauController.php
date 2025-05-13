<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bordereau;
use App\Models\Demande;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class BordereauController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Afficher la liste des demandes
    public function index()
    {
        $demandes = Demande::all();
        return view('bordereaux.index', compact('demandes'));
    }

    // Générer un bordereau
    public function generate(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'Utilisateur non authentifié.'], 401);
        }

        $request->validate([
            'demandes' => 'required|array',
            'demandes.*' => 'exists:demandes,id',
        ]);

        $user = Auth::user();

        $bordereau = new Bordereau();
        $bordereau->user_id = $user->id;

        $currentDate = now()->format('Y-m-d');
        $count = Bordereau::whereDate('created_at', today())->count() + 1;
        $bordereau->id = 'BD_' . $currentDate . '-' . $count;

        $bordereau->save();

        foreach ($request->demandes as $demandeId) {
            $demande = Demande::find($demandeId);
            if ($demande) {
                $demande->bordereau_id = $bordereau->id;
                $demande->save();
            }
        }

        return response()->json(['message' => 'Bordereau généré avec succès.']);
    }

    // Afficher les bordereaux
    public function afficher()
    {
        $bordereaux = Bordereau::with('demandes.agent')->get();
        return view('bordereaux.afficher', compact('bordereaux'));
    }

    // Télécharger le PDF
    public function download($id)
{
    $bordereau = Bordereau::with(['demandes.agent', 'demandes.entite'])->findOrFail($id);
    $demandes = $bordereau->demandes;

    $pdf = Pdf::loadView('pdf.bordereau', compact('demandes', 'bordereau'));

    return $pdf->download("bordereau_{$id}.pdf");
}


    // Supprimer un bordereau
    public function destroy($id)
    {
        $bordereau = Bordereau::findOrFail($id);
        $bordereau->demandes()->update(['bordereau_id' => null]);
        $bordereau->delete();

        return redirect()->back()->with('success', 'Bordereau supprimé avec succès.');
    }
}
