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
use App\Http\Controllers\CommandeController;


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

// Route::get('/etudiant/dashbord',[EtudiantController::class,'index'])->name('etudiant.dashboard');
Route::get('/formateur/dashbord',[FormateurController::class,'index'])->name('formateur.dashboard');
Route::get('/formateur/attente',[FormateurController::class,'attente'])->name('formateur.page.attente');

Route::middleware('etudiant')->group(function (){
    Route::get('/categories',[CategorieController::class, 'listCategorie'])->name("categorie.list");
    Route::get('/categories/{nom_categorie}/formations',[CategorieController::class, 'formationsParCategorie'])->name("categorie.formations");
    Route::get('/formations',[FormationController::class, 'listFormation'])->name("formations.list");
    Route::get('/etudiant/acceuil',[EtudiantController::class, 'index'])->name("etudiant.acceuil");
    Route::get('/etudiant/cours',[EtudiantController::class, 'mesCours'])->name('etudiant.cours');
    // Route::get('/etudiant/cours/{titre}',[EtudiantController::class, 'monCours'])->name('etudiant.moncours');
    Route::get('/etudiant/cours/{id}',[EtudiantController::class, 'monCours'])->name('etudiant.moncours');
    Route::get('/etudiant/achat/formation{formation_id}',[EtudiantController::class, 'Achat'])->name("etudiant.achat");
    Route::post('/etudiant/achat/formation',[EtudiantController::class, 'effectuerPaiement'])->name("etudiant.payer");
    Route::get('/etudiant/detail/formation{formation_id}',[FormationController::class, 'detail'])->name("forma.detail");
    Route::get('/etudiant/commandes', [CommandeController::class, 'index'])->name('commandes.etudiant');
    Route::post('/commande/panier/ajouter', [CommandeController::class, 'ajouterAuPanier'])->name('commande.panier.ajouter');
    Route::get('/commande/panier', [CommandeController::class, 'afficherPanier'])->name('commande.panier');
    Route::delete('/commande/panier/retirer', [CommandeController::class, 'retirerDuPanier'])->name('panier.retirer');
    Route::post('/commande/valider', [CommandeController::class, 'validerPanier'])->name('commande.valider');
    Route::get('/commande/{commande_id}/detail', [CommandeController::class, 'detail'])->name('commande.detail');

});

Route::middleware('formateur')->group(function (){
    
    Route::get('/formateur/creer-formation',[FormationController::class, 'create'])->name("create.formation");
    Route::post('/formateur/creer-formation',[FormationController::class, 'store'])->name("create.formation");
    Route::get('/formateur/formation/mes-formations',[FormateurController::class, 'mesFormations'])->name("formateur.mes-formations");
    Route::post('/formation/logout',[LoginController::class,'logoutFormateur'])->name("logoutFormateur");
    Route::get('/formateur/monprofil',[FormateurController::class,'profil'])->name('monprofil');
    Route::get('/formateur/monprofil/edit/{id}',[FormateurController::class,'profiledit'])->name('monprofil.edit');
    Route::put('/formateur/monprofil/edit/{id}',[FormateurController::class,'profilupdate'])->name('monprofil.update');
    Route::get('/formateur/formation/mes-formations/show{id}',[FormationController::class, 'show'])->name("formation.detail");
    Route::get('/formateur/formation/mes-formations/edit{id}',[FormationController::class, 'edit'])->name("formation.edit");
    Route::put('/formateur/formation/mes-formations/edit{id}',[FormationController::class, 'update'])->name("formation.update");
    Route::delete('/formateur/formation/mes-formations/supprimer{id}',[FormationController::class, 'destroy'])->name("formation.delete");
    Route::put('/formation/formation-{id}/publier', [FormationController::class, 'publier'])->name('formation.publier');
    Route::put('/formation/formation-{id}/depublier', [FormationController::class, 'depublier'])->name('formation.depublier');


    //chapitre
    Route::get('/formateur/formation/mes-formations/formation-{formationId}/ajoutchapitre',[ChapitreController::class, 'afficherChapitres'])->name("chapitre.ajout");
    Route::post('/formateur/formation/mes-formations/formation-{formationId}/ajoutchapitre',[ChapitreController::class, 'ajoutChapitre'])->name("chapitre.ajout");
    // Route::get('/formateur/formation/mes-formations/ajoutchapitre',[ChapitreController::class, 'ajoutChapitre'])->name("formation.ajoutchapitre");
    Route::get('/formateur/formation/mes-formations/chapitre/show{$id}',[ChapitreController::class, 'show'])->name("chapitre.show");
    Route::get('/formateur/formation/mes-formations/chapitre/edit{$id}',[ChapitreController::class, 'edit'])->name("chapitre.edit");
    Route::put('/formateur/formation/mes-formations/chapitre/edit{$id}',[ChapitreController::class, 'update'])->name("chapitre.update");
    Route::get('/formateur/formation/mes-formations/chapitre/supprimer{$id}',[ChapitreController::class, 'destroy'])->name("chapitre.delete");

    // commande
    Route::get('/formateur/commandes', [CommandeController::class, 'index'])->name('commandes.formateur');



});

Route::get('/admin',[AdminUserController::class,'login'])->name('adminLogin');
Route::post('/admin/login',[AdminUserController::class,'logged'])->name('adminLogin');

Route::middleware('auth')->group(function () {
    Route::get('/admin/dashboard',[AdminUserController::class,'index'])->name('adminDashboard');
    Route::get('/admin/gestion-formateur',[AdminUserController::class,'gestFormateur'])->name('admin.gestFormateurs');
    Route::get('/admin/gestion-formateur/attente',[AdminUserController::class,'gestFormateurAttente'])->name('admin.gestFormateurAttente');
    Route::post('/admin/gestion-formateur/valider-formateur/{id}', [AdminUserController::class, 'validerFormateur'])->name('admin.validerFormateur');
    Route::get('/admin/gestion-formateur/attente/show{id}', [AdminUserController::class, 'show'])->name('attente.detail');


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
