<style>
       
         
.dropdown-submenu {
    position: relative;
           
   
}


.dropdown-submenu .dropdown-menu {
    display: none; 
    position: absolute;
    top: 100%; 
    left: 0; 
    visibility: hidden; 
    opacity: 0; 
    transition: opacity 0.3s ease, visibility 0s linear 0.3s; 
    z-index: 1050; 
    width: 200px;
}


.dropdown-submenu:hover .dropdown-menu {
    display: block; 
    visibility: visible; 
    opacity: 1; 
    transition: opacity 0.3s ease, visibility 0s linear 0s; 
}

.dropdown-item:hover {
    background-color: #f8f9fa;
   
}


.dropdown-menu {
    position: absolute;
    z-index: 1050;
    top: 100%;
     margin-left: 20px;
    margin-bottom:20px;
   
}


@media (max-height: 700px) {
    .dropdown-submenu .dropdown-menu {
        max-height: 300px; 
        overflow-y: auto; 
        width: 200px;
    }
}



     
</style>


 
<div class="sidebar pe-4 pb-3" id="sidebar">
    <nav class="navbar bg-light navbar-light">
        <a href="{{route('admin.dashboard')}}" class="navbar-brand mx-4 mb-3">
            <img src="{{asset('admin\assets\img\ifrap_logo.png')}}" style="width:auto; height:100px;" alt="logo image">
        </a>
        <div class="d-flex align-items-center ms-4 mb-4">
            <div class="position-relative">
                <img class="rounded-circle" src="{{ asset('admin/assets/img/' . Auth::user()->image) }}" alt=""
                    style="width: 40px; height: 40px;">
                <div
                    class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1">
                </div>
            </div>
            @php
                
                $role = \DB::table('users')->join('roles', 'users.role', '=', 'roles.id')
                    ->where('users.id',Auth::user()->id)
                    ->select('roles.name as name')
                    ->first();
                $get_rejected_name= get_rejected_name();
           
           
                $allow_to_update_form=DB::table('roles')
                ->join('users','users.role','=','roles.id')
                ->where('users.id',Auth::user()->id)
                ->select('allow_to_update_form')->first() ?? null ;
            @endphp
            <div class="ms-3">
                <h6 class="mb-0">{{Auth::user()->name}}</h6>
                <span>{{$role->name}}</span>
            </div>
        </div>
       
        @php 
      
        $user_managment = json_decode($allow_access->user_management);
        array_unshift($user_managment, 0);@endphp
        <div class="navbar-nav w-100">
            <a href="{{url('admin/dashboard')}}" class="nav-item nav-link active"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
            @if($user_managment[1] == 1 || $user_managment[2] == 2)
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i
                            class="fa fa-laptop me-2"></i>User Management</a>
                    <div class="dropdown-menu bg-transparent border-0">
                        @if($user_managment[1] == 1)
                            <a href="{{route('ip.create')}}" class="dropdown-item">Create</a>
                        @endif
                        @if($user_managment[2] == 2)
                            <a href="{{route('ip.list')}}" class="dropdown-item">List</a>
                        @endif
                    </div>
                </div>
            @endif

            @php $lots_management = json_decode($allow_access->lots_management);
            array_unshift($lots_management, 0);@endphp
            @php $tehsil_management = json_decode($allow_access->tehsil_management);
            array_unshift($tehsil_management, 0);@endphp
           
            @php $uc_management = json_decode($allow_access->uc_management);
                array_unshift($uc_management, 0);

            @endphp
           

            

            @php $form_management = json_decode($allow_access->form_management);
            array_unshift($form_management, 0);@endphp
            @if($form_management[1] == 31 || $form_management[2] == 32)
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i
                        class="fa fa-laptop me-2"></i>Form Management</a>
                <div class="dropdown-menu bg-transparent border-0">
                    @if($form_management[1] == 31)
                    <a href="{{route('form.create')}}" class="dropdown-item">Create</a>
                    @endif
                    @if( $form_management[2] == 32)
                    <a href="{{route('form.list')}}" class="dropdown-item">List</a>
                    @endif
                </div>
            </div>
            @endif
            @php $role_management = json_decode($allow_access->role_management);
            array_unshift($role_management, 0);@endphp
            @if($role_management[1] == 25 || $role_management[2] == 26)
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i
                            class="fa fa-laptop me-2"></i>Role Management</a>
                    <div class="dropdown-menu bg-transparent border-0">
                        @if($role_management[1] == 25)
                            <a href="{{route('role.create')}}" class="dropdown-item">Create</a>
                        @endif
                        @if($role_management[2] == 26)
                            <a href="{{route('role.list')}}" class="dropdown-item">List</a>
                        @endif
                    </div>
                </div>
            @endif
            @php $logs_management = json_decode($allow_access->logs_management);
            array_unshift($logs_management, 0);@endphp
            @if($logs_management[1] == 29)
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i
                            class="fa fa-laptop me-2"></i>Logs Management</a>
                    <div class="dropdown-menu bg-transparent border-0">
                        @if($logs_management[1] == 29)
                            {{--<a href="{{route('logs.data')}}" class="dropdown-item">List</a>--}}
                            <a href="{{route('logdatalist')}}" class="dropdown-item">List</a>
                        @endif 
                        @if(Auth::user()->role==1 || Auth::user()->role==51)
                        <a href="{{route('report')}}" class="dropdown-item">All Module Logs</a>
                        <a href="{{route('grm.filter')}}" class="dropdown-item">GRM user wise logs</a>
                        @endif
                         </div>
                </div>
            @endif
           
            
            @php 
            $pdma_management = json_decode($allow_access->pdma_management);
            array_unshift($pdma_management, 0);
            @endphp
            @if($pdma_management[1] == 47 || $pdma_management[2] == 48 || $pdma_management[3] == 49)
            <div class="nav-item dropdown">
                
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i
                            class="fa fa-laptop me-2"></i>PDNA Management</a>
                     
                    <div class="dropdown-menu bg-transparent border-0">
                         @if($pdma_management[1] == 47)
                            <a href="{{route('upload_ndma_page')}}" class="dropdown-item">Upload PDNA Data</a>
                        @endif   
                        @if($pdma_management[2] == 48)
                            <a href="{{route('pdmadatalist')}}" class="dropdown-item">View PDNA Data</a>
                        @endif
                  
                         
                         </div>
                </div>
            @endif
          
            @php 
            $finance_management = json_decode($allow_access->finance_management);
            array_unshift($finance_management, 0);
            @endphp
            @if($finance_management[1] == 54)
            <div class="nav-item dropdown">
                
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i
                            class="fa fa-laptop me-2"></i>Finance Management</a>
                     
                    <div class="dropdown-menu bg-transparent border-0">

                         @if($finance_management[1] == 54)
                             <a href="{{route('approved_ceo_damage_datalist')}}" class="dropdown-item">Approved By CEO</a>
                            <a href="{{route('withAccountDataFilter')}}" class="dropdown-item">Approved Beneficiaries With <br> Account</a>
                            <a href="{{route('beneficiaryAccountVerificationFilter')}}" class="dropdown-item"> Beneficiaries Verified  <br> Account List</a>
                            <a href="{{route('withOutAccountDataFilter')}}" class="dropdown-item">Approved Beneficiaries <br> Without Account</a>
                            <a href="{{route('upload.bank.account')}}" class="dropdown-item">Upload Beneficiaries  <br> Accounts</a>
                            <a href="{{route('beneficiaryBioMetricFilter')}}" class="dropdown-item">Beneficiaries With <br> Account (New)</a>
                            <a href="{{route('beneficiaryDisbursmentFilter')}}" class="dropdown-item">Ready For Disbursement List</a>
                            <a href="{{route('beneficiaryFirstTrenchFilter')}}" class="dropdown-item">Trench</a>
                            <a href="{{route('financeLogsFilter')}}" class="dropdown-item">Finance Logs</a>
                            @if(Auth::user()->role==48)
                            <a href="{{route('survey.hold.form')}}" class="dropdown-item">Hold List</a>
                            @endif
                        @endif
                        @if(Auth::user()->role==1  ||  Auth::user()->role==48)
                            <a href="{{route('firstTrechDatalist')}}" class="dropdown-item">Create Batch Trench</a>
                            <a href="{{route('main_batch')}}" class="dropdown-item">View Batch Trench</a>
                            <a href="{{route('wholeWithAccountData')}}" class="dropdown-item">Beneficiary Accounts linkage</a>
                        @endif
                        
                         </div>
                </div>
            @endif
            
            
            
            @if(Auth::user()->role==1 || Auth::user()->role==51 || Auth::user()->role==65 || Auth::user()->role==34 || Auth::user()->role==30)
            <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i
                            class="fa fa-laptop me-2"></i>VRC Review</a>
                    <div class="dropdown-menu bg-transparent border-0">
                            <a href="{{route('vrc.list')}}"  class="dropdown-item">VRC Formation</a>
                             @if(Auth::user()->role==1 || Auth::user()->role==34 || Auth::user()->role==30 || Auth::user()->role==51 ||  Auth::user()->role==65)
                            <a href="{{route('vrc_flow_event.filter')}}"  class="dropdown-item">VRC Trainings</a>
                             @endif
                            @if(Auth::user()->role==1 || Auth::user()->role==51 || Auth::user()->role==65)
                            <a href="{{route('vrc_designation.list')}}"  class="dropdown-item">VRC Designation</a>
                            <a href="{{route('vrc_event.list')}}"  class="dropdown-item">VRC Event</a>
                            <a href="{{route('vrc_report_filter')}}"  class="dropdown-item">VRC Member List</a>
                            @endif
                  
                         </div>
                </div>
             @endif
            @if(Auth::user()->role==1 || Auth::user()->role==51  ||   Auth::user()->role==34 || Auth::user()->role==62)
            <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i
                            class="fa fa-laptop me-2"></i>Environment Form Review</a>
                    <div class="dropdown-menu bg-transparent border-0">
                            <a href="{{route('environment.list')}}" class="dropdown-item">Environment Checklist</a>
                            <a href="{{route('environment_case.list')}}" class="dropdown-item">Environment Mitigation</a>
                         </div>
                </div>
             @endif
            @if(Auth::user()->role==1 || Auth::user()->role==51 || Auth::user()->role==34 || Auth::user()->role==61)
            <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i
                            class="fa fa-laptop me-2"></i>Gender Form Review</a>
                    <div class="dropdown-menu bg-transparent border-0">
                            <a href="{{route('gender.list')}}" class="dropdown-item">Gender Checklist </a>
                         </div>
                </div>
        
             @endif
            @if(Auth::user()->role==51 || Auth::user()->role==1 || Auth::user()->role==34 || Auth::user()->role==63)
            <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i
                            class="fa fa-laptop me-2"></i>Social Form Review</a>
                    <div class="dropdown-menu bg-transparent border-0">
                            <a href="{{route('social.list')}}" class="dropdown-item">Social Checklist </a>
                         </div>
                </div>
             @endif
            
            
             
             
             
          
         

        @if(Auth::user()->role != 56 && Auth::user()->role != 68 && Auth::user()->role != 57 && Auth::user()->role != 27 && Auth::user()->role != 64)
            <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"  ><i
                            class="fa fa-laptop me-2"></i>Validation Form Review</a>
                    <div class="dropdown-menu bg-transparent border-0">
                        @php
                        $pending_route = pending_route();
                        @endphp
            @if(Auth::user()->role == 1)    
                                <a href="{{ route($pending_route) }}" class="dropdown-item">
                                      
                                    {{ 
                                         Auth::user()->role == 1 ? 'Total List' : 
                                        (Auth::user()->role == 51 ? 'Field Supervisor Pending List' : 'Pending List') 
                                    }}
                                </a>
            @endif
           @if(Auth::user()->role == 51)
            <a href="{{route('certifyList')}}" class="dropdown-item">QA Certified List</a>
            <a href="{{route('survey.rejected.form')}}" class="dropdown-item">MNE Rejected List</a>
            <a href="{{route('survey.approved.form')}}" class="dropdown-item">MNE Approved List</a>
            <a href="{{route('approved_ceo_damage_datalist')}}" class="dropdown-item">Approved By CEO</a>
            @else
            <a href="{{route('rejected_damage_datalist')}}" class="dropdown-item">Rejected List</a> 
            @if($get_rejected_name!=null)
            <?php $role = upper_role_id_master_report(); ?>
            <a href="{{route('rejected_upper_damage_datalist')}}" class="dropdown-item">Rejected By {{ $role->name ?? '' }}</a>
            @endif
            <a href="{{route('approved_damage_datalist')}}" class="dropdown-item">{{ Auth::user()->role == 37 ? 'Certified User List' : 'Approved List'}}</a>             
            @if(Auth::user()->role==34 || Auth::user()->role==48)
           
            <a href="{{route('approved_ceo_damage_datalist')}}" class="dropdown-item">Approved By CEO</a>
            @endif
            
           @endif
            
            
            
            @if (in_array(Auth::user()->role, [38, 40, 48]))<a href="{{route('hold_damage_datalist')}}" class="dropdown-item">Hold list</a>@endif
            
            @if(Auth::user()->role!=51)
            {{--<a href="https://mis.hru.org.pk/admin/survey/pending" class="dropdown-item">Pending List</a>--}}
            <a href="{{route('pending_damage_datalist')}}" class="dropdown-item">Pending list</a>
            @endif
            @if(Auth::user()->role==1 || Auth::user()->role==30)
            <a href="{{route('missing_document_data_set')}}" class="dropdown-item">Missing Document List</a>
            <a href="{{route('total_missing_document_datalist')}}" class="dropdown-item">Overall Missing Document List</a>
            @endif
            
            @if(Auth::user()->role==1 || Auth::user()->role==38)
            <a href="{{route('missing_document_receive_list')}}" class="dropdown-item">Missing Document Receive List</a>
            @endif
            @if(Auth::user()->role==38)
            <a href="{{route('ineligible_list')}}" class="dropdown-item">Ineligible list</a>
            @endif
            
         
            
            
            
            
           
            
                         </div>
                </div>
@endif                
            
            
            @if(Auth::user()->role != 56 && Auth::user()->role != 68 && Auth::user()->role != 57 && Auth::user()->role != 27 && Auth::user()->role != 64)
                <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"  ><i
                                class="fa fa-laptop me-2"></i>Construction Form Review</a>
                        <div class="dropdown-menu bg-transparent border-0">
                          <a href="{{ route('construction.list') }}" class="dropdown-item">Total List</a>
                          @if(Auth::user()->role == 1 || Auth::user()->role == 51)
                          <a href="{{ route('delay_construction_datalist') }}" class="dropdown-item">33 Days Delay List</a>
                          @endif
                        </div>
                </div>
               @if(Auth::user()->role == 37 || Auth::user()->role == 51 || Auth::user()->role ==38 || Auth::user()->role ==40 || Auth::user()->role ==1)
                <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"  ><i
                                class="fa fa-laptop me-2"></i>Monitoring Form Review</a>
                        <div class="dropdown-menu bg-transparent border-0">
                          <a href="{{ route('mne.list') }}" class="dropdown-item">Total List</a>
                        </div>
                </div>
                @endif
                
            @if(Auth::user()->role != 56 && Auth::user()->role != 68 && Auth::user()->role != 57 && Auth::user()->role != 27 && Auth::user()->role != 64)
                <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i
                                class="fa fa-laptop me-2"></i>Change Beneficiary</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="{{route('changebeneficiary.index')}}" class="dropdown-item">Change Beneficiary List</a>
                            <a href="{{route('changebeneficiary.create')}}" class="dropdown-item">Change Beneficiary Create</a>
                        </div>
                </div>
            @endif   
             @endif   

             
             @if(Auth::user()->role == 56 || Auth::user()->role == 39 || Auth::user()->role == 1)
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>GRM Setup List</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            
                            <a href="{{route('grievance_type.index')}}" class="dropdown-item">Grievance Type List</a>
                            <a href="{{route('grievance_type.create')}}" class="dropdown-item">Grievance Type Create</a>
                            
                            <a href="{{route('piu.index')}}" class="dropdown-item">PIU List</a>
                            <a href="{{route('piu.create')}}" class="dropdown-item">PIU Create</a>
                            
                            <a href="{{route('source_channel.index')}}" class="dropdown-item">Source/Channel List</a>
                            <a href="{{route('source_channel.create')}}" class="dropdown-item">Source/Channel Create</a>
                            
                         </div>
                </div>
                @endif
                @if(Auth::user()->role==56 || Auth::user()->role==68 || Auth::user()->role==57 || Auth::user()->role==39 || Auth::user()->role==1)
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>GRM Complaint</a>
                    <div class="dropdown-menu bg-transparent border-0">
                        <a href="{{route('complaints.index')}}" class="dropdown-item">GRM Master Report</a>
                        <a href="{{route('complaints.pending')}}" class="dropdown-item">Complaint Pending List</a>
                        <a href="{{route('complaints.inprocess')}}" class="dropdown-item">Complaint In Process List</a>
                        <a href="{{route('complaints.closed')}}" class="dropdown-item">Complaint Closed List</a>
                        <a href="{{route('complaints.returned')}}" class="dropdown-item">Complaint Returned List</a>
                        <a href="{{route('complaints.forward')}}" class="dropdown-item">Complaint Forwarded List</a>
                        @if(Auth::user()->role==56 || Auth::user()->role==68 || Auth::user()->role==1)
                        <a href="{{route('complaints.exclusioncases_complaint')}}" class="dropdown-item">Exclusion Cases List</a>
                        @endif
                        <a href="{{route('complaints.create')}}" class="dropdown-item">Complaint Create</a>
                    </div>
                </div>            
                @endif
             
@if( Auth::user()->role != 567 && Auth::user()->role != 577)           
@php 
$report_management_new = json_decode($allow_access->report_management_new);
array_unshift($report_management_new, 0);
$info_graph = json_decode($allow_access->info_graph_management);
array_unshift($info_graph,0);
$chart = json_decode($allow_access->chart_management);
array_unshift($chart,0);

@endphp 
             <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i
                            class="fa fa-laptop me-2"></i>Report Management</a>
                    <div class="dropdown-menu bg-transparent border-0">
                         <ul style="list-style:none;">
                            <li><strong>Reporting</strong></li>
                        @if($report_management_new && $report_management_new[1] == 67)
                          @if(Auth::user()->role == 51)
                            <li><a href="{{route('damagefilter')}}" class="dropdown-item">MNE Multi Filter Master Report</a></li>
                          @else
                            <li><a href="{{route('report_survey_datalist')}}" class="dropdown-item">Master Report</a></li>
                          @endif    
                        @endif    
                        @if($report_management_new && $report_management_new[2] == 68)    
                            <li><a href="{{route('totalvalidatedreport.filter')}}" class="dropdown-item">Total / Validated Data</a></li>
                        @endif    
                        @if($report_management_new && $report_management_new[3] == 69)    
                            <li><a href="{{route('functional_limitation_report.filtertwo')}}" class="dropdown-item">Functional Limitation Report</a></li>
                            {{--<li><a href="{{route('report_survey_customdatalist')}}" class="dropdown-item">Functional Limitation Report OLD</a></li>--}}
                        @endif    
                        @if($report_management_new && $report_management_new[4] == 70)    
                            <li><a href="{{route('master_report_summary')}}" target="_blank" class="dropdown-item">Master Report Summary</a></li>
                        @endif    
                        @if($report_management_new && $report_management_new[5] == 71)    
                            <li><a href="{{route('weekly_summary_report')}}" target="_blank" class="dropdown-item">{{ Auth::user()->role === 64 ? 'District Wise Report' : 'Weekly Summary Report' }}</a></li>
                            <li><a href="{{route('weekly_summary_report_finishing_completed')}}" target="_blank" class="dropdown-item">{{ Auth::user()->role === 64 ? 'District Wise Report Finishing Completed' : 'Weekly Summary Report Finishing Completed' }}</a></li>
                            
                           <li><a href="{{ route('summary_report_allstages') }}" target="_blank" class="dropdown-item">District Wise Summary Report All Stages</a></li>
                            {{--
                            <li><a href="{{ route('report_summary_stagewise', 1) }}" target="_blank" class="dropdown-item">District Wise Summary Report Stage 1</a></li>
                            <li><a href="{{ route('report_summary_stagewise', 2) }}" target="_blank" class="dropdown-item">District Wise Summary Report Stage 2</a></li>
                            <li><a href="{{ route('report_summary_stagewise', 3) }}" target="_blank" class="dropdown-item">District Wise Summary Report Stage 3</a></li>
                            <li><a href="{{ route('report_summary_stagewise', 4) }}" target="_blank" class="dropdown-item">District Wise Summary Report Stage 4</a></li>
                            --}} 
                           
                        @endif
                        @if(Auth::user()->role == 1)
                            <li><a href="{{ route('coordinate.filter') }}" target="_blank" class="dropdown-item">Report Construction Coordinates</a></li>
                            @endif
                        </ul>
                        <hr />
                        @if(Auth::user()->role != 30 || Auth::user()->role != 34)
                        <ul style="list-style:none;">
                            <li><strong>Dashboards</strong></li>
                            <li><a href="{{route('admin.dashboard.validation')}}" class="dropdown-item">Validation</a></li>
                            <li><a href="{{route('admin.dashboard.finance')}}" class="dropdown-item">Finance</a></li>
                            <li><a href="{{route('admin.dashboard.construction')}}" class="dropdown-item">Construction</a></li>
                            <li><a href="{{route('admin.dashboard.drr')}}" class="dropdown-item">DRR</a></li>
                            <li><a href="{{route('admin.dashboard.vrc')}}" class="dropdown-item">VRC</a></li>
                            <li><a href="{{route('admin.dashboard.grm')}}" class="dropdown-item">GRM</a></li>
                        </ul>
                        @endif
                         <hr />
                        <ul style="list-style:none;">
                            <li><strong>Info Graphs</strong></li>
                        @if($info_graph && $info_graph[1] == 72) 
                            <li><a href="{{route('damage_assessment_form')}}" class="dropdown-item">Damage Assessment Form</a></li>
                        @endif
                        @if($info_graph && $info_graph[2] == 73) 
                            <li><a href="{{route('hru_users')}}" class="dropdown-item">HRU Users</a></li>
                        @endif
                        @if($info_graph && $info_graph[3] == 74) 
                            <li><a href="{{route('mne_comments')}}" class="dropdown-item">MNE Comments</a></li>
                        @endif
                        @if($info_graph && $info_graph[4] == 75) 
                            <li><a href="{{route('accounts_already_opened_verified')}}" class="dropdown-item">Accounts Already Opened / Verified</a></li>
                        @endif
                        @if($info_graph && $info_graph[5] == 76) 
                            <li><a href="{{route('accounts_opening_biometric')}}" class="dropdown-item">Accounts opening / Biometric</a></li>
                        @endif
                        @if($info_graph && $info_graph[6] == 77) 
                            <li><a href="{{route('tranches')}}" class="dropdown-item">Tranches</a></li>
                        @endif
                        @if($info_graph && $info_graph[7] == 78) 
                            <li><a href="{{route('construction_stage_wise')}}" class="dropdown-item">Construction Stage Wise</a></li>
                        @endif
                        @if($info_graph && $info_graph[8] == 79) 
                            <li><a href="{{route('vrc_formation')}}" class="dropdown-item">VRC Formation</a></li>
                        @endif
                        @if($info_graph && $info_graph[8] == 80) 
                            <li><a href="{{route('trainings')}}" class="dropdown-item">Trainings</a></li>
                        @endif
                        </ul>
                        
                        <hr />
                        <ul style="list-style:none;">
                            <li><strong>Charts</strong></li>
                        @if($chart && $chart[1] == 81)    
                            <li><a href="{{url('uchart/genderWiseData')}}" target='_blank' class="dropdown-item">Gender Wise</a></li>
                        @endif
                        @if($chart && $chart[2] == 82)    
                            <li><a href="{{url('uchart/bankWiseDataBarChart')}}" target='_blank' class="dropdown-item">Bank Wise</a></li>
                        @endif
                        @if($chart && $chart[3] == 83)    
                            <li><a href="{{url('uchart/tenantWiseData')}}" target='_blank' class="dropdown-item">Tenant Wise</a></li>
                        @endif
                        @if($chart && $chart[4] == 84)    
                            <li><a href="{{url('uchart/constructionTypeData')}}" target='_blank' class="dropdown-item">Construction Wise</a></li>
                        @endif
                        @if($chart && $chart[5] == 85)    
                            <li><a href="{{url('uchart/houseVisible')}}" target='_blank' class="dropdown-item">House Visible Wise</a></li>
                        @endif
                        @if($chart && $chart[6] == 86)    
                            <li><a href="{{url('uchart/salaryWiseData')}}" target='_blank' class="dropdown-item">Salary Wise</a></li>
                        @endif
                        @if($chart && $chart[7] == 87)    
                            <li><a href="{{url('uchart/surveyReport86')}}" target='_blank' class="dropdown-item">Profession Wise</a></li>
                        @endif
                        @if($chart && $chart[8] == 88)    
                            <li><a href="{{url('uchart/damageRoomWiseData')}}" target='_blank' class="dropdown-item">Dammage Room Wise</a></li>
                        @endif
                        @if($chart && $chart[9] == 89)    
                            <li><a href="{{url('uchart/reconstructionStarted')}}" target='_blank' class="dropdown-item">Reconstruction Wise</a></li>
                        @endif
                        @if($chart && $chart[10] == 90)    
                            <li><a href="{{url('uchart/constructionStage')}}" target='_blank' class="dropdown-item">Construction Stage Wise</a></li>
                        @endif
                        @if($chart && $chart[11] == 91)    
                            <li><a href="{{url('uchart/houseFullFill')}}" target='_blank' class="dropdown-item">House Wise</a></li>
                        @endif
                        @if($chart && $chart[12] == 92)    
                            <li><a href="{{url('uchart/ownershipOfLand')}}" target='_blank' class="dropdown-item">Owner Ship Wise</a></li>
                        @endif
                        @if($chart && $chart[13] == 93)    
                            <li><a href="{{url('uchart/statusOfLand')}}" target='_blank' class="dropdown-item">Land Status Wise</a></li>
                        @endif
                        @if($chart && $chart[14] == 94)    
                            <li><a href="{{url('uchart/evidenceType')}}" target='_blank' class="dropdown-item">Evidence Type</a></li>
                        @endif
                        </ul>
                         </div>
    
                </div>
                
         
    
    
@php $bank_management = json_decode($allow_access->bank_management);
array_unshift($bank_management, 0);@endphp

@endif  
<!--GRM NOT Exist-->             
             
             
             
@if(Auth::user()->role==1)             
<div class="nav-item dropdown">
    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="fa fa-laptop me-2"></i> Administrative Tools 
    </a>
    <ul class="dropdown-menu bg-transparent border-0"  aria-labelledby="dropdownMenuButton">
    @php 
        $district_management = json_decode($allow_access->district_management);
        array_unshift($district_management, 0);
    @endphp
     @if($district_management[1] == 9 || $district_management[2] == 10)
    <li class="dropdown-submenu">
        <a href="#" class="dropdown-item dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            District Management 
        </a>
        <ul class="dropdown-menu ">
            @if($district_management[1] == 9)
            <li><a href="{{route('district.list')}}" class="dropdown-item">List</a></li>
            @endif
            @if($district_management[2] == 10)
            <li><a href="{{route('district.create')}}" class="dropdown-item">Create</a></li>
            @endif
        </ul>
    </li>
    @endif
    <li class="dropdown-submenu">
        <a href="#" class="dropdown-item dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            PDNA Management 
        </a>
        <ul class="dropdown-menu ">
                @if(Auth::user()->role==1)
                <a href="{{route('editPDMA')}}" class="dropdown-item">Edit PDNA Data</a>
                @endif
                           
        </ul>
    </li>
    
    <!--tehsil-->
    
     @if($tehsil_management[1] == 13 || $tehsil_management[2] == 14)
    <li class="dropdown-submenu">
        <a href="#" class="dropdown-item dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            Tehsil Management
        </a>
        <ul class="dropdown-menu ">
             @if($tehsil_management[1] == 13)
            <li><a href="{{route('tehsil.list')}}" class="dropdown-item">List</a></li>
            @endif
            @if($tehsil_management[2] == 14)
            <li><a href="{{route('tehsil.create')}}" class="dropdown-item">Create</a></li>
            @endif
        </ul>
    </li>
    @endif
    
    <!--uc-->
    
    
    @if($uc_management[1] == 17 || $uc_management[2] == 18)
    <li class="dropdown-submenu">
        <a href="#" class="dropdown-item dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            UC Management
        </a>
        <ul class="dropdown-menu ">
             @if($uc_management[1] == 17)
            <li><a href="{{route('uc.list')}}" class="dropdown-item">List</a></li>
            @endif
            @if($uc_management[2] == 18)
            <li><a href="{{route('uc.create')}}" class="dropdown-item">Create</a></li>
            @endif
        </ul>
    </li>
    @endif
    <!--Lot-->
    
    @if($lots_management[1] == 5 || $lots_management[2] == 6)
    <li class="dropdown-submenu">
        <a href="#" class="dropdown-item dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            Lot Management
        </a>
        <ul class="dropdown-menu ">
               @if($lots_management[2] == 6)
            <li><a href="{{route('lot.list')}}" class="dropdown-item">List</a></li>
            @endif
             @if($lots_management[1] == 5)
            <li><a href="{{route('lot.create')}}" class="dropdown-item">Create</a></li>
            @endif
        </ul>
    </li>
    @endif
    
    <!--bank management-->
    
    @if($bank_management[1] == 65 || $bank_management[2] == 66)
    <li class="dropdown-submenu">
        <a href="#" class="dropdown-item dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            Bank Management
        </a>
        <ul class="dropdown-menu ">
             @if($bank_management[1] == 65)
            <li><a href="{{route('bank.list')}}" class="dropdown-item">List</a></li>
            @endif
            @if($bank_management[2] == 66)
            <li><a href="{{route('bank.create')}}" class="dropdown-item">Create</a></li>
            @endif
        </ul>
    </li>
    @endif
    
    

    
    
    @if(Auth::user()->role==1)
        <!--section-->
    <li class="dropdown-submenu">
        <a href="#" class="dropdown-item dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            Section Management
        </a>
        <ul class="dropdown-menu ">
            <li><a href="{{route('section.list')}}" class="dropdown-item">List</a></li>
            <li><a href="{{route('section.create')}}" class="dropdown-item">Create</a></li>
          
        </ul>
    </li>
    <li class="dropdown-submenu">
        <a href="#" class="dropdown-item dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            Designation Management
        </a>
        <ul class="dropdown-menu ">
            <li><a href="{{route('designation.list')}}" class="dropdown-item">List</a></li>
            <li><a href="{{route('designation.create')}}" class="dropdown-item">Create</a></li>
          
        </ul>
    </li>
    @endif
    


       
    </ul>
</div>
@endif               
            
        </div>
    </nav>
</div>