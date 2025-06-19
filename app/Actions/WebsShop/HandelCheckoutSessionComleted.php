<?php 

namespace App\Actions\WebsShop;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Laravel\Cashier\Cashier;
use App\Models\User;
use BaconQrCode\Renderer\Path\Line;
use Stripe\LineItem;
use App\Models\OrderItem;

//The value of a good database model: https://tray2.se/posts/database-design
class HandelCheckoutSessionComleted
{
    public function handle($sessionId)
    {
        // DB::transaction : If any part fails, the entire transaction is rolled back 
        DB::transaction(function  () use ($sessionId) {
            
        // https://laravel.com/docs/11.x/billing#using-the-stripe-client
        $session = Cashier::stripe()->checkout->sessions->retrieve($sessionId);
        $user = User::find($session->metadata->user_id);
        $cart = Cart::find($session->metadata->cart_id);
        // total_details Link resource: https://docs.stripe.com/api/checkout/sessions/object#checkout_session_object-total_details
        $order = $user->orders()->create([
            'stripe_checkout_session_id' => $session->id,
            'stripe_checkout_id' => $session->id,
            'amount_shipping' => $session->total_details->amount_shipping,
            'amount_discount' => $session->total_details->amount_discount,
            'amount_tax' => $session->total_details->amount_tax,
            'amount_subtotal' => $session->amount_subtotal,
            'amount_total' => $session->amount_total,
            // Customer details Link resource: https://docs.stripe.com/api/checkout/sessions/object#checkout_session_object-customer_details
            'billing_address' => [
                'name' => $session->customer_details->address->name,
                'city' => $session->customer_details->address->city,
                'country' => $session->customer_details->address->country,
                'line1' => $session->customer_details->address->line1,
                'line2' => $session->customer_details->address->line2,
                'postal_code' => $session->customer_details->address->postal_code,
                'state' => $session->customer_details->address->state,
            ],
            'shipping_address' => [
                'name' => $session->shipping_details->address->name,
                'city' => $session->shipping_details->address->city,
                'country' => $session->shipping_details->address->country,
                'line1' => $session->shipping_details->address->line1,
                'line2' => $session->shipping_details->address->line2,
                'postal_code' => $session->shipping_details->address->postal_code,
                'state' => $session->shipping_details->address->state,
            ],
          
        ])  ;

        // allLineItems: https://stripe.com/docs/api/checkout/sessions/object#checkout_session_object-line_items
        //allLineItems: تُرجع كل العناصر المرتبطة بالجلسة، باستخدام endpoint خاص في Stripe وهو paginated
        $lineItems = Cashier::stripe()->checkout->sessions->allLineItems($session->id);
        //  $lineItems = $stripe->checkout->sessions->allLineItems($sessionId);

        $orderItems = collect($lineItems->all())->map(function (LineItem $lineItem){
            $product = Cashier::stripe()->products->retrieve($lineItem->price->product);

            return new OrderItem ( [
                // 'order_id' => $order->id,
                'product_variant_id' => $product->metadata->product_variant_id,
                'name' => $product->name,
                'description' => $product->description,
                'price' => $lineItem->price->unit_amount,
                'quantity' => $lineItem->quantity,
                'amount_discount' => $lineItem->discount_amount,
                'amount_subtotal' => $lineItem->amount_subtotal,
                'amount_total' => $lineItem->amount_total,
                'amount_tax' => $lineItem->tax_amount
            ]);
        });
        
        
        $order->items()->saveMany($orderItems);
    
        $cart->items()->delete();
        $cart->delete();
    });

    }
    
}