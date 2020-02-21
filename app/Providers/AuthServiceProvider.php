<?php

namespace App\Providers;

use App\User;
use App\Policies\RolePolicy;
use Laravel\Passport\Passport;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Role' => 'App\Policies\RolePolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        $this->registerDashboardPolicies();
        $this->registerLeadPolicies();
        $this->registerCallBackPolicies();
        $this->registerProjectPolicies();
        $this->registerCustomersProjectPolicies();
        $this->registerAdminsPolicies();
        $this->registerCustomersPolicies();
        $this->registerAdminmenuPolicies();
        $this->registerMyTaskPolicies();
        $this->BudgetCategory();
        $this->Banks();
        $this->payableCommitted();
        $this->budgetSheet();
        $this->Departments();
        $this->complaint();
        $this->Hrleads();
        $this->Designation();
        $this->Preferences();
        $this->Generalsettings();
        $this->Holidays();
        $this->Attendancesheet();
        $this->Yccref();
        $this->Leave();
        $this->Adjustments();
        $this->salarysheet();
        $this->inventoryCategory();
        $this->inventory();
        $this->itstation();
        $this->chatPolicies();
        $this->inventoryReport();
        $this->ChartOfAccount();
        $this->JournalVoucher();
        $this->ledger();
        $this->cashbook();
        $this->paypalwithdrwalPolicies();
        $this->staffrequiredPolicies();
        $this->userdocumentPolicies();
        $this->endservicePolicies();
        $this->qualityassurancePolicies();
        $this->yccsupportPolicies();
        $this->logs();
        $this->ccms();
        $this->leads();
        Passport::routes();

    }


    //CCMS
    public function ccms(){
        //teacher_course
        Gate::define('teacher_course-index', function($user){
            return $user->hasAccess(['teacher_course-index']);
        });
		
		Gate::define('create-teacher_course', function($user){
            return $user->hasAccess(['create-teacher_course']);
        });
		
		Gate::define('edit-teacher_course', function($user){
            return $user->hasAccess(['edit-teacher_course']);
        });
		
		Gate::define('delete-teacher_course', function($user){
            return $user->hasAccess(['delete-teacher_course']);
        });

		//teacher_timing
        Gate::define('teacher_timing-index', function($user){
            return $user->hasAccess(['teacher_timing-index']);
        });
		
		Gate::define('create-teacher_timing', function($user){
            return $user->hasAccess(['create-teacher_timing']);
        });
		
		Gate::define('edit-teacher_timing', function($user){
            return $user->hasAccess(['edit-teacher_timing']);
        });
		
		Gate::define('delete-teacher_timing', function($user){
            return $user->hasAccess(['delete-teacher_timing']);
        });	

		//parent
        Gate::define('index-parents', function($user){
            return $user->hasAccess(['index-parents']);
        });
		
		Gate::define('create-parents', function($user){
            return $user->hasAccess(['create-parents']);
        });
		
		Gate::define('edit-parents', function($user){
            return $user->hasAccess(['edit-parents']);
        });
		
		Gate::define('delete-parents', function($user){
            return $user->hasAccess(['delete-parents']);
        });	

		Gate::define('studentformparent', function($user){
            return $user->hasAccess(['studentformparent']);
        });

		Gate::define('create-studentparent', function($user){
            return $user->hasAccess(['create-studentparent']);
        });
		
		Gate::define('show-parents', function($user){
            return $user->hasAccess(['show-parents']);
        });		

		Gate::define('status-parents', function($user){
            return $user->hasAccess(['status-parents']);
        });
		
		Gate::define('createinvoice', function($user){
            return $user->hasAccess(['createinvoice']);
        });
		
		//Invoice
		Gate::define('invoicepreview', function($user){
            return $user->hasAccess(['invoicepreview']);
        });
		Gate::define('saveinvoice', function($user){
            return $user->hasAccess(['saveinvoice']);
        });
		Gate::define('invoicelistpending', function($user){
            return $user->hasAccess(['invoicelistpending']);
        });
		
		
		//Extension
        Gate::define('extension-index', function($user){
            return $user->hasAccess(['extension-index']);
        });
		
		Gate::define('create-extension', function($user){
            return $user->hasAccess(['create-extension']);
        });
		
		Gate::define('edit-extension', function($user){
            return $user->hasAccess(['edit-extension']);
        });
		
		Gate::define('delete-extension', function($user){
            return $user->hasAccess(['delete-extension']);
        });
		
		Gate::define('status-extension', function($user){
            return $user->hasAccess(['status-extension']);
        });	

		//student
        Gate::define('index-student', function($user){
            return $user->hasAccess(['index-student']);
        });
		
		Gate::define('create-student', function($user){
            return $user->hasAccess(['create-student']);
        });
		
		Gate::define('edit-student', function($user){
            return $user->hasAccess(['edit-student']);
        });
		
		Gate::define('delete-student', function($user){
            return $user->hasAccess(['delete-student']);
        });	

		Gate::define('status-student', function($user){
            return $user->hasAccess(['status-student']);
        });	

		Gate::define('show-student', function($user){
            return $user->hasAccess(['show-student']);
        });	

		//Schedule
        Gate::define('index-schedule', function($user){
            return $user->hasAccess(['index-schedule']);
        });
		
		Gate::define('create-schedule', function($user){
            return $user->hasAccess(['create-schedule']);
        });
		
		Gate::define('edit-schedule', function($user){
            return $user->hasAccess(['edit-schedule']);
        });
		
		Gate::define('delete-schedule', function($user){
            return $user->hasAccess(['delete-schedule']);
        });

		Gate::define('show-schedule', function($user){
            return $user->hasAccess(['show-schedule']);
        });	

		Gate::define('editfee', function($user){
            return $user->hasAccess(['editfee']);
        });
		
		Gate::define('updatefee', function($user){
            return $user->hasAccess(['updatefee']);
        });

		//Trial Confirmation
		Gate::define('index-trialconfirmation', function($user){
            return $user->hasAccess(['index-trialconfirmation']);
        });
		Gate::define('status-confirmtrial', function($user){
            return $user->hasAccess(['status-confirmtrial']);
        });	
		//Dead Confirmation		
		Gate::define('index-deadconfirmation', function($user){
            return $user->hasAccess(['index-deadconfirmation']);
        });
		Gate::define('status-confirmdead', function($user){
            return $user->hasAccess(['status-confirmdead']);
        });	
		//Dead Confirmation List
		Gate::define('index-deadconfirmation_list', function($user){
            return $user->hasAccess(['index-deadconfirmation_list']);
        });
		//DC confirm button
		Gate::define('confirmdead_list', function($user){
            return $user->hasAccess(['confirmdead_list']);
        });	
		//Back to schedule button under DC list
		Gate::define('toScheduleFromDeadList', function($user){
            return $user->hasAccess(['toScheduleFromDeadList']);
        });			
		
		//Daily Schedule, class START/END, class details
		Gate::define('index-daily_schedule', function($user){
            return $user->hasAccess(['index-daily_schedule']);
        });
			//start/end
			Gate::define('startClassFunction', function($user){
				return $user->hasAccess(['startClassFunction']);
			});		
			Gate::define('endClass', function($user){
				return $user->hasAccess(['endClass']);
			});
			Gate::define('endClassFunction', function($user){
				return $user->hasAccess(['endClassFunction']);
			});
			//class details
			Gate::define('classDetails', function($user){
				return $user->hasAccess(['classDetails']);
			});		
		
		//teamlead-teams
		Gate::define('teams-index', function($user){
            return $user->hasAccess(['teams-index']);
        });
		Gate::define('create-teams', function($user){
            return $user->hasAccess(['create-teams']);
        });
		Gate::define('edit-teams', function($user){
            return $user->hasAccess(['edit-teams']);
        });
		
		Gate::define('showteam-teams', function($user){
            return $user->hasAccess(['showteam-teams']);
        });
		Gate::define('addmember-teams', function($user){
            return $user->hasAccess(['addmember-teams']);
        });
		Gate::define('deletemember-teams', function($user){
            return $user->hasAccess(['deletemember-teams']);
        });			
    }	

    
    // Logs
    public function logs(){
        Gate::define('activitylogs', function($user){
            return $user->hasAccess(['activitylogs']);
        });
    }

    // Ycc Support System

    public function yccsupportPolicies()
    {
        Gate::define('yccsupport-index', function ($user) {
            return $user->hasAccess(['yccsupport-index']);
        });
        Gate::define('yccsupport-fetch', function ($user) {
            return $user->hasAccess(['yccsupport-fetch']);
        });
        Gate::define('yccsupport-store', function ($user) {
            return $user->hasAccess(['yccsupport-store']);
        });
        Gate::define('yccsupport-edit', function ($user) {
            return $user->hasAccess(['yccsupport-edit']);
        });
        Gate::define('yccsupport-detail', function ($user) {
            return $user->hasAccess(['yccsupport-detail']);
        });
        Gate::define('view-all-yccsupporttickets', function ($user) {
            return $user->hasAccess(['view-all-yccsupporttickets']);
        });
    }

    // Quality Assurance
    public function qualityassurancePolicies(){
        Gate::define('qualityassurance-index', function($user){
            return $user->hasAccess(['qualityassurance-index']);
        });
        Gate::define('qualityassurance-fetch', function($user){
            return $user->hasAccess(['qualityassurance-fetch']);
        });
        Gate::define('qualityassurance-store', function($user){
            return $user->hasAccess(['qualityassurance-store']);
        });
        Gate::define('qualityassurance-edit', function($user){
            return $user->hasAccess(['qualityassurance-edit']);
        });
    }
    //end service checlist
    public function endservicePolicies(){
        
        Gate::define('endservice-index', function($user){
            return $user->hasAccess(['endservice-index']);
        });

        Gate::define('endservice-fetch', function($user){
            return $user->hasAccess(['endservice-fetch']);
        });

        Gate::define('endservice-store', function($user){
            return $user->hasAccess(['endservice-store']);
        });

        Gate::define('endservice-edit', function($user){
            return $user->hasAccess(['endservice-edit']);
        });
        Gate::define('endservice-show', function($user){
            return $user->hasAccess(['endservice-show']);
        });
    } 

    //Hiring Checklist
    public function userdocumentPolicies(){
        
        Gate::define('userdocumemt-index', function($user){
            return $user->hasAccess(['userdocumemt-index']);
        });

        Gate::define('userdocumemt-fetch', function($user){
            return $user->hasAccess(['userdocumemt-fetch']);
        });

        Gate::define('userdocumemt-store', function($user){
            return $user->hasAccess(['userdocumemt-store']);
        });

        Gate::define('userdocumemt-edit', function($user){
            return $user->hasAccess(['userdocumemt-edit']);
        });
        Gate::define('userdocumemt-show', function($user){
            return $user->hasAccess(['userdocumemt-show']);
        });
    }

    //staff required 
    public function staffrequiredPolicies(){
        
        Gate::define('staffrequired-index', function($user){
            return $user->hasAccess(['staffrequired-index']);
        });

        Gate::define('staffrequired-fetch', function($user){
            return $user->hasAccess(['staffrequired-fetch']);
        });

        Gate::define('staffrequired-store', function($user){
            return $user->hasAccess(['staffrequired-store']);
        });

        Gate::define('staffrequired-edit', function($user){
            return $user->hasAccess(['staffrequired-edit']);
        });
        Gate::define('staffrequired-show', function($user){
            return $user->hasAccess(['staffrequired-show']);
        });
    }

     //Paypal withdrawal 
    public function paypalwithdrwalPolicies(){
        
        Gate::define('paypalwithdrwal-index', function($user){
            return $user->hasAccess(['paypalwithdrwal-index']);
        });

        Gate::define('paypalwithdrwal-fetch', function($user){
            return $user->hasAccess(['paypalwithdrwal-fetch']);
        });

        Gate::define('paypalwithdrwal-store', function($user){
            return $user->hasAccess(['paypalwithdrwal-store']);
        });

        Gate::define('paypalwithdrwal-edit', function($user){
            return $user->hasAccess(['paypalwithdrwal-edit']);
        });
        Gate::define('paypalwithdrwal-show', function($user){
            return $user->hasAccess(['paypalwithdrwal-show']);
        });
        Gate::define('paypalwithdrwal-disable', function($user){
            return $user->hasAccess(['paypalwithdrwal-disable']);
        });
        Gate::define('paypalwithdrwal-active', function($user){
            return $user->hasAccess(['paypalwithdrwal-active']);
        });
        Gate::define('paypalwithdrwal-delete', function($user){
            return $user->hasAccess(['paypalwithdrwal-delete']);
        });
    }
    
    //ledger
    public function ledger(){
        
        Gate::define('ledger-index', function($user){
            return $user->hasAccess(['ledger-index']);
        });

    }    
//cashbook
    public function cashbook(){
        
        Gate::define('cashbook-index', function($user){
            return $user->hasAccess(['cashbook-index']);
        });

    } 

//JournalVoucher
public function JournalVoucher(){
        
    Gate::define('journalVoucher-index', function($user){
        return $user->hasAccess(['journalVoucher-index']);
    });

    Gate::define('journalVoucher-fetch', function($user){
        return $user->hasAccess(['journalVoucher-fetch']);
    });

    Gate::define('journalVoucher-store', function($user){
        return $user->hasAccess(['journalVoucher-store']);
    });

    Gate::define('journalVoucher-edit', function($user){
        return $user->hasAccess(['journalVoucher-edit']);
    });
    Gate::define('journalVoucher-update', function($user){
        return $user->hasAccess(['journalVoucher-update']);
    });
    Gate::define('journalVoucher-show', function($user){
        return $user->hasAccess(['journalVoucher-show']);
    });
    Gate::define('journalVoucher-disable', function($user){
        return $user->hasAccess(['journalVoucher-disable']);
    }); 
}
      //Chart of Accounts Menu
    public function ChartOfAccount(){
    
        Gate::define('chartOfAccount-index', function($user){
            return $user->hasAccess(['chartOfAccount-index']);
        });

        Gate::define('chartOfAccount-fetch', function($user){
            return $user->hasAccess(['chartOfAccount-fetch']);
        });

        Gate::define('chartOfAccount-store', function($user){
            return $user->hasAccess(['chartOfAccount-store']);
        });

        Gate::define('chartOfAccount-edit', function($user){
            return $user->hasAccess(['chartOfAccount-edit']);
        });
        Gate::define('chartOfAccount-delete', function($user){ 
            return $user->hasAccess(['chartOfAccount-delete']);
        });

    }

     //inventoryReport
    public function inventoryReport(){
        
        Gate::define('inventoryReport-index', function($user){
            return $user->hasAccess(['inventoryReport-index']);
        });
        Gate::define('inventoryReportIn-index', function($user){
            return $user->hasAccess(['inventoryReportIn-index']);
        });
    }
    
    //For chat
    public function chatPolicies(){
        
        Gate::define('chat-view', function($user){
            return $user->hasAccess(['chat-view']);
        });
        Gate::define('create-chat-groups', function($user){
            return $user->hasAccess(['create-chat-groups']);
        });

        Gate::define('chat-add-new-chat-single', function($user){
            return $user->hasAccess(['chat-add-new-chat-single']);
        });
     
    }

    //IT Station
    public function itstation(){
            
        Gate::define('itstation-index', function($user){
            return $user->hasAccess(['itstation-index']);
        });

        Gate::define('itstation-fetch', function($user){
            return $user->hasAccess(['itstation-fetch']);
        });

        Gate::define('itstation-store', function($user){
            return $user->hasAccess(['itstation-store']);
        });

        Gate::define('itstation-edit', function($user){
            return $user->hasAccess(['itstation-edit']);
        });
        Gate::define('itstation-show', function($user){
            return $user->hasAccess(['itstation-show']);
        });

    }


    //inventory
    public function inventory(){
        
        Gate::define('inventory-index', function($user){
            return $user->hasAccess(['inventory-index']);
        });

        Gate::define('inventory-fetch', function($user){
            return $user->hasAccess(['inventory-fetch']);
        });

        Gate::define('inventory-store', function($user){
            return $user->hasAccess(['inventory-store']);
        });

        Gate::define('inventory-edit', function($user){
            return $user->hasAccess(['inventory-edit']);
        });
        Gate::define('inventory-show', function($user){
            return $user->hasAccess(['inventory-show']);
        });
        
        Gate::define('inventory-issuseStore', function($user){
            return $user->hasAccess(['inventory-issuseStore']);
        });
        Gate::define('inventory-plusStore', function($user){
            return $user->hasAccess(['inventory-plusStore']);
        });

    }

    //inventoryCategory
    public function inventoryCategory(){
        
        Gate::define('inventoryCategory-index', function($user){
            return $user->hasAccess(['inventoryCategory-index']);
        });

        Gate::define('inventoryCategory-fetch', function($user){
            return $user->hasAccess(['inventoryCategory-fetch']);
        });

        Gate::define('inventoryCategory-store', function($user){
            return $user->hasAccess(['inventoryCategory-store']);
        });

        Gate::define('inventoryCategory-edit', function($user){
            return $user->hasAccess(['inventoryCategory-edit']);
        });
        Gate::define('inventoryCategory-show', function($user){
            return $user->hasAccess(['inventoryCategory-show']);
        });

    

    }
    
    //Salary Sheet
    public function salarysheet(){
        
        //Lock Salary Sheet
         Gate::define('locksalarysheet', function($user){
            return $user->hasAccess(['locksalarysheet']);
        });
    
        Gate::define('salarysheet-index', function($user){
            return $user->hasAccess(['salarysheet-index']);
        });

        Gate::define('pay-salarysheet', function($user){
            return $user->hasAccess(['pay-salarysheet']);
        });
    }

    //Payroll Adjustments
    public function Adjustments(){
    
        Gate::define('adjustments-index', function($user){
            return $user->hasAccess(['adjustments-index']);
        });

        Gate::define('create-adjustment', function($user){
            return $user->hasAccess(['create-adjustment']);
        });

        Gate::define('edit-adjustment', function($user){
            return $user->hasAccess(['edit-adjustment']);
        });

        Gate::define('delete-adjustment', function($user){
            return $user->hasAccess(['delete-adjustment']);
        });

        Gate::define('approve-adjustment', function($user){
            return $user->hasAccess(['approve-adjustment']);
        });

    }
    //Leaves
    public function Leave(){
        
        Gate::define('leaves-index', function($user){
            return $user->hasAccess(['leaves-index']);
        });

        Gate::define('create-leave', function($user){
            return $user->hasAccess(['create-leave']);
        });

        Gate::define('edit-leave', function($user){
            return $user->hasAccess(['edit-leave']);
        });

        Gate::define('delete-leave', function($user){
            return $user->hasAccess(['delete-leave']);
        });
    }
    //YCC Reference
    public function Yccref(){
    
        Gate::define('yccref-index', function($user){
            return $user->hasAccess(['yccref-index']);
        });

        Gate::define('create-yccref', function($user){
            return $user->hasAccess(['create-yccref']);
        });

        Gate::define('show-yccref', function($user){
            return $user->hasAccess(['show-yccref']);
        });

        Gate::define('edit-yccref', function($user){
            return $user->hasAccess(['edit-yccref']);
        });

        Gate::define('status-yccref', function($user){
            return $user->hasAccess(['status-yccref']);
        });

        Gate::define('delete-yccref', function($user){
            return $user->hasAccess(['delete-yccref']);
        });
    }
    //Attendance Sheet
    public function Attendancesheet(){
        Gate::define('attendance-index', function($user){
            return $user->hasAccess(['attendance-index']);
        });

        Gate::define('att-approval', function($user){
            return $user->hasAccess(['att-approval']);
        });

        Gate::define('att-viewapproval', function($user){
            return $user->hasAccess(['att-viewapproval']);
        });

        Gate::define('att-approve', function($user){
            return $user->hasAccess(['att-approve']);
        });

        Gate::define('att-reject', function($user){
            return $user->hasAccess(['att-reject']);
        });
    }

    //General Settings
    public function Generalsettings(){
        Gate::define('attendance-exception', function($user){
            return $user->hasAccess(['attendance-exception']);
        });
        
    }
     //Holidays
     public function Holidays(){
    
        Gate::define('holidays-index', function($user){
            return $user->hasAccess(['holidays-index']);
        });

        Gate::define('create-holiday', function($user){
            return $user->hasAccess(['create-holiday']);
        });

        Gate::define('edit-holiday', function($user){
            return $user->hasAccess(['edit-holiday']);
        });

        Gate::define('delete-holiday', function($user){
            return $user->hasAccess(['delete-holiday']);
        });
    }
    //Preferences
    public function Preferences(){
    
        Gate::define('preferences-index', function($user){
            return $user->hasAccess(['preferences-index']);
        });

        Gate::define('create-preference', function($user){
            return $user->hasAccess(['create-preference']);
        });

        Gate::define('edit-preference', function($user){
            return $user->hasAccess(['edit-preference']);
        });

        Gate::define('delete-preference', function($user){
            return $user->hasAccess(['delete-preference']);
        });
    }

    //Departments
    public function Designation(){
    
        Gate::define('designations-index', function($user){
            return $user->hasAccess(['designations-index']);
        });

        Gate::define('create-designation', function($user){
            return $user->hasAccess(['create-designation']);
        });

        Gate::define('edit-designation', function($user){
            return $user->hasAccess(['edit-designation']);
        });

        Gate::define('status-designation', function($user){
            return $user->hasAccess(['status-designation']);
        });

        Gate::define('delete-designation', function($user){
            return $user->hasAccess(['delete-designation']);
        });
    }

    //complaint
    public function complaint(){
        
        Gate::define('complaint-index', function($user){
            return $user->hasAccess(['complaint-index']);
        });

        Gate::define('complaint-fetch', function($user){
            return $user->hasAccess(['complaint-fetch']);
        });

        Gate::define('complaint-store', function($user){
            return $user->hasAccess(['complaint-store']);
        });

        Gate::define('complaint-edit', function($user){
            return $user->hasAccess(['complaint-edit']);
        });
        Gate::define('complaint-show', function($user){
            return $user->hasAccess(['complaint-show']);
        });

        Gate::define('complaint-comment', function($user){
            return $user->hasAccess(['complaint-comment']);
        });
        Gate::define('complaint-disable', function($user){
            return $user->hasAccess(['complaint-disable']);
        });
        Gate::define('departcomplaint-index', function($user){
            return $user->hasAccess(['departcomplaint-index']);
        });
        Gate::define('departcomplaint-fetch', function($user){
            return $user->hasAccess(['departcomplaint-fetch']);
        });
        Gate::define('departcomplaint-show', function($user){
            return $user->hasAccess(['departcomplaint-show']);
        });
        Gate::define('allcomplaint-index', function($user){
            return $user->hasAccess(['allcomplaint-index']);
        });
        Gate::define('allcomplaint-fetch', function($user){
            return $user->hasAccess(['allcomplaint-fetch']);
        });
        Gate::define('allcomplaint-show', function($user){
            return $user->hasAccess(['allcomplaint-show']);
        });

    }



    //Departments
    public function Hrleads(){
        
        Gate::define('index-hrleads', function($user){
            return $user->hasAccess(['index-hrleads']);
        });

        Gate::define('create-hrleads', function($user){
            return $user->hasAccess(['create-hrleads']);
        });

        Gate::define('upload-hrleads', function($user){
            return $user->hasAccess(['upload-hrleads']);
        });
        
        Gate::define('edit-hrleads', function($user){
            return $user->hasAccess(['edit-hrleads']);
        });
        
        Gate::define('show-hrleads', function($user){
            return $user->hasAccess(['show-hrleads']);
        });

        Gate::define('delete-hrleads', function($user){
            return $user->hasAccess(['delete-hrleads']);
        });
        Gate::define('status-hrleads', function($user){    
            return $user->hasAccess(['status-hrleads']);
        });
        //Interviewees Begin
        Gate::define('index-interviewees', function($user){
            return $user->hasAccess(['index-interviewees']);
        });

        //Interviews Begin
        Gate::define('index-interviews', function($user){
            return $user->hasAccess(['index-interviews']);
        });
        
    }
    //Departments
    public function Departments(){
    
        Gate::define('departments-index', function($user){
            return $user->hasAccess(['departments-index']);
        });

        Gate::define('create-department', function($user){
            return $user->hasAccess(['create-department']);
        });

        Gate::define('edit-department', function($user){
            return $user->hasAccess(['edit-department']);
        });

        Gate::define('status-department', function($user){
            return $user->hasAccess(['status-department']);
        });

        Gate::define('delete-department', function($user){
            return $user->hasAccess(['delete-department']);
        });
    }

    //budgetSheet
    public function budgetSheet(){
    
        Gate::define('budgetSheet-index', function($user){
            return $user->hasAccess(['budgetSheet-index']);
        });

        Gate::define('budgetSheet-fetch', function($user){
            return $user->hasAccess(['budgetSheet-fetch']);
        });

        Gate::define('budgetSheet-store', function($user){
             return $user->hasAccess(['budgetSheet-store']);
        });

        Gate::define('budgetSheet-edit', function($user){
            return $user->hasAccess(['budgetSheet-edit']);
        });

        Gate::define('ConsumeBudgetAmount-store', function($user){
            return $user->hasAccess(['ConsumeBudgetAmount-store']);
        });

         Gate::define('budgetSheet-show', function($user){
            return $user->hasAccess(['budgetSheet-show']);
        });


    }

    //payableCommitted
    public function payableCommitted(){
    
        Gate::define('payableCommitted-index', function($user){
            return $user->hasAccess(['payableCommitted-index']);
        });

        Gate::define('payableCommitted-fetch', function($user){
            return $user->hasAccess(['payableCommitted-fetch']);
        });

        Gate::define('payableCommitted-store', function($user){
            return $user->hasAccess(['payableCommitted-store']);
        });

        Gate::define('payableCommitted-edit', function($user){
            return $user->hasAccess(['payableCommitted-edit']);
        });
        
         Gate::define('payableCommitted-status', function($user){
            return $user->hasAccess(['payableCommitted-status']);
        });

       
    }

     //Bank Menu
    public function Banks(){
    
        Gate::define('bank', function($user){
            return $user->hasAccess(['bank']);
        });

        Gate::define('bank-index', function($user){
            return $user->hasAccess(['bank-index']);
        });

        Gate::define('bank-fetch', function($user){
            return $user->hasAccess(['bank-fetch']);
        });

        Gate::define('bank-store', function($user){
            return $user->hasAccess(['bank-store']);
        });

        Gate::define('bank-edit', function($user){
            return $user->hasAccess(['bank-edit']);
        });

    }

     //BudgetCategory Menu
    public function BudgetCategory(){
    
        Gate::define('budgetCategory-index', function($user){
            return $user->hasAccess(['budgetCategory-index']);
        });

        Gate::define('budgetCategory-fetch', function($user){
            return $user->hasAccess(['budgetCategory-fetch']);
        });

        Gate::define('budgetCategory-store', function($user){
            return $user->hasAccess(['budgetCategory-store']);
        });

        Gate::define('budgetCategory-edit', function($user){
            return $user->hasAccess(['budgetCategory-edit']);
        });

    }

    //Admin Menu
    public function registerAdminmenuPolicies(){
    
        Gate::define('menu-index', function($user){
            return $user->hasAccess(['menu-index']);
        });

    }

    public function registerMyTaskPolicies(){
       
        Gate::define('mytask-index', function($user){
            return $user->hasAccess(['mytask-index']);
        });

        Gate::define('mytask-fetch', function($user){
            return $user->hasAccess(['mytask-fetch']);
        });
        Gate::define('todayMassage-index', function($user){
            return $user->hasAccess(['todayMassage-index']);
        });
        Gate::define('todayMassage-fetch', function($user){
            return $user->hasAccess(['todayMassage-fetch']);
        });

    }

    //Dashboard
    public function registerDashboardPolicies(){
    
        Gate::define('stats-hr', function($user){
            return $user->hasAccess(['stats-hr']);
        });

        Gate::define('stats-number', function($user){
            return $user->hasAccess(['stats-number']);
        });

        Gate::define('today-appointments', function($user){
            return $user->hasAccess(['today-appointments']);
        });

        Gate::define('pending-proposal', function($user){
            return $user->hasAccess(['pending-proposal']);
        });

        Gate::define('latest-recordings', function($user){
            return $user->hasAccess(['latest-recordings']);
        });

        Gate::define('latest-leads', function($user){
            return $user->hasAccess(['latest-leads']);
        });

        Gate::define('latest-appointments', function($user){
            return $user->hasAccess(['latest-appointments']);
        });

        Gate::define('lead-chart-10', function($user){
            return $user->hasAccess(['lead-chart-10']);
        });

        Gate::define('appointment-chart-10', function($user){
            return $user->hasAccess(['appointment-chart-10']);
        });

        Gate::define('show-dashboard-calendar', function($user){
            return $user->hasAccess(['show-dashboard-calendar']);
        });
        

    }
    //Call Back
    public function registerCallBackPolicies(){

        Gate::define('create-callback', function ($user){
            return $user->hasAccess(['create-callbacks']);
        });

        Gate::define('search-callbacks', function ($user){
            return $user->hasAccess(['search-callbacks']);

        });

        Gate::define('create-callback', function ($user){
            return $user->hasAccess(['create-callback']);

        });

        Gate::define('leads-callbackfilter', function($user){
            return $user->hasAccess(['leads-callbackfilter']);
        });

        Gate::define('show-all-call-backs', function($user){
            return $user->hasAccess(['show-all-call-backs']);
        });

    }
    //Leads
    public function registerLeadPolicies(){
       
        Gate::define('leads-index', function($user){
            return $user->hasAccess(['leads-index']);
        });

        Gate::define('create-lead', function($user){
            return $user->hasAccess(['create-lead']);
        });

        Gate::define('edit-lead', function($user){
            return $user->hasAccess(['edit-lead']);
        });

        Gate::define('status-lead', function($user){
            return $user->hasAccess(['status-lead']);
        });

        Gate::define('approve-reject-lead', function($user){
            return $user->hasAccess(['approve-reject-lead']);
        });

        Gate::define('for-training-lead', function($user){
            return $user->hasAccess(['for-training-lead']);
        });

        Gate::define('show-lead', function($user){
            return $user->hasAccess(['show-lead']);
        });
        
        Gate::define('delete-lead', function($user){
            return $user->hasAccess(['delete-lead']);
        });

        Gate::define('search-leads', function($user){
            return $user->hasAccess(['search-leads']);
        });


        Gate::define('update-lead', function($user, \App\Lead $lead){
            return $user->hasAccess(['update-lead']) or $user->id==$lead->user_id;
        });

        Gate::define('show-all-leads', function($user){
            return $user->hasAccess(['show-all-leads']);
        });
        

        Gate::define('create-recording', function($user){
            return $user->hasAccess(['create-recording']);
        });

        Gate::define('create-appointment', function($user){
            return $user->hasAccess(['create-appointment']);
        });

        Gate::define('create-callback', function($user){
            return $user->hasAccess(['create-callback']);
        });

        Gate::define('create-doc', function($user){
            return $user->hasAccess(['create-doc']);
        });

        Gate::define('create-proposal', function($user){
            return $user->hasAccess(['create-proposal']);
        });
        Gate::define('upload-proposal', function($user){
            return $user->hasAccess(['upload-proposal']);
        });
        Gate::define('edit-proposal', function($user){
            return $user->hasAccess(['edit-proposal']);
        });
        
    }

    //Project
    public function registerCustomersProjectPolicies(){
       
        Gate::define('customer-projects-index', function($user){
            return $user->hasAccess(['customer-projects-index']);
        });

        Gate::define('customer-fetch-projects', function($user){
            return $user->hasAccess(['customer-fetch-projects']);
        });

        Gate::define('customer-show-projects', function($user){
            return $user->hasAccess(['customer-show-projects']);
        });
    }

    //Project
    public function registerProjectPolicies(){
       
        Gate::define('projects-index', function($user){
            return $user->hasAccess(['projects-index']);
        });

        Gate::define('create-project', function($user){
            return $user->hasAccess(['create-project']);
        });
    }

    //Project
    public function leads(){
       
        Gate::define('close-this-lead', function($user){
            return $user->hasAccess(['close-this-lead']);
        });

    }

    //Sub Admins
    public function registerAdminsPolicies(){

         //New Staff Detail Page Permission Set By Kabeer
        Gate::define('view-presentAddress', function($user){
            return $user->hasAccess(['view-presentAddress']);
        });
        Gate::define('view-permanentAddress', function($user){
            return $user->hasAccess(['view-permanentAddress']);
        });
        Gate::define('view-gaurdianInfo', function($user){
            return $user->hasAccess(['view-gaurdianInfo']);
        });
        Gate::define('view-personalContact', function($user){
            return $user->hasAccess(['view-personalContact']);
        });
        Gate::define('view-UserDepartmentRole', function($user){
            return $user->hasAccess(['view-UserDepartmentRole']);
        });
        Gate::define('view-userAccountInfo', function($user){
            return $user->hasAccess(['view-userAccountInfo']);
        });
        Gate::define('view-otherInfoSettings', function($user){
            return $user->hasAccess(['view-otherInfoSettings']);
        });
        Gate::define('view-attendance', function($user){
            return $user->hasAccess(['view-attendance']);
        });
        Gate::define('view-adjustments', function($user){
            return $user->hasAccess(['view-adjustments']);
        });

        Gate::define('admins-index', function($user){
            return $user->hasAccess(['admins-index']);
        });

        Gate::define('create-staff', function($user){
            return $user->hasAccess(['create-staff']);
        });

        Gate::define('edit-staff', function($user){
            return $user->hasAccess(['edit-staff']);
        });

        Gate::define('status-staff', function($user){
            return $user->hasAccess(['status-staff']);
        });

        Gate::define('show-staff', function($user){
            return $user->hasAccess(['show-staff']);
        });
        
        Gate::define('delete-staff', function($user){
            return $user->hasAccess(['delete-staff']);
        });

        /* To update staff check if required
        Gate::define('edit-staff', function($user, \App\User $user){
            return $user->hasAccess(['edit-staff']) or $user->id==$lead->user_id;
        });
        */

        Gate::define('staff-reset-password', function($user){
            return $user->hasAccess(['staff-reset-password']);
        });

        Gate::define('edit-staff-attendance', function($user){
            return $user->hasAccess(['edit-staff-attendance']);
        });


    }

    //Customers
    public function registerCustomersPolicies(){
        Gate::define('customers-index', function($user){
            return $user->hasAccess(['customers-index']);
        });

        Gate::define('create-customer', function($user){
            return $user->hasAccess(['create-customer']);
        });

        Gate::define('edit-customer', function($user){
            return $user->hasAccess(['edit-customer']);
        });

        Gate::define('status-customer', function($user){
            return $user->hasAccess(['status-customer']);
        });

        Gate::define('show-customer', function($user){
            return $user->hasAccess(['show-customer']);
        });
        
        Gate::define('delete-customer', function($user){
            return $user->hasAccess(['delete-customer']);
        });

        /* To update staff check if required
        Gate::define('edit-staff', function($user, \App\User $user){
            return $user->hasAccess(['edit-staff']) or $user->id==$lead->user_id;
        });
        */

        Gate::define('reset-customer-password', function($user){
            return $user->hasAccess(['reset-customer-password']);
        });

    }

}
