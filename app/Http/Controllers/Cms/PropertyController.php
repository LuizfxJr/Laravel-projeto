<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Http\Requests\PropertyRequest;
use App\Models\PropertiesImage;
use App\Models\Property as PropertyModel;
use App\Models\User as UserModel;
use App\Support\Cropper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PropertyController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $search = request()->input('search');
        $status = request()->input('status');
        $user = Auth::user();

        $propertyModel = new PropertyModel();
        $query = $propertyModel->with('images')->orderBy('id', 'DESC');

        if ($search) {
            $query->where('title', 'LIKE', '%' . $search . '%');
        }

        if ($status) {
            $query->where('status', 'LIKE', '%' . $status . '%');
        }


        if ($user->user_level === 'administrator' || $user->user_level === 'supervisor') {
            // User is administrator or supervisor, retrieve all properties
            $properties = $query->get();
        } elseif ($user->user_level === 'collaborator') {
            // User is a collaborator, retrieve properties by user_id
            $properties = $query->where('user_id', $user->id)->get();
        } else {
            // Handle other cases or return an error message
            return 'Unauthorized access';
        }


        $list_type_simple = [];
        foreach ($propertyModel->list_type as $types) {
            foreach ($types as $key => $type) {
                $list_type_simple[$key] = $type;
            }
        }

        // Formatando o caminho das imagens
        foreach ($properties as $property) {
            foreach ($property->images as $image) {
                $image->image_url = $this->formatImageUrl($image->path);
            }
        }

        return view('cms.properties.index', [
            'properties' => $properties,
            'list_category' => $propertyModel->list_category,
            'list_type' => $propertyModel->list_type,
            'list_type_simple' => $list_type_simple
        ]);
    }


    public function view($id = 9)
    {
        $property = PropertyModel::with('images')->findOrFail($id);

        $list_type_simple = [];
        foreach ($property->list_type as $types) {
            foreach ($types as $key => $type) {
                $list_type_simple[$key] = $type;
            }
        }

        // Formatando o caminho das imagens
        foreach ($property->images as $image) {
            $image->image_url = $this->formatImageUrl($image->path);
        }

        return view('cms.properties.view', [
            'property' => $property,
            'list_category' => $property->list_category,
            'list_type' => $property->list_type,
            'list_type_simple' => $list_type_simple
        ]);
    }

    private function formatImageUrl($path)
    {
        if (empty($path)) {
            return asset("storage/static/image-default.jpg");
        }

        return asset("storage/properties/$path");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = UserModel::select('id', 'name')->orderBy('name')->get();
        $property = new PropertyModel();
        return view('cms.properties.create', [
            'list_category' => $property->list_category,
            'list_type' => $property->list_type,
            'users' => $users
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(PropertyRequest $request)
    {
        $property = PropertyModel::create($request->all())->id;

        if ($request->image) {
            foreach ($request->image as $item) {

                $item->store('properties', 'public');
                $request->merge([
                    'path' => $item->hashName(),
                    'property_id' => $property
                ]);

                PropertiesImage::create($request->all());
            }
        }

        //$property->setSlug();
        return redirect()->route('cms.properties.index')->with([
            'color' => 'green',
            'message' => 'Imóvel salvo com sucesso.'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $property = PropertyModel::with('images')->where('id', $id)->first();


        $users = UserModel::select('id', 'name')->orderBy('name')->get();

        foreach ($property->images as $image) {
            $image->image_url = $this->formatImageUrl($image->path);
        }

        // dd($property);
        return view('cms.properties.edit', [
            'list_category' => $property->list_category,
            'list_type' => $property->list_type,
            'users' => $users,
            'property' => $property
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(PropertyRequest $request, $id)
    {

        $property = PropertyModel::where('id', $id)->first();

        if ($request->purpose  == 'sale') {
            $property->setSaleAttribute(true);;
        } else {
            $property->setSaleAttribute(false);;
        }

        if ($request->purpose  == 'rent') {
            $property->setRentAttribute(true);
            $property->setRentAttribute(true);
        }

        $property->setTypeAttribute($request->type);
        $property->setCategoryAttribute($request->category);
        $property->setAirConditioningAttribute($request->air_conditioning);
        $property->setBarAttribute($request->bar);
        $property->setLibraryAttribute($request->library);
        $property->setBarbecueGrillAttribute($request->barbecue_grill);
        $property->setAmericanKitchenAttribute($request->american_kitchen);
        $property->setFittedKitchenAttribute($request->fitted_kitchen);
        $property->setPantryAttribute($request->pantry);
        $property->setEdiculeAttribute($request->edicule);
        $property->setOfficeAttribute($request->office);
        $property->setBathtubAttribute($request->bathtub);
        $property->setFireplaceAttribute($request->fireplace);
        $property->setLavatoryAttribute($request->lavatory);
        $property->setFurnishedAttribute($request->furnished);
        $property->setPoolAttribute($request->pool);
        $property->setSteamRoomAttribute($request->steam_room);
        $property->setViewOfTheSeaAttribute($request->view_of_the_sea);
        $property->setStatusAttribute($request->status);
        $property->fill($request->all());
        $property->save();

        if ($request->image) {
            foreach ($request->image as $item) {

                $item->store('properties', 'public');
                $request->merge([
                    'path' => $item->hashName(),
                    'property_id' => $property->id
                ]);

                PropertiesImage::create($request->all());
            }
        }

        return redirect()->route('cms.properties.edit', [
            'property' => $property->id
        ])->with([
            'color' => 'green',
            'message' => 'Imóvel atualizado com sucesso.'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function imageSetCover(Request $request)
    {
        $currentImageProperty = PropertiesImage::where('id', $request->image)->first();

        $allImagesProperty = PropertiesImage::where('property_id', $currentImageProperty->property_id)->get();

        foreach ($allImagesProperty as $image) {
            $image->cover = false;
            $image->save();
        }
        $currentImageProperty->cover = true;
        $currentImageProperty->save();
        $json = [
            'success' => true
        ];
        return response()->json($json);
    }

    public function imageRemove(Request $request)
    {
        $currentImageProperty = PropertiesImage::where('id', $request->image)->first();
        $success = false;
        if ($currentImageProperty) {

            if (!!$currentImageProperty->delete()) {
                $success = true;

                Storage::delete($currentImageProperty->path);
                Cropper::flush($currentImageProperty->path);

                $defaultImageProperty = PropertiesImage::where('property_id', $currentImageProperty->property_id)->first();
                if ($defaultImageProperty) {
                    $defaultImageProperty->cover = true;
                    $defaultImageProperty->save();
                }

                $defaultImageId = $defaultImageProperty->id ?? '';
            }
        }
        $json = [
            'success' => $success,
            'defaultImageId' => $defaultImageId ?? ''
        ];

        return response()->json($json);
    }
}
