<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Registro;
use App\Models\Experto;
use Exception;

class RegistrosController extends Controller
{
    /**
     * Devuelve un listado con todos los registros creados
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try {
            $registros = Registro::all();

            return response()->json([
                'registros' => $registros
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al obtener los registros: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Guarda el registro en base de datos
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        try {
            // Valida los datos de entrada
            $rules = [
                'nombre' => 'required|string|max:255',
                'apellidos' => 'required|string|max:255',
                'email' => 'required|email|unique:registros,email',
                'telefono' => 'required|digits:9',
                'ingresos_netos' => 'required|numeric|min:0',
                'cantidad_solicitada' => 'required|numeric|min:0',
                'fecha_registro' => 'nullable|date',
                'franja_comunicacion' => 'required|integer|min:1|max:8',
            ];

            // Valida los datos de entrada y obtiene un arreglo de los datos validados
            $validatedData = $request->validate($rules);

            // Instancia el modelo Registro y asignar los datos validados
            $registro = new Registro();
            $registro->fill($validatedData);

            // Obtiene un id de un experto aleatorio y lo asigna al registro
            $experto = Experto::inRandomOrder()->first();

            // Devuelve una excepción si no hay expertos disponibles
            if (!$experto) {
                throw new Exception('No hay expertos disponibles');
            }

            $registro->experto_id = $experto->id;

            // Guarda el registro en la base de datos
            $registro->save();

            // Retorna una respuesta con un mensaje de éxito
            return response()->json([
                'message' => 'Registro creado correctamente'
            ]);

        } catch (\Exception $e) {
            // En caso de error, retorna una respuesta con un mensaje de error
            return response()->json([
                'message' => 'Error al crear el registro: ' . $e->getMessage()
            ], 500);
        }
    }
}
