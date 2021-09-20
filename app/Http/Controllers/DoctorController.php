<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Pet;
use App\Models\Owner;
use Illuminate\Http\Request;
use Validator;

class DoctorController extends Controller
{
    const RESULTS_IN_PAGE = 10;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $doctors = Doctor::orderBy('surname', 'desc')->get();
        // ->paginate(self::RESULTS_IN_PAGE);

        return view('doctor.index', ['doctors' => $doctors]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('doctor.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'doctor_name' => ['required', 'min:3', 'max:64'],
                'doctor_surname' => ['required', 'min:3', 'max:64'],
                'doctor_category' => ['required', 'min:3', 'max:32']
            ]
        );
        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }
        $doctor = new Doctor;
        $doctor->name = $request->doctor_name;
        $doctor->surname = $request->doctor_surname;
        $doctor->category = $request->doctor_category;
        $doctor->save();
        return redirect()
            ->route('doctor.index')
            ->with('success_message', 'New doctor has arrived.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function show(Doctor $doctor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function edit(Doctor $doctor)
    {
        return view('doctor.edit', ['doctor' => $doctor]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Doctor $doctor)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'doctor_name' => ['required', 'min:3', 'max:64'],
                'doctor_surname' => ['required', 'min:3', 'max:64'],
                'doctor_category' => ['required', 'min:3', 'max:32']
            ]
        );
        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }
        $doctor->name = $request->doctor_name;
        $doctor->surname = $request->doctor_surname;
        $doctor->save();
        return redirect()
            ->route('doctor.index')
            ->with('success_message', 'The doctor was updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Doctor $doctor)
    {
        if ($doctor->doctorPets->count()) {
            return redirect()
                ->route('doctor.index')
                ->with('info_message', 'Action denied.');
        }
        $doctor->delete();
        return redirect()
            ->route('doctor.index')
            ->with('success_message', 'The doctor has gone.');
    }
}