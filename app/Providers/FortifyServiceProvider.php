<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider
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
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        RateLimiter::for('login', function (Request $request) {
            $email = (string) $request->email;

            return Limit::perMinute(5)->by($email.$request->ip());
        });

        // RateLimiter::for('two-factor', function (Request $request) {
        //     return Limit::perMinute(5)->by($request->session()->get('login.id'));
        // });

        // set login view dengan punya kita
        Fortify::loginView(fn() => view('auth.login'));

        // set register view 
        Fortify::registerView(fn() => view('auth.register') );

        // Fortify::verifyEmailView(fn() => view('auth.verify'));

        Fortify::requestPasswordResetLinkView(fn() => view('auth.forgot-password'));

        Fortify::resetPasswordView(function(Request $request) {
            return view('auth.reset-password', compact('request'));
        });

        // Custom logika autentikasi
        // Fortify::authenticateUsing(function ($id) {
        //     // Logika Autentikasi
        // });
    }
}
