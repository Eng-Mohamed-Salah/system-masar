<?php

namespace App\Repository\RepoClass\backend;

use App\Models\ImageService;
use App\Repository\InterFace\PlaneRepoInterface;
use Illuminate\Support\Facades\Storage;

class ImageRepo  implements PlaneRepoInterface
{

    public function index()
    {
        $galaryData = ImageService::select(['id', 'img400x400', 'img800x800', 'img400x800', 'img800x400'])->get();
        return view('services.showGalary', get_defined_vars());
    }

    public function edit($id)
    {

        // $galaryData = ImageService::select(['id', 'title', 'descriptions', 'video', 'url'])->first();
        // return view('services.editGalary', get_defined_vars());
    }

    public function store($request)
    {
        // Test Request
        // dd($request->all());

        // Get Request
        $imageData = new ImageService();
        $imageData->img400x800 = $request->input('img400x800');
        $imageData->img800x400 = $request->input('img800x400');
        $imageData->img400x400 = $request->input('img400x400');
        $imageData->img800x800 = $request->input('img800x800');
        // Save Poster in Server
        if ($request->hasFile('img400x800')) {
            $imageService = time() . '-' . 'image 400x800' . '.' . $request->img400x800->extension();
            $request->img400x800->move(public_path('image/services'), $imageService);
            $pathIntro =  $imageService;
            $imageData->img400x800 = $pathIntro;
        }
        if ($request->hasFile('img800x400')) {
            $imageService = time() . '-' . 'image 800x400' . '.' . $request->img800x400->extension();
            $request->img800x400->move(public_path('image/services'), $imageService);
            $pathIntro =  $imageService;
            $imageData->img800x400 = $pathIntro;
        }
        if ($request->hasFile('img400x400')) {
            $imageService = time() . '-' . 'image 400x400' . '.' . $request->img400x400->extension();
            $request->img400x400->move(public_path('image/services'), $imageService);
            $pathIntro =  $imageService;
            $imageData->img400x400 = $pathIntro;
        }

        if ($request->hasFile('img800x800')) {
            $imageService = time() . '-' . 'image 800x800' . '.' . $request->img800x800->extension();
            $request->img800x800->move(public_path('image/services'), $imageService);
            $pathIntro =  $imageService;
            $imageData->img800x800 = $pathIntro;
        }
        // Save Details Image
        // $imageData->image = $path;
        // $imageData->width = Image::make($pathIntro)->width();
        // $imageData->height = Image::make($pathIntro)->height();


        // Save All Data
        // $serviceIntro->save();
        $imageData->save();

        // Response Message
        return redirect()->back()->with('success', 'تم حفظ البيانات بنجاح.');
    }

    public function update($id,$request){}
    public function updatePhoto($id,$filename,$request)
    {
        $image = ImageService::findOrFail($id);


        if (
            $filename === $image->img400x800 ||
            $filename === $image->img800x800 ||
            $filename === $image->img400x400 ||
            $filename === $image->img800x400
        ) {

                $imageData = new ImageService();
                $imageData->img400x800 = $request->input('img400x800');
                $imageData->img800x400 = $request->input('img800x400');
                $imageData->img400x400 = $request->input('img400x400');
                $imageData->img800x800 = $request->input('img800x800');
                // Save Poster in Server
                if ($request->hasFile('img400x800')) {
                    $imageService = time() . '-' . 'image 400x800' . '.' . $request->img400x800->extension();
                    $request->img400x800->move(public_path('image/services'), $imageService);
                    $pathIntro =  $imageService;
                    $imageData->img400x800 = $pathIntro;
                }
                if ($request->hasFile('img800x400')) {
                    $imageService = time() . '-' . 'image 800x400' . '.' . $request->img800x400->extension();
                    $request->img800x400->move(public_path('image/services'), $imageService);
                    $pathIntro =  $imageService;
                    $imageData->img800x400 = $pathIntro;
                }
                if ($request->hasFile('img400x400')) {
                    $imageService = time() . '-' . 'image 400x400' . '.' . $request->img400x400->extension();
                    $request->img400x400->move(public_path('image/services'), $imageService);
                    $pathIntro =  $imageService;
                    $imageData->img400x400 = $pathIntro;
                }

                if ($request->hasFile('img800x800')) {
                    $imageService = time() . '-' . 'image 800x800' . '.' . $request->img800x800->extension();
                    $request->img800x800->move(public_path('image/services'), $imageService);
                    $pathIntro =  $imageService;
                    $imageData->img800x800 = $pathIntro;
                }
            }
            if ($filename === $image->img400x800) {
                $image->img400x800 = $request->input('img400x800');
            } elseif ($filename === $image->img800x800) {
                $image->img800x800 = $request->input('img800x800');
            } elseif ($filename === $image->img400x400) {
                $image->img400x400 = $request->input('img400x400');
            } elseif ($filename === $image->img800x400) {
                $image->img800x400 = $request->input('img800x400');
            }

            $image->save();


            return redirect()->back()->with('success', 'تم  تحديث الصورة بنجاح.');


        }

    public function deletePhotography($id, $filename)
    {
        $image = ImageService::findOrFail($id);

        // تحقق مما إذا كان اسم الصورة المطلوب حقًا يتطابق مع أحد الأحجام
        if (
            $filename === $image->img400x800 ||
            $filename === $image->img800x800 ||
            $filename === $image->img400x400 ||
            $filename === $image->img800x400
        ) {
            // إذا كان اسم الصورة يتطابق، قم بحذفها من التخزين إذا كانت موجودة
            if (Storage::exists("image/services/{$filename}")) {
                Storage::delete("image/services/{$filename}");
            }

            if ($filename === $image->img400x800) {
                $image->img400x800 = null;
            } elseif ($filename === $image->img800x800) {
                $image->img800x800 = null;
            } elseif ($filename === $image->img400x400) {
                $image->img400x400 = null;
            } elseif ($filename === $image->img800x400) {
                $image->img800x400 = null;
            }

            $image->save();


            return redirect()->back()->with('success', 'تم حذف الصورة بنجاح.');
        }

        // إذا لم يكن اسم الصورة متطابقًا مع أي حجم، فهو خطأ
        return redirect()->back()->with('error', 'خطأ في حذف الصورة.');
    }


    public function delete($id)
    {
    }
}