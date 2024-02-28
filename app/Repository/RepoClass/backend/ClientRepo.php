<?php

namespace App\Repository\RepoClass\backend;

use App\Models\Client;
use App\Models\PlaneServices;
use App\Models\Subscribe;
use App\Repository\InterFace\PlaneRepoInterface;

class ClientRepo implements PlaneRepoInterface
{

    public function index()
    {
        $clientData = Client::orderBy('created_at', 'asc')->get();
        $planeData = PlaneServices::select(['id', 'title'])->get();



        // dd($clientData);
        return view('customers.clients.showClient', get_defined_vars());
    }
    public function showClient($id)
    {
        // $planeData = PlaneServices::findOrFail($id);
        // $clientData = Client::where('id', $id)->get();
        $clientData = Client::findOrFail($id);

        // Analysis Data Subscript

        // Total Plane
        $planesCount = Subscribe::where('client_id', $id)->count();

        // Total Complete
        $completeCount = Subscribe::where('client_id', $id)->where('complete', true)->count();

        // Total Active
        $activeCount = Subscribe::where('client_id', $id)->where('complete', false)->count();

        // Total Payment
        $totalPrice = Subscribe::where('client_id', $id)->join('plane_services', 'subscribes.plane_service_id', '=', 'plane_services.id')->sum('plane_services.cost');


        // dd($clientData);
        return view('customers.clients.profile', get_defined_vars());
    }


    public function edit($id)
    {
        // $planeData = PlaneServices::findOrFail($id);
        // $clientData = Client::where('id', $id)->get();
        $clientData = Client::findOrFail($id);
        $planeData = PlaneServices::orderBy('created_at', 'asc')->get();




        // dd($planeData);
        return view('customers.clients.editClient', get_defined_vars());
    }
    public function store($request)
    {
        // Handel Request
        $clientData = new Client();
        $clientData->name = $request->input('name');
        $clientData->email = $request->input('email');
        $clientData->phone = $request->input('phone');
        $clientData->address = $request->input('address');
        $clientData->image = $request->input('image');

        // Handel Images
        if ($request->hasFile('image')) {
            $imageName = time() . '-' . 'Client' . '.' . $request->image->extension();
            $request->image->move(public_path('images/client'), $imageName);
            $pathImage =  $imageName;
            $clientData->image = $pathImage;
        }
        // Save All Data
        $clientData->save();

        // Response Message
        return redirect()->back()->with('success', 'تم حفظ البيانات بنجاح.');
    }
    public function update($id, $request)
    {
        // Retrieve the client record by ID
        $clientData = Client::findOrFail($id);

        // Update client data
        $clientData->name = $request->input('name');
        $clientData->email = $request->input('email');
        $clientData->phone = $request->input('phone');
        $clientData->address = $request->input('address');

        // Check if new image is provided and handle it
        if ($request->hasFile('image')) {
            $imageName = time() . '-' . 'Client' . '.' . $request->image->extension();
            $request->image->move(public_path('images/client'), $imageName);
            $pathImage =  $imageName;
            $clientData->image = $pathImage;
        }

        // Save updated client data
        $clientData->save();

        // Response Message
        return redirect()->back()->with('success', 'تم تحديث البيانات بنجاح.');
    }
    public function delete($id)
    {
        $clientData = Client::findOrFail($id);

        // Delete the client's image from the filesystem
        // $imagePath = public_path('images/client/' . $clientData->image);
        // if (file_exists($imagePath) && is_file($imagePath)) {
        //     unlink($imagePath);
        // }

        $clientData->delete();

        return redirect()->back()->with('success', 'تم حذف  بنجاح.');
    }
}