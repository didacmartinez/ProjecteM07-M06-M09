<?php
use App\Http\Controllers\MailController;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\FileController;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\PostController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::resource('places', PlaceController::class);
Route::resource('posts', PostController::class);

Route::resource('files', FileController::class)->middleware(['auth', 'role:2']);


Route::get('files/edit/{file}', [FileController::class, 'edit'])->name('files.edit');

Route::get('mail/test', [MailController::class, 'test']);

    
Route::get('/dashboard', function (Request $request) {
   $request->session()->flash('info', 'TEST flash messages');
   return view('dashboard');
})->middleware(['auth','verified'])->name('dashboard');;

Route::get('/', function (Request $request) {
    $message = 'Loading welcome page';
    Log::info($message);
    $request->session()->flash('info', $message);
    return view('welcome');
 });



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
