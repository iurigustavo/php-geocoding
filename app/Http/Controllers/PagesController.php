<?php

    namespace App\Http\Controllers;

    use App\Http\Helpers\CallAPI;
    use App\Models\Vacinacao;
    use App\Models\viewPessoasVacinacao;
    use App\Services\Cargos\CargoService;
    use App\Services\Cargos\NomeacaoService;
    use App\Services\GraficoService;
    use Exception;
    use Illuminate\Support\Arr;
    use Illuminate\Support\Facades\DB;

    class PagesController extends Controller
    {


        public function index()
        {
            $page_title = 'Dashboard';

            return view('pages.principal', compact('page_title'));
        }



    }
