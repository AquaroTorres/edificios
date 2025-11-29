<?php

use App\Models\Certificate;
use App\Models\Income;
use App\Models\Minute;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return redirect()->route('filament.admin.auth.login');
})->name('login');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/admin/finance/income/pdf/{income}', function (Income $income): Response {
        return $income->generatePdf()->stream("comprobante_pago_{$income->id}.pdf");
    })->name('admin.finance.incomes.pdf');

    Route::get('/admin/members/minutes/pdf/{minute}', function (Minute $minute): Response {
        return $minute->generatePdf()->stream("acta_{$minute->id}.pdf");
    })->name('admin.members.minutes.pdf');

    Route::get('/admin/members/users/pdf/{user}', function (User $user): Response {
        return $user->generatePdf()->stream("usuario_{$user->id}.pdf");
    })->name('admin.members.users.pdf');

    Route::get('/admin/members/certificates/pdf/{certificate}', function (Certificate $certificate): Response {
        return $certificate->generatePdf()->stream("certificado_{$certificate->id}.pdf");
    })->name('admin.members.certificates.pdf');
});

// Route::get('/notification', function () {
//     $income = Income::find(100);

//     return (new IncomeRegistered($income))
//         ->toMail(auth()->user());
// });
