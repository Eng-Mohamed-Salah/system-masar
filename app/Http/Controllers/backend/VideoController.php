<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Repository\RepoClass\backend\VideoRepo;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    protected $videoRepo;
    public function __construct(VideoRepo  $videoRepo)
    {
        $this->videoRepo = $videoRepo;
    }

    public function index()
    {
        if (auth()->user()->can('isAdmin') || auth()->user()->can('isHr') || auth()->user()->can('isDataEntry')) {

            return $this->videoRepo->index();
        } else {
            abort(403, 'Unauthorized');
        }
    }
    public function edit($id)
    {
        if (auth()->user()->can('isAdmin') || auth()->user()->can('isHr') || auth()->user()->can('isDataEntry')) {

            return $this->videoRepo->edit($id);
        } else {
            abort(403, 'Unauthorized');
        }
    }
    public function store(Request $request)
    {
        if (auth()->user()->can('isAdmin') || auth()->user()->can('isHr') || auth()->user()->can('isDataEntry')) {

            return $this->videoRepo->store($request);
        } else {
            abort(403, 'Unauthorized');
        }
    }
    public function update($id, Request $request)
    {
        if (auth()->user()->can('isAdmin') || auth()->user()->can('isHr') || auth()->user()->can('isDataEntry')) {

            return $this->videoRepo->update($id, $request);
        } else {
            abort(403, 'Unauthorized');
        }
    }
    public function delete($id)
    {
        if (auth()->user()->can('isAdmin') || auth()->user()->can('isHr') || auth()->user()->can('isDataEntry')) {

            return $this->videoRepo->delete($id);
        } else {
            abort(403, 'Unauthorized');
        }
    }
}