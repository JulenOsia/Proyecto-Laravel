<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Actividad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ActividadController extends Controller
{
    public function index()
    {
        $actividades = Actividad::all();
        return view('actividades', ['actividades' => $actividades]);
    }

    public function validar(Request $request)
    {

        $mensajes = [
            'required' => 'El campo :attribute es requerido.',
            'max:100' => 'El campo :attribute no debe superar los 100 caracteres.',
            'date' => 'El campo :attribute no contiene una fecha valida.'
        ];

        $validator = Validator::make($request->all(), [
            'nombre' => 'required|max:100',
            'fecha' => 'required|date'
        ], $mensajes);

        if ($validator->fails()) {
            return redirect('/')
                ->withInput()
                ->withErrors($validator);
        }

        $task = new Actividad;
        $task->nombre = $request->nombre;
        $task->fecha = $request->fecha;
        $task->save();
        return redirect('/');
    }

    public function deleteActividad(Request $request)
    {
        //validamos que el id sea integer, puede no ser necesario
        $rules = ['id_actividad' => 'integer'];
        $validator = Validator::make($request->only('id_actividad'), $rules);
        if ($validator->fails()) {
            return redirect('/')->withErrors($validator);
        } else {
            if (Actividad::where('id', '=', $request->id_actividad)->delete()) {
                return redirect('/');
            }
        }
    }

    public function buscar()
    {
        $busqueda = null;

        if (isset($_POST['busqueda'])) {
            $actividades = Actividad::all();

            foreach ($actividades as $actividad) {
                if (stristr($actividad['nombre'],$_POST['busqueda'])) {
                    $busqueda[] = $actividad;
                }
            }
            if (empty($busqueda)) {
                $busqueda[] = "no se ha encontrado";
            }
        }
        return view('actividades', ['actividades' => $busqueda]);
    }
}
