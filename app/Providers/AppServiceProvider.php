<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use App\Rules\Recaptcha;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Mendaftarkan validasi reCAPTCHA sebagai custom rule
        Validator::extend('recaptcha', function ($attribute, $value, $parameters, $validator) {
            return (new Recaptcha())->passes($attribute, $value);
        });
    }
}
