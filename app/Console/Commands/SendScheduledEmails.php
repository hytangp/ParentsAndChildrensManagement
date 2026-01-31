<?php

namespace App\Console\Commands;

use App\Jobs\SendChildLinkedEmail;
use App\Models\ParentsChildrens;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SendScheduledEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'emails:send-scheduled';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $getParentsUpdated = ParentsChildrens::where('created_at', '<', Carbon::now())
            ->where('sent', 0)
            ->get();

        foreach($getParentsUpdated as $parent_child){
            if(!empty($parent_child->children) && !empty($parent_child->parent)){
                SendChildLinkedEmail::dispatch($parent_child->children, $parent_child->parent)->delay(now()->addMinutes(5));
    
                $parent_child->sent = 1;
                $parent_child->save();
            }
        }
    }
}