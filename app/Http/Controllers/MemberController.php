<?php

namespace App\Http\Controllers;

use App\Member;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Validator;

class MemberController extends Controller{
    public function index(Request $request){
        if(isset($request->reservoir_id) && $request->reservoir_id !== 0)
            $members = \App\Member::where('reservoir_id', $request->reservoir_id)->orderBy('surname')->get();
        else
            $members = \App\Member::orderBy('surname')->get();
            $reservoirs = \App\Reservoir::orderBy('title')->get();
        return view('members.index', ['members' => $members, 'reservoirs' => $reservoirs]);
    }
    public function create(){
        $reservoirs = \App\Reservoir::orderBy('title')->get();
        return view('members.create', ['reservoirs' => $reservoirs]);
    }
    public function store(Request $request){

        $this->validate($request, [
            // [Dėmesio] validacijoje unique turi būti nurodytas teisingas lentelės pavadinimas!
            // galime pažiūrėti, kas bus jei bus neteisingas

            'name' => 'required|alpha:members,name',
            'surname' => 'required|alpha',
            'live' => 'required',
            'experience' => 'required',
            'registered' => 'required',
            'reservoir_id' => 'required',
            ]);
            
        $member = new Member();
        // can be used for seeing the insides of the incoming request
        // var_dump($request->all()); die();
        $member->fill($request->all());
        if ($member->experience < $member->registered) {
            return back()->withErrors(['error' => ['Negalima kurti naujo nario, jei patirtis mažesnė nei registracijos laikas!']]);
        }
        $member->save();
        return redirect()->route('members.index');
    }
    public function show(Member $member){
        //
    }
    public function edit(Member $member){
        $reservoirs = \App\Reservoir::orderBy('title')->get();
        return view('members.edit', ['member' => $member, 'reservoirs' => $reservoirs]);
    }
    public function update(Request $request, Member $member){

        $this->validate($request, [
            // [Dėmesio] validacijoje unique turi būti nurodytas teisingas lentelės pavadinimas!
            // galime pažiūrėti, kas bus jei bus neteisingas

            'name' => 'required|alpha:members,name',
            'surname' => 'required|alpha',
            'live' => 'required',
            'experience' => 'required',
            'registered' => 'required',
            'reservoir_id' => 'required',
            ]);

        $member->fill($request->all());
        if ($member->experience < $member->registered) {
            return back()->withErrors(['error' => ['Negalima kurti naujo nario, jei patirtis mažesnė nei registracijos laikas!']]);
        }
        $member->save();
        return redirect()->route('members.index');
    }
    public function destroy(Member $member, Request $request)
    {
        $member->delete();
        return redirect()->route('members.index', ['reservoir_id'=> $request->input('reservoir_id')]);
    }
}
