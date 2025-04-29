<?php

namespace App\Http\Controllers;

use App\Models\Demande;
use App\Models\Agent;
use App\Models\Entite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade as PDF;



class DemandeController extends Controller
{
    // Afficher la liste des demandes
    public function index()
{
    $demandes = Demande::all(); // or any other query to get the data
    return view('demandes.index', compact('demandes'));
}


    // Afficher le formulaire de création
    public function create()
    {
        // Récupère toutes les entités
        $entites = Entite::all();
        return view('demandes.create', compact('entites'));
    }

    // Enregistrer une nouvelle demande
    public function store(Request $request)
    {
        // Validation des données
        $request->validate([
            'type' => 'required|string|max:255',
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'telephone' => 'required|string|max:20',
            'email_personnelle' => 'nullable|email',
            'email_professionnelle' => 'nullable|email',
            'cin' => 'nullable|string|max:50',
            'matricule' => 'nullable|string|max:50',
            'code_esquife' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'date_reception' => 'nullable|date',
            'date_envoi' => 'nullable|date',
            'date_reponse' => 'nullable|date',
            'reponse' => 'nullable|string',
            'observation' => 'nullable|string',
            'fichier' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'entite_id' => 'required|exists:entites,id',
        ]);

        // Création de l'agent lié à la demande
        $agent = Agent::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'telephone' => $request->telephone,
            'email_personnelle' => $request->email_personnelle,
            'email_professionnelle' => $request->email_professionnelle,
            'cin' => $request->cin,
            'matricule' => $request->matricule,
            'code_esquif' => $request->code_esquife,
            'entite_id' => $request->entite_id,
            'id_users' => Auth::id(),
        ]);

        // Enregistrement de la demande
        $demande = new Demande();
        $demande->type = $request->type;
        $demande->description = $request->description;
        $demande->date_reception = $request->date_reception;
        $demande->date_envoi = $request->date_envoi;
        $demande->date_reponse = $request->date_reponse;
        $demande->reponse = $request->reponse;
        $demande->observation = $request->observation;
        $demande->agent_id = $agent->id;  // Lier l'agent à la demande
        $demande->entite_id = $request->entite_id;
        $demande->user_id = Auth::id();

        // Vérifier si un fichier a été téléchargé et l'enregistrer
        if ($request->hasFile('fichier')) {
            $demande->fichier = $request->file('fichier')->store('demandes', 'public');
        }

        // Sauvegarde de la demande dans la base de données
        $demande->save();

        // Redirection vers la liste des demandes avec un message de succès
        return redirect()->route('demandes.index')->with('success', 'Demande créée avec succès.');
    }

    // Afficher les détails d'une demande
    public function show($id)
    {
        $demande = Demande::findOrFail($id);
        return view('demandes.show', compact('demande'));
    }
    // Dans le contrôleur BordereauController


    public function genererBordereau()
{
    try {
        // Récupérer les demandes et compter
        $demandes = Demande::all();
        $count = $demandes->count();
    
        // Générer le PDF
        $pdf = PDF::loadView('bordereau.generated', compact('demandes', 'count'));
    
        // Retourner le PDF au navigateur
        return $pdf->download('bordereau.pdf');
    } catch (\Exception $e) {
        \Log::error("Error generating bordereau: " . $e->getMessage());
        return response()->json(['error' => 'An error occurred while generating the bordereau.'], 500);
    }
}  
}
