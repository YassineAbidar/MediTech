<?php

namespace App\Http\Controllers;

use App\Client;
use App\Facture;
use App\FactureProduit;
use App\Produit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

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
        $client = Client::find($request->client);
        $date =  date('d/m/yy');
        $size = count($produits);
        $facture = Facture::create([
            'code_facture' => $request->code_facture,
            'date_creation' => $date,
            'client_id' => $client->id,
        ]);
        $facture_id = DB::table('factures')->max('id');
        $tabProduitQty = [];
        $output = "";
        $total = 0;
        for ($i = 0; $i < $size; $i++) {
            $tabProduitQty[] = $qty_demande[$i];
            $produit = Produit::find($produits[$i]);
            $total += $produit->prix_unitaire * $qty_demande[$i];
            $factProduit = FactureProduit::create([
                'facture_id' => $facture_id,
                'produit_id' => $produits[$i],
                'qty' => $qty_demande[$i],
            ]);
            $output .= '<tr>
                <td>' . $produit->ref_produit . '</td>
                <td>' . $produit->libelle . '</td>
                <td>' . $produit->prix_unitaire . '</td>
                <td>' . $qty_demande[$i] . '</td>
                <td>' . $qty_demande[$i] * $produit->prix_unitaire . '</td>
                </tr>';
        }
        return response()->json([
            'status' => true,
            'facture_id' => $facture_id,
            'resumer' => $output,
            'message' => 'Facture aded successfly',
            'total' => $total,
        ]);
    }
    public function getPdfFacture($id)
    {
        $facture = Facture::find($id);
        // dd($facture, $facture->produits);
        $client = Client::find($facture->client_id);
        $tabProduct = [];
        $ligne_factures = DB::table('facture_produits')->where('facture_id', $id)->get();
        $total = 0;
        foreach ($ligne_factures as $ligne_facture) {
            $produit = Produit::find($ligne_facture->produit_id);
            $tabProduct[] = [$produit, $ligne_facture->qty];
            $total += $produit->prix_unitaire * $ligne_facture->qty;
        }
        // dd($tabProduct);
        $data = [
            'facture' => $facture,
            'produits' => $tabProduct,
            'client' => $client,
            'total'=>$total,
        ];
        $pdf = PDF::loadView('facture.apercu', $data);
        return $pdf->download('Facture.pdf');
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
