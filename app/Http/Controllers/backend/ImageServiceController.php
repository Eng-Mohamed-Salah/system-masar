<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Repository\RepoClass\backend\ImageRepo;
use Illuminate\Http\Request;

class ImageServiceController extends Controller
{
    protected $imageRepo;
    public function __construct(ImageRepo  $imageRepo)
    {
        $this->imageRepo = $imageRepo;
    }

    public function index()
    {
        if (auth()->user()->can('isAdmin') || auth()->user()->can('isHr') || auth()->user()->can('isDataEntry')) {

            return $this->imageRepo->index();
        } else {
            abort(403, 'Unauthorized');
        }
    }
    public function edit($id)
    {
        if (auth()->user()->can('isAdmin') || auth()->user()->can('isHr') || auth()->user()->can('isDataEntry')) {

            return $this->imageRepo->edit($id);
        } else {
            abort(403, 'Unauthorized');
        }
    }
    public function store(Request $request)
    {
        if (auth()->user()->can('isAdmin') || auth()->user()->can('isHr') || auth()->user()->can('isDataEntry')) {

            return $this->imageRepo->store($request);
        } else {
            abort(403, 'Unauthorized');
        }
    }
    public function update($id, Request $request)
    {
        if (auth()->user()->can('isAdmin') || auth()->user()->can('isHr') || auth()->user()->can('isDataEntry')) {

            return $this->imageRepo->update($id, $request);
        } else {
            abort(403, 'Unauthorized');
        }
    }
    public function delete($id)
    {
        if (auth()->user()->can('isAdmin') || auth()->user()->can('isHr') || auth()->user()->can('isDataEntry')) {

            return $this->imageRepo->delete($id);
        } else {
            abort(403, 'Unauthorized');
        }
    }
    public function deletePhotography($id, $filename)
    {
        return $this->imageRepo->deletePhotography($id, $filename);
    }
    public function updatePhoto($id, $filename, Request $request)
    {
        if (auth()->user()->can('isAdmin') || auth()->user()->can('isHr') || auth()->user()->can('isDataEntry')) {

            return $this->imageRepo->updatePhoto($id, $filename, $request);
        } else {
            abort(403, 'Unauthorized');
        }
    }
}