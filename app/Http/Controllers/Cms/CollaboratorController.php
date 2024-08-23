<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Http\Requests\CollaboratorCreateRequest;
use App\Http\Requests\CollaboratorEditRequest;
use App\Http\Services\User\User as UserService;
use App\Http\Services\Helper\Helper as HelperService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CollaboratorController extends Controller
{
    protected $user_service;
    protected $helper_service;

    public function __construct(UserService $user_service, HelperService $helper_service)
    {
        $this->user_service = $user_service;
        $this->helper_service = $helper_service;
    }

    public function index()
    {
        try {
            $filters = collect();
            $filters->search = request()->input('search');
            $filters->occupation_search = request()->input('occupation_search');
            $filters->sector_search = request()->input('sector_search');
            $occupations = $this->user_service->getOccupation();
            $sectors = $this->user_service->getSector();
            $users = $this->user_service->paginate($filters, 10);
            return view('cms.collaborator.index', [
                'users' => $users,
                'occupations' => $occupations,
                'sectors' => $sectors
            ]);
        } catch (Exception $e) {
            $error = 'An error occurred in action cms collaborator index.';
            Log::error($error . ' file: "' . $e->getFile() . '", line: ' . $e->getLine() . ', error: "' . $e->getMessage() . '"');
        }
    }

    public function create()
    {
        try {
            $occupations = $this->user_service->getOccupation();
            $sectors = $this->user_service->getSector();
            $user_levels = $this->user_service->getUserLevels();
            return view('cms.collaborator.create',  [
                'occupations' => $occupations,
                'sectors' => $sectors,
                'user_levels' => $user_levels
            ]);
        } catch (Exception $e) {
            $error = 'An error occurred in action cms collaborator create.';
            Log::error($error . ' file: "' . $e->getFile() . '", line: ' . $e->getLine() . ', error: "' . $e->getMessage() . '"');
        }
    }

    public function store(CollaboratorCreateRequest $request)
    {
        try {
            $this->user_service->createData($request);
            $toast_notification = array(
                'title' => 'Sucesso!',
                'message' => 'Dados salvos com sucesso!',
                'alert-type' => 'success'
            );
            return redirect(route('cms.collaborator.index'))->with($toast_notification);
        } catch (Exception $e) {
            $error = 'An error occurred in action cms collaborator update.';
            Log::error($error . ' file: "' . $e->getFile() . '", line: ' . $e->getLine() . ', error: "' . $e->getMessage() . '"');
            $toast_notification = array(
                'title' => 'Erro',
                'message' => 'Ocorreu um erro ao salvar os dados!',
                'alert-type' => 'warning'
            );
        }
        return back()->with($toast_notification);
    }

    public function edit($id)
    {
        $this->authorize('edit_register');
        try {
            $user = $this->user_service->findOrFail($id);
            $occupations = $this->user_service->getOccupation();
            $sectors = $this->user_service->getSector();
            $user_levels = $this->user_service->getUserLevels();
            return view('cms.collaborator.edit', [
                'user' => $user,
                'occupations' => $occupations,
                'sectors' => $sectors,
                'user_levels' => $user_levels
            ]);
        } catch (Exception $e) {
            $error = 'An error occurred in action cms collaborator edit.';
            Log::error($error . ' file: "' . $e->getFile() . '", line: ' . $e->getLine() . ', error: "' . $e->getMessage() . '"');
        }
    }

    public function report($id)
    {
        try {
            $user = $this->user_service->findOrFail($id);
            $occupations = $this->user_service->getOccupation();
            $sectors = $this->user_service->getSector();
            return view('cms.collaborator.report', [
                'user' => $user,
                'occupations' => $occupations,
                'sectors' => $sectors,
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

    public function update(CollaboratorEditRequest $request, $id)
    {
        $this->authorize('edit_register');
        try {
            $this->user_service->update($id, $request);
            $toast_notification = array(
                'title' => 'Sucesso!',
                'message' => 'Dados salvos com sucesso!',
                'alert-type' => 'success'
            );
        } catch (Exception $e) {
            $error = 'An error occurred in action cms collaborator update.';
            Log::error($error . ' file: "' . $e->getFile() . '", line: ' . $e->getLine() . ', error: "' . $e->getMessage() . '"');
            $toast_notification = array(
                'title' => 'Sucesso!',
                'message' => 'Dados salvos com sucesso!',
                'alert-type' => 'success'
            );
        } catch (Exception $e) {
            $error = 'An error occurred in action cms collaborator update.';
            Log::error($error . ' file: "' . $e->getFile() . '", line: ' . $e->getLine() . ', error: "' . $e->getMessage() . '"');
            $toast_notification = array(
                'title' => 'Erro',
                'message' => 'Ocorreu um erro ao salvar os dados!',
                'alert-type' => 'warning'
            );
        }
        return back()->with($toast_notification);
    }

    public function destroy($id)
    {
        $this->authorize('delete_register');
        try {
            $this->user_service->destroy($id);
            $toast_notification = array(
                'title' => 'Sucesso!',
                'message' => 'Dados salvos com sucesso!',
                'alert-type' => 'success'
            );
            return redirect()->route('cms.collaborator.index')->with($toast_notification);
        } catch (Exception $e) {
            $error = 'An error occurred in action cms collaborator destroy.';
            Log::error($error . ' file: "' . $e->getFile() . '", line: ' . $e->getLine() . ', error: "' . $e->getMessage() . '"');
        }
    }

    public function fileDestroy($id)
    {
        try {
            $this->user_service->fileDelete($id);
            $toast_notification = array(
                'title' => 'Sucesso!',
                'message' => 'Dados salvos com sucesso!',
                'alert-type' => 'success'
            );
            return redirect()->route('cms.collaborator.edit', $id)->with($toast_notification);
        } catch (Exception $e) {
            $error = 'An error occurred in action cms collaborator file destroy.';
            Log::error($error . ' file: "' . $e->getFile() . '", line: ' . $e->getLine() . ', error: "' . $e->getMessage() . '"');
        }
    }
}
