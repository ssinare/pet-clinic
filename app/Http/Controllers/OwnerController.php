<?php

namespace App\Http\Controllers;

use App\Models\Owner;
use Illuminate\Http\Request;
use Validator;

class OwnerController extends Controller
{
    const RESULTS_IN_PAGE = 10;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $owners = Owner::orderBy('surname', 'desc')->get();
        // ->paginate(self::RESULTS_IN_PAGE);

        return view('owner.index', ['owners' => $owners]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('owner.create');
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
                'owner_name' => ['required', 'min:3', 'max:64'],
                'owner_surname' => ['required', 'min:3', 'max:64'],
                'owner_contacts' => ['required']
            ]
        );
        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }
        $owner = new Owner;
        $owner->name = $request->owner_name;
        $owner->surname = $request->owner_surname;
        $owner->contacts = $request->owner_contacts;
        $owner->save();
        return redirect()
            ->route('owner.index')
            ->with('success_message', 'New owner has arrived.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Owner  $owner
     * @return \Illuminate\Http\Response
     */
    public function show(Owner $owner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Owner  $owner
     * @return \Illuminate\Http\Response
     */
    public function edit(Owner $owner)
    {
        return view('owner.edit', ['owner' => $owner]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Owner  $owner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Owner $owner)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'owner_name' => ['required', 'min:3', 'max:64'],
                'owner_surname' => ['required', 'min:3', 'max:64'],
                'owner_contacts' => ['required']
            ]
        );
        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }
        $owner->name = $request->owner_name;
        $owner->surname = $request->owner_surname;
        $owner->contacts = $request->owner_contacts;
        $owner->save();
        return redirect()
            ->route('owner.index')
            ->with('success_message', 'The owner was updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Owner  $owner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Owner $owner)
    {
        if ($owner->ownerPets->count()) {
            return redirect()
                ->route('owner.index')
                ->with('info_message', 'Action denied.');
        }
        $owner->delete();
        return redirect()
            ->route('owner.index')
            ->with('success_message', 'The owner has gone.');
    }
}