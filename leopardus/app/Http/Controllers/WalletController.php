<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\User; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon; 
use App\Wallet;
use App\MetodoPago; use App\SettingsComision; use App\Pagos; use App\Monedas;
use App\Http\Controllers\ComisionesController;
use PragmaRX\Google2FA\Google2FA;


class WalletController extends Controller
{
	function __construct()
	{
        // TITLE
		view()->share('title', 'Wallet');
	}
	
	/**
	 *  Va a la vista principal de la billetera cash
	 * 
	 * @access public
	 * @return view
	 */
	public function index(){
	   
		$moneda = Monedas::where('principal', 1)->get()->first();
		$metodopagos = MetodoPago::all();
		$comisiones = SettingsComision::select('comisionretiro', 'comisiontransf')->where('id', 1)->get();
		$funciones = new ComisionesController;
		$funciones->ObtenerUsuarios();
		$cuentawallet = '';
		$pagosPendientes = false;
			$validarPagos = Pagos::where([
				['iduser', '=', Auth::user()->ID],
				['estado', '=', 0]
			])->first();
			if (!empty($validarPagos)) {
				$pagosPendientes = true;
			}
			$wallets = Wallet::where([
				['iduser', '=', Auth::user()->ID], 
				['debito', '!=', 0],
			])->orWhere([
				['iduser', '=', Auth::user()->ID], 
				['credito', '!=', 0]
				])->get();
			$cuentawallet = DB::table('user_campo')->where('ID', Auth::user()->ID)->select('paypal')->get()[0];
			$cuentawallet = $cuentawallet->paypal;
		// }
		
	   	return view('wallet.indexwallet')->with(compact('metodopagos', 'comisiones', 'wallets', 'moneda', 'cuentawallet', 'pagosPendientes'));
	}


	/**
	 *  Va a la vista principal de la billetera puntos
	 * 
	 * @access public
	 * @return view
	 */
	public function indexPuntos(){
	   
		$moneda = Monedas::where('principal', 1)->get()->first();
		$metodopagos = MetodoPago::all();
		$comisiones = SettingsComision::select('comisionretiro', 'comisiontransf')->where('id', 1)->get();
		$funciones = new ComisionesController;
		$funciones->ObtenerUsuarios();
		$cuentawallet = '';
		if (Auth::user()->rol_id == 0) {
			$wallets = Wallet::where('puntos', '=', 0)->get();;
		} else {
			$wallets = Wallet::where([
				['iduser', '=',Auth::user()->ID], 
				['puntosD', '!=', 0],
			])->orWhere([
				['iduser', '=',Auth::user()->ID], 
				['puntosI', '!=', 0],
			])->get();
			$cuentawallet = DB::table('user_campo')->where('ID', Auth::user()->ID)->select('paypal')->get()[0];
			$cuentawallet = $cuentawallet->paypal;
		}
		
	   	return view('wallet.indexwalletpuntos')->with(compact('metodopagos', 'comisiones', 'wallets', 'moneda', 'cuentawallet'));
	}
	
	/**
	 * Guarda la informacion o los registro del la billetera
	 * 
	 * @access public
	 * @param array $datos - arreglo con los datos necesarios
	 */
	public function saveWallet($datos){
		Wallet::create($datos);
	}
    
    /**
     * Solicita el proceso de retiro de un usuario
     * 
     * @access public
     * @param request $datos - datos para el retiro
     * @return view
     */
    public function retiro(Request $datos){
        $fecha = new Carbon;
        if (!empty($datos)){
			$resta = $datos->total;
			if (Auth::user()->check_token_google == 1) {
				if (!(new Google2FA())->verifyKey(Auth::user()->toke_google, $datos->code)) {
					return redirect()->back()->with('msj2', 'el codigo es incorrecto');
				}
			}
			$checkPago = Pagos::where([
				['iduser', '=', Auth::user()->ID],
				['estado', '=', 0]
			])->first();
			if (!empty($checkPago)) {
				return redirect()->back()->with('msj2', 'Tienes un retiro pendiente');
			}
            if($resta > 0){
                if($resta <= $datos->montodisponible){
                    $tipopago = '';
                    if(!empty($datos->metodocorreo)){
                        $tipopago = 'Email: '.$datos->metodocorreo;
                    }
                    if(!empty($datos->metodowallet)){
                        $tipopago = $tipopago.'- Wallet: '.$datos->metodowallet;
                    }
                    if(!empty($datos->metodobancario)){
                        $tipopago = $tipopago.'- Bank data: '.$datos->metodobancario;
                    }
                    $metodo = MetodoPago::find($datos->metodopago);
                    if ($resta > $datos->monto_min) {
						// DB::table('user_campo')->where('ID', Auth::user()->ID)->update(['paypal' => $datos->metodowallet]);
						$user = Auth::user();
						$user->wallet_amount = ($user->wallet_amount - $resta);
						$datosW = [
							'iduser' => $user->ID,
							'usuario' => $user->display_name,
							'descripcion' => 'Retiro por un monto de - $ '. $datos->monto.' - A la billetera: '.$datos->metodowallet,
							'descuento' => ($datos->monto - $resta),
							'puntos' => 0,
							'puntosI' => 0,
							'puntosD' => 0,
							'debito' => 0,
							'credito' => $datos->monto,
							'balance' => $user->wallet_amount,
							'tipotransacion' => 1,
						];
						$this->saveWallet($datosW);
						$user->save();
						Pagos::create([
							'iduser' => Auth::user()->ID,
							'username' => Auth::user()->display_name,
							'email' => Auth::user()->user_email,
							'monto' => $resta,
							'descuento' => ($datos->monto - $resta),
							'fechasoli' => $fecha->now(),
							'metodo' => $metodo->nombre,
							'tipowallet' => $datos->tipowallet,
							'tipopago' => $tipopago,
							'estado' => 0
						]);
						return redirect()->back()->with('msj', 'El Retiro ha sido procesado');
					} else {
						return redirect()->back()->with('msj2', 'El monto a retirar no puede ser menor la monto minimo');	
					}
                }else{
                    return redirect()->back()->with('msj2', 'El monto a retirar no puede ser mayor a monto disponible');
                }
            }else{
                return redirect()->back()->with('msj2', 'El monto a retirar no puede ser negativo o 0');
			}
        }else{
           return redirect()->back(); 
        }
    }
    
    /**
     * Permite Obtener por donde se procesara el pago al usuario
     * 
     * @access public
     * @param int $id - el metodo de pago selecionado por el usuario
     * @return json
     */
    public function datosMetodo($id){
        $metodo = MetodoPago::find($id);
        $datos = [
            'correo' => $metodo->correo,
            'wallet' => $metodo->wallet,
			'bancario' => $metodo->datosbancarios,
			'tipofeed' => $metodo->tipofeed,
			'feed' => $metodo->feed,
			'monto_min' => $metodo->monto_min
            ];
        return json_encode($datos);
    }
    
    public function historial()
    {
		view()->share('title', 'Historial de Comisiones');

		$moneda = Monedas::where('principal', 1)->get()->first();
       
		$billetera = DB::table('walletlog')
						->where([
							['tipotransacion', '=', 2],
							['debito', '!=', 0]
						])
						->get();
		$data = [
			'billetera' => $billetera,
			'volver' => false
		];

     return view('wallet.historial', compact('data', 'moneda')); 
    }
    
     public function historial_fechas(Request $request)
    {
		view()->share('title', 'Historial de Comisiones- Desde: '.$request->primero.' Hasta: '.$request->segundo);

        $moneda = Monedas::where('principal', 1)->get()->first();
		$billetera = Wallet::whereDate("created_at",">=",$request->primero)
				->whereDate("created_at","<=",$request->segundo)
				->where([
					['tipotransacion', '=', 2],
					['debito', '!=', 0]
				])
				->get();
		
		$data = [
			'billetera' => $billetera,
			'volver' => false
		];
             
 		return view('wallet.historial', compact('data', 'moneda')); 
    }
	
	/**
	 * LLeva a la vista de los retiros de los usuarios
	 *
	 * @return void
	 */
    public function cobros()
    {
		// TITLE
		view()->share('title', 'Historial de Retiro');
		$moneda = Monedas::where('principal', 1)->get()->first();
		$billetera = DB::table('walletlog')
                ->where('iduser', '=', Auth::user()->ID )
                ->where('tipotransacion', '=', 1 )
				->get();
		
		$data = [
			'billetera' => $billetera,
			'volver' => false
		];

     return view('wallet.cobros', compact('data', 'moneda')); 
    }
	
	/**
	 * Permite filtras los retiros de los usuario
	 *
	 * @param Request $request
	 * @return void
	 */
    public function cobros_fechas(Request $request)
    {
		// TITLE
		view()->share('title', 'Historial de Retiro - Desde: '.$request->primero.' Hasta: '.$request->segundo);

		$moneda = Monedas::where('principal', 1)->get()->first();
		$billetera = Wallet::whereDate("created_at",">=",$request->primero)
					->whereDate("created_at","<=",$request->segundo)
					->where('tipotransacion', '=', 2)
					->where('iduser', '=', Auth::user()->ID )
					->get();

		$data = [
			'billetera' => $billetera,
			'volver' => true
		];

     return view('wallet.cobros', compact('data', 'moneda')); 
	}
	

}
