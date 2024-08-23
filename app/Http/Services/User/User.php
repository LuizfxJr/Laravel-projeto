<?php

namespace App\Http\Services\User;

use App\Models\User as UserInterface;
use App\Models\Occupation as OccupationInterface;
use App\Models\WorkShift as WorkShiftInterface;
use App\Models\Sector as SectorInterface;
use Illuminate\Support\Facades\Storage;

class User {

    protected $user;
    protected $occupation;
    protected $work_shift;
    protected $sector;
    protected $file_path = 'users';

    public function __construct(UserInterface $user, OccupationInterface $occupation, WorkshiftInterface $work_shift,  SectorInterface $sector){
        $this->user = $user;
        $this->occupation = $occupation;
        $this->work_shift = $work_shift;
        $this->sector = $sector;
    }

    public function getData(){
        return $this->user->with(['occupation', 'sector'])->get();
    }

    public function createData($request){
        if($request->image){
            $request->file('image')->store('users', 'public');
            $request->merge([
                'file' => $request->image->hashName(),
            ]);
        }
        $request->merge([
            'password' => bcrypt($request->password)
        ]);
        return $this->user->create($request->all());
    }

    public function paginate(object $filters, ?int $quantity_per_page=5)
    {
        return $this->user->indexFilter($filters,$quantity_per_page);
    }

    public function findOrFail($id, $format = true){
       $user = $this->user->findOrFail($id);
       if($format){
         $this->formatUser($user);
       }
       return $user;

    }

    public function formatUser($user){
        $user->image_url = asset("storage/static/image-default.jpg");
        if(isset($user->file)){
            $user->image_url = asset("storage/$this->file_path/$user->file");
        }
        return $user;
    }

    public function update($id, $request){
        $user = $this->findOrFail($id, false);
        if($request->image){
            $request->file('image')->store('users', 'public');
            $request->merge([
                'file' => $request->image->hashName()
            ]);
        }
        if(!$request->password){
            $request->request->remove('password');
        }else{
            $request->merge([
                'password' => bcrypt($request->password)
            ]);
        }
        return $user->update($request->all());
    }

    public function fileDelete($id){
        $user = $this->findOrFail($id, false);
        Storage::disk("public")->delete("$this->file_path/$user->file");
        $user->collumnNull('file');
        return;
    }

    public function destroy($id){
        $user = $this->findOrFail($id);
        Storage::disk("public")->delete("$this->file_path/$user->file");
        return $user->delete();
    }

    public function getOccupation(){
        return $this->occupation->orderBy('description', 'asc')->get();
    }   

    public function getWorkShift(){
        return $this->work_shift->orderBy('description', 'asc')->get();
    }   

    public function getSector(){
        return $this->sector->orderBy('description', 'asc')->get();
    }
    
    public function getUserLevels(){
        return $this->user->getUserLevels();
    }


}