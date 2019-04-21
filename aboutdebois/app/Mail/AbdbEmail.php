<?php

namespace App\Mail;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AbdbEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected $request;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        //
        $this->request = $request;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $validate = $this->request->validate([
            'object' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string'
        ]);
        $date = Carbon::now()->locale('fr_FR')->isoFormat('LLLL');
        return $this->markdown('emails.information', compact('validate', 'date'));
    }
}