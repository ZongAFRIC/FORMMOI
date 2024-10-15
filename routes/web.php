<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\FormateurController;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\FormationController;
// use App\Http\Controllers\ChapitreController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\CategorieController;




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

Route::get('/', [PageController::class, 'index']);

Route::get('/register',[PageController::class, 'register'])->name('register');
Route::get('/login',[PageController::class, 'login'])->name('login');


Route::get('/dashbord',[PageController::class,'dashboard'])->name('dash1');
Route::get('/dashbord1',[PageController::class,'dashb'])->name('dashb');
Route::get('/dashbord',[PageController::class,'dashboard1'])->name('dashboard');
Route::post('/register/etudiant', [RegisterController::class, 'registerEtudiant'])->name('registerEtudiant');
Route::post('/register/formateur', [RegisterController::class, 'registerFormateur'])->name('registerFormateur');
// Route::post('/login', [LoginController::class, 'login']);
Route::post('/login/etudiant', [LoginController::class, 'loginEtudiant'])->name('loginEtudiant');
Route::post('/login/formateur', [LoginController::class, 'loginFormateur'])->name('loginFormateur');

Route::get('/etudiant/dashbord',[EtudiantController::class,'index'])->name('etudiant.dashboard');
Route::get('/formateur/dashbord',[FormateurController::class,'index'])->name('formateur.dashboard');

Route::middleware('etudiant')->group(function (){

    // Route::get('/agent/mes-taches',[AgentController::class, 'mesTaches'])->name("mes-taches");
    // Route::get('/agent/mes-taches-resolues',[AgentController::class, 'mesTachesResolues'])->name("mes-taches-resolues");
    // Route::get('/agent/rapport',[AgentController::class, 'rapport'])->name("mon-rapport");
    // Route::get('/agent/mes-taches/detail{id}',[AgentController::class, 'mesTachesDetail']);
    // Route::get('/agent/incidents-solutions',[AgentController::class, 'incidentsSolution'])->name("incidents-solutions");

});

Route::middleware('formateur')->group(function (){
    
    Route::get('/formateur/creer-formation',[FormationController::class, 'create'])->name("create.formation");
    Route::post('/formateur/creer-formation',[FormationController::class, 'store'])->name("create.formation");
    Route::get('/formateur/formation/mes-formations',[FormateurController::class, 'mesFormations'])->name("formateur.mes-formations");
    
});

Route::get('/admin',[AdminUserController::class,'login'])->name('adminLogin');
Route::post('/admin/login',[AdminUserController::class,'logged'])->name('adminLogin');

// Route::get('/admin/dashboard',[AdminUserController::class,'index'])->name('adminDashboard');
// Route::get('/admin/gestion-formateur',[AdminUserController::class,'gestFormateur'])->name('admin-gestFormateurs');

Route::middleware('auth')->group(function () {
    Route::get('/admin/dashboard',[AdminUserController::class,'index'])->name('adminDashboard');
    Route::get('/admin/gestion-formateur',[AdminUserController::class,'gestFormateur'])->name('admin-gestFormateurs');

    //categorie*************************************
    Route::get('/admin/gestion-categorie',[CategorieController::class,'index'])->name('gestion.categorie');
    Route::get('/admin/gerer-categorie/create', [CategorieController::class, 'create'])->name('categorie.create');
    Route::post('/admin/gerer-categorie/store', [CategorieController::class, 'store']);
    Route::get('/admin/gerer-categorie/editer{id}', [CategorieController::class, 'edit'])->name('categorie.edit');
    Route::put('/admin/gerer-categorie/editer{id}', [CategorieController::class, 'update'])->name('categorie.update');
    Route::get('/admin/gerer-categorie/suprimer{id}', [CategorieController::class, 'destroy'])->name('categorie.delete');
    Route::get('/admin/gerer-categorie/show{id}', [CategorieController::class, 'show'])->name('categorie.detail');
    Route::get('/admin/gerer-categorie/show', [CategorieController::class, 'retour'])->name('categotie.retour');
});

require __DIR__.'/auth.php';
