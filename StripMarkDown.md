

# StripMarkDown

1- stripo login command [link](https://github.com/stripo/stripo-cli)
    After the install the give me 30 days free trial.
A- Download Stripe CLI manually  
```bash
wget https://github.com/stripe/stripe-cli/releases/latest/download/stripe_1.27.0_linux_x86_64.tar.gz
```

B- Extract the archive  
```bash
tar -xzf stripe_1.27.0_linux_x86_64.tar.gz
```

C- Move the binary to a directory in PATH  
```bash
sudo mv stripe /usr/local/bin/
```

D- Verify installation  
```bash
stripe --version
```

E- Run the command  
```bash
stripe login
```


2- Install Laravel Cashier (Stripe) [link](https://laravel.com/docs/12.x/billing)

A- First, install the Cashier package for Stripe   
```bash
sail composer require laravel/cashier
```
B- Then, migrate your database:  
```bash
sail artisan migrate
```
C- Configuration Billable Models 
```bash
use Laravel\Cashier\Billable;

class User extends Authenticatable
{
    use Billable;
}
```

D- Configuration and Define Stripe Keys 
```bash
STRIPE_KEY=your-stripe-key
STRIPE_SECRET=your-stripe-secret
STRIPE_WEBHOOK_SECRET=your-stripe-webhook-secret
```

E- I can also change the default  Currency Configuration 
```bash
CASHIER_CURRENCY=eur
```

F- I install Stripe Webhooks 
 wha are Stripe webhooks? Stripe webhooks are essential for keeping your Laravel application in sync with Stripe's events, allowing for automated updates and real-time interactions with your users. They enhance the functionality of your billing system by ensuring that all changes are accurately reflected in your application.
 
```bash
stripe listen --forward-to=http://localhost/stripe/webhooks --format=json
```
Then copy the secret key from Stripe and add it to the .env file.

3- Create a Stripe Checkout Session  [link](https://docs.stripe.com/api/checkout/sessions/create)
[Laracast Explain ](https://laracasts.com/series/build-a-web-shop-from-a-z/episodes/22)
```bash
stripe checkout sessions create \
  --payment-method-types card \
  --mode payment \
  --success-url http://localhost/stripe/success \
  --cancel-url http://localhost/stripe/cancel \
  --line-items mode=payment \
  --line-items price=price_1Nc2m2DZ8Mkfnho2BsiwbOyr \