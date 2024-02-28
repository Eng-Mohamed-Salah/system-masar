<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Repository\RepoClass\backend\PlaneRepo;
use Illuminate\Http\Request;

class PlaneServicesController extends Controller
{
    protected $planeRepo;
    public function __construct(PlaneRepo $planeRepo)
    {
        $this->planeRepo = $planeRepo;
    }

    public function index()
    {
        if (auth()->user()->can('isAdmin') || auth()->user()->can('isHr') || auth()->user()->can('isDataEntry')) {

            return $this->planeRepo->index();
        } else {
            abort(403, 'Unauthorized');
        }
    }
    public function edit($id)
    {
        if (auth()->user()->can('isAdmin') || auth()->user()->can('isHr') || auth()->user()->can('isDataEntry')) {

            return $this->planeRepo->edit($id);
        } else {
            abort(403, 'Unauthorized');
        }
    }
    public function store(Request $request)
    {
        if (auth()->user()->can('isAdmin') || auth()->user()->can('isHr') || auth()->user()->can('isDataEntry')) {

            return $this->planeRepo->store($request);
        } else {
            abort(403, 'Unauthorized');
        }
    }
    public function update($id, Request $request)
    {
        if (auth()->user()->can('isAdmin') || auth()->user()->can('isHr') || auth()->user()->can('isDataEntry')) {

            return $this->planeRepo->update($id, $request);
        } else {
            abort(403, 'Unauthorized');
        }
    }
    public function delete($id)
    {
        if (auth()->user()->can('isAdmin') || auth()->user()->can('isHr') || auth()->user()->can('isDataEntry')) {

            return $this->planeRepo->delete($id);
        } else {
            abort(403, 'Unauthorized');
        }
    }
}