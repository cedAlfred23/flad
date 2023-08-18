<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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

Route::get('/', function () {
    $jobs = DB::table('jobs')->get();
    $full = DB::table('jobs')->where('type','fullTime')->get();
    $part = DB::table('jobs')->where('type','free')->get();
    return view('welcome',[
        'jobs' => $jobs,
        'full' => $full,
        'part' => $part
    ]);
});

Route::get('/create/job', function () {
    return view('form');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/detail', function () {
    return view('detail');
});

Route::post('store/job', function (Request $request) {
    DB::table('jobs') -> insert(
        [
        'id' => bin2hex(random_bytes(10)),
        'title' => $request->jobTitle,
        'location' => $request->jobLocation,
        'type' => $request->jobType,
        'salaryRange1' => $request->salaryRange1,
        'salaryRange2' => $request->salaryRange2,
        'jobDescription' => $request->jobDescription,
        'deadline' => $request->deadline,
        'responsabilities' => json_encode($request->responsibilities),
        'qualifications' => json_encode($request->qualifications),
        ]
    )
    ;

    return back()->with('ok',"The job post is successful");
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
