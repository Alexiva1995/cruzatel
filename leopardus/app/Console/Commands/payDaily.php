<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Http\Controllers\ComisionesController;

class payDaily extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pay:daily';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Permite Pagar los pago diario cada media hora';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        try {
            $comisiones = new ComisionesController;
            $comisiones->bonoDirecto();
            $this->info('Bono Directo Pagado Correctamente '.Carbon::now());
            $comisiones->bonoXConsumo();
            $this->info('Bono Por Consumo Pagado Correctamente '.Carbon::now());
            $comisiones->recordPoint();
            $this->info('Puntos Pagados Correctamente '.Carbon::now());
        } catch (\Throwable $th) {
            $this->info($th);
        }
    }
}
