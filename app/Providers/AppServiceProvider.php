<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
<<<<<<< HEAD
use Illuminate\Pagination\Paginator;
=======
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
 
>>>>>>> 51c56f78b371845e08e503a1345fe618db601af4

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    public function boot()
    {
<<<<<<< HEAD
       Paginator::useBootstrap(); 
=======
        //
        VerifyEmail::toMailUsing(function (object $notifiable, string $url) {
            return (new MailMessage)
                ->subject('Verify Email Address"111')
                ->line('Click the button below to verify your email address.')
                ->action('Verify Email Address', $url);
        });
>>>>>>> 51c56f78b371845e08e503a1345fe618db601af4
    }

}
