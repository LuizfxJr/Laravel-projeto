<?php

namespace App\Http\Services\Loans;

use App\Models\LoanLog;
use App\Models\Loans as LoansInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class Loans
{

    protected $loans;
    protected $file_path = 'loans';

    public function __construct(LoansInterface $loans)
    {
        $this->loans = $loans;
    }

    public function getData()
    {
        return $this->loans->with(['user', 'client'])->get();
    }

    public function createData($request)
    {
        if ($request->image_1) {
            $request->file('image_1')->store('loans', 'public');
            $request->merge([
                'file_rg' => $request->image_1->hashName(),
            ]);
        }
        if ($request->image_2) {
            $request->file('image_2')->store('loans', 'public');
            $request->merge([
                'file_cpf' => $request->image_2->hashName(),
            ]);
        }
        if ($request->image_3) {
            $request->file('image_3')->store('loans', 'public');
            $request->merge([
                'file_ir' => $request->image_3->hashName(),
            ]);
        }
        if ($request->image_4) {
            $request->file('image_4')->store('loans', 'public');
            $request->merge([
                'file_cc' => $request->image_4->hashName(),
            ]);
        }

        $id = $this->loans->create($request->all())->id;

        return LoanLog::create([
            'loan_id' => $id,
            'user_id' => $request->user_id,
            'action' => "Criação do empréstimo",
        ]);
    }

    public function paginate(object $filters, ?int $quantity_per_page = 5)
    {

        $loans = $this->loans->indexFilter($filters, $quantity_per_page);

        foreach ($loans as $item) {
            $hora_atual = Carbon::now();
            $hora_danger_simulacao = Carbon::parse($item->updated_at);
            $hora_alert_simulacao = Carbon::parse($item->updated_at);
            $hora_danger_andamento = Carbon::parse($item->updated_at);
            $hora_alert_andamento = Carbon::parse($item->updated_at);


            if ($hora_atual->greaterThan($hora_danger_simulacao->addHours(2)) && $item->status === 'Simulação') {
                $item->status_color = 'danger';
            } elseif ($hora_atual->greaterThan($hora_alert_simulacao->addHours(1)) && $item->status === 'Simulação') {
                $item->status_color = 'alert';
            } elseif ($hora_atual->greaterThan($hora_danger_andamento->addHours(48)) && $item->status === 'Andamento') {
                $item->status_color = 'danger';
            } elseif ($hora_atual->greaterThan($hora_alert_andamento->addHours(24)) && $item->status === 'Andamento') {
                $item->status_color = 'alert';
            }
        }

        return $loans;
    }


    public function findOrFail($id, $format = true)
    {
        $loans = $this->loans->findOrFail($id);
        if ($format) {
            $this->formatUser($loans);
        }
        return $loans;
    }

    public function formatUser($loans)
    {
        $loans->image_url = asset("storage/static/image-default.jpg");
        if (isset($loans->file_rg)) {
            $loans->file_rg_url = asset("storage/$this->file_path/$loans->file_rg");
        }
        if (isset($loans->file_cpf)) {
            $loans->file_cpf_url = asset("storage/$this->file_path/$loans->file_cpf");
        }
        if (isset($loans->file_ir)) {
            $loans->file_ir_url = asset("storage/$this->file_path/$loans->file_ir");
        }
        if (isset($loans->file_cc)) {
            $loans->file_cc_url = asset("storage/$this->file_path/$loans->file_cc");
        }
        return $loans;
    }

    public function update($id, $request)
    {
        $loans = $this->findOrFail($id, false);
        if ($request->image_1) {
            $request->file('image_1')->store('loans', 'public');
            $request->merge([
                'file_rg' => $request->image_1->hashName(),
            ]);
        }
        if ($request->image_2) {
            $request->file('image_2')->store('loans', 'public');
            $request->merge([
                'file_cpf' => $request->image_2->hashName(),
            ]);
        }
        if ($request->image_3) {
            $request->file('image_3')->store('loans', 'public');
            $request->merge([
                'file_ir' => $request->image_3->hashName(),
            ]);
        }
        if ($request->image_4) {
            $request->file('image_4')->store('loans', 'public');
            $request->merge([
                'file_cc' => $request->image_4->hashName(),
            ]);
        }


        return $loans->update($request->all());
    }

    public function fileDelete($id)
    {
        $loans = $this->findOrFail($id, false);
        Storage::disk("public")->delete("$this->file_path/$loans->file");
        $loans->collumnNull('file');
        return;
    }

    public function destroy($id)
    {
        $loans = $this->findOrFail($id);
        Storage::disk("public")->delete("$this->file_path/$loans->file");
        return $loans->delete();
    }

    public function getTypeAccount()
    {
        return $this->loans->getTypeAccount();
    }

    public function getStatus()
    {
        return $this->loans->getStatus();
    }
}
