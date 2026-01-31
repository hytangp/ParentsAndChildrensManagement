<?php

namespace App\Mail;

use App\Models\Childrens;
use App\Models\Parents;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ChildLinkedMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Childrens $child,
        public Parents $parent
    ) {}

    public function build()
    {
        return $this->subject('Child Linked Successfully')
            ->view('emails.child-linked')->with(['child' => $this->child, 'parent' => $this->parent]);
    }
}