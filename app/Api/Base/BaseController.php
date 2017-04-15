<?php

namespace App\Api\Base;

use Dingo\Api\Routing\Helpers;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class BaseController extends Controller
{
    use Helpers, AuthorizesRequests, DispatchesJobs, ValidatesRequests, SendsPasswordResetEmails;
}