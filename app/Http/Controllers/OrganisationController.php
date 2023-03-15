<?php

namespace App\Http\Controllers;

use App\Models\Organisation;
use Illuminate\Http\Request;

class OrganisationController extends Controller
{
        // Some sort of index page for organisations?
        public function index(){
            return;
        }
    
        // Showing individual organisation
        // public function show(Organisation $organisation){
        //     // return view('organisations.show');
    
        //     return view('organisation.show', [
        //         'organisation' => $organisation
        //     ]);
        // }
    
        // REMEMBER TO SWITCH ALL REQUESTS TO ORGANISATIONS FOR DEPENDENCY INJECTION
    
        public function show(Request $request){
                    return view('organisations.show');
        }
    
        public function create()
        {
            return view('organisations.create');
        }
    
        // Store organisation data with dependency injection
        public function store(Request $request)
        {
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
    
}