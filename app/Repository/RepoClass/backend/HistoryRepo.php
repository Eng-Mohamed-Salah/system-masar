<?php

namespace App\Repository\RepoClass\backend;

use App\Models\Attendance;
use App\Models\Client;
use App\Models\Expenses;
use App\Models\Marketing;
use App\Models\Pettycash;
use App\Models\PlaneServices;
use App\Models\ProgrammingService;
use App\Models\ProjectMarketing;
use App\Models\ProjectProgramming;
use App\Models\Revenue;
use App\Models\ShortContracts;
use App\Models\Subscribe;
use App\Models\User;
use App\Models\Video;
use App\Repository\InterFace\HistoryRepoInterface;

class HistoryRepo  implements HistoryRepoInterface
{
    // Show All Data Removed Temp =>Method Get
    public function showTrash()
    {
        // Video Data Deleted
        $videoData = Video::onlyTrashed()->select(['id', 'title', 'descriptions', 'url'])->get();
        // Client Data Deleted
        $clientData = Client::onlyTrashed()->select(['id', 'name', 'image', 'deleted_at'])->get();
        // Plane Data Deleted
        $planeData = PlaneServices::onlyTrashed()->select(['id', 'title', 'cost', 'deleted_at'])->get();
        // Programming Data Deleted
        $programmingData = ProgrammingService::onlyTrashed()->select(['id', 'title', 'descriptions', 'image'])->get();
        // Marketing Data Deleted
        $marketData = Marketing::onlyTrashed()->select(['id', 'title', 'descriptions', 'department'])->get();
        // Subscribe Data Deleted
        $subscribeData = Subscribe::onlyTrashed()->select(['id', 'start_data', 'end_data', 'notes', 'client_id', 'plane_service_id', 'complete'])->get();
        // Employee Data Deleted
        $userData = User::onlyTrashed()->select(['id', 'image', 'name', 'deleted_at'])->get();
        // Attendance Data Deleted
        $attendanceData = Attendance::onlyTrashed()->select(['id', 'day', 'check_in', 'absent', 'on_leave', 'employee_id', 'deleted_at'])->get();
        // Revenue Data Deleted
        $revenueData = Revenue::onlyTrashed()->select(['id', 'name', 'amount', 'start_date', 'due_date', 'contract_type', 'deleted_at'])->get();
        // ShortContracts Data Deleted
        $shortContractsData = ShortContracts::onlyTrashed()->select(['id', 'name', 'amount', 'start_date', 'due_date', 'contractShort_type', 'deleted_at'])->get();
        // Expenses Data Deleted
        $expensesData = Expenses::onlyTrashed()->select(['id', 'amount', 'invoice_type', 'start_date', 'due_date', 'deleted_at'])->get();
        // PettyCash Data Deleted
        $pettyCashData = Pettycash::onlyTrashed()->select(['id', 'amount', 'invoicepetty_type', 'start_date', 'due_date', 'deleted_at'])->get();

        // Project Marketing Data Deleted
        $projectMarketing = ProjectMarketing::onlyTrashed()->select(['id', 'project_name', 'deleted_at','department'])->get();
        // Project Programming Data Deleted
        $projectProgramming = ProjectProgramming::onlyTrashed()->select(['id', 'project_name', 'deleted_at','department'])->get();




        return view('customers.historys.history', get_defined_vars());
    }


    // Delete Force Data For Ever => Method Delete
    public function forceDeleteClient($id)
    {

        // Video Data Deleted
        $clientData = Client::withTrashed()->findOrFail($id);

        if ($clientData->trashed()) {
            $imagePaths = [];
            if ($clientData->image) {
                $imagePaths[] = public_path('images/client/' . $clientData->image);
            }
            $clientData->forceDelete();
            return redirect()->back()->with('success', 'تم حذف العميل بنجاح.');
        } else {
            return redirect()->back()->with('error', 'لا يمكن حذف العميل بشكل نهائي، يرجى حذفه أولاً.');
        }
    }

    // Restore Data Deleted => Method Put
    public function restoreClient($id)
    {
        // Video Data Deleted
        $clientData = Client::withTrashed()->findOrFail($id);
        $clientData->restore();
        return redirect()->back()->with('success', 'تم استرجاع السجل بنجاح.');
    }

    // Delete Force Data For Ever => Method Delete
    public function forceDeleteUser($id)
    {

        // Video Data Deleted
        $userData = User::withTrashed()->findOrFail($id);

        if ($userData->trashed()) {
            $imagePaths = [];
            if ($userData->image) {
                $imagePaths[] = public_path('images/' . $userData->image);
            }

            if ($userData->image2) {
                $imagePaths[] = public_path('images/' . $userData->image2);
            }

            if ($userData->image3) {
                $imagePaths[] = public_path('images/' . $userData->image3);
            }

            foreach ($imagePaths as $imagePath) {
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }
            $userData->forceDelete();
            return redirect()->back()->with('success', 'تم حذف العميل بنجاح.');
        } else {
            return redirect()->back()->with('error', 'لا يمكن حذف العميل بشكل نهائي، يرجى حذفه أولاً.');
        }
    }

    // Restore Data Deleted => Method Put
    public function restoreUser($id)
    {
        // Video Data Deleted
        $userData = User::withTrashed()->findOrFail($id);

        $userData->restore();

        return redirect()->back()->with('success', 'تم استرجاع السجل بنجاح.');
    }

    // Delete Force Data For Ever => Method Delete
    public function forceDeletePlane($id)
    {

        // Video Data Deleted
        $planeData = PlaneServices::withTrashed()->findOrFail($id);

        if ($planeData->trashed()) {
            $planeData->forceDelete();
            return redirect()->back()->with('success', 'تم حذف العميل بنجاح.');
        } else {
            return redirect()->back()->with('error', 'لا يمكن حذف العميل بشكل نهائي، يرجى حذفه أولاً.');
        }
    }

    // Restore Data Deleted => Method Put
    public function restorePlane($id)
    {
        // Video Data Deleted
        $planeData = PlaneServices::withTrashed()->findOrFail($id);
        $planeData->restore();


        return redirect()->back()->with('success', 'تم استرجاع السجل بنجاح.');
    }

    // Delete Force Data For Ever => Method Delete
    public function forceDeleteAttendance($id)
    {

        // Video Data Deleted
        $attendanceData = Attendance::withTrashed()->findOrFail($id);

        if ($attendanceData->trashed()) {
            $attendanceData->forceDelete();
            return redirect()->back()->with('success', 'تم حذف السجل بنجاح.');
        } else {
            return redirect()->back()->with('error', 'لا يمكن حذف العميل بشكل نهائي، يرجى حذفه أولاً.');
        }
    }

    // Restore Data Deleted => Method Put
    public function restoreAttendance($id)
    {
        // Video Data Deleted
        $attendanceData = Attendance::withTrashed()->findOrFail($id);
        $attendanceData->restore();


        return redirect()->back()->with('success', 'تم استرجاع السجل بنجاح.');
    }

    // Delete Force Data For Ever => Method Delete
    public function forceDeleteSubscribe($id)
    {

        // Video Data Deleted
        $SubscribeData = Subscribe::withTrashed()->findOrFail($id);

        if ($SubscribeData->trashed()) {
            $SubscribeData->forceDelete();
            return redirect()->back()->with('success', 'تم حذف السجل بنجاح.');
        } else {
            return redirect()->back()->with('error', 'لا يمكن حذف العميل بشكل نهائي، يرجى حذفه أولاً.');
        }
    }

    // Restore Data Deleted => Method Put
    public function restoreSubscribe($id)
    {
        // Video Data Deleted
        $SubscribeData = Subscribe::withTrashed()->findOrFail($id);
        $SubscribeData->restore();


        return redirect()->back()->with('success', 'تم استرجاع السجل بنجاح.');
    }

    // Delete Force Data For Ever => Method Delete
    public function forceDeleteExpenses($id)
    {

        // Video Data Deleted
        $ExpensesData = Expenses::withTrashed()->findOrFail($id);

        if ($ExpensesData->trashed()) {
            $ExpensesData->forceDelete();
            return redirect()->back()->with('success', 'تم حذف السجل بنجاح.');
        } else {
            return redirect()->back()->with('error', 'لا يمكن حذف العميل بشكل نهائي، يرجى حذفه أولاً.');
        }
    }

    // Restore Data Deleted => Method Put
    public function restoreExpenses($id)
    {
        // Video Data Deleted
        $ExpensesData = Expenses::withTrashed()->findOrFail($id);
        for ($i = 1; $i <= 10; $i++) {
            $imageField = 'image' . $i;
            $imageName = $ExpensesData->$imageField;

            if (!empty($imageName)) {
                // Delete the image file
                $imagePath = public_path('images/expenses/' . $imageName);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }
        }
        $ExpensesData->restore();


        return redirect()->back()->with('success', 'تم استرجاع السجل بنجاح.');
    }

    // Delete Force Data For Ever => Method Delete
    public function forceDeletePettyCash($id)
    {

        // Video Data Deleted
        $Pettycash = Pettycash::withTrashed()->findOrFail($id);

        if ($Pettycash->trashed()) {
            $Pettycash->forceDelete();
            return redirect()->back()->with('success', 'تم حذف السجل بنجاح.');
        } else {
            return redirect()->back()->with('error', 'لا يمكن حذف العميل بشكل نهائي، يرجى حذفه أولاً.');
        }
    }

    // Restore Data Deleted => Method Put
    public function restorePettyCash($id)
    {
        // Video Data Deleted
        $Pettycash = Pettycash::withTrashed()->findOrFail($id);
        for ($i = 1; $i <= 10; $i++) {
            $imageField = 'image' . $i;
            $imageName = $Pettycash->$imageField;

            if (!empty($imageName)) {
                // Delete the image file
                $imagePath = public_path('images/expenses/' . $imageName);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }
        }
        $Pettycash->restore();


        return redirect()->back()->with('success', 'تم استرجاع السجل بنجاح.');
    }

    // Delete Force Data For Ever => Method Delete
    public function forceDeleteRevenue($id)
    {

        // Video Data Deleted
        $RevenueData = Revenue::withTrashed()->findOrFail($id);

        if ($RevenueData->trashed()) {
            // Loop through images and delete them
            for ($i = 1; $i <= 10; $i++) {
                $imageField = 'image' . $i;
                $imageName = $RevenueData->$imageField;

                if (!empty($imageName)) {
                    // Delete the image file
                    $imagePath = public_path('images/revenue/' . $imageName);
                    if (file_exists($imagePath)) {
                        unlink($imagePath);
                    }
                }
            }
            $RevenueData->forceDelete();
            return redirect()->back()->with('success', 'تم حذف السجل بنجاح.');
        } else {
            return redirect()->back()->with('error', 'لا يمكن حذف العميل بشكل نهائي، يرجى حذفه أولاً.');
        }
    }

    // Restore Data Deleted => Method Put
    public function restoreRevenue($id)
    {
        // Video Data Deleted
        $RevenueData = Revenue::withTrashed()->findOrFail($id);
        $RevenueData->restore();


        return redirect()->back()->with('success', 'تم استرجاع السجل بنجاح.');
    }

    // Delete Force Data For Ever => Method Delete
    public function forceDeleteShortContracts($id)
    {

        // Video Data Deleted
        $ShortContracts = ShortContracts::withTrashed()->findOrFail($id);

        if ($ShortContracts->trashed()) {
            // Loop through images and delete them
            for ($i = 1; $i <= 10; $i++) {
                $imageField = 'image' . $i;
                $imageName = $ShortContracts->$imageField;

                if (!empty($imageName)) {
                    // Delete the image file
                    $imagePath = public_path('images/revenue/' . $imageName);
                    if (file_exists($imagePath)) {
                        unlink($imagePath);
                    }
                }
            }
            $ShortContracts->forceDelete();
            return redirect()->back()->with('success', 'تم حذف السجل بنجاح.');
        } else {
            return redirect()->back()->with('error', 'لا يمكن حذف العميل بشكل نهائي، يرجى حذفه أولاً.');
        }
    }

    // Restore Data Deleted => Method Put
    public function restoreShortContracts($id)
    {
        // Video Data Deleted
        $ShortContracts = ShortContracts::withTrashed()->findOrFail($id);
        $ShortContracts->restore();


        return redirect()->back()->with('success', 'تم استرجاع السجل بنجاح.');
    }


    // Delete Force Data For Ever => Method Delete
    public function forceDeleteProjectMarketing($id)
    {

        // Video Data Deleted
        $projectMarketing = ProjectMarketing::withTrashed()->findOrFail($id);

        if ($projectMarketing->trashed()) {

            $projectMarketing->forceDelete();
            return redirect()->back()->with('success', 'تم حذف السجل بنجاح.');
        } else {
            return redirect()->back()->with('error', 'لا يمكن حذف العميل بشكل نهائي، يرجى حذفه أولاً.');
        }
    }

    // Restore Data Deleted => Method Put
    public function restoreProjectMarketing($id)
    {
        // Video Data Deleted
        $projectMarketing = ProjectMarketing::withTrashed()->findOrFail($id);
        $projectMarketing->restore();


        return redirect()->back()->with('success', 'تم استرجاع السجل بنجاح.');
    }



    // Delete Force Data For Ever => Method Delete
    public function forceDeleteProjectProgramming($id)
    {

        // Video Data Deleted
        $projectProgramming = ProjectProgramming::withTrashed()->findOrFail($id);

        if ($projectProgramming->trashed()) {

            $projectProgramming->forceDelete();
            return redirect()->back()->with('success', 'تم حذف السجل بنجاح.');
        } else {
            return redirect()->back()->with('error', 'لا يمكن حذف العميل بشكل نهائي، يرجى حذفه أولاً.');
        }
    }

    // Restore Data Deleted => Method Put
    public function restoreProjectProgramming($id)
    {
        // Video Data Deleted
        $projectProgramming = ProjectProgramming::withTrashed()->findOrFail($id);
        $projectProgramming->restore();


        return redirect()->back()->with('success', 'تم استرجاع السجل بنجاح.');
    }
}