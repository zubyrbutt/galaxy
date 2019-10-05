<?php
// Home
Breadcrumbs::for('dashboard', function ($trail) {
    $trail->push('Dashboard', route('dashboard'), ['icon' => 'home.png']);
});

//Profile
Breadcrumbs::for('profile', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Profile', route('profile'));
});


//Manage roles
Breadcrumbs::for('roles.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Manage Roles', route('roles.index'));
});
//Create roles
Breadcrumbs::for('roles.create', function ($trail) {
    $trail->parent('roles.index');
    $trail->push('Add New Roles', route('roles.create'));
});
//Edit roles
Breadcrumbs::for('roles.edit', function ($trail, $id) {
    $trail->parent('roles.index');
    //$role = \App\Role::findOrFail($id);
    //$trail->push('Update Roles '.$role->role_title, route('roles.edit', $id));
    $trail->push('Update Roles', route('roles.edit', $id));
});

//Manager admin menu
Breadcrumbs::for('menu.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Manage Menu', route('menu.index'));
});
//Create admin menu
Breadcrumbs::for('menu.create', function ($trail) {
    $trail->parent('menu.index');
    $trail->push('Add Admin Menu', route('menu.create'));
});
//Edit admin menu
Breadcrumbs::for('menu.edit', function ($trail,$id) {
    $trail->parent('menu.index');
    $trail->push('Update Admin Menu', route('menu.edit', $id));
});

//Manage Departments
Breadcrumbs::for('departments', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Manage Departments', route('departments'));
});

//Manage designations
Breadcrumbs::for('designations', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Manage Designations', route('designations'));
});
//Manager Preferences
Breadcrumbs::for('preferences', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Manage Preferences', route('preferences'));
});
//Manager Holidays
Breadcrumbs::for('holidays', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Manage Holidays', route('holidays'));
});

//Manage Staff
Breadcrumbs::for('admins.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Manage Staff', route('admins.index'));
});
//Create Staff/Emp
Breadcrumbs::for('admins.create', function ($trail) {
    $trail->parent('admins.index');
    $trail->push('Add New Staff', route('admins.create'));
});
//Edit Staff/Emp
Breadcrumbs::for('admins.edit', function ($trail, $id) {
    $trail->parent('admins.index');
    $trail->push('Edit Staff', route('admins.edit', $id));
});
//Staff Details
Breadcrumbs::for('admins.show', function ($trail, $id) {
    $trail->parent('admins.index');
    $staff = \App\User::findOrFail($id);
    $trail->push($staff->fname.' '.$staff->lname, route('admins.show', $id));
});
//Reset Password
Breadcrumbs::for('resetpassword', function ($trail, $id) {
    $trail->parent('admins.show', $id);
    $trail->push('Reset Password', route('resetpassword', $id));
});

//Attendance Sheet
Breadcrumbs::for('attendancesheet', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Attendance Sheet', route('attendancesheet'));
});

//Attendance Approval
Breadcrumbs::for('attendancesheet.approval', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Attendance Approval', route('attendancesheet.approval'));
});


//Manage levaes
Breadcrumbs::for('leaves', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Manage Leaves', route('leaves'));
});

//Manage Adjustments
Breadcrumbs::for('payroll.adjustments', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Manage Adjustments', route('payroll.adjustments'));
});

//Manage Staff Required
Breadcrumbs::for('staffrequired.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Manage Staff Required', route('staffrequired.index'));
});

//Manage Staff Checklist
Breadcrumbs::for('userdocumemt.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Manage Staff Checklist', route('userdocumemt.index'));
});

//Manage Staff End Service Checklist
Breadcrumbs::for('endservice.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Manage End Service Checklist', route('endservice.index'));
});

//Manage Staff Quality Assurance
Breadcrumbs::for('qualityassurance.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Staff Quality Assurance', route('qualityassurance.index'));
});
//QA details
Breadcrumbs::for('qualityassurance.detail', function ($trail,$id) {
    $trail->parent('qualityassurance.index');
    $qadetails = \App\QualityAssurance::findOrFail($id);
    $empname=$qadetails->user->fname .' '. $qadetails->user->lname;
    $trail->push($empname.' QA Report', route('qualityassurance.detail',$id));
});

//Manage Customers
Breadcrumbs::for('customers.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Manage Customers', route('customers.index'));
});

//Create Customer
Breadcrumbs::for('customers.create', function ($trail) {
    $trail->parent('customers.index');
    $trail->push('Add New Customer', route('customers.create'));
});

//Edit Customer
Breadcrumbs::for('customers.edit', function ($trail,$id) {
    $trail->parent('customers.index');
    $trail->push('Update Customer', route('customers.edit',$id));
});

//Customer Detail
Breadcrumbs::for('customers.show', function ($trail,$id) {
    $trail->parent('customers.index');
    $trail->push('Customer Detail', route('customers.show',$id));
});


//Manage Leads
Breadcrumbs::for('leads.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Manage Leads', route('leads.index'));
});

//Create Lead
Breadcrumbs::for('leads.create', function ($trail) {
    $trail->parent('leads.index');
    $trail->push('Add New Leave', route('leads.create'));
});

//Edit Lead
Breadcrumbs::for('leads.edit', function ($trail,$id) {
    $trail->parent('leads.index');
    $trail->push('Update Lead', route('leads.edit',$id));
});

//Lead Detail
Breadcrumbs::for('leads.show', function ($trail,$id) {
    $trail->parent('leads.index');
    $trail->push('Lead Detail', route('leads.show',$id));
});

//Upload recording for lead
Breadcrumbs::for('createrecording', function ($trail,$id) {
    $trail->parent('leads.show',$id);
    $trail->push('Upload Recording', route('createrecording',$id));
});

//create appointment for lead
Breadcrumbs::for('createappointments', function ($trail,$id) {
    $trail->parent('leads.show',$id);
    $trail->push('Create Appointment', route('createappointments',$id));
});

//Upload document for lead
Breadcrumbs::for('createdocs', function ($trail,$id) {
    $trail->parent('leads.show',$id);
    $trail->push('Upload Document', route('createdocs',$id));
});

//Create Proposal Request for lead
Breadcrumbs::for('createproposal', function ($trail,$id) {
    $trail->parent('leads.show',$id);
    $trail->push('Create Proposal Request', route('createproposal',$id));
});

//Create Project from Lead Or creating project from customer details
Breadcrumbs::for('projects', function ($trail,$cid,$id=null) {
    if(!empty($id)){
        $trail->parent('leads.show',$id);
        $trail->push('Create Project', route('projects',[$cid, $id]));
    }else{
        $trail->parent('customers.show',$cid);
        $trail->push('Create Project', route('projects',$cid));
    }
});

//Manage Projects
Breadcrumbs::for('projects.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Manage Projects', route('projects.index'));
});
//Edit Project
Breadcrumbs::for('projects.edit', function ($trail,$id) {
    $trail->parent('projects.index');
    $trail->push('Update Project', route('projects.edit',$id));
});
//Project Details
Breadcrumbs::for('projects.show', function ($trail,$id) {
    $trail->parent('projects.index');
    $trail->push('Project Details', route('projects.show',$id));
});



//Manage Activity Log
Breadcrumbs::for('activitylogs', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Activity Log', route('activitylogs'));
});