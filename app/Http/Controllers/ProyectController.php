<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Events\Meeting;
use App\Models\Proyect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\StoreProyectRequest;
use App\Http\Requests\UpdateProyectRequest;

class ProyectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
    public function index()
    {
        Gate::authorize('proyect.index');
        $proyects = Proyect::orderBy('id','desc')->paginate(7);
        return view('dashboard/proyect/index',['proyects' => $proyects]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('proyect.create');
        $users = User::role('Personal')->get();
        return view('dashboard/proyect/create', ['proyect'=> new Proyect()], compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProyectRequest $request)
    {        
        $personals = collect($request['personals'])->prepend(Auth()->user()->id);    
        try {
            DB::beginTransaction();

            $proyect = Proyect::create(
                    [
                        'name' => $request['name'],
                        'description' => $request['description'],
                        'leader_id' => Auth()->user()->id,                        
                        'password' => $request['password'],
                    ]
            );            
            $proyect->xml = $this->stringGeneralDiagram('Board ' . $proyect->id);
            $proyect->save();
            $proyect->users()->sync($personals);
            DB::commit();
            return view('dashboard/proyect/show', [
                'proyect' => $proyect
            ])->with('success', 'Proyecto creado con éxito!') ;

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('status', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Proyect $proyect)
    {
        Gate::authorize('proyect.show');        
        return view('dashboard/proyect/show', [
            'proyect' => $proyect
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Proyect $proyect)
    {
        Gate::authorize('proyect.edit');
        
        if (Auth()->user()->proyects->contains($proyect)) {
            $users = User::role('Personal')->get();
            return view('dashboard/proyect/edit', compact('proyect', 'users'));
        } else {
            return redirect()->route('proyect.index')->with('error', '¡No pertenece al proyecto!');
        }
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProyectRequest $request, Proyect $proyect)
    {
        $personals = collect($request['personals'])->push(Auth()->user()->id);        
        $proyect->update(
            [
                'name' => $request['name'],
                'description' => $request['description'],                
                'password' => $request['password'],                
            ]
        );
        $proyect->users()->sync($personals);
        return redirect()->route('proyect.index')->with('success','Proyecto actualizado con éxito!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Proyect $proyect)
    {
        Gate::authorize('proyect.destroy');
        if (Auth()->user()->proyects->contains($proyect)) {
            $proyect->delete();
            return redirect()->back()->with('success','Proyecto eliminado con éxito!');
        } else {
            return redirect()->route('proyect.index')->with('error', '¡No pertenece al proyecto!');
        }
        
    }

    //---------------------------------------
    public function board(Proyect $proyect)
    {
        Gate::authorize('proyect.board');
        $user = Auth()->user();
        $tipoRol = "";
        if (Auth()->user()->hasRole(['Jefe de grupo', 'Personal'])) {
            if ($user->proyects->contains($proyect)) {
                $tipoRol = "¡El usuario pertenece al proyecto!";
            } else {
                $tipoRol = "¡No pertenece al proyecto!";
                return redirect()->route('proyect.index')->with('error', $tipoRol);
            }
        }
        
        return view('dashboard/proyect/board', [
            'proyect' => $proyect,
            'tipoRol' => $tipoRol
        ]);
    }

    public function uploadXML(Request $request, Proyect $proyect)
    {
        // subir el xml
        $data_xml = $request['myxml'];
        $proyect->xml = $data_xml;
        $proyect->update();
        $proyect->save();

        broadcast(new Meeting($proyect, $proyect->xml))->toOthers();

        echo 'Actualizado con éxito! del Proyect:' . $proyect->id;
    }

    public function downloadXML(Proyect $proyect)
    {
        return $proyect->xml;        
    }

    function stringGeneralDiagram($nameBoard) : String {
        return '<umldiagrams><UMLSequenceDiagram name="'.$nameBoard.'" backgroundNodes="#ffffbb"><UMLLifeline id="0.6718072184877338:UMLLifeline_1" x="408" y="70" width="60" height="260" backgroundColor="#ffffbb" lineColor="#294253" lineWidth="1" tagValues=""><superitem id="stereotypes" visibleSubComponents="true"/><item id="name" value="B"/></UMLLifeline><UMLLifeline id="0.6718072184877338:UMLLifeline_0" x="194" y="70" width="60" height="260" backgroundColor="#ffffbb" lineColor="#294253" lineWidth="1" tagValues=""><superitem id="stereotypes" visibleSubComponents="true"/><item id="name" value="A"/></UMLLifeline></UMLSequenceDiagram></umldiagrams>';
    }

}
