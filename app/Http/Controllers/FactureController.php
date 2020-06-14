<?php

namespace App\Http\Controllers;

use App\Client;
use App\Facture;
use App\Produit;
use Illuminate\Http\Request;

class FactureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $factures = Facture::all();
        $factureCli = [];
        // foreach ($factures as $facture) {
        //     $cliet = $facture->client;
        //     $factureCli[] = [$facture, $facture->client];
        // }
        // dd($factureCli);
        return view('facture.index')->with('factures', $factures);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clients = Client::all();
        $products = Produit::all();
        return view('facture.create')->with('clients', $clients)
            ->with('products', $products);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $produits = $request->produits;
        $qty_demande = $request->qty_demnde;
        $size = count($produits);
        $tabProduitQty = [];
        for ($i = 0; $i < $size; $i++) {
            $tabProduitQty[] = [$produits[$i], $qty_demande[$i]];
        }
        dd($tabProduitQty);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Facture  $facture
     * @return \Illuminate\Http\Response
     */
    public function show(Facture $facture)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Facture  $facture
     * @return \Illuminate\Http\Response
     */
    public function edit(Facture $facture)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Facture  $facture
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Facture $facture)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Facture  $facture
     * @return \Illuminate\Http\Response
     */
    public function destroy(Facture $facture)
    {
        //
    }
}
