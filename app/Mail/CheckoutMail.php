<?php

declare(strict_types=1);

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Order;
use App\Models\User;

class CheckoutMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    public $order;

    public $user;

    private $keys;

    public function __construct(Order $order, User $user, array $keys)
    {
        $this->order = $order;
        $this->user = $user;
        $this->keys = $keys;
    }

    public function build()
    {
        foreach ($this->order->products as $product) {
            $a = $product->pivot->qty;
        }

        return $this->view('emails.checkout')
            ->subject('Order Confirmation ', $this->user->first_name)
            ->with([
                'order' => $this->order,
                'user'  => $this->user,
                'keys'  => $this->keys,
            ]);
    }
}
