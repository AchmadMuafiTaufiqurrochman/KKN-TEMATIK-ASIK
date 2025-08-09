<?php

namespace App\Http\Controllers;

use App\Models\Potential;

class PotentialController extends Controller
{
    public function index()
    {
        $potentials = Potential::all();
        return view('product', compact('potentials'));
    }
}
