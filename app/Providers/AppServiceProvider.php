<?php

namespace App\Providers;

use Money\Money;
use Money\Currency;
use Money\Currencies\ISOCurrencies;
use Illuminate\Support\Facades\Blade;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Money\Formatter\IntlMoneyFormatter;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Fortify\Fortify;
use App\Factories\CartFactory;
use App\Actions\WebsShop\MigrateSessionCart;


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
        // Model::unguard();
        // Blade::stringable(function (Money $money) {
        //     $currencies  = new ISOCurrencies();
        //     $numberFormatter = new \NumberFormatter('en_US', \NumberFormatter::CURRENCY);
        //     $moneyFormat = new IntlMoneyFormatter($numberFormatter, $currencies);

        //     echo  $moneyFormat->format($money);
        // });

       // https://laravel.com/docs/12.x/fortify#what-is-fortify
        Fortify::authenticateUsing(function (Request $request) {
            $user = User::where('email', $request->email)->first();

            if (
                $user &&
                Hash::check($request->password, $user->password)
            ) {
                (new MigrateSessionCart)->migrate(
                     CartFactory::make(),
                    $user->cart()->first() ?: $user->cart()->create()
                );
                return $user;
            }
        });


        Blade::stringable(function (Money $money) {
            $money = new Money(100, new Currency('USD'));
            $currencies = new ISOCurrencies();

            $numberFormatter = new \NumberFormatter('en_US', \NumberFormatter::CURRENCY);
            $moneyFormatter = new IntlMoneyFormatter($numberFormatter, $currencies);

            echo $moneyFormatter->format($money);
        });
    }
}
