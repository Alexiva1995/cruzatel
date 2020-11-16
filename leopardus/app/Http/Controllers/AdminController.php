<?php



namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\User;
use App\Settings;
use App\Notification;


use App\Http\Controllers\IndexController;
use App\Http\Controllers\ActivacionController;
use App\Http\Controllers\PublicidadController;

class AdminController extends Controller

{

	function __construct()

	{

        // TITLE

		view()->share('title', 'Balance General');

	}



    public function index()
    {

        $funcionesIndex = new IndexController();
        $publicidad = new PublicidadController();
        $activacion = new ActivacionController();
        $activacion->activarUsuarios(Auth::user()->ID);
        $data = [
            'activoBinario' => $funcionesIndex->statusBinary(Auth::user()->ID),
            'progresoDiario' => $publicidad->progresoDiario(Auth::user()->ID),
            'membresia' => [
                'img' => 'https://comunidadlevelup.com/assets/imgLanding/logo.png',
                'nombre' => 'Junior'
            ],
            'puntos' => [
                'derechos' => Auth::user()->puntosder,
                'izquierdos' => Auth::user()->puntosizq
            ],
            'billetera' => number_format(Auth::user()->wallet_amount, 3, ',', '.'),
            'publicidades' => $publicidad->getPublicidadCompartir(Auth::user()->ID)
        ];
        view()->share('title', 'Balance General');
        return view('dashboard.index', compact('data'));
    }


    /**
     * Lleva a la vista de los usuarios directos
     *
     * @return void
     */
    public function direct_records(){
        // TITLE
        view()->share('title', 'Usuarios Directos');
        // DO MENU
        view()->share('do', collect(['name' => 'network', 'text' => 'Red de Usuarios']));
        $referidosDirectos = User::where('referred_id', '=', Auth::user()->ID)
                            ->orderBy('created_at', 'DESC')
                            ->get();
        $data = [
            'referidosDirectos' => $referidosDirectos,
            'volver' => false,
        ];
        return view('dashboard.directRecords')->with(compact('data'));

    }

    /**
     * Permite filtrar a los usuarios directos por fechas
     *
     * @return void
     */
    public function buscardirectos(){
        $primero = new Carbon($_POST["fecha1"]);
        $segundo = new Carbon($_POST["fecha2"]);

        // TITLE
        view()->share('title', 'Usuarios Directos - Desde: '.$primero->format('d-m-Y').' Hasta: '.$segundo->format('d-m-Y'));

        $referidosDirectos = User::whereDate("created_at",">=",$primero)
                            ->whereDate("created_at","<=",$segundo)
                            ->where('referred_id', '=', Auth::user()->ID)
                            ->orderBy('created_at', 'DESC')
                            ->get();

        $data = [
            'referidosDirectos' => $referidosDirectos,
            'volver' => true,
        ];
        return view('dashboard.directRecords')->with(compact('data'));
    }

    /**
     * Lleva a la vista de red
     *
     * @return void
     */
    public function network_records(){

        // TITLE
        view()->share('title', 'Usuarios en Red');

        $funcionesIndex = new IndexController();
        $allReferido = $funcionesIndex->getChidrens2(Auth::user()->ID, [], 1, 'referred_id', 0);
        $data = [
            'allReferido' => $allReferido,
            'volver' => false
        ];

        return view('dashboard.networkRecords')->with(compact('data'));

    }

    /**
     * Permite filtrar mis usuarios en red
     *
     * @return void
     */
    public function buscarnetwork(){

        $primero = new Carbon($_POST["fecha1"]);
        $segundo = new Carbon($_POST["fecha2"]);
        // TITLE
        view()->share('title', 'Usuarios en Red - Desde: '.$primero->format('d-m-Y').' Hasta: '.$segundo->format('d-m-Y'));
        
        $funcionesIndex = new IndexController();
        $allReferidotmp = $funcionesIndex->getChidrens2(Auth::user()->ID, [], 1, 'referred_id', 0);
        $allReferido = [];
        foreach ($allReferidotmp as $referido) {
            $fechaRegistro = new Carbon($referido->created_at);
            if ($fechaRegistro >= $primero && $fechaRegistro <= $segundo) {
                $allReferido [] = $referido;
            }
        }
        $data = [
            'allReferido' => $allReferido,
            'volver' => true
        ];

        return view('dashboard.networkRecords')->with(compact('data'));
    }

    /**
     * Lleva a la vista de los usuario binarios
     *
     * @return void
     */
    public function recordUserBinary()
    {
        // TITLE
        view()->share('title', 'Usuarios Binarios');

        $funcionesIndex = new IndexController();
        $allReferido = $funcionesIndex->getChidrens2(Auth::user()->ID, [], 1, 'position_id', 0);
        $data = [
            'allReferido' => $allReferido,
            'volver' => false
        ];

        return view('dashboard.binaryRecords')->with(compact('data'));
    }

    /**
     * Permite filtrar los usuario binarios
     *
     * @return void
     */
    public function recordUserBinaryBuscar()
    {
        
        $primero = new Carbon($_POST["fecha1"]);
        $segundo = new Carbon($_POST["fecha2"]);
        // TITLE
        view()->share('title', 'Usuarios Binarios - Desde: '.$primero->format('d-m-Y').' Hasta: '.$segundo->format('d-m-Y'));
        
        $funcionesIndex = new IndexController();
        $allReferidotmp = $funcionesIndex->getChidrens2(Auth::user()->ID, [], 1, 'position_id', 0);
        $allReferido = [];
        foreach ($allReferidotmp as $referido) {
            $fechaRegistro = new Carbon($referido->created_at);
            if ($fechaRegistro >= $primero && $fechaRegistro <= $segundo) {
                $allReferido [] = $referido;
            }
        }
        $data = [
            'allReferido' => $allReferido,
            'volver' => true
        ];

        return view('dashboard.binaryRecords')->with(compact('data'));
    }

    /**
     * Permite Borrar a todos los usuarios del sistema menos al admin
     *
     * @return void
     */
    public function deleteTodos()

        {

            $usuario = User::All();



		foreach ($usuario as $usuari) {

			if ($usuari->ID != 1) {

            $user = User::find($usuari->ID);

            DB::table('user_campo')->where('ID', $usuari->ID)->delete();

            $user->delete();  

            }

		}

            return redirect('mioficina/admin/userrecords')->with('msj', 'Todos los usuarios han sidos borrados menos el Administrador');

        }

    /**
     * Lleva a la vista de mi historia de compra
     *
     * @return void
     */
    public function personal_orders(){
        // TITLE
        view()->share('title', 'Ordenes Personales');
        
        $settings = Settings::first();
        $ordenes = [];
        $ordenestmp = DB::table($settings->prefijo_wp.'postmeta')
                    ->select('post_id')
                    ->where('meta_key', '=', '_customer_user')
                    ->where('meta_value', '=', Auth::user()->ID)
                    ->orderBy('post_id', 'DESC')
                    ->get();

        $fecha = [];
        
        foreach ($ordenestmp as $orden) {
            $ordenes = $this->getDetailsOrder($orden->post_id, $ordenes, 1, Auth::user()->display_name, $fecha);
        }

        
        // $fecha = [
        //     'primero' => new Carbon($_POST['fecha1']),
        //     'segundo' => new Carbon($_POST['fecha2'])
        // ];

        $data = [
            'ordenes' => $ordenes,
            'volver' => false
        ];

        return view('dashboard.personalOrders')->with(compact('data'));
    }

    /**
     * Permite aplicar filtro a las compras personales
     *
     * @return void
     */
    public function buscarpersonalorder(){

        // TITLE
        $fecha = [
            'primero' => new Carbon($_POST['fecha1']),
            'segundo' => new Carbon($_POST['fecha2'])
        ];
        view()->share('title', 'Ordenes Personales - Desde: '.$fecha['primero']->format('d-m-Y').' Hasta: '.$fecha['segundo']->format('d-m-Y'));
        
        $settings = Settings::first();
        $ordenes = [];
        $ordenestmp = DB::table($settings->prefijo_wp.'postmeta')
                    ->select('post_id')
                    ->where('meta_key', '=', '_customer_user')
                    ->where('meta_value', '=', Auth::user()->ID)
                    ->orderBy('post_id', 'DESC')
                    ->get();

        
        foreach ($ordenestmp as $orden) {
            $ordenes = $this->getDetailsOrder($orden->post_id, $ordenes, 1, Auth::user()->display_name, $fecha);
        }

        $data = [
            'ordenes' => $ordenes,
            'volver' => true
        ];

        return view('dashboard.personalOrders')->with(compact('data'));

    }

    /**
     * Genera la informacion de la ordenes compradas
     *
     * @param integer $order_id
     * @param array $array_datos
     * @param integer $level
     * @param string $nombre
     * @param array $fecha
     * @return array
     */
    public function getDetailsOrder($order_id, $array_datos, $level, $nombre, $fecha): array
    {
        $settings = Settings::first();
        $fechaOrden = DB::table($settings->prefijo_wp.'posts')
                        ->select('post_date')
                        ->where('ID', '=', $order_id)
                        ->first();
        $totalOrden = DB::table($settings->prefijo_wp.'postmeta')
                        ->select('meta_value')
                        ->where('post_id', '=', $order_id)
                        ->where('meta_key', '=', '_order_total')
                        ->first();
        $nombreOrden = DB::table($settings->prefijo_wp.'postmeta')
                        ->select('meta_value')
                        ->where('post_id', '=', $order_id)
                        ->where('meta_key', '=', '_billing_first_name')
                        ->first();
        $apellidoOrden = DB::table($settings->prefijo_wp.'postmeta')
                        ->select('meta_value')
                        ->where('post_id', '=', $order_id)
                        ->where('meta_key', '=', '_billing_last_name')
                        ->first();
		$nombreCompleto = $nombre;
        if (!empty($nombreOrden->meta_value) && !empty($apellidoOrden->meta_value)) {
    	$nombreCompleto = $nombreOrden->meta_value." ".$apellidoOrden->meta_value;
        }
        $itemsOrden = DB::table($settings->prefijo_wp.'woocommerce_order_items')
                        ->select('order_item_name')
                        ->where('order_id', '=', $order_id)
                        ->where('order_item_type', '=', 'line_item')
                        ->get();
        $estadoOrden = DB::table($settings->prefijo_wp.'posts')
                        ->select('post_status')
                        ->where('ID', '=', $order_id)
                        ->first();
        $estadoEntendible = '';
        switch ($estadoOrden->post_status) {
            case 'wc-completed':
                $estadoEntendible = 'Completado';
                break;
            case 'wc-pending':
                $estadoEntendible = 'Pendiente de Pago';
                break;
            case 'wc-processing':
                $estadoEntendible = 'Procesando';
                break;
            case 'wc-on-hold':
                $estadoEntendible = 'En Espera';
                break;
            case 'wc-cancelled':
                $estadoEntendible = 'Cancelado';
                break;
            case 'wc-refunded':
                $estadoEntendible = 'Reembolsado';
                break;
            case 'wc-failed':
                $estadoEntendible = 'Fallido';
                break;
        }
        $items = "";
        foreach ($itemsOrden as $item){
            $items = $items." ".$item->order_item_name;
        }
        if (!empty($fecha)) {
            $fechaCompra = new Carbon($fechaOrden->post_date);
            if ($fechaCompra->format('ymd') >= $fecha['primero']->format('ymd') && $fechaCompra->format('ymd') <= $fecha['segundo']->format('ymd')) {
                $array_datos [] = [
                    'idorden' => $order_id,
                    'nombre' => $nombreCompleto,
                    'fecha_orden' => $fechaOrden->post_date,
                    'productos' => $items, 
                    'total' => $totalOrden->meta_value,
                    'nivel' => $level,
                    'estado' => $estadoEntendible
                ];
            }
        } else {
            $array_datos [] = [
                'idorden' => $order_id,
                'nombre' => $nombreCompleto,
                'fecha_orden' => $fechaOrden->post_date,
                'productos' => $items, 
                'total' => $totalOrden->meta_value,
                'nivel' => $level,
                'estado' => $estadoEntendible
            ];
        }
        
        return($array_datos);
    }



    /**
     * Genera todas las ordenes de red de usuarios
     * 
     * @access public
     * @return view - vista de transacciones
     */
    public function network_orders(){

        view()->share('title', 'Ordenes de Red');
        $settings = Settings::first();
        $funcionesIndex = new IndexController();
        $TodosUsuarios = $funcionesIndex->getChidrens2(Auth::user()->ID, [], 1, 'referred_id', 0);
        $ordenes = [];
        $fecha = [];
        if (!empty($TodosUsuarios)) {
            foreach($TodosUsuarios as $user){
                $compras = DB::table($settings->prefijo_wp.'postmeta')
                            ->select('post_id')
                            ->where('meta_key', '=', '_customer_user')
                            ->where('meta_value', '=', $user->ID)
                            ->orderBy('post_id', 'DESC')
                            ->get();

                foreach ($compras as $orden){
                    $ordenes = $this->getDetailsOrder($orden->post_id, $ordenes, $user->nivel, $user->display_name, $fecha);
                }
            }
        }

        $data = [
            'ordenes' => $ordenes,
            'volver' => false
        ];
        
        return view('dashboard.networkOrders')->with(compact('data'));
    }

    /**
     * Permite aplicar filtros a las compras de mis usuarios
     *
     * @return void
     */
     public function buscarnetworkorder(){
          // TITLE
        $fecha = [
            'primero' => new Carbon($_POST['fecha1']),
            'segundo' => new Carbon($_POST['fecha2'])
        ];
        view()->share('title', 'Ordenes en Red - Desde: '.$fecha['primero']->format('d-m-Y').' Hasta: '.$fecha['segundo']->format('d-m-Y'));
        $settings = Settings::first();
        $funcionesIndex = new IndexController();
        $TodosUsuarios = $funcionesIndex->getChidrens2(Auth::user()->ID, [], 1, 'referred_id', 0);
        $ordenes = [];
        if (!empty($TodosUsuarios)) {
            foreach($TodosUsuarios as $user){
                $compras = DB::table($settings->prefijo_wp.'postmeta')
                            ->select('post_id')
                            ->where('meta_key', '=', '_customer_user')
                            ->where('meta_value', '=', $user->ID)
                            ->orderBy('post_id', 'DESC')
                            ->get();

                foreach ($compras as $orden){
                    $ordenes = $this->getDetailsOrder($orden->post_id, $ordenes, $user->nivel, $user->display_name, $fecha);
                }
            }
        }

        $data = [
            'ordenes' => $ordenes,
            'volver' => true
        ];
        
        return view('dashboard.networkOrders')->with(compact('data'));

    }

    

    public function buscar(Request $request){

          // TITLE

          view()->share('title', 'Buscar Usuario');



      

     return view('admin.buscar');

    }

    

     public function vista(Request $request){

          // TITLE

          view()->share('title', 'Buscar Usuario');



       $user=User::search($request->get('user_email'))->orderBy('id','ASC')->paginate(1);
        return view('admin.vista')->with('user',$user);

    }


    // /**
    //  * Permite eliminar las ordenes del postmetas
    //  *
    //  * @return void
    //  */
    // public function eliminarOrdenPostmetas()
    // {
    //     $sql = "SELECT * FROM `wp_postmeta` WHERE meta_value like 'wc_order%' ";
    //     $postmetas = DB::select($sql);
    //     foreach ($postmetas as $post) {
    //         if ($post->post_id < 5505) {
    //             DB::statement("DELETE FROM `wp_postmeta` WHERE post_id =".$post->post_id);
    //         }
            
    //     }
    // }

}

