<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use App\Models\User;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        RateLimiter::for('login', function (Request $request) {
            $email = (string) $request->email;
            return Limit::perMinutes(1, 3)->by($email . $request->ip())->response(function () {
                session()->flash('pesan', 'Kembali masuk setelah 1 menit');
                return redirect('/login');
            });
        });

        // RateLimiter::for('two-factor', function (Request $request) {
        //     return Limit::perMinute(5)->by($request->session()->get('login.id'));
        // });

        Fortify::loginView(fn () => view('autentikasi.masuk'));

        Fortify::authenticateUsing(function (Request $request) {
            $user = User::where('email', $request->email)->first();
            $password = $request->password;
            Validator::make(['email' => $request->email], [
                'email' => 'sometimes',
            ])->after(function ($validator) use ($user, $password) {
                if ($user === null) {
                    $validator->errors()->add('email', 'Alamat email tidak terdaftar');
                } elseif (!Hash::check($password, $user->password)) {
                    $validator->errors()->add('password', 'Password yang anda masukkan tidak sesuai');
                }
            })->validateWithBag('default');

            $user = User::where('email', $request->email)->first();
            if ($user && Hash::check($request->password, $user->password)) {
                return $user;
            }
        });

        Fortify::registerView(fn () => view('autentikasi.daftar'));
        Fortify::verifyEmailView(fn () => view('autentikasi.verifikasi-email'));

        Fortify::requestPasswordResetLinkView(fn () => view('autentikasi.verifikasi-email-password'));
        Fortify::resetPasswordView(fn () => view('autentikasi.form-reset-password'));
    }
}
