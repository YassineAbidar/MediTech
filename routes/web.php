<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/admin', function () {
    return view('Client.index');
});
// CLIENT ROUTE
Route::resource('/admin/client', 'ClientController');
Route::POST('admin/client/updaateClient/', 'ClientController@updateClient')->name('client.updateClient');
Route::get('admin/client/delete/{id}', 'ClientController@deleteClient')->name('client.delete');
Route::get('admin/client/getInfo/{id}', 'ClientController@getInfoClient')->name('client.getInfoClient');
// PRODUIT ROUTE
Route::resource('/admin/produit', 'ProduitController');
Route::get('admin/produit/delete/{id}', 'ProduitController@deleteproduit')->name('produit.delete');
Route::get('admin/produitSeleted/', 'ProduitController@getProduitSelection')->name('product.productChoisi');
//
Route::POST('admin/product/updateProduct/', 'ProduitController@updateProduit')->name('produit.editProduct');
//Facture route
Route::resource('/admin/facture', 'FactureController');
//
Route::GET('admin/facture/dowlande/{id}', 'FactureController@getPdfFacture')->name('facture.apercu');
// route FactureProduit

Route::resource('/admin/FacturProduit', 'FactureProduitController');
