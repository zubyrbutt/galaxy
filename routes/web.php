<?php
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
Route::get('/', function () {
    return view('home');
});



Auth::routes();
// Two Factor Authentication
Route::get('/otp', 'TwoFactorController@showTwoFactorForm');
Route::post('/otp', 'TwoFactorController@verifyTwoFactor');
Route::get('/home', 'HomeController@index')->name('home');

//Dashboard
Route::get('dashboard', 'HomeController@dashboard')->middleware('auth','ipcheck')->name('dashboard');

Route::get('/changepassword', ['as' => 'changepassword' , function () {
    return view('changepassword');
 }])->middleware('auth');

Route::get('profile', 'UserController@profile')->middleware('auth','ipcheck')->name('profile');

//Roles
 Route::get('/roles/deactivate/{id}', 'RoleController@deactivate')->middleware('auth','ipcheck');
 Route::get('/roles/active/{id}', 'RoleController@active')->middleware('auth','ipcheck');
 Route::resource('roles', 'RoleController')->middleware('auth','ipcheck');

 //Mark Nofication Read
 Route::post('/readnofication', 'UserController@readnofication')->middleware('auth')->name('readnofication');
 
 //Staff/Admins
 Route::group(['prefix'=> 'admins'],function(){
    Route::get('create', 'UserController@create')->middleware('can:create-staff','ipcheck')->name('admins.create');
    Route::post('', 'UserController@store')->middleware('can:create-staff','ipcheck')->name('admins.store');   
    Route::get('', 'UserController@index')->middleware('can:admins-index','ipcheck')->name('admins.index');
    Route::get('fetch', 'UserController@fetch')->middleware('can:admins-index','ipcheck')->name('admins.fetch');
    Route::get('{id}', 'UserController@show')->middleware('can:show-staff','ipcheck')->name('admins.show');
    Route::delete('delete/{id}', 'UserController@destroy')->middleware('can:delete-staff','ipcheck')->name('admins.destroy');
    Route::get('{id}/edit', 'UserController@edit')->middleware('can:edit-staff','ipcheck')->name('admins.edit');
    Route::patch('{id}', 'UserController@update')->middleware('auth','ipcheck')->name('admins.update');
    //Staff Status
    Route::get('resetpassword/{id}', 'UserController@resetPassword')->middleware('can:staff-reset-password','ipcheck')->name('resetpassword');
    Route::get('deactivate/{id}', 'UserController@deactivate')->middleware('can:status-staff','ipcheck');
    Route::get('active/{id}', 'UserController@active')->middleware('can:status-staff','ipcheck');
    
 });

 //Staff/Attendance sheet
 Route::group(['prefix'=> 'staff'],function(){
   Route::get('attendancesheet', 'AttendancesheetController@index')->middleware('can:attendance-index','ipcheck')->name('attendancesheet');

   //Store New Attedance
     Route::post('attendancesheet', 'AttendancesheetController@store')->middleware('can:edit-staff-attendance','ipcheck')->name('attendancesheet.store');

   //Edit Staff Attendance
   Route::post('attendancesheet/edit', 'AttendancesheetController@edit')->middleware('can:edit-staff-attendance','ipcheck')->name('attendancesheet.edit');
   Route::patch('attendancesheet/update', 'AttendancesheetController@update')->middleware('can:edit-staff-attendance','ipcheck')->name('attendancesheet.update');

   //Attendance Approval
   Route::get('attendancesheet/approval', 'AttendancesheetController@approval')->middleware('can:att-approval','ipcheck')->name('attendancesheet.approval');
   Route::post('attendancesheet/approvalfetch', 'AttendancesheetController@approvalfetch')->middleware('can:att-approval','ipcheck')->name('attendancesheet.approvalfetch');
   Route::post('attendancesheet/viewapproval', 'AttendancesheetController@viewapproval')->middleware('can:att-viewapproval','ipcheck')->name('attendancesheet.viewapproval');
   Route::post('attendancesheet/approve', 'AttendancesheetController@approve')->middleware('can:att-approve','ipcheck')->name('attendancesheet.approve');
   Route::post('attendancesheet/approveall', 'AttendancesheetController@approveall')->middleware('can:att-approve','ipcheck')->name('attendancesheet.approveall');
   Route::post('attendancesheet/reject', 'AttendancesheetController@reject')->middleware('can:att-reject','ipcheck')->name('attendancesheet.reject');
   
   

   //Lock Salary Sheet
   Route::get('locksalarysheet', 'AttendancesheetController@locksalarysheet')->middleware('can:locksalarysheet','ipcheck')->name('locksalarysheet');

   
});

//Leaves 
Route::group(['prefix'=> 'leaves'],function(){
   Route::get('', 'LeaveController@index')->middleware('can:leaves-index','ipcheck')->name('leaves');
   Route::post('/fetch', 'LeaveController@fetch')->middleware('can:leaves-index','ipcheck')->name('leaves.fetch');
   Route::post('', 'LeaveController@store')->middleware('can:create-leave','ipcheck')->name('leaves.store');  
   Route::post('/edit', 'LeaveController@edit')->middleware('can:edit-leave','ipcheck')->name('leave.edit'); 
   Route::patch('/update', 'LeaveController@update')->middleware('can:edit-leave','ipcheck')->name('leave.update');
   Route::delete('/delete/{id}', 'LeaveController@destroy')->middleware('can:delete-leave','ipcheck')->name('leave.destroy');

});
//Payroll
Route::group(['prefix'=> 'payroll'],function(){
   //Staff-->Adjustment
   Route::get('/adjustments', 'AdjustmentController@index')->middleware('can:adjustments-index','ipcheck')->name('payroll.adjustments');
   Route::post('/adjustments/fetch', 'AdjustmentController@fetch')->middleware('can:adjustments-index','ipcheck')->name('adjustments.fetch');
   Route::post('/adjustments', 'AdjustmentController@store')->middleware('can:create-adjustment','ipcheck')->name('adjustments.store');  
   Route::post('/adjustment/edit', 'AdjustmentController@edit')->middleware('can:edit-adjustment','ipcheck')->name('adjustments.edit'); 
   Route::post('/adjustment/approve', 'AdjustmentController@approve')->middleware('can:approve-adjustment','ipcheck')->name('adjustments.approve');
   Route::post('/adjustment/reject', 'AdjustmentController@reject')->middleware('can:approve-adjustment','ipcheck')->name('adjustments.reject');
   Route::patch('/adjustment/update', 'AdjustmentController@update')->middleware('can:edit-adjustment','ipcheck')->name('adjustments.update');
   Route::delete('/adjustment/delete', 'AdjustmentController@destroy')->middleware('can:delete-adjustment','ipcheck')->name('adjustments.destroy');

   Route::get('/salary', 'SalarysheetController@index')->middleware('can:salarysheet-index','ipcheck')->name('payroll.salarysheet');
   Route::post('/salary/create', 'SalarysheetController@create')->middleware('can:pay-salarysheet','ipcheck')->name('payroll.createsalary');
   Route::post('/salary/pay', 'SalarysheetController@store')->middleware('can:pay-salarysheet','ipcheck')->name('payroll.paysalary');
   Route::post('/salary/status', 'SalarysheetController@status')->middleware('can:pay-salarysheet','ipcheck')->name('payroll.statussalary');
   Route::post('/userpayments', 'SalarysheetController@show')->middleware('can:pay-salarysheet','ipcheck')->name('payroll.userpayments');
});
 
 //Settings 
   Route::group(['prefix'=> 'settings'],function(){
      //Settings-->Departments
      Route::get('departments', 'DepartmentController@index')->middleware('can:departments-index','ipcheck')->name('departments');
      Route::post('/departments/fetch', 'DepartmentController@fetch')->middleware('can:departments-index','ipcheck')->name('departments.fetch');
      Route::post('departments', 'DepartmentController@store')->middleware('can:create-department','ipcheck')->name('departments.store');  
      Route::post('/department/edit', 'DepartmentController@edit')->middleware('can:edit-department','ipcheck')->name('department.edit'); 
      Route::patch('/department/update', 'DepartmentController@update')->middleware('can:edit-department','ipcheck')->name('department.update');
      Route::post('/department/deactivate', 'DepartmentController@deactivate')->middleware('can:status-department','ipcheck')->name('department.deactivate');
      Route::post('/department/active', 'DepartmentController@active')->middleware('can:status-department','ipcheck')->name('department.active');
      Route::delete('/department/delete/{id}', 'DepartmentController@destroy')->middleware('can:delete-department','ipcheck')->name('department.destroy');

      //Settings-->Designations
      Route::get('designations', 'DesignationController@index')->middleware('can:designations-index','ipcheck')->name('designations');
      Route::post('/designations/fetch', 'DesignationController@fetch')->middleware('can:designations-index','ipcheck')->name('designations.fetch');
      Route::post('designations', 'DesignationController@store')->middleware('can:create-designation','ipcheck')->name('designation.store');  
      Route::post('/designation/edit', 'DesignationController@edit')->middleware('can:edit-designation','ipcheck')->name('designation.edit'); 
      Route::patch('/designation/update', 'DesignationController@update')->middleware('can:edit-designation','ipcheck')->name('designation.update');
      Route::post('/designation/deactivate', 'DesignationController@deactivate')->middleware('can:status-designation','ipcheck')->name('designation.deactivate');
      Route::post('/designation/active', 'DesignationController@active')->middleware('can:status-designation','ipcheck')->name('designation.active');
      Route::delete('/designation/delete/{id}', 'DesignationController@destroy')->middleware('can:delete-designation','ipcheck')->name('designation.destroy');

      //Settings-->Preferences
      Route::get('preferences', 'PreferenceController@index')->middleware('can:preferences-index','ipcheck')->name('preferences');
      Route::post('/preferences/fetch', 'PreferenceController@fetch')->middleware('can:preferences-index','ipcheck')->name('preferences.fetch');
      Route::post('preferences', 'PreferenceController@store')->middleware('can:create-preference','ipcheck')->name('preference.store');  
      Route::post('/preference/edit', 'PreferenceController@edit')->middleware('can:edit-preference','ipcheck')->name('preference.edit'); 
      Route::patch('/preference/update', 'PreferenceController@update')->middleware('can:edit-preference','ipcheck')->name('preference.update');    
      Route::delete('/preference/delete/{id}', 'PreferenceController@destroy')->middleware('can:delete-preference','ipcheck')->name('preference.destroy');

      //Settings-->Holidays
      Route::get('holidays', 'HolidayController@index')->middleware('can:holidays-index','ipcheck')->name('holidays');
      Route::post('/holidays/fetch', 'HolidayController@fetch')->middleware('can:holidays-index','ipcheck')->name('holidays.fetch');
      Route::post('holidays', 'HolidayController@store')->middleware('can:create-holiday','ipcheck')->name('holiday.store');  
      Route::post('/holiday/edit', 'HolidayController@edit')->middleware('can:edit-holiday','ipcheck')->name('holiday.edit'); 
      Route::patch('/holiday/update', 'HolidayController@update')->middleware('can:edit-holiday','ipcheck')->name('holiday.update');    
      Route::delete('/holiday/delete/{id}', 'HolidayController@destroy')->middleware('can:delete-holiday','ipcheck')->name('holiday.destroy');

      Route::get('activitylogs','LogController@index')->middleware('can:activitylogs','ipcheck','auth')->name('activitylogs');
      Route::post('fetchalog','LogController@fetch')->middleware('can:activitylogs','ipcheck','auth')->name('activitylogs.fetch');      

});

//HR Leads
Route::group(['prefix'=> 'hrleads'],function(){
   Route::get('', 'HrleadController@index')->middleware('can:index-hrleads','ipcheck')->name('hrleads');
   Route::post('/fetch', 'HrleadController@fetch')->middleware('can:index-hrleads','ipcheck')->name('hrleads.fetch');
   Route::post('', 'HrleadController@store')->middleware('can:create-hrleads','ipcheck')->name('hrleads.store');  
   Route::post('/upload', 'HrleadController@upload')->middleware('can:upload-hrleads','ipcheck')->name('hrleads.upload'); 
   Route::post('/show', 'HrleadController@show')->middleware('can:edit-hrleads','ipcheck')->name('hrleads.show');
   Route::post('/edit', 'HrleadController@edit')->middleware('can:edit-hrleads','ipcheck')->name('hrleads.edit');
   Route::patch('/update', 'HrleadController@update')->middleware('can:edit-hrleads','ipcheck')->name('hrleads.update');
   Route::delete('/delete/{id}', 'HrleadController@destroy')->middleware('can:delete-hrleads','ipcheck')->name('hrleads.destroy');
   Route::post('/status', 'HrleadController@status')->middleware('can:status-hrleads','ipcheck')->name('hrleads.status');
   Route::get('interviewees', 'HrleadController@interviewees')->middleware('can:index-interviewees','ipcheck')->name('interviewees');
   Route::post('/fetchinterviewees', 'HrleadController@fetchinterviewees')->middleware('can:index-interviewees','ipcheck')->name('interviewees.fetch');
   Route::get('interviews', 'HrleadController@interviews')->middleware('can:index-interviews','ipcheck')->name('interviews');
   Route::post('/fetchinterviews', 'HrleadController@fetchinterviews')->middleware('can:index-interviews','ipcheck')->name('interviews.fetch');
   
   
});

//YCC Ref
Route::group(['prefix'=> 'yccref'],function(){
   Route::post('/yccrefeads/fetch', 'YccrefController@fetch')->middleware('can:index-yccref','ipcheck')->name('yccrefs.fetch');
   Route::post('/yccrefstatus', 'YccrefController@postleadstatus')->middleware('can:status-yccref','ipcheck')->name('yccrefs.status');

   Route::get('', 'YccrefController@index')->middleware('can:yccref-index','ipcheck')->name('yccrefs');
   Route::post('/fetch', 'YccrefController@fetch')->middleware('can:yccref-index','ipcheck')->name('yccrefs.fetch');
   Route::post('', 'YccrefController@store')->middleware('can:create-yccref','ipcheck')->name('yccrefs.store');  
   Route::get('/{id}', 'YccrefController@show')->middleware('can:edit-yccref','ipcheck')->name('yccref.show');
   Route::post('/edit', 'YccrefController@edit')->middleware('can:edit-yccref','ipcheck')->name('yccref.edit');
   Route::patch('/update', 'YccrefController@update')->middleware('can:edit-yccref','ipcheck')->name('yccref.update');
   Route::delete('/delete/{id}', 'YccrefController@destroy')->middleware('can:delete-yccref','ipcheck')->name('yccrefs.destroy');
});

 //Customers
 Route::group(['prefix'=> 'customers'],function(){
    Route::get('create', 'CustomerController@create')->middleware('can:create-customer','ipcheck')->name('customers.create');
    Route::post('', 'CustomerController@store')->middleware('can:create-customer','ipcheck')->name('customers.store');   
    Route::get('', 'CustomerController@index')->middleware('can:customers-index','ipcheck')->name('customers.index');
    Route::get('{id}', 'CustomerController@show')->middleware('can:show-customer','ipcheck')->name('customers.show');
    Route::delete('delete/{id}', 'CustomerController@destroy')->middleware('can:delete-customer','ipcheck')->name('customers.destroy');
    Route::get('{id}/edit', 'CustomerController@edit')->middleware('can:edit-customer','ipcheck')->name('customers.edit');
    Route::patch('{id}', 'CustomerController@update')->middleware('auth','ipcheck')->name('customers.update');

    //Staff Status
    Route::get('resetpassword/{id}', 'UserController@resetPassword')->middleware('can:reset-customer-password','ipcheck')->name('customer.resetpassword');
    Route::get('deactivate/{id}', 'UserController@deactivate')->middleware('can:status-customer','ipcheck');
    Route::get('active/{id}', 'UserController@active')->middleware('can:status-customer','ipcheck');
    
 });
 
 //Route::resource('customers', 'CustomerController')->middleware('auth');
 
 //Sub admins/staff
 //Route::get('/indexdatatable', 'UserController@indexdatatable')->middleware('auth')->name('indexdatatable');

 

 //Admin Menu
 Route::get('/menu/deactivate/{id}', 'AdminmenuController@deactivate')->middleware('can:menu-index','ipcheck');
 Route::get('/menu/active/{id}', 'AdminmenuController@active')->middleware('can:menu-index','ipcheck');
 Route::resource('menu', 'AdminmenuController')->middleware('can:menu-index','ipcheck');

 

 //Leads
 /* Server side Datatable testing begins */
 Route::get('/leads/leadsmain', 'LeadController@indexmain')->middleware('auth','ipcheck')->name('leads.indexmain');
 Route::get('/leads/anydata', 'LeadController@anyData')->middleware('auth','ipcheck')->name('leads.data');
/* Server side Datatable testing begins */

 Route::group(['prefix'=> 'leads'],function(){
    Route::get('create', 'LeadController@create')->middleware('can:create-lead','ipcheck')->name('leads.create');
    Route::post('', 'LeadController@store')->middleware('can:create-lead','ipcheck')->name('leads.store');   
    Route::post('search', 'LeadController@search')->middleware('can:search-leads','ipcheck')->name('leads.search');
    Route::get('', 'LeadController@index')->middleware('can:leads-index','ipcheck')->name('leads.index');
    Route::get('/{id}', 'LeadController@show')->middleware('can:show-lead','ipcheck')->name('leads.show');
    Route::get('deactivate/{id}', 'LeadController@deactivate')->middleware('can:status-lead','ipcheck');
    Route::get('active/{id}', 'LeadController@active')->middleware('can:status-lead','ipcheck');
    Route::delete('delete/{id}', 'LeadController@destroy')->middleware('can:delete-lead','ipcheck');
    Route::get('/{id}/edit', 'LeadController@edit')->middleware('can:edit-lead')->name('leads.edit','ipcheck');
    Route::patch('/{id}/edit', 'LeadController@update')->middleware('auth')->name('leads.update','ipcheck');
    Route::get('approve/{id}', 'LeadController@approve')->middleware('can:approve-reject-lead','ipcheck');
    Route::get('reject/{id}', 'LeadController@reject')->middleware('can:approve-reject-lead','ipcheck');
    Route::get('fortraining/{id}', 'LeadController@fortraining')->middleware('can:for-training-lead','ipcheck');
    Route::get('removefromtraining/{id}', 'LeadController@removefromtraining')->middleware('can:for-training-lead','ipcheck');
    
    
    //Recordings
    Route::get('createrecording/{id}', 'LeadController@createrecording')->middleware('can:create-recording','ipcheck')->name('createrecording');
    Route::post('storerecording/', 'LeadController@storerecording')->middleware('can:create-recording','ipcheck')->name('storerecording');
    //Appointmetns
    Route::get('createappointments/{id}', 'LeadController@createappointments')->middleware('can:create-appointment','ipcheck')->name('createappointments');
    Route::post('storeappointments/', 'LeadController@storeappointments')->middleware('can:create-appointment','ipcheck')->name('storeappointments');
    //Lead Docs
    Route::get('createdocs/{id}', 'LeadController@createdocs')->middleware('can:create-doc','ipcheck')->name('createdocs');
    Route::post('storedocs/', 'LeadController@storedocs')->middleware('can:create-doc','ipcheck')->name('storedocs');
    //Proposal
    Route::post('storeproposal/', 'LeadController@storeproposal')->middleware('can:create-proposal','ipcheck')->name('storeproposal');
    Route::get('createproposal/{id}', 'LeadController@createproposal')->middleware('can:create-proposal','ipcheck')->name('createproposal');
    //For Proposal file upload
    Route::get('uploadproposal/{id}/{pro_id}', 'LeadController@uploadproposal')->middleware('can:upload-proposal','ipcheck')->name('uploadproposal');
    Route::post('upproposal/{id}', 'LeadController@upproposal')->middleware('auth','ipcheck')->name('upproposal');
    Route::post('updateproposal/{pro_id}', 'LeadController@updateproposal')->middleware('auth','ipcheck')->name('updateproposal');
    Route::get('edit_proposal/{id}/{lead_id}', 'LeadController@edit_proposal')->middleware('can:edit-proposal','ipcheck')->name('edit_proposal');
    
 });

 
 //Recordings
 Route::get('/recordings/{id}', 'RecordingController@index')->middleware('auth','ipcheck')->name('recordings');
 Route::get('/recordings', 'RecordingController@index')->middleware('auth','ipcheck')->name('recordings');
 Route::resource('recordings', 'RecordingController')->middleware('auth','ipcheck');

 //Appintments
 Route::get('/appointments/{id}', 'AppointmentController@index')->middleware('auth','ipcheck')->name('appointments');
 Route::get('/appointments', 'AppointmentController@index')->middleware('auth','ipcheck')->name('appointments');
 Route::resource('appointments', 'AppointmentController')->middleware('auth','ipcheck');

 //Conversation
 Route::post('/leads/store_conversation', 'LeadController@store_conversation')->middleware('auth','ipcheck')->name('store_conversation');
 Route::get('/leads/create_appnote/{id}/{app_id}', 'LeadController@create_appnote')->middleware('auth','ipcheck')->name('create_appnote');
 Route::post('/leads/store_appnote/', 'LeadController@store_appnote')->middleware('auth','ipcheck')->name('store_appnote');
 
//Project Routes Begins
 //Project
 Route::post('/projectasset', 'ProjectController@projectasset')->middleware('auth','ipcheck')->name('projectasset');
 Route::post('/projectmessage', 'ProjectController@projectmessage')->middleware('auth','ipcheck')->name('projectmessage');
 Route::get('/projects/create/{customerid}/{leadid}', 'ProjectController@create')->middleware('auth','ipcheck')->name('projects');
 Route::get('/projects/create/{customerid}', 'ProjectController@create')->middleware('auth','ipcheck')->name('projects');
 Route::resource('projects', 'ProjectController')->middleware('auth','ipcheck');
 
 
  //Project Tasks
  Route::get('/tasks/start/{id}','ProjectTaskController@start')->middleware('auth','ipcheck');
  Route::get('/tasks/end/{id}','ProjectTaskController@end')->middleware('auth','ipcheck');
  Route::get('/tasks/reopen/{id}','ProjectTaskController@reopen')->middleware('auth','ipcheck');
  Route::get('/tasks/{project_id}', 'ProjectTaskController@index')->middleware('auth','ipcheck')->name('tasks');
  Route::get('/tasks', 'ProjectTaskController@index')->middleware('auth','ipcheck')->name('tasks');
  Route::get('/tasks/create/{project_id}', 'ProjectTaskController@create')->middleware('auth','ipcheck')->name('createTasks');
  Route::get('/tasks/detail/{id}', 'ProjectTaskController@show')->middleware('auth','ipcheck')->name('showtask');
  Route::post('/tasks/store', 'ProjectTaskController@store')->middleware('auth','ipcheck');
  Route::get('/tasks/edit/{id}','ProjectTaskController@edit')->middleware('auth','ipcheck')->name('editProjectTasks');
  Route::post('/tasks/update/{id}','ProjectTaskController@update')->middleware('auth','ipcheck');
  
 //Project Links
 Route::post('/projectlink', 'ProjectlinkController@store')->middleware('auth','ipcheck');
 Route::delete('/projectlink/{id}', 'ProjectlinkController@destroy')->middleware('auth','ipcheck');
 
 //Conversation Like Chat
 //Route::get('/', 'ConversationController@index');
 Route::get('messages/{lead_id}', 'ConversationController@fetchMessages');
 Route::post('messages', 'ConversationController@sendMessage');

 
 //Address Books
 //Email
 Route::post('/addressbook', 'AddressbookController@store')->middleware('auth','ipcheck');
 Route::delete('/addressbook/{id}', 'AddressbookController@destroy')->middleware('auth','ipcheck');
 //Phone
 Route::post('/addressbookphone', 'AddressbookController@storephone')->middleware('auth','ipcheck');
 
 //Chapters
 Route::resource('chapters','ChapterController')->middleware('auth','ipcheck');
 
 //Topics
 Route::resource('topics','TopicController')->middleware('auth','ipcheck');


 //YCC leads
 Route::get('/getleads', 'YccleadController@getleads')->middleware('auth','ipcheck');
 Route::get('/yccleads/anydata', 'YccleadController@anyData')->middleware('auth','ipcheck')->name('yccleads.data');
 Route::post('/yccleads/fetch', 'YccleadController@fetch')->middleware('auth','ipcheck')->name('yccleads.fetch');
 Route::post('/yccleadstatus', 'YccleadController@postleadstatus')->middleware('auth','ipcheck');
 Route::resource('yccleads', 'YccleadController')->middleware('auth','ipcheck');
 Route::get('nextPrevious/{id}/{value}', 'YccleadController@nextPrevious')->middleware('auth','ipcheck');
 
 ////// noman routes for yccleads //////////
 Route::post('getEmail','YccleadController@getEmail')->name('getEmail')->middleware('auth','ipcheck');
 Route::post('email.save','YccleadController@postEmail')->name('email.save')->middleware('auth','ipcheck');
 Route::post('getYccLeadData','YccleadController@getYccLeadData')->name('getYccLeadData')->middleware('auth','ipcheck');
 Route::post('getYccLeadFilterData','YccleadController@getYccLeadFilterData')->name('getYccLeadFilterData')->middleware('auth','ipcheck');

 //Get MY Task
 Route::get('/mytask', 'MyTaskController@index')->middleware('can:mytask-index','ipcheck')->name('mytask.index');
 Route::post('/mytask/fetch', 'MyTaskController@fetch')->middleware('can:mytask-fetch','ipcheck')->name('mytask.fetch');

 //Get Today Massages and Task
 Route::get('/todayMassage', 'TodayMassageTaskController@index')->middleware('can:todayMassage-index','ipcheck')->name('todayMassage.index');
 Route::post('/todayMassage/fetch', 'TodayMassageTaskController@fetch')->middleware('can:todayMassage-fetch','ipcheck')->name('todayMassage.fetch');



/////////////// Financial Routes ///////////////////
//budgetCategory
 Route::get('/budgetCategory', 'BudgetCategoryController@index')->middleware('can:budgetCategory-index','ipcheck')->name('budgetCategory.index');
 Route::post('/budgetCategory/fetch', 'BudgetCategoryController@fetch')->middleware('can:budgetCategory-fetch','ipcheck')->name('budgetCategory.fetch');
 Route::post('/budgetCategory/store', 'BudgetCategoryController@store')->middleware('can:budgetCategory-store','ipcheck')->name('budgetCategory.store');
 Route::post('/budgetCategory/edit', 'BudgetCategoryController@edit')->middleware('can:budgetCategory-edit','ipcheck')->name('budgetCategory.edit');


//Banks
Route::get('/bank', 'BankController@index')->middleware('can:bank','ipcheck')->name('bank.index'); 
Route::get('/bank', 'BankController@index')->middleware('can:bank-index','ipcheck')->name('bank.index');
Route::get('/bank/fetch', 'BankController@fetch')->middleware('can:bank-fetch','ipcheck')->name('bank.fetch');
Route::post('/bank/store', 'BankController@store')->middleware('can:bank-store','ipcheck')->name('bank.store');
Route::post('/bank/edit', 'BankController@edit')->middleware('can:bank-edit','ipcheck')->name('bank.edit');

//payableCommitted
Route::get('/payableCommitted', 'PayableCommittedController@index')->middleware('can:payableCommitted-index','ipcheck')->name('payableCommitted.index');
Route::get('/payableCommitted/fetch', 'PayableCommittedController@fetch')->middleware('can:payableCommitted-fetch','ipcheck')->name('payableCommitted.fetch');
Route::post('/payableCommitted/store', 'PayableCommittedController@store')->middleware('can:payableCommitted-store','ipcheck')->name('payableCommitted.store');
Route::post('/payableCommitted/edit', 'PayableCommittedController@edit')->middleware('can:payableCommitted-edit','ipcheck')->name('payableCommitted.edit');
Route::post('getFilterData','PayableCommittedController@getFilterData')->name('getFilterData')->middleware('auth','ipcheck');
Route::post('/payableCommitted/status', 'PayableCommittedController@status')->middleware('can:payableCommitted-status','ipcheck')->name('payableCommitted.status');
Route::post('payableCommitted.status.store', 'PayableCommittedController@statusUpdate')->middleware('auth','ipcheck')->name('payableCommitted.status.store');

//budgetsheet
Route::get('/budgetSheet', 'BudgetSheetController@index')->middleware('can:budgetSheet-index','ipcheck')->name('budgetSheet.index');
Route::post('/budgetSheet/fetch', 'BudgetSheetController@fetch')->middleware('can:budgetSheet-fetch','ipcheck')->name('budgetSheet.fetch');
Route::post('/budgetSheet/store', 'BudgetSheetController@store')->middleware('can:budgetSheet-store','ipcheck')->name('budgetSheet.store');
Route::post('/budgetSheet/edit', 'BudgetSheetController@edit')->middleware('can:budgetSheet-edit','ipcheck')->name('budgetSheet.edit');
Route::post('/ConsumeBudgetAmount/store', 'BudgetSheetController@ConsumeBudgetAmount')->middleware('can:ConsumeBudgetAmount-store','ipcheck')->name('ConsumeBudgetAmount.store');
Route::post('/budgetSheet/show', 'BudgetSheetController@show')->middleware('can:budgetSheet-show','ipcheck')->name('budgetSheet.show');

//Complaint
Route::get('/complaint', 'ComplaintController@index')->middleware('can:complaint-index','ipcheck')->name('complaint.index');
Route::get('/complaint/fetch', 'ComplaintController@fetch')->middleware('can:complaint-fetch','ipcheck')->name('complaint.fetch');
Route::post('/complaint/store', 'ComplaintController@store')->middleware('can:complaint-store','ipcheck')->name('complaint.store');
Route::post('/complaint/edit', 'ComplaintController@edit')->middleware('can:complaint-edit','ipcheck')->name('complaint.edit');
Route::get('/complaint/show/{show}', 'ComplaintController@show')->middleware('can:complaint-show','ipcheck')->name('complaint.show');
Route::post('/complaint/comment', 'ComplaintController@comment')->middleware('can:complaint-comment','ipcheck')->name('complaint.comment');
Route::post('/complaint/commentStore', 'ComplaintController@commentStore')->middleware('auth','ipcheck')->name('complaint.commentStore');
Route::post('complaintComment/fetch', 'ComplaintController@commentFetch')->middleware('auth','ipcheck')->name('complaintComment.fetch');
Route::post('/complaint/disable', 'ComplaintController@disable')->middleware('can:complaint-disable','ipcheck')->name('complaint.disable');
// my department complaint
Route::get('/departcomplaint', 'ComplaintController@department_index')->middleware('can:departcomplaint-index','ipcheck')->name('departcomplaint.index');
Route::get('/departcomplaint/fetch', 'ComplaintController@department_fetch')->middleware('can:departcomplaint-fetch','ipcheck')->name('departcomplaint.fetch');
Route::get('/departcomplaint/show/{show}', 'ComplaintController@department_show')->middleware('can:departcomplaint-show','ipcheck')->name('departcomplaint.show');
// all complaint
Route::get('/allcomplaint', 'ComplaintController@all_index')->middleware('can:allcomplaint-index','ipcheck')->name('allcomplaint.index');
Route::get('/allcomplaint/fetch', 'ComplaintController@all_fetch')->middleware('can:allcomplaint-fetch','ipcheck')->name('allcomplaint.fetch');
Route::get('/allcomplaint/show/{show}', 'ComplaintController@all_show')->middleware('can:allcomplaint-show','ipcheck')->name('allcomplaint.show');


/////////////// Customers side Routes ///////////////////

// Route::get('customer/dashboard', 'Customer\HomeController@dashboard')->middleware('auth')->name('customer/dashboard');

 //Project
 /*Route::post('/customer/projectasset', 'Customer/ProjectController@projectasset')->middleware('auth')->name('customer/projectasset');
 Route::post('customer/projectmessage', 'Customer/ProjectController@projectmessage')->middleware('auth')->name('customer/projectmessage');
 Route::get('/customer/projects/create/{customerid}/{leadid}', 'Customer/ProjectController@create')->middleware('auth')->name('customer/projects');
 Route::get('/customer/projects/create/{customerid}', 'Customer/ProjectController@create')->middleware('auth')->name('projects');*/



 // Customer projects
/*Route::group(['prefix'=> 'customer/projects'],function(){
       
    Route::get('', 'Customer\ProjectController@index')->middleware('can:customer-projects-index')->name('customer.projects.index');
    Route::post('fetch', 'Customer\ProjectController@fetch')->middleware('can:customer-fetch-projects')->name('customer.projects.fetch');   
    Route::get('{id}', 'Customer\ProjectController@show')->middleware('can:customer-show-projects')->name('customer.projects.show');
        
 });
 Route::post('/customer/projectmessage', 'Customer\ProjectController@projectmessage')->middleware('auth')->name('customer/projectmessage');*/
 //Route::resource('customer/projects', 'Customer/ProjectController')->middleware('auth');
 
 Route::get('calculateatt','UserController@calculateatt');
 Route::get('getleaves','AttendancesheetController@getleaves');
 Route::get('attleaves','AttendancesheetController@attleaves');

 Route::get('showleaves','AttendancesheetController@showleaves');
 
 Route::get('calculateattfix','UserController@calculateattfix')->middleware('auth');

 //Leaves from CCMS - API
 Route::post('storeleaveapi','LeaveController@storeleaveapi');


 // inventoryCategory
Route::get('/inventoryCategory', 'InventoryCategoryController@index')->middleware('can:inventoryCategory-index')->name('inventoryCategory.index');
Route::get('/inventoryCategory/fetch', 'InventoryCategoryController@fetch')->middleware('can:inventoryCategory-fetch')->name('inventoryCategory.fetch');
Route::post('/inventoryCategory/store', 'InventoryCategoryController@store')->middleware('can:inventoryCategory-store')->name('inventoryCategory.store');
Route::post('/inventoryCategory/edit', 'InventoryCategoryController@edit')->middleware('can:inventoryCategory-edit')->name('inventoryCategory.edit');
Route::post('inventoryCategory/active', 'InventoryCategoryController@categoryActive')->middleware('auth')->name('inventoryCategory.active');
Route::post('inventoryCategory/disable', 'InventoryCategoryController@categoryDisable')->middleware('auth')->name('inventoryCategory.disable');

// Inventory
Route::get('/inventory', 'InventoryController@index')->middleware('can:inventory-index')->name('inventory.index');
Route::get('/inventory/fetch', 'InventoryController@fetch')->middleware('can:inventory-fetch')->name('inventory.fetch');
Route::post('/inventory/store', 'InventoryController@store')->middleware('can:inventory-store')->name('inventory.store');
Route::post('/inventory/edit', 'InventoryController@edit')->middleware('can:inventory-edit')->name('inventory.edit');
Route::get('/inventory/show/{show}', 'InventoryController@show')->middleware('can:inventory-show')->name('inventory.show');
Route::post('inventorySpecification/fetch', 'InventoryController@specificationFetch')->middleware('auth')->name('inventorySpecification.fetch');
Route::post('/inventory/spStore', 'InventoryController@spStore')->middleware('auth')->name('inventory.spStore');
Route::post('/inventory/spEdit', 'InventoryController@spEdit')->middleware('auth')->name('inventory.spEdit');
Route::post('InventorySNOFetch/fetch', 'InventoryController@InventorySNOFetch')->middleware('auth')->name('InventorySNOFetch.fetch');
Route::post('InventoryQtyFetch/fetch', 'InventoryController@InventoryQtyFetch')->middleware('auth')->name('InventoryQtyFetch.fetch');
Route::post('inventory/issuseStore', 'InventoryController@issuseStore')->middleware('can:inventory-issuseStore')->name('inventory.issuseStore');
Route::post('inventory/plusStore', 'InventoryController@plusStore')->middleware('can:inventory-plusStore')->name('inventory.plusStore');
Route::post('inventory/active', 'InventoryController@inventoryActive')->middleware('auth')->name('inventory.active');
Route::post('inventory/disable', 'InventoryController@inventoryDisable')->middleware('auth')->name('inventory.disable');
Route::post('inventorySNO/active', 'InventoryController@inventorySNOActive')->middleware('auth')->name('inventorySNO.active');
Route::post('inventorySNO/disable', 'InventoryController@inventorySNODisable')->middleware('auth')->name('inventorySNO.disable');
Route::get('/inventory/Report', 'InventoryReportController@inventoryReport')->middleware('can:inventoryReport-index')->name('inventoryReport.index');
Route::get('InventoryReport/fetch', 'InventoryReportController@InventoryReportfetch')->middleware('auth')->name('InventoryReport.fetch');
Route::get('/inventoryIn/Report', 'InventoryReportController@inventoryReportIn')->middleware('can:inventoryReportIn-index')->name('inventoryReportIn.index');
Route::get('InventoryReportIn/fetch', 'InventoryReportController@InventoryReportInfetch')->middleware('auth')->name('InventoryReportIn.fetch');


 // ITStation
Route::get('/itstation', 'ITStationController@index')->middleware('can:itstation-index')->name('itstation.index');
Route::get('/itstation/fetch', 'ITStationController@fetch')->middleware('can:itstation-fetch')->name('itstation.fetch');
Route::post('/itstation/store', 'ITStationController@store')->middleware('can:itstation-store')->name('itstation.store');
Route::post('/itstation/edit', 'ITStationController@edit')->middleware('can:itstation-edit')->name('itstation.edit');
Route::get('/itstation/show/{show}', 'ITStationController@show')->middleware('can:itstation-show')->name('itstation.show');
 Route::post('ITStationInventory/fetch', 'ITStationController@ITStationInventory')->middleware('auth')->name('ITStationInventory.fetch');
 Route::post('/itstation/InventoryStore', 'ITStationController@InventoryStore')->middleware('auth')->name('itstation.InventoryStore');
 Route::post('/itstation/spEdit', 'ITStationController@spEdit')->middleware('auth')->name('itstation.spEdit');
Route::post('itemSNOFetchByInventory', 'ITStationController@itemSNOFetchByInventory')->middleware('auth')->name('itemSNOFetchByInventory');
Route::post('roomFetchByFloor', 'ITStationController@roomFetchByFloor')->middleware('auth')->name('roomFetchByFloor');
Route::post('itstation/inventory/active', 'ITStationController@InventoryActive')->middleware('auth')->name('itstation.inventory.active');
Route::post('itstation/inventory/disable', 'ITStationController@InventoryDisable')->middleware('auth')->name('itstation.inventory.disable');
Route::post('itstation/active', 'ITStationController@itstationActive')->middleware('auth')->name('itstation.active');
Route::post('itstation/disable', 'ITStationController@itstationDisable')->middleware('auth')->name('itstation.disable');
 

 // chart of account
 Route::get('/chartOfAccount', 'FinanceCategoryController@index')->middleware('can:chartOfAccount-index')->name('chartOfAccount.index');
 Route::post('/chartOfAccount/fetch', 'FinanceCategoryController@fetch')->middleware('can:chartOfAccount-fetch')->name('chartOfAccount.fetch');
 Route::post('/chartOfAccount/store', 'FinanceCategoryController@store')->middleware('can:chartOfAccount-store')->name('chartOfAccount.store');
 Route::post('/chartOfAccount/edit', 'FinanceCategoryController@edit')->middleware('can:chartOfAccount-edit')->name('chartOfAccount.edit');
 Route::post('/chartOfAccount/delete', 'FinanceCategoryController@delete')->middleware('can:chartOfAccount-delete')->name('chartOfAccount.delete');

// journalVoucher
Route::get('/journalVoucher', 'JournalVoucherController@index')->middleware('can:journalVoucher-index')->name('journalVoucher.index');
Route::get('/journalVoucher/fetch', 'JournalVoucherController@fetch')->middleware('can:journalVoucher-fetch')->name('journalVoucher.fetch');
Route::post('/journalVoucher/store', 'JournalVoucherController@store')->middleware('can:journalVoucher-store')->name('journalVoucher.store');
Route::post('/journalVoucher/edit', 'JournalVoucherController@edit')->middleware('can:journalVoucher-edit')->name('journalVoucher.edit');
Route::post('/journalVoucher/update', 'JournalVoucherController@update')->middleware('can:journalVoucher-update')->name('journalVoucher.update');
Route::get('/journalVoucher/show/{show}', 'JournalVoucherController@show')->middleware('can:journalVoucher-show')->name('journalVoucher.show'); 
Route::post('journalVoucher/active', 'JournalVoucherController@itstationActive')->middleware('auth')->name('journalVoucher.active');
Route::post('journalVoucher/disable', 'JournalVoucherController@delete')->middleware('can:journalVoucher-disable')->name('journalVoucher.disable');
Route::post('journalVoucherDetail/fetch', 'JournalVoucherController@journalVoucherDetailFetch')->middleware('auth')->name('journalVoucherDetail.fetch');
Route::post('/journalVoucherDetail/edit', 'JournalVoucherController@jvEdit')->middleware('can:journalVoucherDetail-edit')->name('journalVoucherDetail.edit');
Route::post('/journalVoucherDetail/update', 'JournalVoucherController@jvUpdate')->middleware('can:journalVoucherDetail-update')->name('journalVoucherDetail.update');


//ledger
Route::get('/ledger', 'LedgerController@index')->middleware('can:ledger-index')->name('ledger.index');
Route::post('/ledger/fetch', 'LedgerController@fetch')->middleware('auth')->name('ledger.fetch');

//cash book
Route::get('/cashbook', 'CashBookController@index')->middleware('can:cashbook-index')->name('cashbook.index');
Route::post('/cashbook/fetch', 'CashBookController@fetch')->middleware('auth')->name('cashbook.fetch');




 // Chat Module Routes 
 Route::get('chat','ChatController@index')->middleware('can:chat-view')->name('chat');
 Route::get('contacts_list','ChatController@contactList')->middleware('can:chat-view')->name('contacts_list');
 Route::get('getConversations/{contact_id}','ChatController@getConversations')->middleware('can:chat-view')->name('getConversations');
 Route::get('getGroupMembers/{contact_id}','ChatController@getGroupMembers')->middleware('can:chat-view')->name('getGroupMembers');
 Route::get('getUserChatRoomsIDs','ChatController@getUserChatRoomsIDs')->middleware('can:chat-view')->name('getUserChatRoomsIDs');
 Route::post('sendMessage','ChatController@sendMessage')->middleware('can:chat-view')->name('sendMessage'); 
 Route::post('createChatRoom','ChatController@createChatRoom')->middleware('can:chat-add-new-chat-single')->name('createChatRoom');
 Route::post('addNewMembersToGroup','ChatController@addNewMembersToGroup')->middleware('can:chat-view')->name('addNewMembersToGroup');
 Route::get('getUsersChatRooms','ChatController@getUsersChatRooms')->middleware('can:chat-view')->name('getUsersChatRooms');
 Route::get('get_room_conversations/{room_id}','ChatController@getRoomConversations')->middleware('can:chat-view')->name('get_room_conversations');
 Route::post('create-chat-groups','ChatController@createGroups')->middleware('can:create-chat-groups')->name('create-chat-groups');
 Route::post('send-files-chat','ChatController@sendFiles')->middleware('can:chat-view')->name('send-files-chat');
 Route::post('messagemarkasRead','ChatController@markasread')->name('messagemarkasRead');

 Route::post('callusers','ChatController@callusers')->name('callusers');
 Route::post('answercall','ChatController@answercall')->name('answercall');
 Route::post('removememberfromgroup', 'ChatController@removememberfromgroup')->name('removememberfromgroup');



// Paypal Withdrwal

Route::get('/paypalwithdrwal', 'PaypalwithdrwalController@index')->middleware('can:paypalwithdrwal-index','ipcheck')->name('paypalwithdrwal.index');
Route::post('/paypalwithdrwal/fetch', 'PaypalwithdrwalController@fetch')->middleware('can:paypalwithdrwal-fetch','ipcheck')->name('paypalwithdrwal.fetch');
Route::post('/paypalwithdrwal/store', 'PaypalwithdrwalController@store')->middleware('can:paypalwithdrwal-store','ipcheck')->name('paypalwithdrwal.store');
Route::post('/paypalwithdrwal/edit', 'PaypalwithdrwalController@edit')->middleware('can:paypalwithdrwal-edit','ipcheck')->name('paypalwithdrwal.edit');
Route::post('paypalwithdrwal/active', 'PaypalwithdrwalController@paypalActive')->middleware('can:paypalwithdrwal-active','auth','ipcheck')->name('paypalwithdrwal.active');
Route::post('paypalwithdrwal/disable', 'PaypalwithdrwalController@paypalDisable')->middleware('can:paypalwithdrwal-disable','auth','ipcheck')->name('paypalwithdrwal.disable');
Route::post('paypalwithdrwal/delete', 'PaypalwithdrwalController@delete')->middleware('can:paypalwithdrwal-delete','auth','ipcheck')->name('paypalwithdrwal.delete');


// Staff Required For HR and Department Manager

Route::get('/staffrequired', 'StaffRequiredController@index')->middleware('can:staffrequired-index','ipcheck')->name('staffrequired.index');
Route::post('/staffrequired/fetch', 'StaffRequiredController@fetch')->middleware('can:staffrequired-fetch','ipcheck')->name('staffrequired.fetch');
Route::post('/staffrequired/store', 'StaffRequiredController@store')->middleware('can:staffrequired-store','ipcheck')->name('staffrequired.store');
Route::post('/staffrequired/edit', 'StaffRequiredController@edit')->middleware('can:staffrequired-edit','ipcheck')->name('staffrequired.edit');
Route::post('staffrequired/active', 'StaffRequiredController@paypalActive')->middleware('auth','ipcheck')->name('staffrequired.active');
Route::post('staffrequired/disable', 'StaffRequiredController@paypalDisable')->middleware('auth','ipcheck')->name('staffrequired.disable');
Route::post('staffrequired/delete', 'StaffRequiredController@delete')->middleware('auth','ipcheck')->name('staffrequired.delete');
Route::post('staffrequired/viewdetail', 'StaffRequiredController@viewdetail')->middleware('auth','ipcheck')->name('staffrequired.viewdetail');
Route::post('staffrequired/changestatus', 'StaffRequiredController@changestatus')->middleware('auth','ipcheck')->name('staffrequired.changestatus');


// Staff Hiring Checklist For HR 

Route::get('/userdocument', 'UserDocumentController@index')->middleware('can:userdocumemt-index','ipcheck')->name('userdocumemt.index');
Route::post('/userdocumemt/fetch', 'UserDocumentController@fetch')->middleware('can:userdocumemt-fetch','ipcheck')->name('userdocumemt.fetch');
Route::post('/userdocumemt/store', 'UserDocumentController@store')->middleware('can:userdocumemt-store','ipcheck')->name('userdocumemt.store');
Route::post('/userdocumemt/edit', 'UserDocumentController@edit')->middleware('can:userdocumemt-edit','ipcheck')->name('userdocumemt.edit');
Route::post('userdocumemt/active', 'UserDocumentController@paypalActive')->middleware('auth','ipcheck')->name('userdocumemt.active');
Route::post('userdocumemt/disable', 'UserDocumentController@paypalDisable')->middleware('auth','ipcheck')->name('userdocumemt.disable');
Route::post('userdocumemt/delete', 'UserDocumentController@delete')->middleware('auth','ipcheck')->name('userdocumemt.delete');
Route::post('userdocumemt/adduserchecklists', 'UserDocumentController@adduserchecklists')->middleware('auth','ipcheck')->name('adduserchecklists');

// Staff End service Checklist For HR 

Route::get('/endservice', 'EndServiceController@index')->middleware('can:endservice-index','ipcheck')->name('endservice.index');
Route::post('/endservice/fetch', 'EndServiceController@fetch')->middleware('can:endservice-fetch','ipcheck')->name('endservice.fetch');
Route::post('/endservice/store', 'EndServiceController@store')->middleware('can:endservice-store','ipcheck')->name('endservice.store');
Route::post('/endservice/edit', 'EndServiceController@edit')->middleware('can:endservice-edit','ipcheck')->name('endservice.edit');
Route::post('endservice/active', 'EndServiceController@paypalActive')->middleware('auth','ipcheck')->name('endservice.active');
Route::post('endservice/disable', 'EndServiceController@paypalDisable')->middleware('auth','ipcheck')->name('endservice.disable');
Route::post('endservice/delete', 'EndServiceController@delete')->middleware('auth','ipcheck')->name('endservice.delete');
Route::post('endservice/endservice', 'EndServiceController@endservice')->middleware('auth','ipcheck')->name('endservice');
Route::post('endservice/endservicelists', 'EndServiceController@endservicelists')->middleware('auth','ipcheck')->name('endservicelists');

//QA routes

Route::get('/qualityassurance', 'QualityAssuranceController@index')->middleware('can:qualityassurance-index', 'ipcheck')->name('qualityassurance.index');
Route::post('/qualityassurance/fetch', 'QualityAssuranceController@fetch')->middleware('can:qualityassurance-fetch', 'ipcheck')->name('qualityassurance.fetch');
Route::post('/qualityassurance/store', 'QualityAssuranceController@store')->middleware('can:qualityassurance-store', 'ipcheck')->name('qualityassurance.store');
Route::post('/qualityassurance/edit', 'QualityAssuranceController@edit')->middleware('can:qualityassurance-edit', 'ipcheck')->name('qualityassurance.edit');
Route::post('qualityassurance/active', 'QualityAssuranceController@Active')->middleware('auth', 'ipcheck')->name('qualityassurance.active');
Route::post('qualityassurance/disable', 'QualityAssuranceController@Disable')->middleware('auth', 'ipcheck')->name('qualityassurance.disable');
Route::post('qualityassurance/delete', 'QualityAssuranceController@delete')->middleware('auth', 'ipcheck')->name('qualityassurance.delete');
Route::get('qualityassurance/detail/{id}', 'QualityAssuranceController@detail')->middleware('auth', 'ipcheck')->name('qualityassurance.detail');

// Ycc Support Routes
Route::get('/yccsupport', 'YccSupportController@index')->middleware('can:yccsupport-index', 'ipcheck')->name('yccsupport.index');
Route::post('/yccsupport/fetch', 'YccSupportController@fetch')->middleware('can:yccsupport-fetch', 'ipcheck')->name('yccsupport.fetch');
Route::post('/yccsupport/store', 'YccSupportController@store')->middleware('can:yccsupport-store', 'ipcheck')->name('yccsupport.store');
Route::post('/yccsupport/edit', 'YccSupportController@edit')->middleware('can:yccsupport-edit', 'ipcheck')->name('yccsupport.edit');
Route::post('yccsupport/active', 'YccSupportController@changestatus')->middleware('auth', 'ipcheck')->name('yccsupport.active');
Route::post('yccsupport/disable', 'YccSupportController@Disable')->middleware('auth', 'ipcheck')->name('yccsupport.disable');
Route::post('yccsupport/delete', 'YccSupportController@delete')->middleware('auth', 'ipcheck')->name('yccsupport.delete');
Route::post('yccsupportaddmessage', 'YccSupportController@yccsupportaddmessage')->middleware('auth', 'ipcheck')->name('yccsupportaddmessage');
Route::get('yccsupport/detail/{id}', 'YccSupportController@detail')->middleware('can:yccsupport-detail','auth', 'ipcheck')->name('yccsupport.detail');
Route::post('getnewsupportemails', 'YccSupportController@getleads')->middleware('auth', 'ipcheck')->name('getnewsupportemails');

Route::get('yccsupport-close-ticket/{support_id}', 'YccSupportController@closeticket')->name('yccsupport-close-ticket');
Route::get('yccsupport_thankyou', 'YccSupportController@thanyou')->name('yccsupport_thankyou');
Route::post('yccsubmitfeedback', 'YccSupportController@yccsubmitfeedback')->name('yccsubmitfeedback');
Route::post('ycccloseticket', 'YccSupportController@ycccloseticket')->name('ycccloseticket');





//CCMS start
//teacher course	//CCMS
Route::group(['prefix'=> 'teacher_course'],function(){
   Route::resource('teacher_course','TeacherCourseController')->middleware('auth');
      Route::get('create', 'TeacherCourseController@create')->middleware('can:create-teacher_course')->name('teacher_course.create');
      Route::post('', 'TeacherCourseController@store')->middleware('can:create-teacher_course')->name('teacher_course.store');   
      Route::get('', 'TeacherCourseController@index')->middleware('can:teacher_course-index')->name('teacher_course.index');
      Route::get('{id}', 'TeacherCourseController@show')->middleware('can:show-teacher_course')->name('teacher_course.show');
      Route::delete('delete/{id}', 'TeacherCourseController@destroy')->middleware('can:delete-teacher_course')->name('teacher_course.destroy');
      Route::get('{id}/edit', 'TeacherCourseController@edit')->middleware('can:edit-teacher_course')->name('teacher_course.edit');
     Route::patch('{id}', 'TeacherCourseController@update')->middleware('auth')->name('teacher_course.update');
     
  });
  
   //teacher timing	//CCMS
  Route::group(['prefix'=> 'teacher_timing'],function(){
   Route::resource('teacher_timing','TeacherTimingController')->middleware('auth');
      Route::get('create', 'TeacherTimingController@create')->middleware('can:create-teacher_timing')->name('teacher_timing.create');
      Route::post('', 'TeacherTimingController@store')->middleware('can:create-teacher_timing')->name('teacher_timing.store');   
      Route::get('', 'TeacherTimingController@index')->middleware('can:teacher_timing-index')->name('teacher_timing.index');
      Route::get('{id}', 'TeacherTimingController@show')->middleware('can:show-teacher_timing')->name('teacher_timing.show');
      Route::delete('delete/{id}', 'TeacherTimingController@destroy')->middleware('can:delete-teacher_timing')->name('teacher_timing.destroy');
      Route::get('{id}/edit', 'TeacherTimingController@edit')->middleware('can:edit-teacher_timing')->name('teacher_timing.edit');
     Route::patch('{id}', 'TeacherTimingController@update')->middleware('auth')->name('teacher_timing.update');
     
  });
  
  /* //Settings-->parents*/	//CCMS
   Route::group(['prefix'=> 'parents'],function(){
      Route::get('create', 'ParentController@create')->middleware('can:create-parents')->name('parents.create');
      Route::post('', 'ParentController@store')->middleware('can:create-parents')->name('parents.store');   
      Route::get('', 'ParentController@index')->middleware('can:index-parents')->name('parents.index');
     Route::post('/fetch', 'ParentController@fetch')->middleware('can:index-parents')->name('parents.fetch');
      Route::post('/show', 'ParentController@show')->middleware('can:show-parents')->name('parents.show');
      Route::delete('delete/{id}', 'ParentController@destroy')->middleware('can:delete-parents')->name('parents.destroy');
      Route::post('/edit', 'ParentController@edit')->middleware('can:edit-parents')->name('parents.edit');
     Route::patch('/update', 'ParentController@update')->middleware('auth')->name('parents.update');
     Route::get('/studentformparent_index', 'ParentController@studentformparent_index')->middleware('auth')->name('parents.studentformparent_index');
     Route::get('/studentformparent/{id}', 'ParentController@studentformparent')->middleware('can:studentformparent')->name('parents.studentformparent');
     Route::post('/deactivate', 'ParentController@deactivate')->middleware('can:status-parents')->name('parents.deactivate');
     Route::post('/active', 'ParentController@active')->middleware('can:status-parents')->name('parents.active');
  
     Route::post('studentparent_store/', 'ParentController@studentparent_store')->middleware('auth')->name('studentparent.store'); 
     Route::get('/createinvoice/{id}', 'ParentController@createinvoice')->middleware('can:createinvoice')->name('parents.createinvoice');
     Route::post('/invoicepreview', 'ParentController@invoicepreview')->middleware('can:invoicepreview')->name('parents.invoicepreview');
     Route::post('/saveinvoice', 'ParentController@saveinvoice')->middleware('auth')->name('parents.saveinvoice');
  //create invoice detail		without_login
     Route::get('create_invoice_detail_without_login/{invoice_id?}','ParentController@create_invoice_detail_without_login')->name('create_invoice_detail_without_login');
  //print_invoice	without_login
     Route::get('print_invoice/{invoice_id?}','ParentController@print_invoice')->name('print_invoice');
  //downloadpdf	without_login
     Route::get('downloadpdf/{invoice_id?}','ParentController@downloadpdf')->name('downloadpdf');
  
  //create invoice from schedule
  Route::get('/createinvoicestu/{id}', 'ParentController@createinvoicestu')->middleware('can:createinvoice')->name('parents.createinvoicestu');
  //clean this later
  Route::get('/createinvoice_fivedays', 'ParentController@createinvoice_fivedays')->middleware('can:createinvoice')->name('parents.createinvoice_fivedays');
  
  });
  
  //student	//CCMS
  Route::group(['prefix'=> 'student'],function(){
     Route::get('', 'StudentController@index')->middleware('can:index-student')->name('student');
     Route::post('/fetch', 'StudentController@fetch')->middleware('can:index-student')->name('student.fetch');
     Route::post('/show', 'StudentController@show')->middleware('can:show-student')->name('student.show');
     Route::post('', 'StudentController@store')->middleware('can:create-student')->name('student.store');  
     Route::post('/edit', 'StudentController@edit')->middleware('can:edit-student')->name('student.edit');
     Route::patch('/update', 'StudentController@update')->middleware('can:edit-student')->name('student.update');
     Route::delete('/delete/{id}', 'StudentController@destroy')->middleware('can:delete-student')->name('student.destroy');
     Route::post('/status', 'StudentController@status')->middleware('can:status-student')->name('student.status');
     
     Route::post('/deactivate', 'StudentController@deactivate')->middleware('can:status-student')->name('student.deactivate');
     Route::post('/active', 'StudentController@active')->middleware('can:status-student')->name('student.active'); 
     Route::post('/resetpassword', 'StudentController@update')->middleware('can:edit-student')->name('student.resetpassword');
  });
  
   //Schedule	//CCMS
   Route::group(['prefix'=> 'schedule'],function(){	 
     //Trial confirmation
	Route::get('trialconfirmation', 'ScheduleController@trialconfirmation')->middleware('can:index-trialconfirmation')->name('schedule.trialconfirmation');	
   //Trial confirm
  Route::get('confirmtrial/{id}', 'ScheduleController@confirmtrial')->middleware('can:status-confirmtrial');	
  //Dead confirmation
  Route::get('deadconfirmation/{id}', 'ScheduleController@deadconfirmation')->middleware('can:index-deadconfirmation')->name('schedule.deadconfirmation');	
   //Dead confirm
  Route::patch('confirmdead/{id}', 'ScheduleController@confirmdead')->middleware('can:status-confirmdead');
  //Dead confirmation list
  Route::get('deadconfirmation_list', 'ScheduleController@deadconfirmation_list')->middleware('can:index-deadconfirmation_list')->name('schedule.deadconfirmation_list');	
  //confirmdead_list
  Route::get('confirmdead_list/{id}', 'ScheduleController@confirmdead_list')->middleware('can:confirmdead_list')->name('schedule.confirmdead_list');	
  //toScheduleFromDeadList
  Route::get('toScheduleFromDeadList/{id}', 'ScheduleController@toScheduleFromDeadList')->middleware('can:toScheduleFromDeadList')->name('schedule.toScheduleFromDeadList');	
  //setup fee
   Route::get('{id}/editfee', 'ScheduleController@editfee')->middleware('can:editfee')->name('schedule.editfee');
   Route::patch('updatefee/{id}', 'ScheduleController@updatefee')->middleware('can:updatefee')->name('schedule.updatefee');
   Route::get('create', 'ScheduleController@create')->middleware('can:create-schedule')->name('schedule.create');
   Route::post('', 'ScheduleController@store')->middleware('can:create-schedule')->name('schedule.store');   
   Route::get('', 'ScheduleController@index')->middleware('can:index-schedule')->name('schedule.index');
  Route::post('/fetch', 'ScheduleController@fetch')->middleware('can:index-schedule')->name('schedule.fetch');	
   Route::get('{id}', 'ScheduleController@show')->middleware('can:show-schedule')->name('schedule.show');
   Route::delete('delete/{id}', 'ScheduleController@destroy')->middleware('can:delete-schedule')->name('schedule.destroy');
   Route::get('{id}/edit', 'ScheduleController@edit')->middleware('can:edit-schedule')->name('schedule.edit');
   Route::patch('{id}', 'ScheduleController@update')->middleware('auth')->name('schedule.update');
  
  Route::post('/schedule/availableTeacher', ['as'=>'/schedule/availableTeacher','uses'=>'ScheduleController@showAvailableTeacher']);
  Route::get('createMakeRegular/{id}','ScheduleController@createMakeRegular')->middleware('auth')->name('createMakeRegular');
   Route::post('storeMakeRegular/', 'ScheduleController@storeMakeRegular')->middleware('auth')->name('storeMakeRegular');   
  Route::post('/schedule/getCurrencyValueFromDB', ['as'=>'/schedule/getCurrencyValueFromDB','uses'=>'ScheduleController@getCurrencyValueFromDB']);
  });
  
   //daily_schedule	//CCMS
  Route::group(['prefix'=> 'daily_schedule'],function(){
   Route::resource('daily_schedule','DailyScheduleController')->middleware('auth');
      Route::get('create', 'DailyScheduleController@create')->middleware('can:create-daily_schedule')->name('daily_schedule.create');
      Route::post('', 'DailyScheduleController@store')->middleware('can:create-daily_schedule')->name('daily_schedule.store');   
  //class details
     Route::get('classDetails', 'DailyScheduleController@classDetails')->middleware('can:classDetails')->name('daily_schedule.classDetails');
     Route::post('/classDetails/search', 'DailyScheduleController@classDetails')->middleware('can:classDetails')->name('daily_schedule.classDetailsSearch');
  //daily schedule    
     Route::get('', 'DailyScheduleController@index')->middleware('can:index-daily_schedule')->name('daily_schedule.index');
      Route::post('/search', 'DailyScheduleController@index')->middleware('can:index-daily_schedule')->name('daily_schedule.search');    
     Route::get('{id}', 'DailyScheduleController@show')->middleware('can:show-daily_schedule')->name('daily_schedule.show');
      Route::delete('delete/{id}', 'DailyScheduleController@destroy')->middleware('can:delete-daily_schedule')->name('daily_schedule.destroy');
      Route::get('{id}/edit', 'DailyScheduleController@edit')->middleware('can:edit-daily_schedule')->name('daily_schedule.edit');
  //class START/END	
     Route::patch('{id}', 'DailyScheduleController@update')->middleware('auth')->name('daily_schedule.update');
     Route::get('startClassFunction/{id}','DailyScheduleController@startClassFunction')->middleware('can:startClassFunction')->name('startClassFunction');
     Route::get('endClass/{id}','DailyScheduleController@endClass')->middleware('can:endClass')->name('endClass');
      Route::patch('endClassFunction/{id}', 'DailyScheduleController@endClassFunction')->middleware('can:endClassFunction')->name('endClassFunction');
  });
  
   //teams	//CCMS
   
   
   
//Invoice	//CCMS
 Route::group(['prefix'=> 'invoice'],function(){
   Route::resource('invoice','InvoiceController')->middleware('auth');	
   Route::get('create', 'InvoiceController@create')->middleware('can:create-invoice')->name('invoice.create');
   Route::post('', 'InvoiceController@store')->middleware('can:create-invoice')->name('invoice.store');   
   //Pending invoices list
   Route::get('', 'InvoiceController@index')->middleware('can:invoicelistpending')->name('invoicelist.index');
   Route::post('/invoicelist/search', 'InvoiceController@index')->middleware('can:invoicelistpending')->name('invoicelist.indexSearch');
   
   //
   Route::get('{id}', 'InvoiceController@show')->middleware('can:show-invoice')->name('invoice.show');
   Route::delete('delete/{id}', 'InvoiceController@destroy')->middleware('can:delete-invoice')->name('invoice.destroy');
   Route::get('{id}/edit', 'InvoiceController@edit')->middleware('can:edit-invoice')->name('invoice.edit');
   Route::post('/invoice_reminder', 'InvoiceController@invoice_reminder')->middleware('auth')->name('invoice.invoice_reminder');
   Route::patch('/reminder_update', 'InvoiceController@reminder_update')->middleware('auth')->name('invoice.reminder_update');
   Route::patch('{id}', 'InvoiceController@update')->middleware('auth')->name('invoice.update');
   Route::get('/invoicedetail_list/{id}', 'InvoiceController@invoicedetail_list')->middleware('auth')->name('invoice.invoicedetail_list');
   Route::get('/makeinvoicepayment/{invoiceid}', 'InvoiceController@makeinvoicepayment')->middleware('auth')->name('makeinvoicepayment');
   Route::post('/updateinvoicepayment', 'InvoiceController@updateinvoicepayment')->middleware('auth')->name('updateinvoicepayment');
   //invoice_deadconfirmation
   Route::get('invoice_deadconfirmation/{id}', 'InvoiceController@invoice_deadconfirmation')->middleware('auth')->name('invoice.invoice_deadconfirmation');		
   //invoice_dead
   Route::post('/invoice_dead', 'InvoiceController@invoice_dead')->middleware('auth')->name('invoice.invoice_dead');
   
  });
  
  //CCMS to ERP import route
   Route::get('ccmstoerpimport/', 'CcmstoerpimportController@index')->middleware('auth')->name('ccmstoerpimport');
   Route::get('ccmstoerpimport/teachertimingimport', 'CcmstoerpimportController@teachertimingimport')->middleware('auth')->name('ccmstoerpimport.teachertimingimport');
   Route::get('ccmstoerpimport/teachercourseimport', 'CcmstoerpimportController@teachercourseimport')->middleware('auth')->name('ccmstoerpimport.teachercourseimport');
  
   //Currencies Liverate
Route::get('currenciesliverate/', 'CurrenciesController@index')->name('currenciesliverate');
 
//IPN listener
Route::post('/paymentipnlistener', 'ParentController@paymentipnlistener')->name('paymentipnlistener.ipn');
Route::get('/paymentipnlistenerTEST', 'ParentController@paymentipnlistenerTEST')->name('paymentipnlistenerTEST');


  
  //CCMS		end