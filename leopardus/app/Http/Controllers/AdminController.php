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
                'nombre' => 'Membresia Junior'
            ],
            'puntos' => [
                'derechos' => Auth::user()->puntosder,
                'izquierdos' => Auth::user()->puntosizq
            ],
            'billetera' => Auth::user()->wallet_amount,
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


        return view('dashboard.directRecords')->with(compact('referidosDirectos'));

    }

    

    public function buscardirectos(){

        // TITLE

        view()->share('title', 'Usuarios Directos');



        // DO MENU

        view()->share('do', collect(['name' => 'network', 'text' => 'Red de Usuarios']));



        $primero = new Carbon($_POST["fecha1"]);

        $segundo = new Carbon($_POST["fecha2"]);


            $referidosDirectos =User::whereDate("created_at",">=",$primero)

             ->whereDate("created_at","<=",$segundo)

             ->where('referred_id', '=', Auth::user()->ID)

             ->orderBy('created_at', 'DESC')

             ->get();




        return view('dashboard.buscardirectos')->with(compact('referidosDirectos'));

    }

    

    public function buscarnetwork(){

        // TITLE

        view()->share('title', 'Usuarios en Red');

        view()->share('do', collect(['name' => 'network', 'text' => 'Red de Usuarios']));


        $allReferido = $this->generarArregloUsuario(Auth::user()->ID);
        return view('dashboard.buscarnetwork')->with(compact('allReferido','primero','segundo'));

    }

    public function buscarnetworknivel(Request $request)
    {
                // TITLE
                $funcionesIndex = new IndexController();
                view()->share('title', 'Usuarios en Red');

                // DO MENU
        
                view()->share('do', collect(['name' => 'network', 'text' => 'Red de Usuarios']));
                
                $allReferidotmp = $funcionesIndex->getChidrens2(Auth::user()->ID, [], 1, 'referred_id', 0);
                $allReferido = [];
                foreach ($allReferidotmp as $user ) {
                    if ($request->nivel > 0) {
                        if ($user['nivel'] == $request->nivel) {
                            $allReferido [] = $user;
                        }
                    } else {
                            $allReferido [] = $user;
                    }
                    
                }
                return view('dashboard.networkRecords')->with(compact('allReferido'));
    }



    public function network_records(){

        // TITLE

        view()->share('title', 'Usuarios en Red');

        $funcionesIndex = new IndexController();

        // DO MENU

        view()->share('do', collect(['name' => 'network', 'text' => 'Red de Usuarios']));

        
        $allReferido = $funcionesIndex->getChidrens2(Auth::user()->ID, [], 1, 'referred_id', 0);


        return view('dashboard.networkRecords')->with(compact('allReferido'));

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

    

    public function personal_orders(){
          // TITLE
          view()->share('title', 'Ordenes Personales');
        $settings = Settings::first();
        $ordenes = DB::table($settings->prefijo_wp.'postmeta')
                    ->select('post_id')
                    ->where('meta_key', '=', '_customer_user')
                    ->where('meta_value', '=', Auth::user()->ID)
                    ->orderBy('post_id', 'DESC')
                    ->get();
         //******************
        //Marcar como leídas las notificaciones pendientes de Órdenes Directas
        $notificaciones_pendientes = DB::table('notifications')
                                        ->select('id')
                                        ->where('user_id', '=', Auth::user()->ID)
                                        ->where('notification_type', '=', 'OD')
                                        ->where('status', '=', 0)
                                        ->get();
        foreach ($notificaciones_pendientes as $not){
            Notification::find($not->id)->update(['status' => 1]);
        }
        //********************
        return view('dashboard.personalOrders')->with(compact('ordenes'));



    }

    

    

     public function buscarpersonalorder(){

          // TITLE

          view()->share('title', 'Ordenes Personales');

        $settings = Settings::first();

        $primero = new Carbon($_POST['fecha1']);

        $segundo = new Carbon($_POST['fecha2']);

        

        $ordenes = DB::table($settings->prefijo_wp.'postmeta')

                    ->select('post_id')

                    ->where('meta_key', '=', '_customer_user')

                    ->where('meta_value', '=', Auth::user()->ID)

                    ->orderBy('post_id', 'DESC')

                    ->get();

        return view('dashboard.buscarpersonalorder')->with(compact('ordenes','primero','segundo'));



    }

    /**
     * Genera la Informacion de las ordenes de la red
     * 
     * @access public
     * @param int $order_id - orden de la compra, array $array_datos - informacion de las compras, int $level - nivel del usuario
     * @return array
     */
    public function getDetailsOrder($order_id, $array_datos, $level, $nombre, $fecha){
        $settings = Settings::first();
        $numOrden = DB::table($settings->prefijo_wp.'postmeta')
                        ->select('meta_value')
                        ->where('post_id', '=', $order_id)
                        ->where('meta_key', '=', '_order_key')
                        ->first();
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
                array_push($array_datos, array($order_id, $nombreCompleto, $fechaOrden->post_date, $items, $totalOrden->meta_value, $level, $estadoEntendible) );
            }
        } else {
            array_push($array_datos, array($order_id, $nombreCompleto, $fechaOrden->post_date, $items, $totalOrden->meta_value, $level, $estadoEntendible) );
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

        $compras = array();

        $fecha = [];

         if (!empty($TodosUsuarios)) {

        foreach($TodosUsuarios as $user){

            $ordenes = DB::table($settings->prefijo_wp.'postmeta')

                            ->select('post_id')

                            ->where('meta_key', '=', '_customer_user')

                            ->where('meta_value', '=', $user['ID'])

                            ->orderBy('post_id', 'DESC')

                            ->get();



            foreach ($ordenes as $orden){

                $compras = $this->getDetailsOrder($orden->post_id, $compras, '1', $user->display_name, $fecha);

            }

        }

    }



        //******************

        //Marcar como leídas las notificaciones pendientes de Órdenes en Red

        $notificaciones_pendientes = DB::table('notifications')

                                        ->select('id')

                                        ->where('user_id', '=', Auth::user()->ID)

                                        ->where('notification_type', '=', 'OR')

                                        ->where('status', '=', 0)

                                        ->get();



        foreach ($notificaciones_pendientes as $not){

            Notification::find($not->id)->update(['status' => 1]);

        }

        //********************



        return view('dashboard.networkOrders')->with(compact('compras'));

    }

    

    

     public function buscarnetworkorder(){
          // TITLE
          view()->share('title', 'Ordenes de Red');
          $funcionesIndex = new IndexController();

          $TodosUsuarios = $funcionesIndex->getChidrens2(Auth::user()->ID, [], 1, 'referred_id', 0);
         $settings = Settings::first();
        $compras = array();

        $fecha = [
            'primero' => new Carbon($_POST['fecha1']),
            'segundo' => new Carbon($_POST['fecha2'])
        ];
         if (!empty($TodosUsuarios)) {
        foreach($TodosUsuarios as $user){

            $ordenes = DB::table($settings->prefijo_wp.'postmeta')
                            ->select('post_id')
                            ->where('meta_key', '=', '_customer_user')
                            ->where('meta_value', '=', $user['ID'])
                            ->orderBy('post_id', 'DESC')
                            ->get();
            foreach ($ordenes as $orden){
                $compras = $this->getDetailsOrder($orden->post_id, $compras, '1', $user->display_name, $fecha);
            }
        }
    }

        

        return view('dashboard.networkOrders')->with(compact('compras'));

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

