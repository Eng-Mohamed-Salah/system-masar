<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Repository\RepoClass\backend\HistoryRepo;
use Illuminate\Http\Request;

class HistoryData extends Controller
{
    protected $historyRepo;
    public function __construct(HistoryRepo  $historyRepo)
    {
        $this->historyRepo = $historyRepo;
    }


    public function showTrash()
    {
        if (auth()->user()->can('isAdmin')) {
        return $this->historyRepo->showTrash();
         }else{
            abort(403, 'Unauthorized');

        }
    }
    // Client Deleted Forced History
    public function forceDeleteClient($id)
    {
        if (auth()->user()->can('isAdmin')) {
        return $this->historyRepo->forceDeleteClient($id);
       }else{
        abort(403, 'Unauthorized');

    }
    }
    // Client Restore History
    public function restoreClient($id)
    {
        if (auth()->user()->can('isAdmin')) {
        return $this->historyRepo->restoreClient($id);
         }else{
            abort(403, 'Unauthorized');

        }
    }

    // Employee Restore History
    public function forceDeleteUser($id)
    {
        if (auth()->user()->can('isAdmin')) {
        return $this->historyRepo->forceDeleteUser($id);
         }else{
            abort(403, 'Unauthorized');

        }
    }
    // Employee Restore History
    public function restoreUser($id)
    {
        if (auth()->user()->can('isAdmin')) {
        return $this->historyRepo->restoreUser($id);
         }else{
            abort(403, 'Unauthorized');

        }
    }

    // Plane Restore History
    public function forceDeletePlane($id)
    {
        if (auth()->user()->can('isAdmin')) {
        return $this->historyRepo->forceDeletePlane($id);
         }else{
            abort(403, 'Unauthorized');

        }
    }
    // Employee Restore History
    public function restorePlane($id)
    {
        if (auth()->user()->can('isAdmin')) {
        return $this->historyRepo->restorePlane($id);
         }else{
            abort(403, 'Unauthorized');

        }
    }

    // Attendance Restore History
    public function forceDeleteAttendance($id)
    {
        if (auth()->user()->can('isAdmin')) {
        return $this->historyRepo->forceDeleteAttendance($id);
         }else{
            abort(403, 'Unauthorized');

        }
    }
    // Employee Restore History
    public function restoreAttendance($id)
    {
        if (auth()->user()->can('isAdmin')) {
        return $this->historyRepo->restoreAttendance($id);
         }else{
            abort(403, 'Unauthorized');

        }
    }

    // forceDeleteSubscribe Restore History
    public function forceDeleteExpenses($id)
    {
        if (auth()->user()->can('isAdmin')) {
        return $this->historyRepo->forceDeleteExpenses($id);
         }else{
            abort(403, 'Unauthorized');

        }
    }

    // Employee Restore History
    public function restoreExpenses($id)
    {
        if (auth()->user()->can('isAdmin')) {
        return $this->historyRepo->restoreExpenses($id);
         }else{
            abort(403, 'Unauthorized');

        }
    }

    // forceDeleteSubscribe Restore History
    public function forceDeletePettyCash($id)
    {
        if (auth()->user()->can('isAdmin')) {
        return $this->historyRepo->forceDeletePettyCash($id);
         }else{
            abort(403, 'Unauthorized');

        }
    }

    // Employee Restore History
    public function restorePettyCash($id)
    {
        if (auth()->user()->can('isAdmin')) {
        return $this->historyRepo->restorePettyCash($id);
         }else{
            abort(403, 'Unauthorized');

        }
    }

    // Employee Restore History
    public function restoreSubscribe($id)
    {
        if (auth()->user()->can('isAdmin')) {
        return $this->historyRepo->restoreSubscribe($id);
         }else{
            abort(403, 'Unauthorized');

        }
    }

    // forceDeleteSubscribe Restore History
    public function forceDeleteSubscribe($id)
    {
        if (auth()->user()->can('isAdmin')) {
        return $this->historyRepo->forceDeleteSubscribe($id);
         }else{
            abort(403, 'Unauthorized');

        }
    }


    // forceDeleteSubscribe Restore History
    public function forceDeleteRevenue($id)
    {
        if (auth()->user()->can('isAdmin')) {
        return $this->historyRepo->forceDeleteRevenue($id);
         }else{
            abort(403, 'Unauthorized');

        }
    }
    // Employee Restore History
    public function restoreRevenue($id)
    {
        if (auth()->user()->can('isAdmin')) {
        return $this->historyRepo->restoreRevenue($id);
         }else{
            abort(403, 'Unauthorized');

        }
    }

    // forceDeleteSubscribe Restore History
    public function forceDeleteShortContracts($id)
    {
        if (auth()->user()->can('isAdmin')) {
        return $this->historyRepo->forceDeleteShortContracts($id);
         }else{
            abort(403, 'Unauthorized');

        }
    }
    // Employee Restore History
    public function restoreShortContracts($id)
    {
        if (auth()->user()->can('isAdmin')) {
        return $this->historyRepo->restoreShortContracts($id);
         }else{
            abort(403, 'Unauthorized');

        }
    }

    // forceDeleteSubscribe Restore History
    public function forceDeleteProjectMarketing($id)
    {
        if (auth()->user()->can('isAdmin')) {
        return $this->historyRepo->forceDeleteProjectMarketing($id);
         }else{
            abort(403, 'Unauthorized');

        }
    }
    // Employee Restore History
    public function restoreProjectMarketing($id)
    {
        if (auth()->user()->can('isAdmin')) {
        return $this->historyRepo->restoreProjectMarketing($id);
         }else{
            abort(403, 'Unauthorized');

        }
    }

    // forceDeleteSubscribe Restore History
    public function forceDeleteProjectProgramming($id)
    {
        if (auth()->user()->can('isAdmin')) {
        return $this->historyRepo->forceDeleteProjectProgramming($id);
         }else{
            abort(403, 'Unauthorized');

        }
    }
    // Employee Restore History
    public function restoreProjectProgramming($id)
    {
        if (auth()->user()->can('isAdmin')) {
        return $this->historyRepo->restoreProjectProgramming($id);
         }else{
            abort(403, 'Unauthorized');

        }
    }



}