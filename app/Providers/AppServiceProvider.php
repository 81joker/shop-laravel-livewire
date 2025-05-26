<?php

namespace App\Providers;

use Money\Money;
use Money\Currency;
use Money\Currencies\ISOCurrencies;
use Illuminate\Support\Facades\Blade;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Money\Formatter\IntlMoneyFormatter;




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
        Blade::stringable(function (Money $money) {
            $money = new Money(100, new Currency('USD'));
            $currencies = new ISOCurrencies();

            $numberFormatter = new \NumberFormatter('en_US', \NumberFormatter::CURRENCY);
            $moneyFormatter = new IntlMoneyFormatter($numberFormatter, $currencies);

            echo $moneyFormatter->format($money);
        });
    }
}
