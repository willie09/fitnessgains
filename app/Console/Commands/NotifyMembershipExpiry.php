<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Member;
use App\Notifications\MembershipExpiryNotification;
use Carbon\Carbon;

class NotifyMembershipExpiry extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:membership-expiry';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send notification emails to members whose membership is about to expire';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $today = Carbon::today();
        $thresholdDate = $today->copy()->addDays(7);

        $members = Member::whereBetween('expiry_date', [$today, $thresholdDate])->get();

        foreach ($members as $member) {
            $member->notify(new MembershipExpiryNotification($member));
            $this->info("Notification sent to: {$member->email}");
        }

        return 0;
    }
}
