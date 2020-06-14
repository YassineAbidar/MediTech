<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    public function factures()
    {
        return $this->belongsToMany('App\Facture','facture_produits');
    }
    protected $fillable=[
        'ref_produit','prix_unitaire','quantity_stock','libelle',
    ];
}
