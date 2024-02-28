<?php

namespace App\Repository\RepoClass\backend;

use App\Models\ProgrammingService;
use App\Repository\InterFace\PlaneRepoInterface;

class ProgrammingRepo  implements PlaneRepoInterface
{

    // Show All Plane
    public function index()
    {
        $programmingData = ProgrammingService::select(['id', 'title', 'descriptions', 'image'])->get();
        return view('services.showProgramming', get_defined_vars());
    }
    // Show Edit Plane
    public function edit($id)
    {
        $programmingData = ProgrammingService::select(['id', 'title', 'descriptions', 'image'])->first();

        // dd($planeData);
        return view('services.editProgramming', get_defined_vars());
    }

    public function store($request)
    {
        // Test Request
        // dd($request->all());

        // Get Request
        $programmingData = new ProgrammingService();
        $programmingData->title = $request->input('title');
        $programmingData->descriptions = $request->input('descriptions');
        // $programmingData->department = $request->input('department');
        // $programmingData->url = $request->input('url');
        $programmingData->image = $request->input('image');
        // Save Poster in Server
        if ($request->hasFile('image')) {
            $programmingService = time() . '-' . 'programming' . '.' . $request->image->extension();
            $request->image->move(public_path('image/services'), $programmingService);
            $pathIntro =  $programmingService;
            $programmingData->image = $pathIntro;
        }

        // Save All Data
        // $serviceIntro->save();
        $programmingData->save();

        // Response Message
        return redirect()->back()->with('success', 'تم حفظ البيانات بنجاح.');
    }

    public function update($id,  $request)
    {
        // Find the ProgrammingService model by ID
        $programmingData = ProgrammingService::find($id);

        // Check if the model exists
        if (!$programmingData) {
            return redirect()->back()->with('error', 'الفيديو غير موجود.');
        }

        // Update the model with the request data
        $programmingData->update([
            'title' => $request->input('title'),
            'descriptions' => $request->input('descriptions'),
            //  'image' => $request->input('image'),
        ]);

        // Update image in Server
        if ($request->hasFile('image')) {
            $programmingService = time() . '-' . 'programming' . '.' . $request->image->extension();
            $request->image->move(public_path('image/services'), $programmingService);
            $pathIntro =  $programmingService;
            $programmingData->image = $pathIntro;
        }

        // Save the changes
        $programmingData->save();

        // Response Message
        return redirect()->back()->with('success', 'تم تحديث البيانات بنجاح.');
    }

    public function delete($id)
    {
        $programmingService = ProgrammingService::findOrFail($id);

        if ($programmingService->image) {
            $imagePath = public_path('image/services/') . $programmingService->image;
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $programmingService->delete();
        return redirect()->back()->with('success', 'تم حذف  بنجاح.');


    }
}