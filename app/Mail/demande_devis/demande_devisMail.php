<?php

namespace App\Mail\demande_devis;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class demande_devisMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct($resp_cfp,$module,$resp_etp,$etp)
    {
        $this->module = $module;
        $this->resp_etp = $resp_etp;
        $this->resp_cfp = $resp_cfp;
        $this->etp = $etp;
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->resp_cfp->email_resp_cfp)
            ->subject('Demmande de devis')
            ->view('demande_devis.demande_devis')
            ->with([
                'module' => $this->module,
                'resp_etp' => $this->resp_etp,
                'resp_cfp' => $this->resp_cfp,
                'etp' => $this->etp
            ]);
    }
}
