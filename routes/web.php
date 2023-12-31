  <?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['namespace' => 'App\Http\Controllers'], function()
    {   
            Route::get('/', function () {
              return redirect('/login');
    });

//REGISTER ROUTE

Route::group(['middleware' => ['guest']], function() {
           
    Route::get('/register', 'RegisterController@show')->name('register.show');
    Route::post('/register', 'RegisterController@register')->name('register.perform');

//REGISTER USER ROUTE
    Route::get('/registration', 'RegistrationController@show')->name('registration.show');
    Route::post('/registration', 'RegistrationController@register')->name('registration.perform');
    

//LOGIN ROUTE

    Route::get('/login', 'LoginController@show')->name('login.show');
    Route::post('/login', 'LoginController@login')->name('login.perform');



    });

//ADMIN DASHBOARRD/LOGOUT

Route::group(['middleware' => ['admin'], 'prefix' => 'admin'], function() {
            
    Route::get('/logout', 'LogoutController@logout')->name('logout.perform');
    Route::get('/dashboard', 'Dashboard\DashboardController@index')->name('admin.dashboard');

#ADMIN

// TRANSACTION ROUTES
    Route::get('/transaction/new', 'TransactionController@newtransaction')->name('transaction.new');
    Route::post('/transaction/new/store', 'TransactionController@storetransaction')->name('transaction.store');
    Route::get('/transaction/pending', 'PendingController@pendingtransaction')->name('transaction.pending');
    Route::get('/transaction/approved', 'ApprovedController@approvedtransaction')->name('transaction.approved');

//LOGS ROUTES
    Route::get('/log/document', 'LogController@documentlog')->name('log.document');
   
      

//TRANSACTION EDIT/ DELETE/ VIEW
    Route::get('/pending/edit/{id}', 'PendingController@edittransaction')->name('pending.edit');
    Route::post('/pending/edit/update', 'PendingController@updatetransaction')->name('pending.edit.update');
    Route::get('/pending/delete/{id}', 'PendingController@deletetransaction')->name('pending.delete');
    Route::get('/pending/view/{id}', 'PendingController@viewlog')->name('pending.view');
    Route::post('/pending/edit/view', 'PendingController@viewlog')->name('pending.edit.view');
    Route::post('/record-visit',[TrackingController::class, 'recordVisit']);
        
       

//EMPLOYEE ROUTES
    Route::get('/employee/new', 'EmployeeController@newemployee')->name('employee.new');
    Route::post('/employee/new/save', 'EmployeeController@saveemployee')->name('employee.save');
    Route::get('/employee/list', 'ListController@listemployee')->name('employee.list');

//EMPLOYEE EDIT DELETE
    Route::get('/list/edit/{id}', 'ListController@editlist')->name('list.edit');
    Route::post('/list/edit/update', 'ListController@updatelist')->name('list.edit.update');   
    Route::get('/list/delete/{id}', 'ListController@deletelist')->name('list.delete');

    });
//APPROVED ROUTES
    Route::get('/approved', [ApprovedController::class, 'status'])->name('approved.status');
    Route::put('/approved/{}/status', [ApprovedController::class, 'status'])->name('approved.status');

#USERS

//DASHBOARD/LOGOUT

    Route::group(['middleware' => ['user'],'prefix' => 'user'], function() {

    Route::get('/logout', 'LogoutController@logout')->name('user.logout.perform');
    Route::get('/dashboard', 'User\DashboardController@index')->name('user.dashboard');


//TRANSACTIONS

    Route::get('/transaction/pending', 'User\UserPendingController@userpendingtransaction')->name('transaction.user');

//LOGS

    Route::get('/log/document', 'User\UserLogController@userdocumentlog')->name('log.user');
           

           

    });          
});

    

        
        
