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
Route::get('/formations/recherche', [PageController::class, 'recherche'])->name('formations.recherche');

// Route::get('/etudiant/dashbord',[EtudiantController::class,'index'])->name('etudiant.dashboard');
Route::get('/formateur/dashbord',[FormateurController::class,'index'])->name('formateur.dashboard');
Route::get('/formateur/attente',[FormateurController::class,'attente'])->name('formateur.page.attente');

Route::middleware('etudiant')->group(function (){
    
    Route::get('/formations',[FormationController::class, 'listFormation'])->name("formations.list");
    Route::get('/etudiant/acceuil',[EtudiantController::class, 'index'])->name("etudiant.acceuil");
    Route::get('/etudiant/cours',[EtudiantController::class, 'mesCours'])->name('etudiant.cours');
    // Route::get('/search-formations/etd',[FormationController::class, 'searchFormationEtd'])->name('etd.search-formations');
    Route::get('/search-formations',[FormationController::class, 'searchFormationEt'])->name('etd.searf');

    Route::get('/profil',[EtudiantController::class,'profil'])->name('profil');
    Route::get('/profil/edit/{id}',[EtudiantController::class,'profiledit'])->name('profil.edit');
    Route::put('/profil/edit/{id}',[EtudiantController::class,'profilupdate'])->name('profil.update');
    Route::post('/logout',[LoginController::class,'logoutEtudiant'])->name("logoutEtudiant");
});

Route::middleware('formateur')->group(function (){
    
    Route::get('/formateur/creer-formation',[FormationController::class, 'create'])->name("create.formation");
    Route::post('/formateur/creer-formation',[FormationController::class, 'store'])->name("create.formation");
    Route::get('/formateur/formation/mes-formations',[FormateurController::class, 'mesFormations'])->name("formateur.mes-formations");
    Route::get('/formateur/formations',[FormationController::class, 'allFormations'])->name("formateur.formations");
    Route::get('/search-formations/etd', [FormationController::class, 'searchFormationFmt'])->name('fmt-search-formations');
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
    // Route::get('/formateur/cours',[FormateurController::class, 'mesCours'])->name('formateur.cours');
    Route::get('/search-formations', [FormationController::class, 'searchFormation'])->name('formations.search');
    Route::get('/formateur/caisse', [FormateurController::class, 'caisse'])->name('formateur.caisse');

    //chapitre
    Route::get('/formateur/formation/mes-formations/formation-{formationId}/ajoutchapitre',[ChapitreController::class, 'afficherChapitres'])->name("chapitre.ajout");
    Route::post('/formateur/formation/mes-formations/formation-{formationId}/ajoutchapitre',[ChapitreController::class, 'ajoutChapitre'])->name("chapitre.ajout");
    // Route::get('/formateur/formation/mes-formations/ajoutchapitre',[ChapitreController::class, 'ajoutChapitre'])->name("formation.ajoutchapitre");
    Route::get('/formateur/formation/mes-formations/formation-{formationId}/chapitre',[ChapitreController::class, 'formationChapitres'])->name("formation.chapitre");
    Route::get('/formateur/formation/mes-formations/chapitre/show{$id}',[ChapitreController::class, 'show'])->name("chapitre.show");
    Route::get('/formateur/formation/mes-formations/chapitre/edit_{$id}',[ChapitreController::class, 'editChapitre'])->name("chapitre.edit");
    Route::put('/formateur/formation/mes-formations/chapitre/edit{$id}',[ChapitreController::class, 'update'])->name("chapitre.update");
    Route::get('/formateur/formation/mes-formations/chapitre/supprimer{$id}',[ChapitreController::class, 'destroy'])->name("chapitre.delete");


    Route::get('/formateur/paramettre',[FormateurController::class, 'paramettre'])->name('formateur.paramettre');
    Route::get('/formateur/paramettre/gestion-compte',[FormateurController::class, 'gererCompte'])->name('formateur.gererCompte');
    Route::post('/formateur/paramettre/gestion-compte/edit{id}/email',[FormateurController::class, 'editCompteEmail'])->name('formateur.editCompteEmail');
    Route::post('/formateur/paramettre/gestion-compte/edit{id}/password',[FormateurController::class, 'updateMotDePasse'])->name('formateur.updateCompte');
    Route::delete('/formateur/paramettre/gestion-compte/supprimer{id}',[FormateurController::class, 'destroyCompte'])->name('formateur.deleteCompte');

});

// Routes communes
Route::middleware(['auth:etudiant,formateur'])->group(function () {
    Route::get('/achat/formation/{formation_id}', [FormationController::class,'achat'])->name('formation.achat');
    Route::get('/paiement/orange-money/{formation_id}', [PaiementController::class, 'orangeMoney'])->name('paiement.orange-money');
    Route::get('/paiement/moov-money/{formation_id}', [PaiementController::class, 'moovMoney'])->name('paiement.moov-money');
    Route::get('/paiement/telecel-money/{formation_id}', [PaiementController::class, 'telecelMoney'])->name('paiement.telecel-money');
    Route::get('/paiement/sank-money/{formation_id}', [PaiementController::class, 'sankMoney'])->name('paiement.sank-money');
    Route::get('/paiement/coris-money/{formation_id}', [PaiementController::class, 'corisMoney'])->name('paiement.coris-money');
    Route::get('/paiement/wave/{formation_id}', [PaiementController::class, 'wave'])->name('paiement.wave');
    Route::post('/paiement/processus', [PaiementController::class, 'processusPaiement'])->name('paiement.processus');
    Route::post('/chapitres/{chapitreId}/noter', [AvisController::class, 'noter'])->name('chapitre.noter');
    Route::post('/chapitres/{chapitreId}/commenter', [AvisController::class, 'commenter'])->name('chapitre.commenter');
    Route::get('/search-categories', [CategorieController::class, 'search'])->name('categories.search');
    Route::get('/search-formations', [FormationController::class, 'searchEf'])->name('formations.search');
    Route::get('/categories/{nom_categorie}/formations',[CategorieController::class, 'formationsParCategorie'])->name("categorie.formations");
    Route::get('/categories',[CategorieController::class, 'categoriesListe'])->name("categorie.list");
    Route::get('/formation/detail/formation_{formation_id}',[FormationController::class, 'detail'])->name("forma.detail");
    Route::get('/formation/cours/{id}',[FormationController::class, 'monCours'])->name("formation.monCours");
    Route::post('/chapitre/{id}/termine', [ChapitreController::class, 'marquerTermine'])->name('chapitre.marquerTermine');
    // Route::get('/liste-cours',[FormationController::class, 'mesCours'])->name("formation.mesCours");
    Route::get('/liste-mescours',[FormationController::class, 'mesCours'])->name("formation.mesCours");
    Route::get('/search-cours', [FormationController::class, 'searchCours'])->name('search-cours');
    
    //gestion compte
    Route::get('/paramettre',[PageController::class, 'paramettre'])->name('paramettre');
    Route::get('/paramettre/gestion-compte',[PageController::class, 'gererCompte'])->name('gererCompte');
    Route::post('/paramettre/gestion-compte/edit{id}/email',[PageController::class, 'editCompteEmail'])->name('editCompteEmail');
    Route::post('/paramettre/gestion-compte/edit{id}/password',[PageController::class, 'updateMotDePasse'])->name('updateCompte');
    Route::delete('/paramettre/gestion-compte/supprimer{id}',[PageController::class, 'destroyCompte'])->name('deleteCompte');
    Route::get('/paramettre/gestion-compte/supprimer{id}',[PageController::class, 'destroyCompte'])->name('deleteCompte');


    // Route::get('/messages/{user_id}/{user_id}', [MessageController::class, 'chatterAvec'])->name('messages.chatterAvec');
    Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
    Route::get('/messages/{user_id}/{user_type}', [MessageController::class, 'chargerMessages'])->name('messages.show');
    Route::post('/messages/envoyer', [MessageController::class, 'envoyerMessage'])->name('messages.envoyer');
});

Route::get('/admin',[AdminUserController::class,'login'])->name('adminLogin');
Route::post('/admin/login',[AdminUserController::class,'logged'])->name('adminLogin');

Route::middleware('auth')->group(function () {
    Route::get('/admin/dashboard',[AdminUserController::class,'index'])->name('adminDashboard');
    Route::get('/admin/gestion-formateur',[AdminUserController::class,'gestFormateur'])->name('admin.gestFormateurs');
    Route::get('/admin/gestion-formateur/attente',[AdminUserController::class,'gestFormateurAttente'])->name('admin.gestFormateurAttente');
    Route::post('/admin/gestion-formateur/valider-formateur/{id}', [AdminUserController::class, 'validerFormateur'])->name('admin.validerFormateur');
    Route::get('/admin/gestion-formateur/attente/show{id}', [AdminUserController::class, 'show'])->name('attente.detail');
    Route::get('/admin/gestion-formateur/formateur/show{id}', [AdminUserController::class, 'actifshow'])->name('formateur.detail');
    Route::put('/admin/gestion-formateur/edit/formateur{id}/activer', [AdminUserController::class, 'activerformateur'])->name('formateur.activation');
    Route::put('/admin/gestion-formateur/edit/formateur{id}/desactiver', [AdminUserController::class, 'desactiverformateur'])->name('formateur.desactivation');    
    Route::put('/admin/changer_pourcentage{id}',[AdminUserController::class,'updatePourcentage'])->name('formateur.updatePourcentage');

    //etudiant **********************************
    Route::get('/admin/gestion-etudiant',[AdminUserController::class,'gestEtudiant'])->name('admin.gestEtudiants');
    Route::get('/admin/gestion-etudiant/detail/etudiant{id}',[AdminUserController::class,'gestEtudiantShow'])->name('admin.gestEtudiantsShow');
    Route::get('/admin/gestion-etudiant/edit/etudiant{id}',[AdminUserController::class,'gestEtudiantEdit'])->name('admin.gestEtudiantsEdit');
    Route::put('/admin/gestion-etudiant/edit/etudiant{id}/activer', [AdminUserController::class, 'activer'])->name('etudiant.activation');
    Route::put('/admin/gestion-etudiant/edit/etudiant{id}/desactiver', [AdminUserController::class, 'desactiver'])->name('etudiant.desactivation');

    
    //categorie*************************************
    Route::get('/admin/gestion-categorie',[CategorieController::class,'index'])->name('gestion.categorie');
    Route::get('/admin/gerer-categorie/create', [CategorieController::class, 'create'])->name('categorie.create');
    Route::post('/admin/gerer-categorie/store', [CategorieController::class, 'store']);
    Route::get('/admin/gerer-categorie/editer{id}', [CategorieController::class, 'edit'])->name('categorie.edit');
    Route::put('/admin/gerer-categorie/editer{id}', [CategorieController::class, 'update'])->name('categorie.update');
    Route::get('/admin/gerer-categorie/suprimer{id}', [CategorieController::class, 'destroy'])->name('categorie.delete');
    Route::get('/admin/gerer-categorie/show{id}', [CategorieController::class, 'show'])->name('categorie.detail');
    Route::get('/admin/gerer-categorie/show', [CategorieController::class, 'retour'])->name('categotie.retour');

    //formation **********************************************************
    Route::get('/admin/gestion-formation',[AdminUserController::class,'gestFormation'])->name('gestion.formation');
    Route::get('/admin/gerer-formation/show{id}', [GestFormationController::class, 'show'])->name('gformation.show');


});

require __DIR__.'/auth.php';
