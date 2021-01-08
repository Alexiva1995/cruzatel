<?php

namespace App\Http\Controllers;

use App\CicloPublicidad;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\User; 
use App\Commission; 
use App\SettingsComision;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\WalletController;

class ComisionesController extends Controller
{

  // Obtiene al usuario a a todo los usuarios
  public function ObtenerUsuarios()
  {
    $GLOBALS['settingsComision'] = SettingsComision::find(1);
    if (Auth::user()->rol_id == 0) {
        // $this->bonoUnilevel(Auth::user()->ID);
    } else {
        try {
            $this->bonoDirecto();
            $this->bonoXConsumo();
            $this->recordPoint();
        } catch (\Throwable $th) {
            dd($th);
        }
    }
  }

  /**
   * Permite recorrer la matriz para obtener los puntos necesarios
   *
   * @param integer $iduser
   * @return void
   */
  public function recordPoint()
  {
        $funciones = new IndexController;
        $compras = $funciones->getAllCompras();
        foreach ($compras as $compra) {
            $sponsors = $funciones->getSponsor($compra['idusuario'], [], 0, 'ID', 'referred_id');
            $referido = User::find($compra['idusuario']);
            if(!empty($referido)){
                $side = $referido->ladomatrix;
                foreach ($sponsors as $sponsor) {
                    if ($sponsor->ID != $compra['idusuario']) {
                        $idcomision = '10'.$compra['idcompra'];
                        if ($this->checkComision($idcomision, $sponsor->ID)) {
                            foreach ($compra['productos'] as $producto) {
                                $concepto = 'Primera Compra sin Comision';
                                $this->guardarComision($sponsor->ID, $idcomision, $producto['precio'], $referido->user_email, $sponsor->nivel, $concepto, 'referido');
                                $this->PuntosPaquetes($sponsor->ID, $producto['precio'], $referido->user_email, $side);
                            }
                        }
                        $side = $sponsor->ladomatrix;
                    }

                }
            }
        }
    }


  /**
   * Agrega los puntos obtenido por los paquetes comprando mis usuarios
   *
   * @param integer $iduser - id usuario
   * @param integer $totalcomision - puntos obtenidos
   * @return void
   */
  public function PuntosPaquetes(int $iduser, float $totalcomision, string $referred_email, $lado)
  {
        if ($iduser != 1) {
            $user = User::find($iduser);
            $referido = User::where('user_email', $referred_email)->first();
            $puntosI = 0; $puntosD = 0;
            if ($referido->ID != $iduser) {
                if ($lado == 'I') {
                    $user->puntosizq = ($user->puntosizq + $totalcomision);
                    $puntosI = $totalcomision;
                }elseif($lado == 'D'){
                    $user->puntosder = ($user->puntosder + $totalcomision);
                    $puntosD = $totalcomision;
                }
                $user->save();
                $concepto = 'Puntos por las compras del usuario '.$referido->display_name;
                $datos = [
                    'iduser' => $iduser,
                    'usuario' => $user->display_name,
                    'descripcion' => $concepto,
                    'puntos' => 0,
                    'puntosI' => $puntosI,
                    'puntosD' => $puntosD,
                    'tantechcoin' => 0,
                    'descuento' => 0,
                    'debito' => 0,
                    'credito' => 0,
                    'balance' => 0,
                    'tipotransacion' => 2
                ];
                $funciones = new WalletController;
                $funciones->saveWallet($datos);
            }
        }
    }

  // guarda la comision una vez procesada
  public function guardarComision($iduser, $idcompra, $totalComision, $referred_email, $referred_level, $concepto, $tipo_comision)
  {
            $dinero = 0; $puntos = 0;
            $dinero = $totalComision;
            $comision = new Commission();
            $comision->user_id = $iduser;
            $comision->compra_id = $idcompra;
            $comision->date = Carbon::now();
            $comision->total = $totalComision;
            $comision->concepto = $concepto;
            $comision->tipo_comision = $tipo_comision;
            $comision->referred_email = $referred_email;
            $comision->referred_level = $referred_level;
            $comision->status = ($concepto == 'Primera Compra sin Comision')? true : false;

            if ($concepto != 'Primera Compra sin Comision') {
                $user = User::find($iduser);
                $user->wallet_amount = ($user->wallet_amount + $dinero);
                $user->save();
                $datos = [
                    'iduser' => $iduser,
                    'usuario' => $user->display_name,
                    'descripcion' => $concepto,
                    'puntos' => 0,
                    'puntosI' => 0,
                    'puntosD' => 0,
                    'descuento' => 0,
                    'debito' => $dinero,
                    'tantechcoin' => 0,
                    'credito' => 0,
                    'balance' => $user->wallet_amount,
                    'tipotransacion' => 2
                ];
                $funciones = new WalletController;
                $funciones->saveWallet($datos);
                // $user->wallet_amount = ($user->wallet_amount + $dinero);
                // $user->save();
                // $datos = [
                //     'iduser' => $iduser,
                //     'usuario' => $user->display_name,
                //     'descripcion' => $concepto,
                //     'puntos' => 0,
                //     'puntosI' => 0,
                //     'puntosD' => 0,
                //     'descuento' => 0,
                //     'debito' => $dinero,
                //     'tantechcoin' => 0,
                //     'credito' => 0,
                //     'balance' => $user->wallet_amount,
                //     'tipotransacion' => 2
                // ];
                // $funciones = new WalletController;
                // $funciones->saveWallet($datos);
            }
            $comision->save();
  }




  /**
   * Permite pagar el pono unilevel
   *
   * @return void
   */
    public function bonoDirecto()
    {
        $funciones = new IndexController;
        $compras = $funciones->getAllCompras();
        foreach ($compras as $compra) {
            $sponsors = $funciones->getSponsor($compra['idusuario'], [], 0, 'ID', 'referred_id');
            foreach ($sponsors as $sponsor) {
                if ($sponsor->nivel == 1) {
                    $idcomision = '34'.$compra['idcompra'];
                    if ($this->checkComision($idcomision, $sponsor->ID)) {
                        $referido = User::find($compra['idusuario']);
                        foreach ($compra['productos'] as $producto) {
                            $porcent = 0.03;
                            if ($porcent > 0 && $producto['precio'] > 0) {
                                $pagar = ($producto['precio'] * $porcent);
                                $this->guardarComision($sponsor->ID, $idcomision, $pagar, $referido->user_email, $sponsor->nivel, 'Bono Indicacion Directa, usuario '.$referido->display_name.' por la orden '.$compra['idcompra'], 'referido'); 
                            }
                        }
                    }
                }
            }
        }
    }

    /**
     * Permite pagar el bono por consumo residual
     *
     * @param integer $iduser
     * @return void
     */
    public function bonoXConsumoResidual(int $iduser)
    {
        $funcionesIndex = new IndexController();
        $users = $funcionesIndex->getChidrens2($iduser, [], 1, 'referred_id', 0);
        foreach ($users as $user) {
            if ($user->nivel < 7) {
                $fechatmpSemana = Carbon::now();
                $semana = $fechatmpSemana->weekOfYear;
                $year = $fechatmpSemana->year;
                $completado = CicloPublicidad::where([
                    ['iduser', '=', $user->ID],
                    ['completado', '=', 1],
                    ['semana', '=', $semana],
                    ['year', '=', $year]
                ])->first();
                if (!empty($completado)) {
                    $idcomision = '80'.$completado->id;
                    if ($this->checkComision($idcomision, $iduser)) {
                        $bono = 0.40;
                        $concepto = 'Bono por consumo residual por el usuario '.$user->display_name.' por la orden '.$completado->id;
                        $this->guardarComision($iduser, $idcomision, $bono, $user->email, $user->nivel, $concepto, 'bono');
                    }
                }
            }
        }
    }

    /**
     * Permite pagar el bono por consumo
     *
     * @param integer $iduser
     * @return void
     */
    public function bonoXConsumo()
    {
        $funcionesIndex = new IndexController();
        $compras = $funcionesIndex->getAllCompras();
        foreach ($compras as $compra) {
            if ($compra['membresia']) {
                $sponsors = $funcionesIndex->getSponsor($compra['idusuario'], [], 0, 'ID', 'referred_id');
                foreach ($sponsors as $sponsor ) {
                    if ($sponsor->nivel > 0 && $sponsor->nivel < 7) {
                        $idcomision = '60'.$compra['idcompra'];
                        if ($this->checkComision($idcomision, $sponsor->ID)) {
                            if ($compra['total'] >= 50) {
                                $referido = User::find($compra['idusuario']);
                                $bono = ($compra['total'] * 0.05);
                                $concepto = 'Bono por consumo por el usuario '.$referido->display_name.' por la orden '.$compra['idcompra'];
                                $this->guardarComision($sponsor->ID, $idcomision, $bono, $referido->user_email, $sponsor->nivel, $concepto, 'bono');
                            }
                        }
                    }
                }
            }
        }
    }

    /**
     * Permite pagar el bono de forma individual
     *
     * @param integer $iduser
     * @return void
     */
    public function bonoIndividual($iduser)
    {
        $fechatmpSemana = Carbon::now();
        $semana = $fechatmpSemana->weekOfYear;
        $year = $fechatmpSemana->year;
        $completado = CicloPublicidad::where([
            ['iduser', '=', $iduser],
            ['completado', '=', 1],
            ['semana', '=', $semana],
            ['year', '=', $year]
        ])->first();
        if (!empty($completado)) {
            $user = User::find($iduser);
            $bono = 0;
            $paquete = json_decode($user->paquete);
            $idcomision = '40'.$completado->id;
            if (stripos($paquete->nombre, 'Junior') !== false) {
                $bono == 10;
            }
            if (stripos($paquete->nombre, 'Silver') !== false) {
                $bono == 20;
            }
            if (stripos($paquete->nombre, 'Golden') !== false) {
                $bono == 60;
            }
            if ($this->checkComision($idcomision, $iduser)) {
                $concepto = 'Bono de individualidad de la semana '.$semana.' del año '.$year;
                $this->guardarComision($iduser, $idcomision, $bono, $user->email, 1, $concepto, 'bono');
            }
            
        }
    }

    /**
     * Permite verificar si una comision ya fue cobrada
     *
     * @param integer $idcompra
     * @param integer $iduser
     * @return void
     */
    public function checkComision($idcompra, $iduser)
    {
        $result = false;
        $check = DB::table('commissions')
                ->select('id')
                ->where('user_id', '=', $iduser)
                ->where('compra_id', '=', $idcompra)
                ->first();
        if ($check == null) {
            $result = true;
        }
        return $result;
    }


    /**
     * Permite pagar los bonos por los puntos acumulado de los usuarios a lo largo del dia
     *
     * @param integer $iduser
     * @return void
     */
    public function bonoPorPuntos($iduser)
    {
        $funcionesIndex = new IndexController();
        $user = User::find($iduser);

        if ($funcionesIndex->statusBinary($iduser)) {
            $pagar = 0;
            if ($user->puntosizq >= $user->puntosder) {
                $pagar = $user->puntosder;
            }else{
                $pagar = $user->puntosizq;
            }
            if (!empty($user->paquete)) {
                $paquete = json_decode($user->paquete);
                if ($pagar > $paquete->precio) {
                    $pagar = $paquete->precio;
                }
            }
            if ($pagar != 0) {
                $user->puntosizq = ($user->puntosizq - (float)$pagar);
                $user->puntosder = ($user->puntosder - (float)$pagar);
                $bono = ($pagar * 0.02);
                $this->guardarComision($iduser, 20, $bono, $user->user_email, 0, 'Bonos Binario', 'bono');
                $user->save();
            }
        }
    }


}

