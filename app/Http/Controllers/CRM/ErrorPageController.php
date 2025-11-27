<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Controller;

class ErrorPageController extends Controller
{
    public function notFound()
    {
        return response()
            ->view('crm.errors.fallback', [], 404);
    }
}
