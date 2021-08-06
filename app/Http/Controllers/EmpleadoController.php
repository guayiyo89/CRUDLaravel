<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // show the data in the Empleados index page and paginate it
        $datos['empleados'] = Empleado::paginate(5);
        return view('empleado.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('empleado.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //data validation
        $campos=[
            'nombre'=>'required|string',
            'apellidoP'=>'required|string|max:100',
            'apellidoM'=>'required|string|max:100',
            'correo'=>'required|email',
            'foto'=>'required|max:10000|mimes:jpeg,png,gif'
        ];

        $mensaje=[
            'required'=>'El :attribute es obligatorio',
            'email'=>'Debe tener el siguiente formato ejemplo@guayo.com',
            'foto.required'=>'La foto es requerida.'
        ];

        $this->validate($request, $campos, $mensaje);
        //we get the data
        $datosEmpleado = request()->except('_token');

        //how to catch the photo
        if($request->hasFile('foto')){
            //we store it in the directory /public/uploads
            $datosEmpleado['foto'] = $request->file('foto')->store('uploads','public');
        }

        Empleado::insert($datosEmpleado);

        //JSON response
        //return response()->json($datosEmpleado);
        return redirect('empleado')->with('mensaje','Empleado creado correctamante.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function show(Empleado $empleado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //we seach the Empleado by his Id and return it to $empleado
        $empleado = Empleado::findOrFail($id);
        return view('empleado.edit', compact('empleado'));
        //inside the compact the variable goes without the $ symbol
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $campos=[
            'nombre'=>'required|string',
            'apellidoP'=>'required|string|max:100',
            'apellidoM'=>'required|string|max:100',
            'correo'=>'required|email',
            'foto'=>'max:10000|mimes:jpeg,png,gif'
        ];

        $mensaje=[
            'required'=>'El :attribute es obligatorio',
            'email'=>'Debe tener el siguiente formato ejemplo@guayo.com'
        ];

        $this->validate($request, $campos, $mensaje);
        
        //we must delete the _method too
        $datosEmpleado = $request->except(['_token','_method']);

        //update the pfoto
        if($request->hasFile('foto')){
            //delete the previous photo
            $empleado = Empleado::findOrFail($id);
            Storage::delete('public/'.$empleado->foto);
            //we store it in the directory /public/uploads
            $datosEmpleado['foto'] = $request->file('foto')->store('uploads','public');
        }

        Empleado::where('id', '=', $id)->update($datosEmpleado);

        //return to Edit form
        return redirect('empleado')->with('mensaje','Empleado editado correctamante.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Delete the associated image
        $empleado = Empleado::findOrFail($id);
        if(Storage::delete('public/'.$empleado->foto)){
            Empleado::destroy($id);
        }
        return redirect('empleado')->with('mensaje','Empleado eliminado correctamante.');
    }
}
