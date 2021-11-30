<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;

class VideosController extends Controller
{
    public function crear(Request $req){

        $respuesta = ["status" => 1, "msg" => ""];

        $datos = $req->getContent();

        $datos = json_decode($datos);

        $videos = new Video();

        $videos->titulo = $datos->titulo;
        $videos->foto = $datos->foto;
        $videos->enlace = $datos->enlace;
        $videos->cursos_id = $datos->cursos_id;


        try{
            $videos->save();
            $respuesta['msg'] = "Video guardado con id ".$videos->id;
        }catch(\Exception $e){
            $respuesta['status'] = 0;
            $respuesta['msg'] = "Se ha producido un error: ".$e->getMessage();
        }

        return response()->json($respuesta);
    }

    
    public function ver($id){
        $respuesta = ["status" => 1, "msg" => ""];

        try{
            $videos = Video::find($id);
            $videos->makeVisible(['enlace','updated_at']);
            $respuesta['datos'] = $videos;
        }catch(\Exception $e){
            $respuesta['status'] = 0;
            $respuesta['msg'] = "Se ha producido un error: ".$e->getMessage();
        }

        return response()->json($respuesta);
    }

}
