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

Route::get('/', function () {
    return view('auth.login');
})->name('login');

//

// CLIENT ROUTE
Route::resource('/admin/client', 'ClientController');
Route::resource('/admin/users', 'UserController');
Route::POST('admin/client/updaateClient/', 'ClientController@updateClient')->name('client.updateClient');
Route::get('admin/client/delete/{id}', 'ClientController@deleteClient')->name('client.delete');
Route::get('admin/client/getInfo/{id}', 'ClientController@getInfoClient')->name('client.getInfoClient');
// client.categoryClient
Route::get('admin/client/client/category', 'ClientController@getCategoryClient')->name('client.categoryClient');
// PRODUIT ROUTE
Route::resource('/admin/produit', 'ProduitController');
Route::get('admin/produit/delete/{id}', 'ProduitController@deleteproduit')->name('produit.delete');
Route::get('admin/produitSeleted/', 'ProduitController@getProduitSelection')->name('product.productChoisi');
Route::get('admin/demande/product', 'ProduitController@getDemandeProduit')->name('produit.demande');
//
Route::POST('admin/product/updateProduct/', 'ProduitController@updateProduit')->name('produit.editProduct');
//Facture route
Route::resource('/admin/facture', 'FactureController');
Route::GET('admin/facture/dowlande/{id}', 'FactureController@getPdfFacture')->name('facture.apercu');
Route::GET('admin/facture/show/{id}', 'FactureController@showFacture')->name('facture.showFact');
Route::GET('admin/facture/delete/{id}', 'FactureController@deletefacture')->name('facture.delete');

//
Route::GET('admin/facture/codeFacture/{code}', 'FactureController@getCodeFacture')->name('getCodeFacture');


// route FactureProduit

Route::resource('/admin/FacturProduit', 'FactureProduitController');

//
Route::get('/home', 'HomeController@index')->name('home');

//User
Route::post('/loginUser', 'UserController@SeConnecter')->name('seconnecter');
Route::get('/admin/user', 'UserController@getAllUser')->name('user.index');
Route::get('/admin/user/delete/{id}', 'UserController@deleteUser')->name('user.delete');
Route::POST('/admin/user/add/', 'UserController@store')->name('user.store');
Route::get('/admin/user/logout/', 'UserController@logout')->name('user.logOut');
