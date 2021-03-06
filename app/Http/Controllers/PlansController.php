<?php

namespace App\Http\Controllers;

use App\Fee;
use App\Plan;
use App\Service;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PlansController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Plan $plan)
    {
        $columns = $plan->prepareTableColumns();
        $rows = $plan->prepareTableRows($plan->orderBy('name','asc')->get());
        return view('plans.index',compact(['columns','rows']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Plan $plan, Fee $fee, Service $service)
    {
        $fee_columns = $fee->prepareTableSelectColumns();
        // Pre
        $pre_fee_rows = $fee->prepareTableSelectRows($fee->orderBy('name','asc')->get());
        // Post
        $post_fee_rows =  $fee->prepareTableSelectPostRows($fee->orderBy('name','asc')->get());
        // Cancel
        $cancel_fee_rows =  $fee->prepareTableSelectCancelRows($fee->orderBy('name','asc')->get());
        $service_columns = $service->prepareTableSelectColumns();
        $service_rows = $service->prepareTableSelectRows($service->orderBy('name','asc')->get());
        return view('plans.create',compact(['fee_columns','pre_fee_rows','post_fee_rows','cancel_fee_rows','service_columns','service_rows']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Plan $plan)
    {
        //Validate the form
        $this->validate(request(), [
            'name' => 'required|string|max:255',
            'desc' => 'required|string',
            'start'=>'required',
            'end'=>'required'
        ]); 
        // save plan
        $request->status = 1;
        $request->start = date('Y-m-d 00:00:00',strtotime($request->start));
        $request->end = date('Y-m-d 23:59:59',strtotime($request->end));
        $save = $plan->create([
            'name'=>$request->name,
            'desc'=>$request->desc,
            'pre'=>$request->pre,
            'price'=>$request->price,
            'post'=>$request->post,
            'cancel'=>$request->cancel,
            'hourly'=>$request->hourly,
            'daily'=>$request->daily,
            'weekly'=>$request->weekly,
            'monthly'=>$request->monthly,
            'yearly'=>$request->yearly,
            'start'=>$request->start,
            'end'=>$request->end
        ]);

            
        if ($save) {
            // save pre_fee_plan if exists
            $pre_plans = request()->preFeePlan;
            if (count($pre_plans) > 0) {
                foreach ($pre_plans as $fee_id) {
                    $save->preFees()->attach($fee_id);
                }
            }

            // save cancel_fee_plan if exists
            $cancel_plans = request()->cancelFeePlan;
            if (count($cancel_plans) > 0) {
                foreach ($cancel_plans as $cancel_id) {
                    $save->cancelFees()->attach($cancel_id);
                }
            }

            // save post_fee_plan if exists
            $post_plans = request()->postFeePlan;
            if (count($post_plans) > 0) {
                foreach ($post_plans as $post_id) {
                    $save->postFees()->attach($post_id);
                }
            }

            // save plan_services if exists
            $plan_services = request()->planService;
            if (count($plan_services) > 0) {
                foreach ($plan_services as $service_id) {
                    $save->serviceFees()->attach($service_id);
                }
            }

            flash('Successfully saved a new plan!')->success();
            return redirect()->route('plans_index');
        }
        

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function show(Plan $plan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function edit(Plan $plan, Fee $fee, Service $service)
    {
        $fee_columns = $fee->prepareTableSelectColumns();
        // Pre
        $pre_fee_rows = $fee->prepareTableSelectRows($fee->orderBy('name','asc')->get());
        // Post
        $post_fee_rows =  $fee->prepareTableSelectPostRows($fee->orderBy('name','asc')->get());
        // Cancel
        $cancel_fee_rows =  $fee->prepareTableSelectCancelRows($fee->orderBy('name','asc')->get());
        $service_columns = $service->prepareTableSelectColumns();
        $service_rows = $service->prepareTableSelectRows($service->orderBy('name','asc')->get());
        return view('plans.edit',compact(['plan','fee_columns','pre_fee_rows','post_fee_rows','cancel_fee_rows','service_columns','service_rows']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Plan $plan)
    {
        //Validate the form
        $this->validate(request(), [
            'name' => 'required|string|max:255',
            'desc' => 'required|string',
            'start'=>'required',
            'end'=>'required'
        ]); 
        // save plan
        $request->status = 1;
        $request->start = date('Y-m-d 00:00:00',strtotime($request->start));
        $request->end = date('Y-m-d 23:59:59',strtotime($request->end));
        $save = $plan->update([
            'name'=>$request->name,
            'desc'=>$request->desc,
            'pre'=>$request->pre,
            'price'=>$request->price,
            'post'=>$request->post,
            'cancel'=>$request->cancel,
            'hourly'=>$request->hourly,
            'daily'=>$request->daily,
            'weekly'=>$request->weekly,
            'monthly'=>$request->monthly,
            'yearly'=>$request->yearly,
            'start'=>$request->start,
            'end'=>$request->end
        ]);

            
        if ($save) {
            // save pre_fee_plan if exists
            $pre_plans = request()->preFeePlan;
            if (count($pre_plans) > 0) {
                foreach ($pre_plans as $fee_id) {
                    $hasPivot = $plan->preFees()->where('fee_id',$fee_id)->exists();
                    if ($hasPivot) {
                        $plan->preFees()->detach();
                        // $plan->preFees()->updateExistingPivot($fee_id, ['fee_id'=>2]);
                    } 
                    $plan->preFees()->attach($fee_id);
                    
                }
            }

            // save cancel_fee_plan if exists
            $cancel_plans = request()->cancelFeePlan;
            if (count($cancel_plans) > 0) {
                foreach ($cancel_plans as $cancel_id) {
                    $hasPivot = $plan->cancelFees()->where('fee_id',$cancel_id)->exists();
                    if ($hasPivot) {
                        $plan->cancelFees()->detach();
                    } 
                    $plan->cancelFees()->attach($cancel_id);
                }
            }

            // save post_fee_plan if exists
            $post_plans = request()->postFeePlan;
            if (count($post_plans) > 0) {
                foreach ($post_plans as $post_id) {
                    $hasPivot = $plan->postFees()->where('fee_id',$post_id)->exists();
                    if ($hasPivot) {
                        $plan->postFees()->detach();
                    } 
                    $plan->postFees()->attach($post_id);
                }
            }

            // save plan_services if exists
            $plan_services = request()->planService;
            if (count($plan_services) > 0) {
                foreach ($plan_services as $service_id) {
                    $hasPivot = $plan->serviceFees()->where('service_id',$service_id)->exists();
                    if ($hasPivot) {
                        $plan->serviceFees()->detach();
                    } 
                    $plan->serviceFees()->attach($service_id);
                }
            }

            flash('Successfully updated a plan!')->success();
            return redirect()->route('plans_index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Plan $plan)
    {
        $delete = $plan->delete();
        if ($delete) {
            // remove pivot relationships
            // $plan->preFees()->detach();
            // $plan->postFees()->detach();
            // $plan->cancelFees()->detach();
            // $plan->serviceFees()->detach();
            flash('Successfully removed Plan from system')->success();
            return redirect()->back();
        }
    }

    
}
