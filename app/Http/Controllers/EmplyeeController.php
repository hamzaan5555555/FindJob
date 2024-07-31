<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmplyeeRequest;
use App\Http\Requests\UpdateEmplyeeRequest;
use App\Models\Admin;
use App\Models\Emplyee;
use App\Models\Emplyer;

use App\Models\JobApplication;
use App\Models\SavedJob;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class EmplyeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Emplyee::where('user_id', Auth::user()->id)->get();
        return view('front.account.employee.employee-info', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmplyeeRequest $request)
    {

    }

    /**
     * Display the specified resource.
     */
    public function show(Emplyee $emplyee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Emplyee $emplyee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmplyeeRequest $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'education' => 'required',
            'experience' => 'required',
            'certification' => 'required',
            'cv' => 'required|image',
        ]);

        $userID = Auth::id();
        if ($validator->passes()) {
            $employee = Emplyee::find($id);

            $employee->educations = $request->education;
            $employee->experiences = $request->experience;
            $employee->certifications = $request->certification;
            $employee->website = $request->website;
            $employee->github = $request->github;
            $employee->twitter = $request->twitter;
            if ($request->hasFile('cv')) {
                $cv = $request->file('cv');
                $cvName = $userID . '-' . time() . '.' . $cv->getClientOriginalExtension();
                $cv->storeAs('public/cv', $cvName);
                $employee->cv = $cvName;
            }


           $employee->save();

            return redirect()->back()->with('success', 'Skills updated successfully!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Emplyee $emplyee)
    {
        //
    }

    public function appliedJob()
    {
        $user_id = Auth::id();
        $jobApplications = JobApplication::where('user_id', $user_id)->orderBy('created_at', 'DESC')->get();
        return view('front.account.job.job-application', compact('jobApplications'));
    }

    public function savedJob()
    {
        $user_id = Auth::id();
        $jobSaved = SavedJob::where('user_id', $user_id)->orderBy('created_at', 'DESC')->get();
        return view('front.account.job.job-save', compact('jobSaved'));
    }

    public function removeJob()
    {
        $jobApp = new JobApplication();
        $jobApplication = JobApplication::where([
            ['user_id', Auth::user()->id],
        ])->first();


        $jobApplication->delete();

        session()->flash('success', 'Your application for this job has been removed successfully.');
        return redirect()->back();
    }

    public function removeSavedJob()
    {
        $jobSave = new JobApplication();
        $jobSaved = SavedJob::where([
            ['user_id', Auth::user()->id],
        ])->first();


        $jobSaved->delete();

        session()->flash('success', 'Your saved job has been removed successfully.');
        return redirect()->back();
    }
}
