<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Models\Profile;
use Illuminate\Support\Facades\DB;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $teachers = Profile::select('t.id', 'fname', 'lname')
            ->leftjoin('teachers as t', 't.id', 'teacher_id')
            ->where('school_id', $request->school_id)
            ->get();

        return response(['teachers' => $teachers], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
       $teacher = DB::table('teachers as t')
        ->select(
        'd.district_name as district',
        's.school_name as school', 
        'p.grade_id as grade',
        'subject_id as subject',
        't.fname as tfn',
        't.lname as tln',
        't.email as tem',
        'c.fname as cfn',
        'c.lname as cln',
        'c.email as cem'
        )
        ->leftJoin('profiles as p', 'p.teacher_id', 't.id')
        ->leftJoin('schools as s', 's.id', 'p.school_id')
        ->leftJoin('districts as d', 'd.nces_district_id', 's.nces_district_id')
        ->leftJoin('coaches as c', 'c.id', 'p.coach_id')
        ->where('t.id', $request->id)
        ->first();

        return $teacher;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function edit(Teacher $teacher)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Teacher $teacher)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Teacher $teacher)
    {
        //
    }
}
