<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Laravel\Cashier\Events\WebhookReceived;
use Stripe\Webhook;

class StripeEventListener
{


    /**
     * Handle the event.
     */
    public function handle(WebhookReceived $event): void
    {
        // I need more information about the event !!!
        if ($event->payload['type'] === 'checkout.session.completed') {
            // Handle the checkout session completed event
            $session = $event->payload['data']['object']['id'];
            // You can access session details like $session['id'], $session['amount_total'], etc.
            // Perform your logic here, e.g., updating order status, sending confirmation emails, etc.

            (new \App\Actions\WebsShop\HandelCheckoutSessionComleted())->handle($session);
        }
        // elseif ($event->payload['type'] === 'invoice.payment_succeeded') {
          
        // }
    }
}
// $event->payload['type']; // 'checkout.session.completed'
// $event->payload['data']['object']['id']; // 'cs_test_12345'
/*
🔁 كيف تتم العملية بالكامل:
✅ يحدث حدث داخل Stripe
مثلاً: أحد العملاء يكمل عملية الدفع.

🔔 ترسل Stripe طلب Webhook
ترسل Stripe طلب HTTP POST إلى عنوان معين في تطبيقك (مثل: /stripe/webhook).

📩 تستقبل Laravel هذا الطلب
Laravel Cashier يستقبل الطلب ويحوّله إلى حدث اسمه WebhookReceived ويحمل كل بيانات الـ Webhook.

🧠 يتم استدعاء الـ Listener الخاص بك
الكلاس StripeEventListener يستمع لهذا الحدث، ويتم تمرير المتغير $event إليه.

📦 في هذه اللحظة يكون:

php
Kopieren
Bearbeiten
$event->payload['type']
متاحًا، ويُخبرك ما نوع الحدث الذي أرسلته Stripe مثل:

checkout.session.completed (إتمام جلسة الدفع)

invoice.payment_succeeded (نجاح دفع الفاتورة)

customer.subscription.updated (تحديث الاشتراك)

وغيرها...

*/