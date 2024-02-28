<?php

namespace App\Repository\RepoClass\backend;

use App\Models\Video;
use App\Repository\InterFace\PlaneRepoInterface;

class VideoRepo  implements PlaneRepoInterface
{

    public function index()
    {
        $videoData = Video::select(['id', 'title', 'descriptions', 'video', 'url'])->get();
        return view('services.showVideo', get_defined_vars());
    }

    public function edit($id)
    {

        $videoData = Video::select(['id', 'title', 'descriptions', 'video', 'url'])->first();
        return view('services.editVideo', get_defined_vars());
    }

    public function store($request)
    {
        // Test Request
        // dd($request->all());

        // Get Request
        $videoData = new Video();
        $videoData->title = $request->input('title');
        $videoData->descriptions = $request->input('descriptions');
        $videoData->url = $request->input('url');
        $videoData->video = $request->input('video');


        // Save Video in Server
        if ($request->hasFile('video')) {
            $posterService = time() . '-' . 'video' . '.' . $request->video->extension();
            $request->video->move(public_path('service/video'), $posterService);
            $pathPoster =  $posterService;
            $videoData->video = $pathPoster;
        }

        // Save All Data
        // $serviceIntro->save();
        $videoData->save();

        // Response Message
        return redirect()->back()->with('success', 'تم حفظ البيانات بنجاح.');
    }

    public function update($id,  $request)
    {

        // Find the videoService model by ID
        $videoData = Video::find($id);

        // Check if the model exists
        if (!$videoData) {
            return redirect()->back()->with('error', 'الفيديو غير موجود.');
        }

        // Update the model with the request data
        $videoData->update([
            'title' => $request->input('title'),
            'descriptions' => $request->input('descriptions'),
            'url' => $request->input('url'),
        ]);

        // Update Poster in Server
        // if ($request->hasFile('poster')) {
        //     $posterService = time() . '-poster.' . $request->poster->extension();
        //     $request->poster->move(public_path('poster/services'), $posterService);
        //     $pathIntro = $posterService;
        //     $videoData->poster = $pathIntro;
        // }

        // Update Video in Server
        if ($request->hasFile('video')) {
            $posterService = time() . '-video.' . $request->video->extension();
            $request->video->move(public_path('service/video'), $posterService);
            $pathPoster = $posterService;
            $videoData->video = $pathPoster;
        }

        // Save the changes
        $videoData->save();

        // Response Message
        return redirect()->back()->with('success', 'تم تحديث البيانات بنجاح.');
    }

    public function delete($id)
    {
        $videoService = Video::findOrFail($id);

        if ($videoService->video) {
            $videoPath = public_path('service/video') . $videoService->video;
            if (file_exists($videoPath)) {
                unlink($videoPath);
            }
        }

        $videoService->delete();
        return redirect()->back()->with('success', 'تم حذف  بنجاح.');
    }
}