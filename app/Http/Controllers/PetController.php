<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Models\Doctor;
use App\Models\Owner;
use Illuminate\Http\Request;
use Validator;
use PDF;


class PetController extends Controller
{
    const RESULTS_IN_PAGE = 10;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $doctors = Doctor::orderBy('surname')->get();
        $owners = Owner::orderBy('surname')->get();
        // ->paginate(self::RESULTS_IN_PAGE)
        //->withQueryString();
        if ($request->sort) {
            if ('species' == $request->sort && 'asc' == $request->sort_dir) {
                $pets = Pet::orderBy('species')->paginate(self::RESULTS_IN_PAGE)->withQueryString();
            } else if ('species' == $request->sort && 'desc' == $request->sort_dir) {
                $pets = Pet::orderBy('species', 'desc')->paginate(self::RESULTS_IN_PAGE)->withQueryString();
            } else if ('birth_date' == $request->sort && 'asc' == $request->sort_dir) {
                $pets = Pet::orderBy('birth_date')->paginate(self::RESULTS_IN_PAGE)->withQueryString();
            } else if ('birth_date' == $request->sort && 'desc' == $request->sort_dir) {
                $pets = Pet::orderBy('birth_date', 'desc')->paginate(self::RESULTS_IN_PAGE)->withQueryString();
            } else {
                $pets = Pet::paginate(self::RESULTS_IN_PAGE)->withQueryString();
            }
        } else if ($request->filter && 'doctor' == $request->filter) {
            $pets = Pet::where('doctor_id', $request->doctor_id)->paginate(self::RESULTS_IN_PAGE)->withQueryString();
        } else if ($request->filter && 'owner' == $request->filter) {
            $pets = Pet::where('owner_id', $request->owner_id)->paginate(self::RESULTS_IN_PAGE)->withQueryString();
        } else if ($request->filter && 'species_filter' == $request->filter) {
            $pets = Pet::where('species', $request->species_id)->paginate(self::RESULTS_IN_PAGE)->withQueryString();
        } else if ($request->search && 'all' == $request->search) {
            $pets = Pet::where('birth_date', $request->s)->paginate(self::RESULTS_IN_PAGE)->withQueryString();


            $words = explode(' ', $request->s);

            if (count($words) == 1) {
                $pets = Pet::where('birth_date', 'like', '%' . $request->s . '%')
                    ->orWhere('species', 'like', '%' . $request->s . '%')
                    ->paginate(self::RESULTS_IN_PAGE)->withQueryString();
            } else {
                $pets = Pet::where(function ($query) use ($words) {
                    $query->orWhere('birth_date', 'like', '%' . $words[0] . '%')
                        ->orWhere('species', 'like', '%' . $words[0] . '%');
                })
                    ->where(function ($query) use ($words) {
                        $query->orWhere('birth_date', 'like', '%' . $words[1] . '%')
                            ->orWhere('species', 'like', '%' . $words[1] . '%');
                    })->paginate(self::RESULTS_IN_PAGE)->withQueryString();
            }
        }
        //nieko nesortinam
        else {
            $pets = Pet::paginate(self::RESULTS_IN_PAGE)->withQueryString();
        }

        $petSpeciess = [];
        foreach ($pets as $pet) {

            $petSpeciess[] = $pet->species;
        }
        $petSpeciess = array_unique($petSpeciess);

        return view('pet.index', [
            'pets' => $pets,
            'petSpeciess' => $petSpeciess,
            'sortDirection' => $request->sort_dir ?? 'asc',
            'doctors' => $doctors,
            'doctor_id' => $request->doctor_id ?? '0',
            'owners' => $owners,
            'owner_id' => $request->owner_id ?? '0',
            's' => $request->s ?? ''
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $doctors = Doctor::orderBy('surname', 'asc')->get();
        $owners = Owner::orderBy('surname', 'asc')->get();
        return view('pet.create', ['doctors' => $doctors], ['owners' => $owners]);
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
                'pet_name' => ['required', 'min:3', 'max:255'],
                'pet_species' => ['required', 'min:3', 'max:20'],
                'pet_birth_date' => ['required', 'integer', 'min:1990', 'max:2022'],
                'pet_document' => ['required', 'min:3', 'max:20'],
                'pet_history' => ['required'],
                'doctor_id' => ['required', 'integer', 'min:1', 'max:1000'],
                'owner_id' => ['required', 'integer', 'min:1', 'max:1000'],
            ]
        );
        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }
        $pet = new Pet();
        $pet->name = $request->pet_name;
        $pet->species = $request->pet_species;
        $pet->birth_date = $request->pet_birth_date;
        $pet->document = $request->pet_document;
        $pet->history = str_replace('script', '', $request->pet_history);
        $pet->doctor_id = $request->doctor_id;
        $pet->owner_id = $request->owner_id;
        $pet->save();
        return redirect()
            ->route('pet.index')
            ->with('success_message', 'New pet.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pet  $pet
     * @return \Illuminate\Http\Response
     */
    public function show(Pet $pet)
    {
        return view('pet.show', ['pet' => $pet]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pet  $pet
     * @return \Illuminate\Http\Response
     */
    public function edit(Pet $pet)
    {
        //$doctors = Doctor::all(); // is duombazes paimam nerusiuotus
        // $doctors = $doctors->sortBy('surname');// liepiam laraveliui surusiuoti


        $doctors = Doctor::orderBy('surname', 'asc')->get();
        $owners = Owner::orderBy('surname', 'asc')->get();
        return view('pet.edit', ['pet' => $pet, 'doctors' => $doctors, 'owners' => $owners]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pet  $pet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pet $pet)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'pet_name' => ['required', 'min:3', 'max:255'],
                'pet_species' => ['required', 'min:3', 'max:20'],
                'pet_birth_date' => ['required', 'integer'],
                'pet_document' => ['required', 'min:3', 'max:20'],
                'pet_history' => ['required'],
                'doctor_id' => ['required', 'integer', 'min:1', 'max:1000'],
                'owner_id' => ['required', 'integer', 'min:1', 'max:1000']
            ]
        );
        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }
        $pet->name = $request->pet_name;
        $pet->species = $request->pet_species;
        $pet->birth_date = $request->pet_birth_date;
        $pet->document = $request->pet_document;
        $pet->history = str_replace('script', '', $request->pet_history);
        $pet->doctor_id = $request->doctor_id;
        $pet->owner_id = $request->owner_id;
        $pet->save();
        return redirect()
            ->route('pet.index')
            ->with('success_message', 'Pet updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pet  $pet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pet $pet)
    {
        $pet->delete();
        return redirect()
            ->route('pet.index')
            ->with('success_message', 'The pet was deleted.');
    }
    public function pdf(Pet $pet)
    {
        $pdf = PDF::loadView('pet.pdf', ['pet' => $pet]);
        return $pdf->download($pet->species . '-' . $pet->birth_date . '.pdf');
    }
}