<?php

use App\Http\Controllers\Cms\PropertyController;
use App\Http\Controllers\Cms\ClientController;
use App\Http\Controllers\Cms\CollaboratorController;
use App\Http\Controllers\Cms\FinancingController;
use App\Http\Controllers\Cms\LoansController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HomeWebController;
use App\Http\Controllers\Cms\PontoController;
use Illuminate\Support\Facades\Auth;
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
    return redirect('cms/login');
});

// Route::get('/web', function () {
//     return redirect('web/home');
// });

Route::group(['prefix' => 'cms'], function () {
    Auth::routes();
});

Route::prefix('cms')->name('cms.')->middleware(['auth'])->group(function () {
    Route::get('home', [HomeController::class, 'index'])->name('home');

    //collaborator
    Route::get('collaborator/report/{id}', [CollaboratorController::class, 'report'])->name('collaborator.report');
    Route::any('collaborator/{id}/edit/delete-file', [CollaboratorController::class, 'fileDestroy'])->name('collaborator.fileDestroy');
    Route::resource('collaborator', CollaboratorController::class);

    //client
    Route::resource('client', ClientController::class);

    //financing
    Route::get('financing/historic/{id}', [FinancingController::class, 'historic'])->name('financing.historic');
    Route::get('financing/download/{id}', [FinancingController::class, 'download'])->name('financing.download');
    Route::get('financing/consulta/{id}', [FinancingController::class, 'consulta'])->name('financing.consulta');
    Route::resource('financing', FinancingController::class);

    //loan
    Route::get('loan/historic/{id}', [LoansController::class, 'historic'])->name('loan.historic');
    Route::get('loan/download/{id}', [LoansController::class, 'download'])->name('loan.download');
    Route::get('loan/consulta/{id}', [LoansController::class, 'consulta'])->name('loan.consulta');
    Route::resource('loan', LoansController::class);

    Route::get('/pontos/relatorio-usuario/{id}', [PontoController::class, 'relatorioUsuario'])->name('pontos.relatorioUsuario');
    Route::resource('pontos', PontoController::class);

    Route::get('properties/view/{id}', [PropertyController::class, 'view'])->name('properties.view');
    Route::resource('properties', PropertyController::class);
});

Route::prefix('web')->name('web.')->group(function () {
    Route::get('home', [HomeWebController::class, 'index'])->name('home');
});

Route::get('/teste', function () {
    return view('cms.inspector.mail');
});
