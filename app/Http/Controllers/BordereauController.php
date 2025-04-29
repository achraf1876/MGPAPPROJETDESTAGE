<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BordereauController extends Controller
{
    public function historique()
    {
        // Your logic here to show the historical data
        return view('bordereau.historique');
    }
}
