<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH . '/libraries/BaseController.php';
require APPPATH . '/libraries/Statistics.php';

class Main extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('login_model');
        $this->load->model('main_model');
        $this->global['notification'] = $this->main_model->getNotification($this->session->userdata('role'));
    }   
    
    /**
     * Index Page for this controller.
     */
    public function index()
    {
        $this->isLoggedIn();
    }

    public function approveEventDescription(){
        $this->global['id'] =$this->input->get('id');
        $this->global['name'] =$this->session->userdata('name');
        $this->global['role'] =$this->session->userdata('role');
        $this->global['role_text'] =$this->session->userdata('role');
        $this->global['pageTitle'] = 'MEWU: Assign';
        $this->loadViews("admin/eventAddDescription", $this->global, NULL, NULL);
    }

    public function approveEventRequests(){
        $id = $this->input->post('id');
        $description = $this->input->post('description');
        $this->main_model->approveEventRequests($id,$description);
        $this->main_model->eventNotify($id);
        $this->session->set_flashdata('success','successfully');
        redirect(base_url().'user/viewEventRequest');
    }

    public function approveEventDescriptionDisapprove(){
        $this->global['id'] =$this->input->get('id');
        $this->global['name'] =$this->session->userdata('name');
        $this->global['role'] =$this->session->userdata('role');
        $this->global['role_text'] =$this->session->userdata('role');
        $this->global['pageTitle'] = 'MEWU: Assign';
        $this->loadViews("admin/eventAddDescriptionDisapprove", $this->global, NULL, NULL);
    }

     public function disapproveEventRequests(){
        $id = $this->input->post('id');
        $description = $this->input->post('description');
        $this->main_model->disapproveEventRequests($id,$description);
        $this->main_model->eventNotify($id);
        $this->session->set_flashdata('error','successfully Disapprove');
        redirect(base_url().'user/viewEventRequest');
    }

    public function approveJobRequests(){
        $id = $this->input->post('id');
        $date_actual = $this->input->post('date_actual');
        $description = $this->input->post('description');
        $personel = $this->input->post('personel');
        if($date_actual <= date('Y-m-d H:i:s')){
            $this->session->set_flashdata('error', 'Input Right Date');
             redirect(base_url().'main/assignJobRequests');
         }else{
            $this->main_model->approveJobRequests($id,$personel,$date_actual,$description);
            $this->main_model->jobRequestNotify($id,$personel);
            $this->session->set_flashdata('success', 'Successfull Assign');
            redirect(base_url().'main/assignJobRequests');
         }
    }

     public function disapproveJobDescriptionDisapprove(){
        $this->global['id'] =$this->input->get('id');
        $this->global['name'] =$this->session->userdata('name');
        $this->global['role'] =$this->session->userdata('role');
        $this->global['role_text'] =$this->session->userdata('role');
        $this->global['pageTitle'] = 'MEWU: Assign';
        $this->loadViews("admin/jobAddDescriptionDis", $this->global, NULL, NULL);
    }

     public function disapproveJobRequests(){
        $id = $this->input->post('id');
        $description = $this->input->post('description');
        $this->main_model->disapproveJobRequests($id,$description);
        $this->main_model->jobRequestNotify($id,NULL);
        $this->session->set_flashdata('error', 'Input Right Date');
        redirect(base_url().'user/viewRepairRequest');
    }

    public function assignJobRequests(){
        $this->global['id'] =$this->input->get('id');
        $this->global['name'] =$this->session->userdata('name');
        $this->global['role'] =$this->session->userdata('role');
        $this->global['role_text'] =$this->session->userdata('role');
        $this->global['pageTitle'] = 'MEWU: Assign';
        $this->global['option'] = $this->main_model->getMaintenanceStaff();
        $this->loadViews("admin/assignPersonJobRequest", $this->global, NULL, NULL);
    }
    
    public function viewAddNewEquipment(){

        $this->load->model('user_model');
        $this->global['name'] =$this->session->userdata('name');
        $this->global['role'] =$this->session->userdata('role');
        $this->global['role_text'] =$this->session->userdata('role');
        $this->global['pageTitle'] = 'MEWU : Dashboard';
        $this->loadViews("admin/addEquipment", $this->global, NULL, NULL);
    }

    public function viewAddNewHistory(){

        $this->load->model('user_model');
        $this->global['name'] =$this->session->userdata('name');
        $this->global['role'] =$this->session->userdata('role');
        $this->global['role_text'] =$this->session->userdata('role');
        $this->global['pageTitle'] = 'MEWU : Dashboard';
        $this->loadViews("maintenance/addHistory", $this->global, NULL, NULL);
    }

    public function viewAddJobRequest(){
        $data['option']=$this->main_model->getLocation();
        $this->global['name'] =$this->session->userdata('name');
        $this->global['role'] =$this->session->userdata('role');
        $this->global['role_text'] =$this->session->userdata('role_text');
        $this->global['pageTitle'] = 'MEWU : Add Repair Request';
        $this->loadViews("jobRequest", $this->global, $data, NULL);
    }

    public function viewAddJobRequestEdit(){
        
        $id = $this->input->get('id');
        $data['data'] = $this->main_model->getJobRequestData($id);
        $this->global['name'] =$this->session->userdata('name');
        $this->global['role'] =$this->session->userdata('role');
        $this->global['role_text'] =$this->session->userdata('role_text');
        $this->global['pageTitle'] = 'MEWU : Edit Repair Info';
        $this->loadViews("jobRequestEdit", $this->global, $data, NULL);
    }

    public function viewAddNewVenue(){

        $this->global['name'] =$this->session->userdata('name');
        $this->global['role'] =$this->session->userdata('role');
        $this->global['role_text'] =$this->session->userdata('role_text');
        $this->global['pageTitle'] = 'MEWU : Add New Venue';
        $this->loadViews("admin/addVenue", $this->global, NULL, NULL);
    }

    public function viewAddNewDepartment(){

        $this->global['name'] =$this->session->userdata('name');
        $this->global['role'] =$this->session->userdata('role');
        $this->global['role_text'] =$this->session->userdata('role_text');
        $this->global['pageTitle'] = 'MEWU : Add New Department';
        $this->loadViews("admin/addDepartment", $this->global, NULL, NULL);
    }

    public function viewAddNewLocation(){

        $this->global['name'] =$this->session->userdata('name');
        $this->global['role'] =$this->session->userdata('role');
        $this->global['role_text'] =$this->session->userdata('role_text');
        $this->global['pageTitle'] = 'MEWU : Add New Location';
        $this->loadViews("admin/addLocation", $this->global, NULL, NULL);
    }

    public function viewAddNewEventEquipment(){

        $this->global['name'] =$this->session->userdata('name');
        $this->global['role'] =$this->session->userdata('role');
        $this->global['role_text'] =$this->session->userdata('role_text');
        $this->global['pageTitle'] = 'MEWU : Add New Venue';
        $this->loadViews("admin/addEventEquipment", $this->global, NULL, NULL);
    }

    public function viewAddNewEventRequest(){

        $this->load->model('main_model');
        $data['equipment']=$this->main_model->getEventEquipment();
        $data['venuedata']=$this->main_model->getVenue();
        $data['option']=$this->main_model->getDepartment();
        $this->global['name'] =$this->session->userdata('name');
        $this->global['role'] =$this->session->userdata('role');
        $this->global['role_text'] =$this->session->userdata('role_text');
        $this->global['pageTitle'] = 'MEWU : Add New Venue';
        $this->loadViews("addEventRequest", $this->global, $data, NULL);
    }

    public function viewAddNewJobRequest(){

        $this->load->model('main_model');
        $data['option']=$this->main_model->getLocation();
        $this->global['name'] =$this->session->userdata('name');
        $this->global['role'] =$this->session->userdata('role');
        $this->global['role_text'] =$this->session->userdata('role_text');
        $this->global['pageTitle'] = 'MEWU : Add New Venue';
        $this->loadViews("jobRequest", $this->global, $data, NULL);
    }

    public function viewEventSchedule(){

       
        $this->global['name'] =$this->session->userdata('name');
        $this->global['role'] =$this->session->userdata('role');
        $this->global['role_text'] =$this->session->userdata('role_text');
        $this->global['pageTitle'] = 'MEWU : Add New Department';
        $this->loadViews("viewEventSchedule", $this->global, NULL, NULL);
    }
    public function viewForecast(){
        $data = $this->main_model->get_data()->result();
        $this->global['data'] = json_encode($data);
        $this->global['name'] =$this->session->userdata('name');
        $this->global['role'] =$this->session->userdata('role');
        $this->global['role_text'] =$this->session->userdata('role_text');
        $this->global['pageTitle'] = 'MEWU : Forecast';
        $this->loadViews("admin/viewForecast", $this->global, NULL, NULL);
    }

    public function viewForecastStatic(){
        $data = $this->main_model->get_data()->result();
        $this->global['data'] = json_encode($data);
        $this->global['name'] =$this->session->userdata('name');
        $this->global['role'] =$this->session->userdata('role');
        $this->global['role_text'] =$this->session->userdata('role_text');
        $this->global['pageTitle'] = 'MEWU : Forecast';
        $this->loadViews("admin/viewForecastStatic", $this->global, NULL, NULL);
    }

    public function venueInsert(){

        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('session');
        
        // set validation rules
        $this->form_validation->set_rules('RoomNo', 'RoomNo', 'required|alpha_numeric');
        $this->form_validation->set_rules('name', 'name', 'required');
        $this->form_validation->set_rules('type', 'type', 'required');
        
        if ($this->form_validation->run() == false) {
            
            $this->viewAddNewVenue();
            
            } else {
                
                $this->load->model('main_model');
            
            $data = array(  
                'bldgNo' => $this->input->post('RoomNo'),
                'name' => $this->input->post('name'),
                'type' => $this->input->post('type')
            );  

            $this->main_model->venueInsert($data);
            redirect('/viewVenue'); 
            }
    }

    public function departmentInsert(){

        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('session');
        
        // set validation rules
        $this->form_validation->set_rules('acroname', 'acroname', 'required|alpha_numeric');
        $this->form_validation->set_rules('name', 'name', 'required');
        
        if ($this->form_validation->run() == false) {
            
            $this->viewAddNewDepartment();
            
            } else {
                
                $this->load->model('main_model');
            
            $data = array(  
                'acroname' => $this->input->post('acroname'),
                'name' => $this->input->post('name'),
            );  

            $this->main_model->departmentInsert($data);
            $this->viewAddNewDepartment();
            // redirect('/viewDepartment');   
            }
    }

    public function locationInsert(){

        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('session');
        
        // set validation rules
        $this->form_validation->set_rules('bldgNo', 'bldgNo', 'required');
        
        if ($this->form_validation->run() == false) {
            
            $this->viewAddNewLocation();
            
            } else {
                
                $this->load->model('main_model');
            
            $data = array(  
                
                'bldgNo' => $this->input->post('bldgNo'),
                'roomNo' => $this->input->post('roomNo'),
                'name' => $this->input->post('name'),
            );  

            $this->main_model->locationInsert($data);
            // $this->viewAddNewLocation();
            redirect('User/viewLocation');   
            }
    }

    public function equipmentInsert(){

        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('session');
        
        // set validation rules
        
        $this->form_validation->set_rules('equipName', 'Name', 'required');
        

        
        if ($this->form_validation->run() == false) {
            
            $this->viewAddNewEquipment();
            
            } else {
                
                $this->load->model('main_model');
            
            $data = array(  
                'equipName' => $this->input->post('equipName'),
                'brand' => $this->input->post('brand'),
                'model' => $this->input->post('model'),
                'serialNo' => $this->input->post('serialNo'),
                'office' => $this->input->post('office'),
                'department' => $this->input->post('department'),
                'type' => $this->input->post('type'),
                'yearAcc' => $this->input->post('yearAcc')
            );  
            $this->main_model->equipmentInsert($data);
            $this->viewAddNewEquipment();
            // redirect('/viewDepartment');   
            }
    }

    public function adminEventEquipmentInsert(){

        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('session');
        
        // set validation rules
        
        $this->form_validation->set_rules('name', 'Name', 'required');
        

        
        if ($this->form_validation->run() == false) {
            
            $this->viewAddNewEventEquipment();
            
            } else {
                
                $this->load->model('main_model');
            
            $data = array(  
                'name' => $this->input->post('name'),
                'type' => $this->input->post('type'),
                
            );  

            $this->main_model->adminEventEquipmentInsert($data);
            $this->session->set_flashdata('success')  ;
            $this->viewAddNewEventEquipment();
            // redirect('/viewDepartment');   
            }
    }

    public function eventRequestInsert(){

        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('session');
        
        // set validation rules
        
        $dateActual = $this->input->post('dateActual');
        $timeActual = $this->input->post('timeActual');
        $dateEnd = $this->input->post('dateEnd');
        $timeEnd = $this->input->post('timeEnd');
        $venueID = $this->input->post('venue');
        $validate = $this->main_model->validateRequest($dateActual,$timeActual,$dateEnd,$timeEnd,$venueID);
        $this->form_validation->set_rules('tittleEvent', 'Tittle', 'required');

        
        if ($this->form_validation->run() == false || $this->input->post('dateActual') < date('Y-m-d H:i:s') || $validate == FALSE) {
            
            // $this->viewAddNewEventRequest();
            
            if($validate == FALSE){
                $this->session->set_flashdata('error', 'Occupied Time and Date For Event');
            }else{
                $this->session->set_flashdata('error', 'Input Right Date');
            }
            
            redirect(base_url().'main/viewAddNewEventRequest');
           
            
            } else {
            // $venue = $this->input->post('venue[]');
            $equipment = $this->input->post('equipment[]');
            //echo var_dump($venue);
           
            $tableNo = $this->input->post('tableNo');
            $chairNo = $this->input->post('chairNo');
            $data = array(  
                'noParticipant' => $this->input->post('noParticipant'),
                'dateActual' => $this->input->post('dateActual'),
                'timeActual' => $this->input->post('timeActual'),
                'dateEnd' => $this->input->post('dateEnd'),
                'timeEnd' => $this->input->post('timeEnd'),
                'purpose' => $this->input->post('purpose'),
                'tittleEvent' => $this->input->post('tittleEvent'),
                'status' => 'pending',
                'contactNo' => $this->input->post('contactNo'),
                'venueID' => $this->input->post('venue'),
                'departmentID' => $this->input->post('department'),
                'resBy' => $this->session->userdata('userId')
            );  
            $this->main_model->eventRequestInsert($data);
            $lastId = $this->main_model->getLastId();
            // $this->main_model->eventVenueInsert($lastId,$venue);
            $this->main_model->eventEquipmentInsert($lastId,$equipment,$tableNo,$chairNo);
            $this->viewAddNewEventRequest();
            // redirect('/viewDepartment');   
            }
    }

    public function jobRequestInsert(){

        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('session');
        
        // set validation rules
        $this->form_validation->set_rules('itemNo', 'Item Number', 'required|alpha_numeric');
        $this->form_validation->set_rules('description', 'Description', 'required');
        
        if ($this->form_validation->run() == false) {
            
            $this->viewAddNewJobRequest();
            
            } else {
                
                $this->load->model('main_model');
            
            $data = array(  
                'itemNo' => $this->input->post('itemNo'),
                'workDescript' => $this->input->post('description'),
                'location' => $this->input->post('location'),
                'resBy' => $this->session->userdata('userId'),
                'remark' => 'pending'

            );  

            $this->main_model->jobRequestInsert($data);
            redirect('main/jobRequestInsert'); 
            }
    }

    public function jobRequestUpdate(){
        $jobId = $this->input->post('jobId');
        $remark = $this->input->post('remark');
        $dateTimeEnd = $this->input->post('dateTimeEnd');
        $this->main_model->jobRequestUpdate($jobId,$dateTimeEnd,$remark);
        $result = $this->main_model->jobRequestUpdate($jobId,$dateTimeEnd,$remark);
        if($result == true)
        {
            $this->session->set_flashdata('success', 'User updated successfully');
        }
        else
        {
            $this->session->set_flashdata('error', 'User updation failed');
        }
        redirect(base_url().'user/viewMySchedule');
    }

     public function historyInsert(){

        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('session');
        
        // set validation rules
        
        $this->form_validation->set_rules('dateReq', 'dateReq', 'required');
        

        
        if ($this->form_validation->run() == false) {
            
            $this->historyInsert();
            
            } else {

            $data = array(  
                'dateReq' => $this->input->post('dateReq'),
                'description' => $this->input->post('description'),
                'partRep' => $this->input->post('partRep'),
                'dateRep' => $this->input->post('dateRep'),
                'timeRep' => $this->input->post('timeRep'),
                'datefin' => 'datefin',
                'remark' => $this->input->post('remark'),
                'performedBy' => $this->input->post('performedBy'),
            );  
            $this->main_model->historyInsert($data);
            redirect('maintenance/addHistory');   
            }
    }

    function viewStudentAllRequest()
    {

            $id = $this->session->userdata('userId');
           
            $searchText = $this->security->xss_clean($this->input->post('searchText'));
            $data['searchText'] = $searchText;
            
            $this->load->library('pagination');
            
            $count = $this->main_model->viewStudentRequestsCounts($searchText);

            $returns = $this->paginationCompress ("student/viewStudentRequests", $count, 10 );
            
            $data['userRecords'] = $this->main_model->viewStudentRequests($searchText, $returns["page"], $returns["segment"],$id);
            
            $this->global['pageTitle'] = 'MEWU : View Event Request';
            $this->global['name'] =$this->session->userdata('name');
            $this->global['role'] =$this->session->userdata('role');
            $this->global['role_text'] =$this->session->userdata('role_text');
            
            $this->loadViews("student/viewStudentRequests", $this->global, $data, NULL);
        
    }

    function viewStudentApproveRequest()
    {

            $id = $this->session->userdata('userId');
           
            $searchText = $this->security->xss_clean($this->input->post('searchText'));
            $data['searchText'] = $searchText;
            
            $this->load->library('pagination');
            
            $count = $this->main_model->viewStudentApproveRequestsCounts($searchText);

            $returns = $this->paginationCompress ("student/viewStudentRequests", $count, 10 );
            
            $data['userRecords'] = $this->main_model->viewStudentApproveRequests($searchText, $returns["page"], $returns["segment"],$id);
            
            $this->global['pageTitle'] = 'MEWU : View Event Request';
            $this->global['name'] =$this->session->userdata('name');
            $this->global['role'] =$this->session->userdata('role');
            $this->global['role_text'] =$this->session->userdata('role_text');
            
            $this->loadViews("student/viewStudentRequests", $this->global, $data, NULL);
        
    }

    function viewStudentPendingRequest()
    {

            $id = $this->session->userdata('userId');
           
            $searchText = $this->security->xss_clean($this->input->post('searchText'));
            $data['searchText'] = $searchText;
            
            $this->load->library('pagination');
            
            $count = $this->main_model->viewStudentPendingRequestsCounts($searchText);

            $returns = $this->paginationCompress ("student/viewStudentRequests", $count, 10 );
            
            $data['userRecords'] = $this->main_model->viewStudentPendingRequests($searchText, $returns["page"], $returns["segment"],$id);
            
            $this->global['pageTitle'] = 'MEWU : View Event Request';
            $this->global['name'] =$this->session->userdata('name');
            $this->global['role'] =$this->session->userdata('role');
            $this->global['role_text'] =$this->session->userdata('role_text');
            
            $this->loadViews("student/viewStudentRequests", $this->global, $data, NULL);
        
    }

    function viewStudentDeclineRequest()
    {

            $id = $this->session->userdata('userId');
           
            $searchText = $this->security->xss_clean($this->input->post('searchText'));
            $data['searchText'] = $searchText;
            
            $this->load->library('pagination');
            
            $count = $this->main_model->viewStudentDeclineRequestsCounts($searchText);

            $returns = $this->paginationCompress ("student/viewStudentRequests", $count, 10 );
            
            $data['userRecords'] = $this->main_model->viewStudentDeclineRequests($searchText, $returns["page"], $returns["segment"],$id);
            
            $this->global['pageTitle'] = 'MEWU : View Event Request';
            $this->global['name'] =$this->session->userdata('name');
            $this->global['role'] =$this->session->userdata('role');
            $this->global['role_text'] =$this->session->userdata('role_text');
            
            $this->loadViews("student/viewStudentRequests", $this->global, $data, NULL);
        
    }

    function viewRepairAllRequests()
    {

            $id = $this->session->userdata('userId');
           
            $searchText = $this->security->xss_clean($this->input->post('searchText'));
            $data['searchText'] = $searchText;
            
            $this->load->library('pagination');
            
            $count = $this->main_model->viewRepairRequestCounts($searchText);

            $returns = $this->paginationCompress ("staff/viewEventRequest", $count, 10 );
            
            $data['userRecords'] = $this->main_model->viewRepairRequests($searchText, $returns["page"], $returns["segment"],$id);
            
            $this->global['pageTitle'] = 'MEWU : View Event Request';
            $this->global['name'] =$this->session->userdata('name');
            $this->global['role'] =$this->session->userdata('role');
            $this->global['role_text'] =$this->session->userdata('role_text');
            
            $this->loadViews("staff/viewRepairRequests", $this->global, $data, NULL);
        
    }

    function viewRepairtPendingRequest()
    {

            $id = $this->session->userdata('userId');
           
            $searchText = $this->security->xss_clean($this->input->post('searchText'));
            $data['searchText'] = $searchText;
            
            $this->load->library('pagination');
            
            $count = $this->main_model->viewRepairPendingRequestCounts($searchText);

            $returns = $this->paginationCompress ("staff/viewRepairRequest", $count, 10 );
            
            $data['userRecords'] = $this->main_model->viewRepairPendingRequests($searchText, $returns["page"], $returns["segment"],$id);
            
            $this->global['pageTitle'] = 'MEWU : View Event Request';
            $this->global['name'] =$this->session->userdata('name');
            $this->global['role'] =$this->session->userdata('role');
            $this->global['role_text'] =$this->session->userdata('role_text');
            
            $this->loadViews("staff/viewRepairRequests", $this->global, $data, NULL);
        
    }

    function viewRepairApproveRequest()
    {

            $id = $this->session->userdata('userId');
           
            $searchText = $this->security->xss_clean($this->input->post('searchText'));
            $data['searchText'] = $searchText;
            
            $this->load->library('pagination');
            
            $count = $this->main_model->viewRepairApproveRequestCounts($searchText);

            $returns = $this->paginationCompress ("staff/viewRepairRequest", $count, 10 );
            
            $data['userRecords'] = $this->main_model->viewRepairApproveRequests($searchText, $returns["page"], $returns["segment"],$id);
            
            $this->global['pageTitle'] = 'MEWU : View Event Request';
            $this->global['name'] =$this->session->userdata('name');
            $this->global['role'] =$this->session->userdata('role');
            $this->global['role_text'] =$this->session->userdata('role_text');
            
            $this->loadViews("staff/viewRepairRequests", $this->global, $data, NULL);
        
    }

    function viewRepairDeclineRequest()
    {

            $id = $this->session->userdata('userId');
           
            $searchText = $this->security->xss_clean($this->input->post('searchText'));
            $data['searchText'] = $searchText;
            
            $this->load->library('pagination');
            
            $count = $this->main_model->viewRepairDeclineRequestCounts($searchText);

            $returns = $this->paginationCompress ("staff/viewRepairRequest", $count, 10 );
            
            $data['userRecords'] = $this->main_model->viewRepairDeclineRequests($searchText, $returns["page"], $returns["segment"],$id);
            
            $this->global['pageTitle'] = 'MEWU : View Event Request';
            $this->global['name'] =$this->session->userdata('name');
            $this->global['role'] =$this->session->userdata('role');
            $this->global['role_text'] =$this->session->userdata('role_text');
            
            $this->loadViews("staff/viewRepairRequests", $this->global, $data, NULL);
        
    }

    function viewRepairFinishedRequest()
    {

            $id = $this->session->userdata('userId');
           
            $searchText = $this->security->xss_clean($this->input->post('searchText'));
            $data['searchText'] = $searchText;
            
            $this->load->library('pagination');
            
            $count = $this->main_model->viewRepairFinishedRequestCounts($searchText);

            $returns = $this->paginationCompress ("staff/viewRepairRequest", $count, 10 );
            
            $data['userRecords'] = $this->main_model->viewRepairFinishedRequests($searchText, $returns["page"], $returns["segment"],$id);
            
            $this->global['pageTitle'] = 'MEWU : View Event Request';
            $this->global['name'] =$this->session->userdata('name');
            $this->global['role'] =$this->session->userdata('role');
            $this->global['role_text'] =$this->session->userdata('role_text');
            
            $this->loadViews("staff/viewRepairRequests", $this->global, $data, NULL);
        
    }


    

}

?>