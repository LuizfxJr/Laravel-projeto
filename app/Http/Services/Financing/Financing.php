<?php

namespace App\Http\Services\Financing;

use App\Models\Financing as FinancingInterface;
use App\Models\FinancingLog;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class Financing
{

    protected $financing;
    protected $file_path = 'financings';

    public function __construct(FinancingInterface $financing)
    {
        $this->financing = $financing;
    }

    public function getData()
    {
        return $this->financing->with(['user', 'client'])->get();
    }

    public function createData($request)
    {
        if ($request->image_1) {
            $request->image_1->store('financings', 'public');
            $request->merge([
                'file_cpf' => $request->image_1->hashName(),
            ]);
        }
        if ($request->image_2) {
            $request->image_2->store('financings', 'public');
            $request->merge([
                'file_rg' => $request->image_2->hashName(),
            ]);
        }
        if ($request->image_3) {
            $request->image_3->store('financings', 'public');
            $request->merge([
                'file_cr' => $request->image_3->hashName(),
            ]);
        }
        if ($request->image_4) {
            $request->image_4->store('financings', 'public');
            $request->merge([
                'file_ir' => $request->image_4->hashName(),
            ]);
        }
        $id = $this->financing->create($request->all())->id;

        return FinancingLog::create([
            'financing_id' => $id,
            'user_id' => $request->user_id,
            'action' => "Criação do financiamento",
        ]);
    }

    public function paginate(object $filters, ?int $quantity_per_page = 5)
    {

        $financing = $this->financing->indexFilter($filters, $quantity_per_page);

        foreach ($financing as $item) {
            $hora_atual = Carbon::now();
            $hora_danger_simulacao = Carbon::parse($item->updated_at);
            $hora_alert_simulacao = Carbon::parse($item->updated_at);
            $hora_danger_andamento = Carbon::parse($item->updated_at);
            $hora_alert_andamento = Carbon::parse($item->updated_at);

            if ($item->status === 'Negaddo') {
                $item->status_color = 'danger';
            }

            if ($hora_atual->greaterThan($hora_danger_simulacao->addHours(2)) && $item->status === 'Análise Interna') {
                $item->status_color = 'danger';
            } elseif ($hora_atual->greaterThan($hora_alert_simulacao->addHours(1)) && $item->status === 'Análise Interna') {
                $item->status_color = 'alert';
            } elseif ($hora_atual->greaterThan($hora_danger_andamento->addHours(48)) && $item->status === 'Andamento') {
                $item->status_color = 'danger';
            } elseif ($hora_atual->greaterThan($hora_alert_andamento->addHours(24)) && $item->status === 'Andamento') {
                $item->status_color = 'alert';
            }
        }

        return $financing;
    }

    public function findOrFail($id, $format = true)
    {
        $financing = $this->financing->findOrFail($id);
        if ($format) {
            $this->formatUser($financing);
        }
        return $financing;
    }

    public function formatUser($financing)
    {
        $financing->image_url = asset("storage/static/image-default.jpg");
        if (isset($financing->file_rg)) {
            $financing->file_rg_url = asset("storage/$this->file_path/$financing->file_rg");
        }
        if (isset($financing->file_cpf)) {
            $financing->file_cpf_url = asset("storage/$this->file_path/$financing->file_cpf");
        }
        if (isset($financing->file_ir)) {
            $financing->file_ir_url = asset("storage/$this->file_path/$financing->file_ir");
        }
        if (isset($financing->file_cr)) {
            $financing->file_cr_url = asset("storage/$this->file_path/$financing->file_cr");
        }

        return $financing;
    }

    public function update($id, $request)
    {
        $financing = $this->findOrFail($id, false);
        if ($request->image_1) {
            $request->file('image_1')->store('financings', 'public');
            $request->merge([
                'file_rg' => $request->image_1->hashName(),
            ]);
        }
        if ($request->image_2) {
            $request->file('image_2')->store('financings', 'public');
            $request->merge([
                'file_cpf' => $request->image_2->hashName(),
            ]);
        }
        if ($request->image_3) {
            $request->file('image_3')->store('financings', 'public');
            $request->merge([
                'file_ir' => $request->image_3->hashName(),
            ]);
        }
        if ($request->image_4) {
            $request->file('image_4')->store('financings', 'public');
            $request->merge([
                'file_cr' => $request->image_4->hashName(),
            ]);
        }


        return $financing->update($request->all());
    }

    public function fileDelete($id)
    {
        $financing = $this->findOrFail($id, false);
        Storage::disk("public")->delete("$this->file_path/$financing->file");
        $financing->collumnNull('file');
        return;
    }

    public function destroy($id)
    {
        $financing = $this->findOrFail($id);
        Storage::disk("public")->delete("$this->file_path/$financing->file");
        return $financing->delete();
    }


    public function getUserLevels()
    {
        return $this->financing->getUserLevels();
    }

    public function getTypeFinancing()
    {
        return $this->financing->getTypeFinancing();
    }

    public function getTypeProduct()
    {
        return $this->financing->getTypeProduct();
    }

    public function getTypeAccount()
    {
        return $this->financing->getTypeAccount();
    }

    public function getStatus()
    {
        return $this->financing->getStatus();
    }
}
