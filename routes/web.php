<?php
// ====================== { Start Import Files} ======================
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\RevenueController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\backend\ClientController;
use App\Http\Controllers\backend\ImageServiceController;
use App\Http\Controllers\backend\MarketingController;
use App\Http\Controllers\backend\PlaneServicesController;
use App\Http\Controllers\backend\ProgrammingServiceController;
use App\Http\Controllers\backend\SubscribeController;
use App\Http\Controllers\backend\VideoController;
use App\Http\Controllers\DeductionsAndBonusesController;
use App\Http\Controllers\ExpensesController;
use App\Http\Controllers\backend\HistoryData;
use App\Http\Controllers\MangerController;
use App\Http\Controllers\PettycashController;
use App\Http\Controllers\ProjectProgrammingController;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\ShortContractsController;
use App\Http\Controllers\StorageController;
use App\Models\ProjectProgramming;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

// ====================== { End Import Files} ======================


// ========================== Start Welcome Page =========================================
Route::get('/', function () {
    return view('client.welcome');
});
// ========================== End Welcome Page =========================================

// ========================== Start Login Page =========================================
Route::middleware(['guest'])->group(function () {
    Route::get('/client/login', function () {
        return view('auth.login');
    });
});
// ========================== End Login Page =========================================

// ========================== Start Register Page =========================================
require __DIR__ . '/auth.php';
Route::post('/register', [EmployeeController::class, 'storeAdmin'])->name('admin');
// ========================== End Register Page =========================================


// ========================== Start Interface Page =========================================
Route::get('/client/interface', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');
// ========================== End Interface Page =========================================

// ========================== Start HR Page =========================================
Route::get('/admin/hr/dashboard', function () {
    return view('/admin/hr/dashboard');
});

Route::prefix('admin/hr')->middleware('auth')->group(function () {

    // Route Add Data Entry Attendance for Employees By Id
    Route::get('/dataEntry', [AttendanceController::class, 'create'])->name('admin.hr.dataEntry');

    // Route Save Data Entry Attendance for Employees By Id
    Route::post('/dataEntry', [AttendanceController::class, 'store'])->name('admin.hr.dataEntry.store');

    // Route Update Data Entry Employees By Id
    Route::post('/editEmp/{id}', [AttendanceController::class, 'update'])->name('admin.hr.dataEntry.update');

    // Route Delete Data Entry Employees By Id
    Route::delete('/editEmp/delete/{id}', [AttendanceController::class, 'destroy'])->name('admin.hr.dataEntry.delete');


    // Route Show All Employees
    Route::get('/empList', [EmployeeController::class, 'index'])->name('admin.hr.empList');

    // Route Add Employees
    Route::get('/create', [EmployeeController::class, 'create'])->name('admin.hr.create');

    // Route Save Employees By Id
    Route::post('/empList', [EmployeeController::class, 'store'])->name('admin.hr.store');

    // Route Profile Employees By Id
    Route::get('/empList/{id}', [EmployeeController::class, 'show'])->name('admin.hr.show');

    // Route Edite Data Employees By Id
    Route::get('/empList/{id}/edit', [EmployeeController::class, 'edit'])->name('admin.hr.edit');

    // Route Update Data Employees By Id
    Route::put('/empList/{id}', [EmployeeController::class, 'update'])->name('admin.hr.update');

    // Route Delete Data Employees By Id
    Route::delete('/empList/{id}', [EmployeeController::class, 'destroy'])->name('admin.hr.destroy');

    // Route Save Data DeductionsAndBonuses By Id
    Route::post('/empList/DeductionsAndBonuses', [DeductionsAndBonusesController::class, 'store'])->name('admin.hr.DandB.store');

    // Route Delete Data DeductionsAndBonuses By Id
    Route::delete('/empList/DeductionsAndBonuses/{id}', [DeductionsAndBonusesController::class, 'destroy'])->name('admin.hr.DandB.delete');

    // Route Update Data DeductionsAndBonuses By Id
    // Route::put('/empList/DeductionsAndBonuses/{id}', [DeductionsAndBonusesController::class, 'update'])->name('admin.hr.DandB.update');
});
// ========================== End HR Page =========================================

// ========================== Start Customer Service Page =========================================

// Page Marketing Sections
Route::get('/client/marketing/sections', function () {
    return view('/client/marketing/sections');
});
// ========================== End Customer Service Page =========================================



// ========================== Start Attendance Page =========================================

// Save Data Entry
Route::post('/editEmp/updateNotes/{id}', [EmployeeController::class, 'updateNotes'])->name('admin.notes')->middleware('auth');

// Update Notes in Table Attendance
Route::put('/editEmp/deductionsandbonuses/{id}', [EmployeeController::class, 'updateDeductionsAndBonuses'])->name('admin.updateBonuses')->middleware('auth');

// ========================== End Attendance Page =========================================


// ========================== Start Edit Finance with Controller =========================================

// Route Dashboard Finances
Route::get('/admin/finance/dashboard', function () {
    return view('admin.fiances.dashboardfinance');
})->middleware('auth');

// ------------------------- Start Revenues -------------------------

// Route Show All Data in Revenues
Route::get('/admin/finance/revenues', [RevenueController::class, 'index'])->name('admin.fiances.revenues')->middleware('auth');

// Route Save Data in Basic Revenues
Route::post('/admin/finance/revenues/savebasic', [RevenueController::class, 'storebasic'])->name('admin.fiances.revenuesstore')->middleware('auth');

// Route Save Data in Short Contracts
Route::post('/admin/finance/revenues/saveshortContracts', [ShortContractsController::class, 'store'])->name('admin.fiances.shortContracts')->middleware('auth');

// Route Delete  Short Contracts By ID
Route::delete('/admin/finance/revenues/ShortContracts/{id}', [ShortContractsController::class, 'destroy'])->name('admin.fiances.shortContracts.destroy')->middleware('auth');

// Route Delete  Basic Revenues By ID
Route::delete('/admin/finance/revenues/{id}', [RevenueController::class, 'destroy'])->name('admin.fiances.destroy')->middleware('auth');

// Route Show Edit Revenues By ID
Route::get('/admin/finance/revenues/{id}', [RevenueController::class, 'showBasic'])->name('finance.edit.revenues')->middleware('auth');

// Route Update Edit  Revenues By ID
Route::put('/admin/finance/revenues/edit/{id}', [RevenueController::class, 'updateBasic'])->name('finance.edit.revenuesupdate')->middleware('auth');

// Route Show Edit Short Contracts By ID
Route::get('/admin/finance/revenues/shortcontract/{id}', [ShortContractsController::class, 'showShortcontract'])->name('finance.edit.showShortcontract')->middleware('auth');

// Route Update Edit Short Contracts By ID
Route::put('/admin/finance/revenues/shortcontract/{id}', [ShortContractsController::class, 'updateShortcontract'])->name('finance.edit.shortcontractsupdate')->middleware('auth');


// Route Filter Date Basic Revenue
Route::get('/filter', [RevenueController::class, 'filter'])->name('revenue.filter')->middleware('auth');

// Route Filter Date Short Contracts
Route::get('/filtershortcontract', [ShortContractsController::class, 'filter'])->name('shortcontract.filter')->middleware('auth');

// Route Revenue Chckbox
Route::put('/admin/finance/revenues/{id}/updateCheckbox', [RevenueController::class, 'updateCheckbox'])->name('updateChckbox.revenue')->middleware('auth');

// ------------------------- End Revenues -------------------------



// ------------------------- Start Expenses -------------------------

// Route Show All Data  Expences  And Petty Cash
Route::get('/admin/finance/expenses', [ExpensesController::class, 'index'])->name('admin.fiances.expenses')->middleware('auth');

// Route Save Expences
Route::post('/admin/finance/expenses', [ExpensesController::class, 'store'])->name('admin.fiances.expensesSave')->middleware('auth');

// Route Delete Expences By Id
Route::delete('/admin/finance/expenses/{id}', [ExpensesController::class, 'destroy'])->name('admin.fiances.expenses_delete')->middleware('auth');

// Route Edit Expences By Id
Route::get('/admin/finance/expenses/{id}', [ExpensesController::class, 'showExpences'])->name('finance.edit.expenses')->middleware('auth');

// Route Update Edit Expences By ID
Route::put('/admin/finance/expenses/{id}', [ExpensesController::class, 'updateExpences'])->name('finance.edit.saveExpences')->middleware('auth');

// Route Save Data Petty Cash
Route::post('/admin/finance/expenses_pettycash', [PettycashController::class, 'storepetty'])->name('admin.fiances.expenses_pettysave')->middleware('auth');

// Route Delete Petty Cash By ID
Route::delete('/admin/finance/expenses/petty/{id}', [PettycashController::class, 'destroy'])->name('admin.fiances.petty_delete')->middleware('auth');


// Route Edit petty cash By Id
Route::get('/admin/finance/expenses/pettycash/{id}', [PettycashController::class, 'showPettycash'])->name('finance.edit.pettycash')->middleware('auth');

// Route Update Edit petty cash By ID
Route::put('/admin/finance/expenses/pettycash/{id}', [PettycashController::class, 'updatePettycash'])->name('finance.edit.savePettycash')->middleware('auth');




// Route Filter Date Expences
Route::get('/filterexpencess', [ExpensesController::class, 'filter'])->name('expences.filter')->middleware('auth');

// Route Filter Date petty cash
Route::get('/filterpettycash', [PettycashController::class, 'filter'])->name('pettycash.filter')->middleware('auth');


// ------------------------- End Expenses -------------------------


// ------------------------- Start Salary -------------------------
Route::get('/admin/finance/bonusesdiscounts', [SalaryController::class, 'index'])->name('fiances.salary')->middleware('auth');
// ------------------------- End Salary -------------------------




// ------------------------- Start Storage -------------------------

//  Get Data
Route::get('/admin/finance/storage', [StorageController::class, 'index'])->name('storage')->middleware('auth');

// Get Data By Filter Day
Route::get('/admin/finance/storage/filterDay', [StorageController::class, 'filterData'])->name('filterDay_data')->middleware('auth');

// Get Data By Filter Month
Route::get('/admin/finance/storage/filterMonth', [StorageController::class, 'filterDataMonth'])->name('filterMonth_data')->middleware('auth');

// Get Data By Filter Year
Route::get('/admin/finance/storage/filterYear', [StorageController::class, 'filterDataYear'])->name('filterYear_data')->middleware('auth');



// ------------------------- End Storage -------------------------

// ========================== End Edit Finance with Controller =========================================




// ========================== Start Manager with Controller =========================================


// Route Employees Manager
Route::get('/client/manager/dashbord', [MangerController::class, 'index'])->name('manager.listEmployee')->middleware('auth');

// Route Create Tasks Manager Marketing
Route::get('/client/manager/marketing/createTasks', [MangerController::class, 'create'])->name('manager.marketing.createtasks')->middleware('auth');
// Route Create Tasks Manager Programming
Route::get('/client/manager/programming/createTasks', [MangerController::class, 'createPro'])->name('manager.programming.createtasks')->middleware('auth');

// Ajax Get Employee By Json
Route::get('/employeesMarketing', function (User $user) {
    // Ruls Conditions
    $userRole = auth()->user()->role;
    $userDepartment = auth()->user()->department;
    // If Status Manager And Department is Programming
    // if ($userRole == 'manager' && $userDepartment == 'programming') {
    //     $employees = $user->whereNotIn('role', ['admin', 'hr', 'finance', 'manager', 'dataentry'])->where('department', ['programming'])->get();
    //     //  $employees = 'A7A Condition 1';
    // }

    // If Status Admin And Department is Programming
    //    if ($userRole == 'admin' && $userDepartment == 'programming') {
    //     $employees = $user->whereNotIn('role', ['admin', 'hr', 'finance', 'manager', 'dataentry'])->where('department', ['programming'])->get();
    //     // $employees = 'A7A Condition 4';

    // }

    // If Status Manager And Department is Marketing Or Any Think
    if ($userRole == 'manager' && $userDepartment != 'programming') {
        $employees = $user->whereNotIn('role', ['admin', 'hr', 'finance', 'manager', 'dataentry'])->where('department', "!=", ['programming'])->get();
        //  $employees = 'A7A Condition 2';
    }

    // If Status Admin And Department is Marketing
    if ($userRole == 'admin' && $userDepartment != 'programming') {
        $employees = $user->whereNotIn('role', ['admin', 'hr', 'finance', 'manager', 'dataentry'])->where('department', "!=", ['programming'])->get();
        //  $employees = 'A7A Condition 3';

    }
    // Test
    // return $employees;

    return response()->json($employees);
});




// ========== {{ Start Marketing  }}  ==========


// Route Save Project Marketing
Route::post('/client/manager/marketing/createTasks/marketing', [MangerController::class, 'storeMarketing'])->name('projects.marketing.store');

// Route Get All Project Marketing
Route::get('/client/manager/marketing/list-project', [MangerController::class, 'showProjectMarketing'])->name('projects.marketing.showProject');

// Route Edit Tasks Manager
Route::get('/client/manager/marketing/editTasks/{id}', [MangerController::class, 'editMarketing'])->name('manager.marketing.edittask')->middleware('auth');

// Route Update Tasks Manager
Route::put('/client/manager/editTasks/marketing/{projectId}', [MangerController::class, 'updateMar'])->name('manager.marketing.updatetask')->middleware('auth');
// Route Data Json  Marketing
Route::post('/update-marketing/{projectId}', [MangerController::class, 'updateMarketing'])->name('updateMarketing');

// Route Delete Project Marketing By ID
Route::delete('/client/manager/marketing/Tasks/{id}', [MangerController::class, 'destroy'])->name('manager.marketing.delete')->middleware('auth');

// Route Upload Link Employee
Route::put('/save-link', [MangerController::class, 'saveLink'])->name('save.link');

// ========== {{ End Marketing  }}  ==========






// ========== {{ Start Programming  }}  ==========


// Route Save Project Programming
Route::post('/client/manager/marketing/createTasks/programming', [ProjectProgrammingController::class, 'storeProgramming'])->name('projects.programming.store');

// Route Get All Project Programming
Route::get('/client/manager/programming/list-project', [MangerController::class, 'showProjectMarketing'])->name('projects.marketing.showProject');


// Route Get All Data json Project Programming
Route::get('/client/manager/programming/list-project', [ProjectProgrammingController::class, 'showProjectProgramming'])->name('projects.programming.showProject');

// Route Edit Tasks programming
Route::get('/client/manager/programming/editTasks/{id}', [ProjectProgrammingController::class, 'editPro'])->name('manager.programming.edittask')->middleware('auth');

// Route Update Tasks programming
Route::put('/client/manager/editTasks/programming/{projectId}', [ProjectProgrammingController::class, 'updateProgramming'])->name('manager.programming.updatetask')->middleware('auth');
// Route Data Json  programming
Route::post('/update-programming/{projectId}', [ProjectProgrammingController::class, 'updateProgramming2'])->name('updateProgramming');

// Route Delete Project Programming By ID
Route::delete('/client/manager/programming/Tasks/{id}', [ProjectProgrammingController::class, 'destroy'])->name('manager.programming.delete')->middleware('auth');


// Ajax Get Employee Programming By Json
Route::get('/employeesProgramming', function (User $user) {
    // Ruls Conditions
    $userRole = auth()->user()->role;
    $userDepartment = auth()->user()->department;
    // If Status Manager And Department is Programming
    // if ($userRole == 'manager' && $userDepartment == 'programming') {
    //     $employees = $user->whereNotIn('role', ['admin', 'hr', 'finance', 'manager', 'dataentry'])->where('department', ['programming'])->get();
    //     //  $employees = 'A7A Condition 1';
    // }

    // // If Status Admin And Department is Programming
    //    if ($userRole == 'admin' && $userDepartment == 'programming') {
    //     $employees = $user->whereNotIn('role', ['admin', 'hr', 'finance', 'manager', 'dataentry'])->where('department', ['programming'])->get();
    //     // $employees = 'A7A Condition 4';

    // }
    $employees = $user->whereNotIn('role', ['admin', 'hr', 'finance', 'manager', 'dataentry'])
        ->where('department', 'programming')
        ->get();
    // Test
    // return $employees;

    return response()->json($employees);
});


// ========== {{ End customers  }}  ==========


// ========== {{ Client  }}  ==========
// Route::get('/show-client', function () {
//     return view('customers.clients.showClient');
// });

// Route::get('/edit-client', function () {
//     return view('customers.clients.editClient');
// });

// ========== {{ Plans  }}  ==========
// Route::get('/show-plan', function () {
//     return view('customers.plans.showPlan');
// });

Route::get('/edit-plan', function () {
    return view('customers.plans.editPlan');
});

// // ========== {{ History  }}  ==========
// Route::get('/show-history', function () {
//     return view('customers.historys.history');
// });

// ========== {{ End customers  }}  ==========



// ========== {{ Start services  }}  ==========
// Route::get('/show-galary', function () {
//     return view('services.showGalary');
// });

// Route::get('/edit-galary', function () {
//     return view('services.editGalary');
// });

// Route::get('/show-marketing', function () {
//     return view('services.showMarketing');
// });

// Route::get('/edit-marketing', function () {
//     return view('services.editMarketing');
// });

// Route::get('/show-programming', function () {
//     return view('services.showProgramming');
// });

// Route::get('/edit-programming', function () {
//     return view('services.editProgramming');
// });

// Route::get('/edit-video', function () {
//     return view('services.editVideo');
// });

// Route::get('/show-video', function () {
//     return view('services.showVideo');
// });
// ========== {{ End services  }}  ==========


// ========== {{ Start Client  }}  ==========
// Route::get('/profile',function(){
//     return view('customers.clients.profile');
// });
// ========== {{ End Client  }}  ==========

// ========================== End Manager with Controller =========================================


// ========================== Start Future System =========================================

// ========== {{ Plans  }}  ==========
Route::get('/show-plane', [PlaneServicesController::class, 'index'])->name('show-plane');
Route::post('/create-plane', [PlaneServicesController::class, 'store'])->name('create-plane');
Route::put('/update-plane/{id}', [PlaneServicesController::class, 'update'])->name('update-plane');
Route::get('/edit-plane/{id}', [PlaneServicesController::class, 'edit'])->name('edit-plane');
Route::delete('/delete-plane/{id}', [PlaneServicesController::class, 'delete'])->name('delete-plane');

// ========== {{ Plans  }}  ==========
Route::get('/show-client', [ClientController::class, 'index'])->name('show-client');
Route::post('/create-client', [ClientController::class, 'store'])->name('create-client');
Route::put('/update-client/{id}', [ClientController::class, 'update'])->name('update-client');
Route::get('/showDetails-client/{id}', [ClientController::class, 'showClient'])->name('showDetails-client');
Route::get('/edit-client/{id}', [ClientController::class, 'edit'])->name('edit-client');
Route::delete('/delete-client/{id}', [ClientController::class, 'delete'])->name('delete-client');

// ========== {{ Marketing  }}  ==========
Route::get('/show-marketing', [MarketingController::class, 'index'])->name('show-marketing');
Route::get('/edit-marketing/{id}', [MarketingController::class, 'edit'])->name('edit-marketing');
Route::put('/update-marketing/{id}', [MarketingController::class, 'update'])->name('update-marketing');
Route::post('/create-marketing', [MarketingController::class, 'store'])->name('create-marketing');
Route::delete('/delete-marketing/{id}', [MarketingController::class, 'delete'])->name('delete-marketing');

// ========== {{ Programming  }}  ==========
Route::get('/show-programming', [ProgrammingServiceController::class, 'index'])->name('show-programming');
Route::get('/edit-programmingService/{id}', [ProgrammingServiceController::class, 'edit'])->name('edit-programmingService');
Route::post('/create-programming', [ProgrammingServiceController::class, 'store'])->name('create-programming');
Route::put('/update-programmingService/{id}', [ProgrammingServiceController::class, 'update'])->name('update-programmingService');
Route::delete('/delete-programmingService/{id}', [ProgrammingServiceController::class, 'delete'])->name('delete-programmingService');

// ========== {{ Video  }}  ==========
Route::get('/show-video', [VideoController::class, 'index'])->name('show-video');
Route::get('/edit-video/{id}', [VideoController::class, 'edit'])->name('edit-video');
Route::put('/update-video/{id}', [VideoController::class, 'update'])->name('update-video');
Route::post('/create-video', [VideoController::class, 'store'])->name('create-video');
Route::delete('/delete-video/{id}', [VideoController::class, 'delete'])->name('delete-video');
// ========== {{ Image  }}  ==========
Route::get('/show-galary', [ImageServiceController::class, 'index'])->name('show-galary');
Route::get('/edit-galary/{id}', [ImageServiceController::class, 'edit'])->name('edit-galary');
Route::post('/create-galary', [ImageServiceController::class, 'store'])->name('create-galary');
// Route::put('/update-galary', [ImageServiceController::class, 'update'])->name('update-galary');
Route::put('/delete-galary/{id}/{filename}', [ImageServiceController::class, 'deletePhotography'])->name('delete-galary');
Route::put('/update-galary/{id}/{filename}', [ImageServiceController::class, 'updatePhoto'])->name('update-galary');
// ========== {{ Subscribe  }}  ==========
Route::post('/create-subscribe', [SubscribeController::class, 'store'])->name('create-subscribe');
Route::delete('/delete-subscribe/{id}', [SubscribeController::class, 'delete'])->name('delete-subscribe');
Route::patch('/subscribe/{subscribe}', [SubscribeController::class, 'updateComplete'])->name('subscribe.updateComplete');
Route::post('/updateSubscribe', [SubscribeController::class, 'updatesubScription'])->name('updateSubscribe');
Route::put('/update-subscribe/{id}', [SubscribeController::class, 'update'])->name('update-subscribe');

// ========== {{ History  }}  ==========
Route::get('/show-history',[ HistoryData::class ,'showTrash'])->name('show-history');
Route::post('/restore-clienthistory/{id}',[ HistoryData::class ,'restoreClient'])->name('restore-clienthistory');
Route::delete('/delete-clienthistory/{id}',[ HistoryData::class ,'forceDeleteClient'])->name('delete-clienthistory');

Route::post('/restore-userhistory/{id}',[ HistoryData::class ,'restoreUser'])->name('restore-userhistory');
Route::delete('/delete-userhistory/{id}',[ HistoryData::class ,'forceDeleteUser'])->name('delete-userhistory');

Route::post('/restore-planehistory/{id}',[ HistoryData::class ,'restorePlane'])->name('restore-planehistory');
Route::delete('/delete-planehistory/{id}',[ HistoryData::class ,'forceDeletePlane'])->name('delete-planehistory');

Route::post('/restore-attendance/{id}',[ HistoryData::class ,'restoreAttendance'])->name('restore-attendance');
Route::delete('/delete-attendance/{id}',[ HistoryData::class ,'forceDeleteAttendance'])->name('delete-attendance');

Route::post('/restore-expenses/{id}',[ HistoryData::class ,'restoreExpenses'])->name('restore-expenses');
Route::delete('/delete-expenses/{id}',[ HistoryData::class ,'forceDeleteExpenses'])->name('delete-expenses');

Route::post('/restore-revenue/{id}',[ HistoryData::class ,'restoreRevenue'])->name('restore-revenue');
Route::delete('/delete-revenue/{id}',[ HistoryData::class ,'forceDeleteRevenue'])->name('delete-revenue');

Route::post('/restore-pettycash/{id}',[ HistoryData::class ,'restorePettyCash'])->name('restore-pettycash');
Route::delete('/delete-pettycash/{id}',[ HistoryData::class ,'forceDeletePettyCash'])->name('delete-pettycash');

Route::post('/restore-shortcontracts/{id}',[ HistoryData::class ,'restoreShortContracts'])->name('restore-shortcontracts');
Route::delete('/delete-shortcontracts/{id}',[ HistoryData::class ,'forceDeleteShortContracts'])->name('delete-shortcontracts');

Route::post('/restore-projectmarketing/{id}',[ HistoryData::class ,'restoreProjectMarketing'])->name('restore-projectmarketing');
Route::delete('/delete-projectmarketing/{id}',[ HistoryData::class ,'forceDeleteProjectMarketing'])->name('delete-projectmarketing');

Route::post('/restore-projectprogramming/{id}',[ HistoryData::class ,'restoreProjectProgramming'])->name('restore-projectprogramming');
Route::delete('/delete-projectprogramming/{id}',[ HistoryData::class ,'forceDeleteProjectProgramming'])->name('delete-projectprogramming');
// ========================== End Future System =========================================