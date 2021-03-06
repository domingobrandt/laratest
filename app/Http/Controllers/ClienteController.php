<?php

namespace Uxcamp\Http\Controllers;

use Illuminate\Http\Request;
use Uxcamp\Cliente;
use Uxcamp\Http\Requests\Store;
use Uxcamp\clientes_empresas;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    
    public function index(Request $request)
    {
       //$request->user()->authorizeRoles(['admin','user']);
        //$clientes = Cliente::all();
        $relacion = new clientes_empresas();

        if($request->ajax()){
            $clientes = Cliente::all();
            return response()->json($clientes, 200);
    	}
        $name  = $request->get('name');
        $slug = $request->get('slug');
        $bio   = $request->get('bio');

        $clientes = Cliente::orderBy('id', 'DESC')
        ->name($name)
        ->slug($slug)
        ->bio($bio)
        ->paginate(10);
        $relacion->user_id = $request->get('user_id');
        $relacion->job_id = $request->get('job_id');

        return view('cliente.index', compact('clientes','relacion'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create(Request $request)
    {
        //$jobs= Job::pluck('name','id');

        $request->user()->authorizeRoles(['admin','domin']);
        return view('cliente.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Store $request)
    {
        $cliente = new Cliente();
        $relacion = new clientes_empresas();

        if($request->hasFile('avatar')){
            $file = $request->file('avatar');
            $namea = time().$file->getClientOriginalName();
            $file->move(public_path().'/images/', $namea);
        }

        $cliente->name = $request->input('name');
        $cliente->bio = $request->input('bio');
        $cliente->avatar = $namea; 
        $cliente->slug = $request->input('slug');
        $relacion->job_id = $request->input('job_id');
        $relacion->user_id = $request->input('user_id');

        //$empresa = Uxcamp\Empresa::find(1);
       //$cliente = Uxcamp\Cliente::find(1);
                //$cliente->empresa_id;
        //$cliente->empresa->id = $request->input('');
        $cliente->save();
        $relacion->save();
        
        return redirect()->route('cliente.index',compact('relacion'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(cliente $cliente)
    {
        //$cliente = Cliente::where('slug','=',$slug)->firstOrFail();
        //$cliente = Cliente::find($id);
        return view('cliente.show', compact('cliente'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(cliente $cliente)
    {

        return view('cliente.edit', compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, cliente $cliente)
    {
        $request->user()->authorizeRoles(['admin','domin']);
        $cliente->fill($request->except('avatar'));
        if($request->hasFile('avatar')){
            $file = $request->file('avatar');
            $namea = time().$file->getClientOriginalName();
            $cliente->avatar =$namea;
            $file->move(public_path().'/images/', $namea);
        }

        //$cliente->empresa_id;
        //$cliente->empresa->id;
        $cliente->save();
        return redirect()->route('cliente.show', [$cliente])->with('status','Cliente actualizado correctament');
        //return 'updated';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, cliente $cliente)
    {
        $request->user()->authorizeRoles(['admin','domin']);
        $file_path = public_path().'/images/'.$cliente->avatar;
        \File::delete($file_path);
        $cliente->delete();
        return redirect()->route('cliente.index')->with('status','Cliente Eliminado');
        //return 'deleted';
    }
}
