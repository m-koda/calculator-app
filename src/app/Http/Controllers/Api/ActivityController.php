<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Activity;

class ActivityController extends Controller
{
    public function store(Request $request)
    {
        $activity = new Activity();
        $activity->user_id = $request->user()->id;
        $activity->fill($request->all())->save();
    }
}
