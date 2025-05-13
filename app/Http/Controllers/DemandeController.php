<?php

namespace App\Http\Controllers;

use App\Models\Demande;
use App\Models\Agent;
use App\Models\Entite;
use App\Models\Bordereau;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DemandeController extends Controller
{
    public function index()
    {
        // Récupérer toutes les demandes avec pagination
        $demandes = Demande::paginate(10);
        return view('demandes.index', compact('demandes'));
    }
    public function generateBordereau()
{
    $demandes = Demande::all(); // Example of fetching all demandes
    return view('your-view-name', compact('demandes'));
}

    public function create()
    {
        // Récupérer toutes les entités pour le formulaire de création
        $entites = Entite::all();
        return view('demandes.create', compact('entites'));
    }

    public function store(Request $request)
    {
        // Valider les données envoyées
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

        // Créer un agent
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

        // Créer une nouvelle demande
        $demande = new Demande();
        $demande->type = $request->type;
        $demande->description = $request->description;
        $demande->date_reception = $request->date_reception;
        $demande->date_envoi = $request->date_envoi;
        $demande->date_reponse = $request->date_reponse;
        $demande->reponse = $request->reponse;
        $demande->observation = $request->observation;
        $demande->agent_id = $agent->id;
        $demande->entite_id = $request->entite_id;
        $demande->user_id = Auth::id();

        // Si un fichier est téléchargé, le traiter
        if ($request->hasFile('fichier')) {
            $filename = time() . '_' . $request->file('fichier')->getClientOriginalName();
            $path = $request->file('fichier')->storeAs('demandes', $filename, 'public');
            $demande->fichier = $path;
        }

        // Sauvegarder la demande
        $demande->save();

        // Redirection vers la liste des demandes avec un message de succès
        return redirect()->route('demandes.index')->with('success', 'Demande créée avec succès.');
    }

    public function show($id)
    {
        // Afficher une demande spécifique
        $demande = Demande::findOrFail($id);
        return view('demandes.show', compact('demande'));
    }



 

    public function historique()
    {
        // Récupérer l'historique des demandes archivées
        $demandes = Demande::with(['agent', 'entite'])
            ->where('archived', true)
            ->orderBy('updated_at', 'desc')
            ->get();

        return view('demandes.historique', compact('demandes'));
    }
    public function edit($id)
{
    $demande = Demande::findOrFail($id);
    $agents = Agent::all();
    $entites = Entite::all();

    return view('demandes.edit', compact('demande', 'agents', 'entites'));
}
public function destroy($id)
{
    // Rechercher la demande par son ID
    $demande = Demande::findOrFail($id);

    // Supprimer la demande
    $demande->delete();

    // Rediriger avec un message de succès
    return redirect()->route('demandes.index')->with('success', 'Demande supprimée avec succès');
}


public function update(Request $request, $id)
{
    $demande = Demande::findOrFail($id);

    // Mise à jour de la demande
    $demande->update([
        'type' => $request->type,
        'date_reception' => $request->date_reception,
        'date_envoi' => $request->date_envoi,
        'date_reponse' => $request->date_reponse,
        'description' => $request->description,
        'reponse' => $request->reponse,
        'observation' => $request->observation,
        'entite_id' => $request->entite_id, // ne pas oublier ce champ
    ]);

    // Mise à jour fichier si existe
    if ($request->hasFile('fichier')) {
        $path = $request->file('fichier')->store('fichiers', 'public');
        $demande->fichier = $path;
        $demande->save();
    }

    // Mise à jour de l'agent
    if ($demande->agent) {
        $demande->agent->update([
            'nom' => $request->agent_nom,
            'prenom' => $request->agent_prenom,
            'telephone' => $request->agent_telephone,
            'email_professionnelle' => $request->agent_email_pro, // corriger nom du champ
            'email_personnelle' => $request->agent_email_perso,    // corriger nom du champ
            'cin' => $request->agent_cin,
            'matricule' => $request->agent_matricule,
            'code_esquif' => $request->agent_code_esquif,
        ]);
    }

    // Ne pas mettre à jour entite ici, juste le rattacher par son ID
    // Supprimer cette section :
    // if ($demande->entite) {
    //     $demande->entite->update([
    //         'nom' => $request->entite_nom,
    //     ]);
    // }

    return redirect()->route('demandes.show', $demande->id)
        ->with('success', 'Demande mise à jour avec succès.');
}




    public function showDemandeForm()
    {
        $demandes = Demande::all(); // Fetch all demandes from the database
        dd($demandes); // This will dump and die to show if data is being fetched correctly.
        return view('bordereaux.index', compact('demandes'));
    }
    

    
}
