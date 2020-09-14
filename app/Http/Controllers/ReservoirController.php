<?php

namespace App\Http\Controllers;

use App\Reservoir;
use Illuminate\Http\Request;

class ReservoirController extends Controller
{
    public function index() {
        return view('reservoirs.index', ['reservoirs' => Reservoir::orderBy('title')->get()]);
    }

    public function create() {
       return view('reservoirs.create');
   }

    public function store(Request $request) {
      
        $this->validate($request, [
            // [Dėmesio] validacijoje unique turi būti nurodytas teisingas lentelės pavadinimas!
            // galime pažiūrėti, kas bus jei bus neteisingas

            'title' => 'required|alpha:reservoirs,title',
            'area' => 'required|numeric',
            ]);
            
        $reservoir = new Reservoir();
         // can be used for seeing the insides of the incoming request
         // var_dump($request->all()); die();
        $reservoir->fill($request->all());

        return ($reservoir->save() !==1 ) ? 
        redirect()->route('reservoir.index')->with('status_success', 'Sukurta!') :
        redirect()->route('reservoir.index')->with('status_error', 'Nesukurta!');///<- NOTIFICATION LOGIKA su printu i puslapy
    }

        
    //     $reservoir->save();
    //     return redirect()->route('reservoir.index');
    // }

    // public function show(Reservoir $reservoir)
    // {
    //     //
    // }

    public function edit(Reservoir $reservoir)
    {
        return view('reservoirs.edit', ['reservoir' => $reservoir]);
    }

    public function update(Request $request, Reservoir $reservoir){

        $this->validate($request, [
            // [Dėmesio] validacijoje unique turi būti nurodytas teisingas lentelės pavadinimas!
            // galime pažiūrėti, kas bus jei bus neteisingas

            'title' => 'required|alpha:reservoirs,title',
            'area' => 'required|numeric',
            ]);

        $reservoir->fill($request->all());

        return ($reservoir->save() !==1 ) ? 
            redirect()->route('reservoir.index')->with('status_success', 'Atnaujinta!') :
            redirect()->route('reservoir.index')->with('status_error', 'Neatnaujinta!');///<- NOTIFICATION LOGIKA su printu i puslapy
        }

    //     $reservoir->save();
    //     return redirect()->route('reservoir.index');
    // }

    public function destroy(Reservoir $reservoir){

        return ($reservoir->delete() ) ? 
        redirect()->route('reservoir.index')->with('status_success', 'Ištrinta!'):
        redirect()->route('reservoir.index')->with('status_error', 'Nesukurta!');

        // $reservoir->delete();
        // return redirect()->route('reservoir.index');
    }
    
}
