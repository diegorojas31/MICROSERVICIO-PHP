<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AugmentedRealityController extends Controller
{
    public function generate_object3D(Request $request)
    {
        $url_photo = $request->url_photo;  // Asumiendo que la URL de la foto viene en este campo
        ini_set('max_execution_time', 300);

        $pythonPath = base_path('CONVERTEROBJECT3D/venv/Scripts/python');
        $scriptPath = base_path('CONVERTEROBJECT3D/main.py');

        // Añade la URL de la foto como un argumento al comando
        $command = "\"$pythonPath\" \"$scriptPath\" \"$url_photo\" 2>&1";

        $output = shell_exec($command);

        if ($output) {
            return response()->json(['message' => $output]);
        } else {
            return response()->json(['error' => 'Error al ejecutar el script', 'command' => $command]);
        }
    }
}
