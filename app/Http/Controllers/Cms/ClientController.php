<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClientRequest;
use App\Http\Services\Client\Client as ClientService;
use App\Http\Services\Helper\Helper as HelperService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ClientController extends Controller
{
    protected $client_service;
    protected $helper_service;

    public function __construct(ClientService $client_service, HelperService $helper_service)
    {
        $this->client_service = $client_service;
        $this->helper_service = $helper_service;
    }

    public function index()
    {
        try {
            $filters = collect();
            $filters->search = request()->input('search');
            $filters->search_cpf = request()->input('search_cpf');
            // $filters->occupation_search = request()->input('occupation_search');
            // $filters->sector_search = request()->input('sector_search');

            $client = $this->client_service->paginate($filters, 5);

            // $equipment_export = $this->client_service->getDataExport($filters);
            // session()->put('equipment_export', $equipment_export);

            return view('cms.client.index', [
                'clients' => $client,
            ]);
        } catch (Exception $e) {
            $error = 'An error occurred in action cms equipment index.';
            Log::error($error . ' file: "' . $e->getFile() . '", line: ' . $e->getLine() . ', error: "' . $e->getMessage() . '"');
        }
    }

    public function report($id)
    {
        try {
            $equipment = $this->client_service->findOrFail($id);
            $equipment_image = $this->client_service->findForWhere($id);
            $federative_units = $this->helper_service->getFederativeUnit();
            $sector_allocation = $this->client_service->getSector();
            $equipment_type = $this->client_service->getEquipmentType();
            $images = $equipment_image->all();
            return view('cms.client.report', [
                'equipment' => $equipment,
                'federative_units' => $federative_units,
                'sector_allocation' => $sector_allocation,
                'equipment_type' => $equipment_type,
                'equipment_image' => $images,
            ]);
        } catch (Exception $e) {
            $error = 'An error occurred in action cms equipment edit.';
            Log::error($error . ' file: "' . $e->getFile() . '", line: ' . $e->getLine() . ', error: "' . $e->getMessage() . '"');
        }
    }

    public function create()
    {
        try {
            $marital_status = $this->client_service->getMaritalStatus();
            return view('cms.client.create', ['marital_status' => $marital_status]);
        } catch (Exception $e) {
            $error = 'An error occurred in action cms equipment create.';
            Log::error($error . ' file: "' . $e->getFile() . '", line: ' . $e->getLine() . ', error: "' . $e->getMessage() . '"');
        }
    }

    public function store(ClientRequest $request)
    {
        try {
            $this->client_service->createData($request);
            $toast_notification = array(
                'title' => 'Sucesso!',
                'message' => 'Cliente salvos com sucesso!',
                'alert-type' => 'success'
            );
            return redirect(route('cms.client.index'))->with($toast_notification);
        } catch (Exception $e) {
            $error = 'An error occurred in action cms equipment create.';
            Log::error($error . ' file: "' . $e->getFile() . '", line: ' . $e->getLine() . ', error: "' . $e->getMessage() . '"');
        }
    }

    public function edit($id)
    {
        $this->authorize('edit_register');
        $marital_status = $this->client_service->getMaritalStatus();
        try {
            $client = $this->client_service->findOrFail($id);

            return view('cms.client.edit', [
                'client' => $client, 'marital_status' => $marital_status
            ]);
        } catch (Exception $e) {
            $error = 'An error occurred in action cms equipment edit.';
            Log::error($error . ' file: "' . $e->getFile() . '", line: ' . $e->getLine() . ', error: "' . $e->getMessage() . '"');
        }
    }

    public function show($id)
    {
        return back();
    }

    public function update(Request $request, $id)
    {
        try {
            $this->client_service->update($id, $request);
            $toast_notification = array(
                'title' => 'Sucesso!',
                'message' => 'Cliente atualizado com sucesso!',
                'alert-type' => 'success'
            );
        } catch (Exception $e) {
            $error = 'An error occurred in action cms equipment update.';
            Log::error($error . ' file: "' . $e->getFile() . '", line: ' . $e->getLine() . ', error: "' . $e->getMessage() . '"');
            $toast_notification = array(
                'title' => 'Erro',
                'message' => 'Ocorreu um erro ao editar os dados!',
                'alert-type' => 'warning'
            );
        }
        return back()->with($toast_notification);
    }

    public function destroy($id)
    {
        $this->authorize('delete_register');
        try {
            $this->client_service->destroy($id);
            $toast_notification = array(
                'title' => 'Sucesso!',
                'message' => 'Cliente excluído com sucesso!',
                'alert-type' => 'success'
            );
            return redirect()->route('cms.client.index')->with($toast_notification);
        } catch (Exception $e) {
            $error = 'An error occurred in action cms equipment edit.';
            Log::error($error . ' file: "' . $e->getFile() . '", line: ' . $e->getLine() . ', error: "' . $e->getMessage() . '"');
        }
    }

    public function search($request)
    {
        
        $termoPesquisa = $request->get('q');

        $client = $this->client_service->findOrFail($termoPesquisa);


        return response()->json($client);
    }

    // public function exportCSV(Request $request)
    // {
    //     $fileName = 'equipment_export.csv';
    //     $equipments = session()->get('equipment_export');

    //     $headers = array(
    //         "Content-type"        => "text/csv",
    //         "Content-Disposition" => "attachment; filename=$fileName",
    //         "Pragma"              => "no-cache",
    //         "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
    //         "Expires"             => "0"
    //     );

    //     $columns = array(
    //         'Tipo Equipamento',
    //         'Nome Equipamento',
    //         'Data Cadastro',
    //         'Fornecedor',
    //         'Setor Alocação',
    //     );

    //     $callback = function () use ($equipments, $columns) {
    //         $file = fopen('php://output', 'w');
    //         fputcsv($file, $columns);

    //         foreach ($equipments as $equipment) {
    //             $row['Tipo Equipamento']  = $equipment->equipment_type->description;
    //             $row['Nome Equipamento']    = $equipment->name;
    //             $row['Data Cadastro']    = $equipment->register_date;
    //             $row['Fornecedor']    = $equipment->provider;
    //             $row['Setor Alocação']  = $equipment->sector_allocation->description;

    //             fputcsv($file, array(
    //                 $row['Tipo Equipamento'],
    //                 $row['Nome Equipamento'],
    //                 $row['Data Cadastro'],
    //                 $row['Fornecedor'],
    //                 $row['Setor Alocação'],
    //             ));
    //         }

    //         fclose($file);
    //     };

    //     return response()->stream($callback, 200, $headers);
    // }
}
