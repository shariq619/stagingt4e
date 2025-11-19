<?php

namespace App\Events;

use App\Models\User;
use App\Models\FrontOrderDetails;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class LearnerStatusUpdated
{
    use Dispatchable, SerializesModels;

    public $learner;
    public $newStatus;
    public $orderDetail;

    public function __construct(User $learner, string $newStatus, FrontOrderDetails $orderDetail)
    {
        $this->learner = $learner;
        $this->newStatus = $newStatus;
        $this->orderDetail = $orderDetail;
    }
}
