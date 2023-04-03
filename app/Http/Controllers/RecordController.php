<?php

namespace App\Http\Controllers;

use App\Models\MainCategory;
use App\Models\StudyRecord;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\RecordService;
use App\Http\Requests\StoreStudyRecordRequest;

class RecordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $user = User::find(Auth::id());

        $recordService = app()->make(RecordService::class);
        $records = $recordService->getTodayRecords($user);

        $todays_records = StudyRecord::fetchTodayRecord($user->id);
        $this_month_records = StudyRecord::fetchThisMonthRecord($user->id);

        $todays_total_study_time = $todays_records->sum('minute');
        $this_month_total_study_time = $this_month_records->sum('minute');

        return view('records.index', compact('records', 'todays_total_study_time', 'this_month_total_study_time'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        $main_categories = MainCategory::where('user_id', Auth::id())->get();

        $sub_categories = new Collection();
        foreach ($main_categories as $main_category) {
            $sub_categories = $sub_categories->merge($main_category->SubCategories);
        }

        return view('records.create', compact('sub_categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreStudyRecordRequest  $request
     */
    public function store(StoreStudyRecordRequest $request)
    {
        $study_record = new StudyRecord();
        $study_record->fill($request->all());
        $study_record->user_id = Auth::id();
        $study_record->save();

        return redirect()->route('records.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     */
    public function destroy($id)
    {
        //
    }
}
