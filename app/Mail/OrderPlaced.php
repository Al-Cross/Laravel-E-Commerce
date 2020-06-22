<?php

namespace App\Mail;

use App\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderPlaced extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $email;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Order $order, $email = null)
    {
        $this->order = $order;
        $this->email = $email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if ($this->email) {
            return $this->to($this->email, $this->order->billing_name)
                ->subject('Order For Laravel E-Commerce')
                ->markdown('emails.order_placed');
        }

        return $this->to($this->order->billing_email, $this->order->billing_name)
            ->subject('Order For Laravel E-Commerce')
            ->markdown('emails.order_placed');
    }
}
