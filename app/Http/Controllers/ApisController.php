<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Job;

class ApisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('apis.index');
    }

    public function clients()
    {
        return view('apis.clients');
    }

    public function tokens()
    {
        return view('apis.tokens');
    }

    public function charts($type, Job $job)
    {
        $data = $job->prepareChartData($type);

        return response()->json($data);
    }

}
