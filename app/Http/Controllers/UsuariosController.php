<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Curso;

class UsuariosController extends Controller
{
    public function crear(Request $req){

        $respuesta = ["status" => 1, "msg" => ""];

        $datos = $req->getContent();

        $datos = json_decode($datos);

        $usuario = new Usuario();

        $usuario->nombre = $datos->nombre;
        $usuario->foto = $datos->foto;
        $usuario->email = $datos->email;
        $usuario->contraseña = $datos->contraseña;
        $usuario->activo = $datos->activo = 1;

        if(isset($datos->email))
            $usuario->email = $datos->email;

        try{
            $usuario->save();
            $respuesta['msg'] = "Usuario guardado con id ".$usuario->id;
        }catch(\Exception $e){
            $respuesta['status'] = 0;
            $respuesta['msg'] = "Se ha producido un error: ".$e->getMessage();
        }

        return response()->json($respuesta);
    }


    public function desactivar($id){

        $respuesta = ["status" => 1, "msg" => ""];

        try{
            $usuario = Usuario::find($id);

            if($usuario && $usuario->activo == 1){
                $usuario->activo = 0;
                $usuario->save();
                $respuesta['msg'] = "Usuario desactivado";
            }else if($usuario->activo == 0){
                $respuesta["msg"] = "Usuario está desactivado";
            }else{
                $respuesta["msg"] = "Usuario no encontrado";
                $respuesta["status"] = 0;
            }

        }catch(\Exception $e){
            $respuesta['status'] = 0;
            $respuesta['msg'] = "Se ha producido un error: ".$e->getMessage();
        }

        return response()->json($respuesta);
    }


    public function editar(Request $req,$id){

        $respuesta = ["status" => 1, "msg" => ""];

        $datos = $req->getContent();

        $datos = json_decode($datos);

        try{
            $usuario = Usuario::find($id);

            if($usuario){

                if(isset($datos->nombre))
                    $usuario->nombre = $datos->nombre;
                if(isset($datos->foto))
                    $usuario->foto = $datos->foto;
                if(isset($datos->contraseña))
                    $usuario->contraseña = $datos->contraseña;

                $usuario->save();
                $respuesta['msg'] = "Usuario actualizado.";
            }else{
                $respuesta["msg"] = "Usuario no encontrado";
                $respuesta["status"] = 0;
            }
        }catch(\Exception $e){
            $respuesta['status'] = 0;
            $respuesta['msg'] = "Se ha producido un error: ".$e->getMessage();
        }

        return response()->json($respuesta);
    }

    public function adquirir_cursos($usuarios_id, $cursos_id){
        $respuesta = ["status" => 1, "msg" => ""];

        $usuario = Usuario::find($usuarios_id);
        $curso = Curso::find($cursos_id);

        try{
            $usuario = Usuario::all();
            $respuesta['datos'] = $usuario;
            if ($usuario && $curso){
                $usuario->curso()->attach($curso);
                $respuesta['msg'] = "El usuario ".$usuario->id "ha adquirido el curso con id ".$curso->id;
            }else {
                $respuesta["msg"] = "Usuario no encontrado";
                $respuesta["status"] = 0;
            }

        }catch(\Exception $e){
            $respuesta['status'] = 0;
            $respuesta['msg'] = "Se ha producido un error: ".$e->getMessage();
        }

        return response()->json($respuesta);
    }
    
    public function listar(){

        $respuesta = ["status" => 1, "msg" => ""];
        try{
            $usuario = Usuario::all();
            $respuesta['datos'] = $usuario;
        }catch(\Exception $e){
            $respuesta['status'] = 0;
            $respuesta['msg'] = "Se ha producido un error: ".$e->getMessage();
        }
        return response()->json($respuesta);
    }

    public function ver($id){
        $respuesta = ["status" => 1, "msg" => ""];

        try{
            $usuario = Usuario::find($id);
            $usuario->makeVisible(['nombre','foto', 'updated_at']);
            $respuesta['datos'] = $usuario;
        }catch(\Exception $e){
            $respuesta['status'] = 0;
            $respuesta['msg'] = "Se ha producido un error: ".$e->getMessage();
        }

        return response()->json($respuesta);
    }
}

