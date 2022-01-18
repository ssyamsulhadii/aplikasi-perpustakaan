<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'nama' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => $this->passwordRules(),
        ], [
            'password.confirmed' => 'Konfirmasi password tidak sesuai.',
            'email.unique' => 'Alamat email sudah terdaftar.'
        ])->validate();

        $user = User::create([
            'nama' => $input['nama'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'email_verified_at' => now(),
            'telpon' => "-",
            'alamat' => "-",
        ]);
        $user->anggota()->create();

        return $user;
    }
}