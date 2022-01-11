<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

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
            'name'      => ['required', 'string', 'max:255'],
            'username'  => ['required', 'string', 'max:255'],
            'telp'      => ['required', 'string', 'max:15'],
            'email'     => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'  => $this->passwordRules(),
            'password_confirmation' => 'required',
            'terms'     => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
        ])->validate();

        return User::create([
            'name'      => $input['name'],
            'username'  => $input['username'],
            'email'     => $input['email'],
            'telp'      => $input['telp'],
            'role'      => 'user',
            'password'  => Hash::make($input['password']),
        ]);
    }
}
