<?php

namespace App\Console\Commands;

use App\Models\EmailLog;
use App\Models\Website;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendPostEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-post-emails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send emails to subscribers about new posts';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $websites = Website::with(['posts', 'subscriptions'])->get();

        foreach ($websites as $website) {
            $posts = $website->posts;
            $subscriptions = $website->subscriptions;
        
            if ($posts->isEmpty() || $subscriptions->isEmpty()) {
                continue;
            }
            
            foreach ($posts as $post) {
                foreach ($subscriptions as $subscription) {
                    $alreadyEmailed = EmailLog::where('post_id', $post->id)
                                              ->where('subscription_id', $subscription->id)
                                              ->exists();
                    if (!$alreadyEmailed) {
                        Mail::to($subscription->email)->send(new \App\Mail\PostNotification($post));
                            EmailLog::create([
                                'post_id' => $post->id,
                                'subscription_id' => $subscription->id,
                            ]);
                    }
                }
            }
        }
    
        $this->info('Emails sent successfully.');
        return Command::SUCCESS;
                        
            
    }
}
