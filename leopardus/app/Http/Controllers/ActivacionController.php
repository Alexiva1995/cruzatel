<?php

namespace App\Http\Controllers;
use App\User;

use Carbon\Carbon;
use App\Http\Controllers\IndexController;


class ActivacionController extends Controller
{

    /**
     * Verifica que es estado de los usuarios 
     * 
     * @access public 
     * @param int $userid - id del usuarios a verificar
     * @return string
     */
    public function activarUsuarios($userid)
    {
        $funciones = new IndexController;
        $user = User::find($userid);
        $fechaActual = Carbon::now();
        $paquete = [];
        if (!$this->statusActivacion($user)) {
            $compras = $funciones->getInforShopping($user->ID);
            $fechaNueva = null;
            $activo = false;
            foreach ($compras as $compra) {
                $fechaTmp = new Carbon($compra['fecha']);
                $fechaNueva = $fechaTmp->addDay(200);
                if ($fechaNueva > $fechaActual) {
                    $activo = true;
                    foreach ($compra['productos'] as $producto) {
                        $paquete = $producto;
                    }
                }else{
                    $activo = false;
                }
            }
            if ($activo) {
                $user->paquete = json_encode($paquete);
                $user->status = 1;
                $user->fecha_activacion = $fechaNueva;
                $user->save();
            }else{
                $user->status = 0;
                $user->save();
            }
        }
    }

    /**
     * Permite verificar el estado del usuario
     *
     * @param object $user
     * @return bool
     */
    private function statusActivacion($user): bool
    {
        $result = true;
        $fechaActual = Carbon::now();
        if (empty($user->fecha_activacion)) {
            $result = false;
        }else{
            $fechatmp = new Carbon($user->fecha_activacion);
            if ($fechatmp < $fechaActual) {
                $result = false;
            }
        }
        return $result;
    }

}
