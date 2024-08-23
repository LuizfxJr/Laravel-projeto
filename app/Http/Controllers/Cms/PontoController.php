<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Http\Services\User\User;
use Illuminate\Http\Request;
use App\Models\Ponto;
use App\Models\User as ModelsUser;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PontoController extends Controller
{
    public function index(Request $request)
    {

        if (Auth::user()->user_level === 'collaborator') {
            $horas_trabalhadas_mes = 0;

            $pontos = Ponto::where('user_id', Auth::user()->id)
                ->whereYear('data', Carbon::now()->year)
                ->whereMonth('data', Carbon::now()->month)
                ->orderBy('data', 'desc')
                ->get();

            $horas_trabalhadas_mes = $this->queryConsult(Auth::user()->id, Carbon::now()->year, Carbon::now()->month);
            return view('cms.pontos.index', compact('pontos', 'horas_trabalhadas_mes'));
        } else {

            $query = Ponto::query();
            $horas_trabalhadas_mes = 0;



            if ($request->mes) {
                $data = Carbon::parse($request->mes);

                $ano = $data->year;
                $mes = $data->month;

                $query->whereYear('data', $data->year)
                    ->whereMonth('data', $data->month);

                if ($request->has('collaborator_id')) {
                    $query->where('user_id', $request->collaborator_id);
                    $horas_trabalhadas_mes = $this->queryConsult($request->collaborator_id, $data->year, $data->month);
                } else {
                    $horas_trabalhadas_mes = $this->queryConsult(Auth::user()->id, $data->year, $data->month);
                    $query->where('user_id', Auth::user()->id);
                }
            } else {
                $query->whereYear('data', Carbon::now()->year)
                    ->whereMonth('data', Carbon::now()->month);

                if ($request->has('collaborator_id')) {
                    $query->where('user_id', $request->collaborator_id);
                    $horas_trabalhadas_mes = $this->queryConsult($request->collaborator_id, Carbon::now()->year, Carbon::now()->month);
                } else {
                    $query->where('user_id', Auth::user()->id);
                    $horas_trabalhadas_mes = $this->queryConsult(Auth::user()->id, Carbon::now()->year, Carbon::now()->month);
                }
            }

            $pontos = $query->orderBy('data', 'desc')
                ->get();

            $collaborators = ModelsUser::all();


            return view('cms.pontos.index', compact('pontos', 'collaborators', 'horas_trabalhadas_mes'));
        }
    }

    public function queryConsult($id, $year, $month)
    {
        return Ponto::where('user_id', $id)
            ->whereYear('data', $year)
            ->whereMonth('data', $month)
            ->groupBy(DB::raw('YEAR(data), MONTH(data)'))
            ->get([
                DB::raw('YEAR(data) as year'),
                DB::raw('MONTH(data) as month'),
                DB::raw('SUM(TIME_TO_SEC(TIMEDIFF(IFNULL(hora_intervalo_saida, hora_saida), hora_entrada))) as segundos')
            ]);
    }

    public function relatorioUsuario($id)
    {
        $pontos = Ponto::where('user_id', $id)
            ->groupBy(DB::raw('YEAR(data), MONTH(data)'))
            ->get([
                DB::raw('YEAR(data) as year'),
                DB::raw('MONTH(data) as month'),
                DB::raw('SUM(TIME_TO_SEC(TIMEDIFF(IFNULL(hora_intervalo_saida, hora_saida), hora_entrada))) as segundos')
            ]);

        return view('cms.pontos.relatorio-usuario', compact('pontos'));
    }

    public function store(Request $request)
    {
        $ponto = new Ponto;
        $ponto->user_id = Auth::user()->id;
        $ponto->data = Carbon::now();
        $ponto->hora_entrada = Carbon::now();

        if ($request->has('hora_saida')) {
            $ponto->hora_saida = Carbon::now();
        }

        if ($request->has('hora_intervalo_saida')) {
            $ponto->hora_intervalo_saida = Carbon::now();
        }

        if ($request->has('hora_intervalo_volta')) {
            $ponto->hora_intervalo_volta = Carbon::now();
        }

        $ponto->save();

        return redirect()->route('cms.pontos.index')->with('success', 'Ponto registrado com sucesso!');
    }

    public function update(Request $request, $id)
    {
        $ponto = Ponto::findOrFail($id);

        $request->hora_entrada ? $ponto->hora_entrada = $request->hora_entrada : null;
        $request->hora_saida ? $ponto->hora_saida = $request->hora_saida : null;
        $request->hora_intervalo_saida ? $ponto->hora_intervalo_saida = $request->hora_intervalo_saida : null;
        $request->hora_intervalo_volta ? $ponto->hora_intervalo_volta = $request->hora_intervalo_volta : null;

        if ($request->tipo === 'hora_entrada') {
            $ponto->hora_entrada = Carbon::now();
        }

        if ($request->tipo === 'hora_saida') {
            $ponto->hora_saida = Carbon::now();
        }

        if ($request->tipo === 'hora_intervalo_saida') {
            $ponto->hora_intervalo_saida = Carbon::now();
        }

        if ($request->tipo === 'hora_intervalo_volta') {
            $ponto->hora_intervalo_volta = Carbon::now();
        }

        $ponto->save();

        return redirect()->route('cms.pontos.index')->with('success', 'Ponto atualizado com sucesso!');
    }
}
