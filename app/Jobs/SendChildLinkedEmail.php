<?php

namespace App\Jobs;

use App\Mail\ChildLinkedMail;
use App\Models\Childrens;
use App\Models\Parents;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendChildLinkedEmail implements ShouldQueue
{
   use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public Childrens $child,
        public Parents $parent
    ) {}

    public function handle(): void
    {
        Mail::to($this->parent->email)
            ->send(new ChildLinkedMail($this->child, $this->parent));
    }
}