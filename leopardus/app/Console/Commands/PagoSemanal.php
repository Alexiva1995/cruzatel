<?php

namespace App\Console\Commands;

use App\Http\Controllers\ComisionesController;
use App\User;
use Illuminate\Console\Command;


class PagoSemanal extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pago:semanal';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Permite activar el pago de los bonos semanales';

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
        $users = User::where('ID', '!=', 1)->get();
        $funcionConmision = new ComisionesController();
        foreach ($users as $user) {
            $funcionConmision->bonoIndividual($user->ID);
            $funcionConmision->bonoXConsumoResidual($user->ID);
        }
    }
}
