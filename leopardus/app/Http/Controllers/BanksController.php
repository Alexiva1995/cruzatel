<?php

namespace App\Http\Controllers;

use App\Banks;
use App\BanksOrden;
use App\User;
use Illuminate\Http\Request;

use App\Http\Controllers\TiendaController;

class BanksController extends Controller
{
    /**
     * LLeva a la vista de todos los bancos
     *
     * @return void
     */
    public function index()
    {
        view()->share('title', 'Banco');
        $banks = Banks::all();

        return view('bank.index', compact('banks'));
    }

    /**
     * Permite guardar la informacion de los bancos
     *
     * @param Request $request
     * @return void
     */
    public function save(Request $request)
    {
        $validate = $request->validate([
            'nombre' => ['required'],
            'titular' => ['required'],
            'dni' => ['required'],
            'correo' => ['required'],
            'tipo_cuenta' => ['required'],
            'numero_cuenta' => ['required', 'unique:banks'],
        ]);

        if ($validate) {
            Banks::create($request->all());

            return redirect()->back()->with('msj', 'Banco '.$request->nombre.' Agregado');
        }
    }

    /**
     * Permite actualizar la informacion de los bancos
     *
     * @param Request $request
     * @return void
     */
    public function update(Request $request)
    {
        $validate = $request->validate([
            'nombre' => ['required'],
            'titular' => ['required'],
            'dni' => ['required'],
            'correo' => ['required'],
            'tipo_cuenta' => ['required'],
            'numero_cuenta' => ['required'],
        ]);

        if ($validate) {
            Banks::where('id', $request->idbank)->update([
                'nombre' => $request->nombre,
                'titular' => $request->titular,
                'dni' => $request->dni,
                'correo' => $request->correo,
                'tipo_cuenta' => $request->tipo_cuenta,
                'numero_cuenta' => $request->numero_cuenta
            ]);

            return redirect()->back()->with('msj', 'Banco '.$request->nombre.' Actualizado');
        }
    }

    /**
     * Permite borrar los banco creados
     *
     * @param integer $id
     * @return void
     */
    public function delete($id)
    {
        $tmpname = '';
        $bank = Banks::find($id);
        $tmpname = $bank->nombre;
        $bank->delete();

        return redirect()->back()->with('msj', 'Banco '.$tmpname.' Borrado');
    }

    /**
     * LLeva a la vista de las Transferencia Bancarias Pendientes
     *
     * @return void
     */
    public function solicitud()
    {
        view()->share('title', 'Transferecias Bancarias');
        $ordens = BanksOrden::all()->where('status', '=', 0);

        foreach ($ordens as $orden) {
            $user = User::find($orden->iduser);
            $orden->user_name = $user->display_name;
        }

        return view('bank.solicitud', compact('ordens'));
    }


    /**
     * Permite actualizar la orden de bauche
     *
     * @param integer $id
     * @param string $estado
     * @return void
     */
    public function actionOrden($id, $estado)
    {
        $bankOrden = BanksOrden::find($id);
        $tienda = new TiendaController();
        $estadoWP = '';
        if ($estado == 'aprobada') {
            $bankOrden->status = 1;
            $estadoWP = 'wc-completed';
        }else{
            $bankOrden->status = 2;
            $estadoWP = 'wc-cancelled';
        }

        if ($estadoWP != '') {
            $tienda->accionSolicitud($bankOrden->idorden, $estadoWP);
            $bankOrden->save();
            return redirect()->back()->with('msj', 'Orden '.$bankOrden->idorden.' fue '.$estado.' Con exito');
        }else{
            return redirect()->back()->with('msj', 'Ocurrio un error en al'.$estado);
        }

    }
}
