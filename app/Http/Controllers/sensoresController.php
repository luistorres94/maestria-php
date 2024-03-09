<?php

namespace App\Http\Controllers;

use App\Models\humiditi;
use App\Models\temperature;
use Carbon\Carbon;
use Illuminate\Http\Request;

class sensoresController extends Controller
{
    public function recibeDatos(Request $request){
        $token = $request->header('X-CSRF-TOKEN');
        $tokenPersonalizado = '12345'; // Token personalizado a comparar

        if ($token != $tokenPersonalizado) {
            return response()->json(['message' => 'Token inválido']);
        }
        $fechaActual = Carbon::now('America/Mexico_City');
        $datos = $request->json()->all();
        if($datos){
           $temperatura = $datos["temperatura"];
            $humedad = $datos["humedad"];
            $fechaFormateada = $fechaActual->format('Y-m-d H:i:s');
            $temperaturaDB = new temperature([
                'temperature' => $temperatura,
                'date' => $fechaFormateada 
            ]);
            $temperaturaDB->save();
            $humedadDB = new humiditi([
                'humidity' => $humedad,
                'date' => $fechaFormateada
            ]);
            $humedadDB->save();
            return response()->json(["success"=>true],200);
            
        }
        
        
    }

    public function muestraDatosTemperatura(){
        $datos = temperature::orderBy('date', 'desc')->take(20)->pluck('temperature');
        return response()->json($datos);
    
    }

    public function muestraFechasTemperatura(){
        $datos = temperature::orderBy('date', 'desc')->take(20)->pluck('date');
        return response()->json($datos);
    }

    public function muestraDatosHumedad(){
        $datos = humiditi::orderBy('date', 'desc')->take(20)->pluck('humidity');
        return response()->json($datos);
    }

    public function muestraFechasHumedad(){
        $datos = humiditi::orderBy('date', 'desc')->take(20)->pluck('date');
        return response()->json($datos);
    }
    public function temperaturaActual(){
        $datos = temperature::orderBy('date', 'desc')->take(1)->get();
        return response()->json($datos); 
    }

    public function humedadActual(){
        $datos = humiditi::orderBy('date', 'desc')->take(1)->get();
        return response()->json($datos);
    }
}
