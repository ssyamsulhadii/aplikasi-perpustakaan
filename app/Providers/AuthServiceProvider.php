<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Lang;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        VerifyEmail::toMailUsing(function (User $user, string $verificationUrl) {
            $message = new MailMessage;
            $message->subject(Lang::get('Verifikasi Email'))
                ->greeting('Hei, ' . $user->nama . '!')
                ->line(Lang::get('Berhasil melakukan pendaftaran. Sekarang email kamu sudah terdaftar di website Dinas Kearsipan dan Perpustakaan Kota kapuas. Tekan tombol dibawah untuk masuk kewebsite...!'))
                ->action(Lang::get('Aplikasi Perpustakaan'), "#")
                ->line(Lang::get('Bilka kamu memiliki pertanyaan, silakan menghubungi kami di 082290901212'))
                ->salutation('Salam : Sahabat Membaca');
            return ($message);
        });

        ResetPassword::toMailUsing(function (User $user, string $url) {
            $message = new MailMessage;
            $message->subject(Lang::get('Reset Password'))
                ->greeting('Hei, ' . $user->nama . '!')
                ->line(Lang::get('Untuk mereset password kamu, silakan klik tautan tombol dibawah ini.'))
                ->action(Lang::get('Reset Password'), route('password.reset', ['token' => $url]))
                ->line(Lang::get('Tautan ini hanya berlaku :count menit.', ['count' => config('auth.passwords.' . config('auth.defaults.passwords') . '.expire')]))
                ->salutation('Terimakasih.');
            return ($message);
        });
    }
}