<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Repository\RepoClass\backend\ClientRepo;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    protected $clientRepo;
    public function __construct(ClientRepo $clientRepo)
    {
        $this->clientRepo = $clientRepo;
    }

    public function index()
    {
        if (auth()->user()->can('isAdmin') || auth()->user()->can('isHr') || auth()->user()->can('isDataEntry')) {
            return $this->clientRepo->index();
        } else {
            abort(403, 'Unauthorized');
        }
    }
    public function showClient($id)
    {
        if (auth()->user()->can('isAdmin') || auth()->user()->can('isHr') || auth()->user()->can('isDataEntry')) {

            return $this->clientRepo->showClient($id);
        } else {
            abort(403, 'Unauthorized');
        }
    }
    public function edit($id)
    {
        if (auth()->user()->can('isAdmin') || auth()->user()->can('isHr') || auth()->user()->can('isDataEntry')) {

            return $this->clientRepo->edit($id);
        } else {
            abort(403, 'Unauthorized');
        }
    }
    public function store(Request $request)
    {
        if (auth()->user()->can('isAdmin') || auth()->user()->can('isHr') || auth()->user()->can('isDataEntry')) {

            return $this->clientRepo->store($request);
        } else {
            abort(403, 'Unauthorized');
        }
    }
    public function update($id, Request $request)
    {
        if (auth()->user()->can('isAdmin') || auth()->user()->can('isHr') || auth()->user()->can('isDataEntry')) {

            return $this->clientRepo->update($id, $request);
        } else {
            abort(403, 'Unauthorized');
        }
    }
    public function delete($id)
    {
        if (auth()->user()->can('isAdmin') || auth()->user()->can('isHr') || auth()->user()->can('isDataEntry')) {
            return $this->clientRepo->delete($id);
        } else {
            abort(403, 'Unauthorized');
        }
    }
}