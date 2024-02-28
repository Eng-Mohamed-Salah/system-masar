<?php
namespace App\Repository\RepoClass\backend;

use App\Models\Marketing;
use App\Models\PlaneServices;
use App\Repository\InterFace\PlaneRepoInterface;

class MarketingRepo implements PlaneRepoInterface
{
    public function index(){
        $marketData = Marketing::select(['id','title','descriptions','department'])->get();
        return view('services.showMarketing',get_defined_vars());
    }
    public function edit($id){
        $marketData = Marketing::where('id', $id)->select(['id','title','descriptions','department'])->first();

        // dd($planeData);
        return view('services.editMarketing',get_defined_vars());
    }
    public function store($request){
     // Test Request
        // dd($request->all());

        // Get Request
        $marketingData = new Marketing();
        $marketingData ->title = $request->input('title');
        $marketingData ->descriptions = $request->input('descriptions');
        $marketingData ->department = $request->input('department');

         // Save All Data
        // $serviceIntro->save();
        $marketingData->save();

        // Response Message
        return redirect()->back()->with('success', 'تم حفظ البيانات بنجاح.');

    }


    public function update($id, $request){
        $marketingData = Marketing::find($id);
        // Check if the model exists
        if (!$marketingData) {
            return redirect()->back()->with('error', 'الفيديو غير موجود.');
        }
        // Update Data
        $marketingData->update([
            'title' => $request->input('title'),
            'descriptions' => $request->input('descriptions'),
            'department' => $request->input('department'),
        ]);

        // Response Message
        return redirect()->back()->with('success', 'تم تحديث البيانات بنجاح.');

    }
    public function delete($id){
        $marketData = Marketing::findOrFail($id);
        $marketData->delete();

        return redirect()->back()->with('success', 'تم حذف  بنجاح.');

    }

}