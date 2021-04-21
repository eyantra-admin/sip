<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use App\Model\Payment;

class PaymentEmail extends Mailable
{
    protected $payment,$name;

    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->payment=$payment;
        $this->name=$name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $trans_date=$this->payment->trans_date;
        if($this->payment->trans_date == NULL)
            $trans_date=$this->payment->recon_date;


        return $this->view('emails.registration.payment')
        ->subject('e-Yantra Summer Internship 2021: Payment Details')
        ->with([
            'amountPaid' => $this->payment->amount,
            'trxId' => $this->payment->trans_id,
            'trxDate' => $trans_date,
            'remark' => $this->payment->remark,
            'name'=> $this->name,
        ]);
    }
}
