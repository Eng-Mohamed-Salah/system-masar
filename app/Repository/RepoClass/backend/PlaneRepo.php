<?php
namespace App\Repository\RepoClass\backend;

use App\Models\PlaneServices;
use App\Repository\InterFace\PlaneRepoInterface;

class PlaneRepo implements PlaneRepoInterface
{

    // Show All Plane
    public function index(){
        $planeData = PlaneServices::orderBy('created_at', 'asc')->get();
        // dd($planeData);
        return view('customers.plans.showPlan',get_defined_vars());
    }
    // Show Edit Plane
    public function edit($id){
        // $planeData = PlaneServices::findOrFail($id);
        $planeData = PlaneServices::where('id', $id)->get();

        // dd($planeData);
        return view('customers.plans.editPlan',get_defined_vars());
    }

    public function store($request){
        // Test Request
        // dd($request->all());

        // Get Request
        $planeData = new PlaneServices();
        $planeData ->title = $request->input('title');
        $planeData ->cost = $request->input('cost');
        $planeData ->customService = $request->input('customService');

         // Save All Data
        // $serviceIntro->save();
        $planeData->save();

        // Response Message
        return redirect()->back()->with('success', 'تم حفظ البيانات بنجاح.');

    }

    public function update($id,  $request){
        // Find the record by ID
        $planeData = PlaneServices::findOrFail($id);

        // Update data
        $planeData->title = $request->input('title');
        $planeData->cost = $request->input('cost');
        $planeData->customService = $request->input('customService');

        // Save the updated data
        $planeData->save();

        // Response Message
        return redirect()->back()->with('success', 'تم تحديث البيانات بنجاح.');

    }

    public function delete($id)
    {
        $plane = PlaneServices::findOrFail($id);
        $plane->delete();

        return redirect()->back()->with('success', 'تم حذف الحزمة بنجاح.');
    }


}
