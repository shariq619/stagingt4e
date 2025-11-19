<?php

namespace App\Observers;

use App\Events\LearnerStatusUpdated;
use App\Models\FrontOrderDetails;

class FrontOrderDetailsObserver
{
    public function updated(FrontOrderDetails $model)
    {
        if ($model->wasChanged('course_status') && $model->learner) {
            event(new LearnerStatusUpdated(
                $model->learner,
                $model->course_status,
                $model
            ));
        }
    }
}
