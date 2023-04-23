<?php

namespace App\Http\Controllers;

use App\Models\Organisation;
use App\Models\User;
use App\Models\Vacancy;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OrganisationController extends Controller
{
    // Some sort of index page for organisations?
    public function index()
    {
        return view('organisations.index', [
            'organisations' => Organisation::paginate(6),
        ]);
    }

    // REMEMBER TO SWITCH ALL REQUESTS TO ORGANISATIONS FOR DEPENDENCY INJECTION

    public function show(Organisation $organisation)
    {
        return view('organisations.show', [
            'organisation' => $organisation,
            'vacancies' => Vacancy::all()->where('organisation_id', '=', $organisation->organisation_id),
            'owner' => User::all()->find($organisation->owner_id)
        ]);
    }

    public function create()
    {
        return view('organisations.create');
    }

    // Store organisation data with dependency injection
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'organisation_name' => 'required'
        ]);

        // Stores in the logo folder in public
        if ($request->hasFile('picture')) {
            $formFields['picture'] = $request->file('picture')->store('logos', 'public');
        }

        $formFields['owner_id'] = auth()->id();
        $formFields['time_created'] = Carbon::now();
        $formFields['address'] = $request->address;
        $formFields['email'] = $request->email;
        $formFields['contact_number'] = $request->contact_number;
        $formFields['description'] = $request->description;


        Organisation::create($formFields);



        return redirect('/home')->with('success', 'Organisation created successfully!');
    }

    public function edit(Request $request, Organisation $organisation)
    {
        //dd($organisation->email);
        return view('organisations.edit', ['organisation' => $organisation]);
    }

    // Attempt to update organisation
    public function update(Request $request, Organisation $organisation)
    {
        // dd($organisation->organisation_id);
        // Make sure logged in user is owner or admin
        if ($organisation->owner_id == auth()->id() || auth()->user()->is_admin) {
            // Deleting custom picture from organisation
            if ($organisation->picture && Storage::disk('public')->exists($organisation->picture)) {
                Storage::disk('public')->delete($organisation->picture);
            }

            $formFields = $request->validate([
                'organisation_name' => 'required'
            ]);

            // Stores in the logo folder in public
            if ($request->hasFile('picture')) {
                $formFields['picture'] = $request->file('picture')->store('logos', 'public');
            }

            // $formFields['owner_id'] = auth()->id();
            $formFields['address'] = $request->address;
            $formFields['email'] = $request->email;
            $formFields['contact_number'] = $request->contact_number;
            $formFields['description'] = $request->description;


            $organisation->update($formFields);


            // $organisation->delete();
        } else {
            abort(403, 'Can\'t update organisation');
        }

        return back()->with('message', 'Organisation updated successfully!');


        // return view('organisations.manage')->with('message', 'Organisation updated successfully!');
        // CODE FOR VALIDATING, STORING IN DATABASE, ETC.
    }

    // Attempt to delete organisation
    public function destroy(Organisation $organisation)
    {
        // Make sure logged in user is owner or admin
        if ($organisation->owner_id == auth()->id() || auth()->user()->is_admin) {
            // Deleting custom picture from organisation
            if ($organisation->picture && Storage::disk('public')->exists($organisation->picture)) {
                Storage::disk('public')->delete($organisation->picture);
            }

            $organisation->delete();
        } else {
            abort(403, deleteError);
        }

        // return redirect('/users/'.auth()->id());
        return redirect()->route('home');
    }


}
