<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoanRequest;
use App\Http\Services\Loans\Loans as LoansService;
use App\Http\Services\Client\Client as ClientService;
use App\Http\Services\Helper\Helper as HelperService;
use App\Http\Services\User\User as UserService;
use App\Models\LoanLog;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LoansController extends Controller
{
    protected $loan_service;
    protected $helper_service;
    protected $client_service;
    protected $user_service;
    protected $file_path = 'loans';

    public function __construct(LoansService $loan_service, HelperService $helper_service, ClientService $client_service, UserService $user_service)
    {
        $this->loan_service = $loan_service;
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

            $loans = $this->loan_service->paginate($filters, 5);

            $status = $this->loan_service->getStatus();
            $clients = $this->client_service->getData();
            $users = $this->user_service->getData();
            // $equipment_export = $this->loan_service->getDataExport($filters);
            // session()->put('equipment_export', $equipment_export);

            return view('cms.loan.index', [
                'loans' => $loans,
                'status' => $status,
                'clients' => $clients,
                'users' => $users
            ]);
        } catch (Exception $e) {
            $error = 'An error occurred in action cms loan index.';
            Log::error($error . ' file: "' . $e->getFile() . '", line: ' . $e->getLine() . ', error: "' . $e->getMessage() . '"');
        }
    }

    public function report($id)
    {
        try {
            $financing = $this->loan_service->findOrFail($id);

            return view('cms.loan.report', [
                'financing' => $financing,

            ]);
        } catch (Exception $e) {
            $error = 'An error occurred in action cms financing edit.';
            Log::error($error . ' file: "' . $e->getFile() . '", line: ' . $e->getLine() . ', error: "' . $e->getMessage() . '"');
        }
    }

    public function historic($id)
    {
        try {
            $user = request()->input('user');

            $loansLogs = LoanLog::with('user')->where('user_id', 'LIKE', '%' . $user . '%')->where('loan_id', $id)->get();
            $users = $this->user_service->getData();

            return view(
                'cms.loan.historic',
                [
                    'loansLogs' => $loansLogs,
                    'users' => $users,
                ]
            );
        } catch (Exception $e) {
            $error = 'An error occurred in action cms financing create.';
            Log::error($error . ' file: "' . $e->getFile() . '", line: ' . $e->getLine() . ', error: "' . $e->getMessage() . '"');
        }
    }

    public function create($id)
    {
        try {
            // $federative_units = $this->helper_service->getFederativeUnit();
            // $sector_allocation = $this->loan_service->getSector();
            // $equipment_type = $this->loan_service->getEquipmentType();


            return view('cms.loan.create');
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
            // $sector_allocation = $this->loan_service->getSector();
            // $equipment_type = $this->loan_service->getEquipmentType();
            $type_account = $this->loan_service->getTypeAccount();

            return view(
                'cms.loan.create',
                [
                    'type_account' => $type_account,
                    'client' => $client
                ]
            );
        } catch (Exception $e) {
            $error = 'An error occurred in action cms financing create.';
            Log::error($error . ' file: "' . $e->getFile() . '", line: ' . $e->getLine() . ', error: "' . $e->getMessage() . '"');
        }
    }

    public function store(Request $request)
    {
        try {
            $this->loan_service->createData($request);
            $toast_notification = array(
                'title' => 'Sucesso!',
                'message' => 'Financiamento salvos com sucesso!',
                'alert-type' => 'success'
            );
            return redirect(route('cms.loan.index'))->with($toast_notification);
        } catch (Exception $e) {
            $error = 'An error occurred in action cms financing create.';
            Log::error($error . ' file: "' . $e->getFile() . '", line: ' . $e->getLine() . ', error: "' . $e->getMessage() . '"');
        }
    }

    public function edit($id)
    {
        $this->authorize('edit_register');
        try {
            $loans = $this->loan_service->findOrFail($id);
            $client = $this->client_service->findOrFail($loans->client_id);

            $type_account = $this->loan_service->getTypeAccount();
            $status = $this->loan_service->getStatus();

            return view('cms.loan.edit', [
                'loans' => $loans,
                'client' => $client,
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

    public function update(Request $request, $id)
    {
        $this->authorize('edit_register');
        try {
            $loan = $this->loan_service->findOrFail($id);
            $previousData = $loan->toArray();

            $this->loan_service->update($id, $request);
            $updatedData = $request->toArray();

            $changes = array_diff_assoc($updatedData, $previousData);

            if (!empty($changes)) {
                $user = auth()->user();
                foreach ($changes as $field => $value) {
                    if ($field !== '_method' && $field !== '_token') {

                        if ($field === 'file_cpf') {
                            LoanLog::create([
                                'loan_id' => $loan->id,
                                'user_id' => $user->id,
                                'action' => "Alteração do arquivo CPF",
                            ]);
                        } else if ($field === 'file_ir') {
                            LoanLog::create([
                                'loan_id' => $loan->id,
                                'user_id' => $user->id,
                                'action' => "Alteração do arquivo IR",
                            ]);
                        } else if ($field === 'file_cc') {
                            LoanLog::create([
                                'loan_id' => $loan->id,
                                'user_id' => $user->id,
                                'action' => "Alteração do arquivo Comprovante Residencia",
                            ]);
                        } else if ($field === 'file_rg') {
                            LoanLog::create([
                                'loan_id' => $loan->id,
                                'user_id' => $user->id,
                                'action' => "Alteração do arquivo RG",
                            ]);
                        } else {

                            LoanLog::create([
                                'loan_id' => $loan->id,
                                'user_id' => $user->id,
                                'action' => "Alteração do campo '$field' de '{$previousData[$field]}' para '$value'",
                            ]);
                        }
                    }
                }
            }

            $toast_notification = array(
                'title' => 'Sucesso!',
                'message' => 'Financiamento atualizado com sucesso!',
                'alert-type' => 'success'
            );
        } catch (Exception $e) {
            $error = 'An error occurred in action cms financing update.';
            Log::error($error . ' file: "' . $e->getFile() . '", line: ' . $e->getLine() . ', error: "' . $e->getMessage() . '"');
            $toast_notification = array(
                'title' => 'Erro',
                'message' => 'Ocorreu um erro ao editar os dados!',
                'alert-type' => 'warning'
            );
        }
        return redirect(route('cms.loan.index'))->with($toast_notification);
    }

    public function destroy($id)
    {
        $this->authorize('delete_register');
        try {
            $this->loan_service->destroy($id);
            $toast_notification = array(
                'title' => 'Sucesso!',
                'message' => 'Financiamento excluído com sucesso!',
                'alert-type' => 'success'
            );
            return redirect()->route('cms.loan.index')->with($toast_notification);
        } catch (Exception $e) {
            $error = 'An error occurred in action cms financing edit.';
            Log::error($error . ' file: "' . $e->getFile() . '", line: ' . $e->getLine() . ', error: "' . $e->getMessage() . '"');
        }
    }

    public function fileDestroy($id, $id_equipment)
    {
        try {
            $this->loan_service->fileDelete($id);
            $toast_notification = array(
                'title' => 'Sucesso!',
                'message' => 'Dados salvos com sucesso!',
                'alert-type' => 'success'
            );
            return redirect()->route('cms.loan.edit', $id_equipment)->with($toast_notification);
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
