<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Http\Requests\EquipmentRequest;
use App\Http\Requests\FinancingRequest;
use App\Http\Services\Financing\Financing as FinancingService;
use App\Http\Services\Client\Client as ClientService;
use App\Http\Services\Helper\Helper as HelperService;
use App\Http\Services\User\User as UserService;
use App\Models\FinancingLog;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FinancingController extends Controller
{
    protected $financing_service;
    protected $helper_service;
    protected $client_service;
    protected $user_service;
    protected $file_path = 'financing';

    public function __construct(FinancingService $financing_service, HelperService $helper_service, ClientService $client_service, UserService $user_service)
    {
        $this->financing_service = $financing_service;
        $this->helper_service = $helper_service;
        $this->client_service = $client_service;
        $this->user_service = $user_service;
    }

    public function index()
    {
        try {
            $filters = collect();
            $filters->client = request()->input('client');
            $filters->user = request()->input('user');
            $filters->status = request()->input('status');

            $financing = $this->financing_service->paginate($filters, 5);

            $status = $this->financing_service->getStatus();
            $clients = $this->client_service->getData();
            $users = $this->user_service->getData();
            // $equipment_export = $this->financing_service->getDataExport($filters);
            // session()->put('equipment_export', $equipment_export);

            return view('cms.financing.index', [
                'financings' => $financing,
                'status' => $status,
                'clients' => $clients,
                'users' => $users
            ]);
        } catch (Exception $e) {
            $error = 'An error occurred in action cms financing index.';
            Log::error($error . ' file: "' . $e->getFile() . '", line: ' . $e->getLine() . ', error: "' . $e->getMessage() . '"');
        }
    }

    public function report($id)
    {
        try {
            $financing = $this->financing_service->findOrFail($id);

            return view('cms.financing.report', [
                'financing' => $financing,

            ]);
        } catch (Exception $e) {
            $error = 'An error occurred in action cms financing edit.';
            Log::error($error . ' file: "' . $e->getFile() . '", line: ' . $e->getLine() . ', error: "' . $e->getMessage() . '"');
        }
    }

    public function create($id)
    {
        try {
            // $federative_units = $this->helper_service->getFederativeUnit();
            // $sector_allocation = $this->financing_service->getSector();
            // $equipment_type = $this->financing_service->getEquipmentType();
            $type_financing = $this->financing_service->getTypeFinancing();
            $type_product = $this->financing_service->getTypeProduct();
            $type_account = $this->financing_service->getTypeAccount();

            return view('cms.financing.create', ['type_financing' => $type_financing, 'type_product' => $type_product, 'type_account' => $type_account]);
        } catch (Exception $e) {
            $error = 'An error occurred in action cms financing create.';
            Log::error($error . ' file: "' . $e->getFile() . '", line: ' . $e->getLine() . ', error: "' . $e->getMessage() . '"');
        }
    }

    public function historic($id)
    {
        try {
            $user = request()->input('user');

            $financingsLogs = FinancingLog::with('user')->where('user_id', 'LIKE', '%' . $user . '%')->where('financing_id', $id)->get();
            $users = $this->user_service->getData();

            return view(
                'cms.financing.historic',
                [
                    'financingsLogs' => $financingsLogs,
                    'users' => $users,
                ]
            );
        } catch (Exception $e) {
            $error = 'An error occurred in action cms financing create.';
            Log::error($error . ' file: "' . $e->getFile() . '", line: ' . $e->getLine() . ', error: "' . $e->getMessage() . '"');
        }
    }

    public function consulta($id)
    {
        try {
            $client = $this->client_service->findOrFail($id);
            // $federative_units = $this->helper_service->getFederativeUnit();
            // $sector_allocation = $this->financing_service->getSector();
            // $equipment_type = $this->financing_service->getEquipmentType();
            $type_financing = $this->financing_service->getTypeFinancing();
            $type_product = $this->financing_service->getTypeProduct();
            $type_account = $this->financing_service->getTypeAccount();

            return view(
                'cms.financing.create',
                [
                    'type_financing' => $type_financing,
                    'type_product' => $type_product,
                    'type_account' => $type_account, 'client' => $client
                ]
            );
        } catch (Exception $e) {
            $error = 'An error occurred in action cms financing create.';
            Log::error($error . ' file: "' . $e->getFile() . '", line: ' . $e->getLine() . ', error: "' . $e->getMessage() . '"');
        }
    }

    public function store(FinancingRequest $request)
    {
        try {
            $this->financing_service->createData($request);
            $toast_notification = array(
                'title' => 'Sucesso!',
                'message' => 'Financiamento salvos com sucesso!',
                'alert-type' => 'success'
            );
            return redirect(route('cms.financing.index'))->with($toast_notification);
        } catch (Exception $e) {
            $error = 'An error occurred in action cms financing create.';
            Log::error($error . ' file: "' . $e->getFile() . '", line: ' . $e->getLine() . ', error: "' . $e->getMessage() . '"');
        }
    }

    public function edit($id)
    {
        $this->authorize('edit_register');
        try {
            $financing = $this->financing_service->findOrFail($id);
            $client = $this->client_service->findOrFail($financing->client_id);

            $type_financing = $this->financing_service->getTypeFinancing();
            $type_product = $this->financing_service->getTypeProduct();
            $type_account = $this->financing_service->getTypeAccount();
            $status = $this->financing_service->getStatus();

            return view('cms.financing.edit', [
                'financing' => $financing,
                'client' => $client,
                'type_financing' => $type_financing,
                'type_product' => $type_product,
                'type_account' => $type_account,
                'status' => $status,
            ]);
        } catch (Exception $e) {
            $error = 'An error occurred in action cms financing edit.';
            Log::error($error . ' file: "' . $e->getFile() . '", line: ' . $e->getLine() . ', error: "' . $e->getMessage() . '"');
        }
    }

    public function show($id)
    {
        return back();
    }

    public function update(FinancingRequest $request, $id)
    {
        $this->authorize('edit_register');
        try {
            $financing = $this->financing_service->findOrFail($id);
            $previousData = $financing->toArray();

            $this->financing_service->update($id, $request);
            $updatedData = $request->toArray();

            // Comparar os dados anteriores com os dados atualizados
            $changes = array_diff_assoc($updatedData, $previousData);

            // Registrar as alterações no log
            if (!empty($changes)) {
                $user = auth()->user();
                foreach ($changes as $field => $value) {
                    if ($field !== '_method' && $field !== '_token') {

                        if ($field === 'file_cpf') {
                            FinancingLog::create([
                                'financing_id' => $financing->id,
                                'user_id' => $user->id,
                                'action' => "Alteração do arquivo CPF",
                            ]);
                        } else if ($field === 'file_ir') {
                            FinancingLog::create([
                                'financing_id' => $financing->id,
                                'user_id' => $user->id,
                                'action' => "Alteração do arquivo IR",
                            ]);
                        } else if ($field === 'file_cr') {
                            FinancingLog::create([
                                'financing_id' => $financing->id,
                                'user_id' => $user->id,
                                'action' => "Alteração do arquivo Comprovante Residencia",
                            ]);
                        } else if ($field === 'file_rg') {
                            FinancingLog::create([
                                'financing_id' => $financing->id,
                                'user_id' => $user->id,
                                'action' => "Alteração do arquivo RG",
                            ]);
                        } else {

                            FinancingLog::create([
                                'financing_id' => $financing->id,
                                'user_id' => $user->id,
                                'action' => "Alteração do campo '$field' de '{$previousData[$field]}' para '$value'",
                            ]);
                        }
                    }
                }
            }

            $toast_notification = [
                'title' => 'Sucesso!',
                'message' => 'Financiamento atualizado com sucesso!',
                'alert-type' => 'success'
            ];
        } catch (Exception $e) {
            $error = 'An error occurred in action cms financing update.';
            Log::error($error . ' file: "' . $e->getFile() . '", line: ' . $e->getLine() . ', error: "' . $e->getMessage() . '"');
            $toast_notification = [
                'title' => 'Erro',
                'message' => 'Ocorreu um erro ao editar os dados!',
                'alert-type' => 'warning'
            ];
        }
        return redirect(route('cms.financing.index'))->with($toast_notification);
    }

    public function destroy($id)
    {
        $this->authorize('delete_register');
        try {
            $this->financing_service->destroy($id);
            $toast_notification = array(
                'title' => 'Sucesso!',
                'message' => 'Financiamento excluído com sucesso!',
                'alert-type' => 'success'
            );
            return redirect()->route('cms.financing.index')->with($toast_notification);
        } catch (Exception $e) {
            $error = 'An error occurred in action cms financing edit.';
            Log::error($error . ' file: "' . $e->getFile() . '", line: ' . $e->getLine() . ', error: "' . $e->getMessage() . '"');
        }
    }

    public function fileDestroy($id, $id_equipment)
    {
        try {
            $this->financing_service->fileDelete($id);
            $toast_notification = array(
                'title' => 'Sucesso!',
                'message' => 'Dados salvos com sucesso!',
                'alert-type' => 'success'
            );
            return redirect()->route('cms.financing.edit', $id_equipment)->with($toast_notification);
        } catch (Exception $e) {
            $error = 'An error occurred in action cms financing file destroy.';
            Log::error($error . ' file: "' . $e->getFile() . '", line: ' . $e->getLine() . ', error: "' . $e->getMessage() . '"');
        }
    }

    public function exportCSV(Request $request)
    {
        $fileName = 'equipment_export.csv';
        $equipments = session()->get('equipment_export');

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array(
            'Tipo Financiamento',
            'Nome Financiamento',
            'Data Cadastro',
            'Fornecedor',
            'Setor Alocação',
        );

        $callback = function () use ($equipments, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($equipments as $financing) {
                $row['Tipo Financiamento']  = $financing->equipment_type->description;
                $row['Nome Financiamento']    = $financing->name;
                $row['Data Cadastro']    = $financing->register_date;
                $row['Fornecedor']    = $financing->provider;
                $row['Setor Alocação']  = $financing->sector_allocation->description;

                fputcsv($file, array(
                    $row['Tipo Financiamento'],
                    $row['Nome Financiamento'],
                    $row['Data Cadastro'],
                    $row['Fornecedor'],
                    $row['Setor Alocação'],
                ));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
