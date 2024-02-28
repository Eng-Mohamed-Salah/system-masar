<?php

namespace App\Repository\RepoClass\backend;

use App\Models\Subscribe;
use App\Repository\InterFace\PlaneRepoInterface;

class SubscribeRepo  implements PlaneRepoInterface
{

    public function index()
    {
    }

    public function edit($id)
    {
    }

    public function store($request)
    {
        // تحقق من البيانات المدخلة
        // $request->validate([
        //     'start_data' => 'required|date',
        //     'end_data' => 'required|date',
        //     'notes' => 'nullable|string',
        //     'user_id' => 'required|exists:clients,id',
        //     'plane_service_id' => 'required|exists:plane_services,id',
        // ]);

        // إنشاء الاشتراك
        $subscribe = new Subscribe([
            'start_data' => $request->start_data,
            'end_data' => $request->end_data,
            'notes' => $request->notes,
            'client_id' => $request->client_id,
            'plane_service_id' => $request->plane_service_id,
            'complete' => false,
        ]);

        // حفظ الاشتراك
        $subscribe->save();
        // dd($subscribe);
        // إعادة التوجيه أو عرض رسالة نجاح
        return redirect()->back()->with('success', 'تم إنشاء الاشتراك بنجاح.');
    }

    public function update($id, $request)
    {
        $subscribe = Subscribe::find($id);

        // تحقق من البيانات المدخلة
        // $subscribe = $request->validate([
        //     'start_data' => 'required|date',
        //     'end_data' => 'required|date',
        //     'notes' => 'nullable|string',
        //     'user_id' => 'required|exists:clients,id',
        //     'plane_service_id' => 'required|exists:plane_services,id',
        // ]);

        // تحديث البيانات
        $subscribe->update([
            'start_data' => $request->start_data,
            'end_data' => $request->end_data,
            'notes' => $request->notes,
            'user_id' => $request->user_id,
            'plane_service_id' => $request->plane_service_id,
        ]);

        // إعادة التوجيه أو عرض رسالة نجاح
        return redirect()->back()->with('success', 'تم تحديث الاشتراك بنجاح.');
    }

    public function delete($id)
    {
        $subscribe = Subscribe::findOrFail($id);

        // حذف الاشتراك
        $subscribe->delete();

        // إعادة التوجيه أو عرض رسالة نجاح
        return redirect()->back()->with('success', 'تم حذف الاشتراك بنجاح.');
    }

    public function updateComplete($subscribe, $request)
    {
        $subscribe = Subscribe::find($subscribe);
        // $subscribe->update(['complete' => $request->complete]);
        $subscribe->update(['complete' => request('complete')]);
        return redirect()->back()->with('success', 'تم أكتمال الاشتراك بنجاح.');
    }
    public function updatesubScription($request)
    {
        $subscribe = Subscribe::find($request->input('id'));

        if (!$subscribe) {
            return response()->json(['success' => false, 'message' => 'Subscription not found']);
        }

        $subscribe = Subscribe::find($request->input('id'));
        $subscribe->plane_service_id = $request->input('plane_service_id');
        $subscribe->start_data = $request->input('start_data');
        $subscribe->end_data = $request->input('end_data');
        $subscribe->notes = $request->input('notes');
        $subscribe->save();

        return response()->json(['success' => true]);
    }
}