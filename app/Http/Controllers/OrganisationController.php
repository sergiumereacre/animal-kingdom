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
        return view('organisations.index');
    }

    // Showing individual organisation
    // public function show(Organisation $organisation){
    //     // return view('organisations.show');

    //     return view('organisation.show', [
    //         'organisation' => $organisation
    //     ]);
    // }

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

        return redirect('/home');

        // CODE FOR VALIDATING, STORING IN DATABASE, ETC.
    }

    public function edit(Request $request)
    {

        return view('organisations.edit');
        // return view('organisations.edit', ['organisation' => $organisation]);
    }

    // Attempt to update organisation
    public function update(Request $request, Organisation $organisation)
    {
    }

    // Attempt to delete organisation
    public function destroy(Organisation $organisation)
    {
        // Make sure logged in user is owner
        if ($organisation->owner_id != auth()->id()) {
            abort(403, 'Unauthorized Action, you\'re not the owner!!');
        }

        // Deleting custom picture from organisation
        if ($organisation->picture && Storage::disk('public')->exists($organisation->picture)) {
            Storage::disk('public')->delete($organisation->picture);
        }

        $organisation->delete();
        return redirect('/home');
    }

            if($request->hasFile('picture')) {
                $formFields['picture'] = $request->file('picture')->store('logos', 'public');
            }

            $formFields['owner_id'] = auth()->id();

            Organisation::create($formFields);

            return redirect('/home');

            // CODE FOR VALIDATING, STORING IN DATABASE, ETC.
        }

        public function edit(Request $request)
        {

            return view('organisations.edit');
            // return view('organisations.edit', ['organisation' => $organisation]);
        }

        // Attempt to update organisation
        public function update(Request $request, Organisation $organisation){

        }

        // Attempt to delete organisation
        public function destroy(Organisation $organisation){

        }

        // Redirect to manage page
        public function manage(){
            return view('organisations.manage');

            // Eventually, we should be able to map a user's organisations to the organisations variable
            return view('organisations.manage', ['organisations' => auth()->user()->organisations()->get()]);

        }

        // Eventually, we should be able to map a user's organisations to the organisations variable
        return view('organisations.manage', ['organisations' => auth()->user()->organisations()->get()]);
    }
}
