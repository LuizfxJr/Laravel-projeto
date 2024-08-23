<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User as UserModel;

class HomeController extends Controller
{
    protected $material_service;
    protected $equipment_service;
    protected $inspection_service;
    protected $productivity_analysis_service;


    public function __construct()
    {
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $user = $request->input('user');

        $financings = DB::table('financings')
            ->select(
                DB::raw('COUNT(CASE WHEN status = "novo" THEN 1 END) as novo'),
                DB::raw('COUNT(CASE WHEN status = "Análise Interna" THEN 1 END) as simulacao'),
                DB::raw('COUNT(CASE WHEN status = "Pré Aprovado" THEN 1 END) as preaprovado'),
                DB::raw('SUM(IF(status = "Recolhimento de documentos cliente" OR status = "Abertura de conta/tranferencia", 1, 0)) as andamento'),
                DB::raw('COUNT(CASE WHEN status = "aprovado" THEN 1 END) as aprovado'),
                DB::raw('SUM(IF(status = "Buscando Imóvel" OR status = "Recolhimento de documentos/vendedor" OR status = "Vistoria" OR status = "Análise de documentos" OR status = "Contrato" OR status = "Cartório" OR status = "Anexo de Matricula/Contrato", 1, 0)) as andamentoPos'),
                DB::raw('COUNT(CASE WHEN status = "Finalizado/Pago aos Vendedores" THEN 1 END) as finalizado'),
                DB::raw('COUNT(CASE WHEN status = "Negado" THEN 1 END) as recusado'),
            )
            ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                return $query->whereBetween('created_at', [$startDate, $endDate]);
            })
            ->where('user_id', 'LIKE', '%' . $user . '%')
            ->get();

        $loans = DB::table('loans')
            ->select(
                DB::raw('COUNT(CASE WHEN status = "novo" THEN 1 END) as novo'),
                DB::raw('COUNT(CASE WHEN status = "simulação" THEN 1 END) as simulacao'),
                DB::raw('COUNT(CASE WHEN status = "andamento" THEN 1 END) as andamento'),
                DB::raw('COUNT(CASE WHEN status = "recusado" THEN 1 END) as recusado'),
                DB::raw('COUNT(CASE WHEN status = "aprovado" THEN 1 END) as aprovado')
            )
            ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                return $query->whereBetween('created_at', [$startDate, $endDate]);
            })
            ->where('user_id', 'LIKE', '%' . $user . '%')
            ->get();

        $properties = DB::table('properties')
            ->select(
                DB::raw('COUNT(CASE WHEN status = "0" THEN 1 END) as novo'),
                DB::raw('COUNT(CASE WHEN status = "1" THEN 1 END) as vendido')
            )
            ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                return $query->whereBetween('created_at', [$startDate, $endDate]);
            })
            ->where('user_id', 'LIKE', '%' . $user . '%')
            ->get();

        $users = UserModel::select('id', 'name')->orderBy('name')->get();

        return view('cms.home', [
            'financings' => $financings,
            'loans' => $loans,
            'properties' => $properties,
            'users' => $users
        ]);
    }
}
