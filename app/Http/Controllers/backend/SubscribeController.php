<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Subscribe;
use App\Repository\RepoClass\backend\SubscribeRepo;
use Illuminate\Http\Request;

class SubscribeController extends Controller
{
    protected $subscribeRepo;
    public function __construct(SubscribeRepo  $subscribeRepo)
    {
        $this->subscribeRepo = $subscribeRepo;
    }

    public function index()
    {
        if (auth()->user()->can('isAdmin') || auth()->user()->can('isHr') || auth()->user()->can('isDataEntry')) {

            return $this->subscribeRepo->index();
        } else {
            abort(403, 'Unauthorized');
        }
    }
    public function edit($id)
    {
        if (auth()->user()->can('isAdmin') || auth()->user()->can('isHr') || auth()->user()->can('isDataEntry')) {

            return $this->subscribeRepo->edit($id);
        } else {
            abort(403, 'Unauthorized');
        }
    }
    public function store(Request $request)
    {
        if (auth()->user()->can('isAdmin') || auth()->user()->can('isHr') || auth()->user()->can('isDataEntry')) {

            return $this->subscribeRepo->store($request);
        } else {
            abort(403, 'Unauthorized');
        }
    }
    public function update($id, Request $request)
    {
        if (auth()->user()->can('isAdmin') || auth()->user()->can('isHr') || auth()->user()->can('isDataEntry')) {

            return $this->subscribeRepo->update($id, $request);
        } else {
            abort(403, 'Unauthorized');
        }
    }
    public function delete($id)
    {
        if (auth()->user()->can('isAdmin') || auth()->user()->can('isHr') || auth()->user()->can('isDataEntry')) {

            return $this->subscribeRepo->delete($id);
        } else {
            abort(403, 'Unauthorized');
        }
    }
    public function updateComplete($id, Request $subscribe)
    {
        if (auth()->user()->can('isAdmin') || auth()->user()->can('isHr') || auth()->user()->can('isDataEntry')) {

            return $this->subscribeRepo->updateComplete($id, $subscribe);
        } else {
            abort(403, 'Unauthorized');
        }
    }
    public function updatesubScription(Request $request)
    {
        if (auth()->user()->can('isAdmin') || auth()->user()->can('isHr') || auth()->user()->can('isDataEntry')) {

            return $this->subscribeRepo->updatesubScription($request);
        } else {
            abort(403, 'Unauthorized');
        }
    }
}