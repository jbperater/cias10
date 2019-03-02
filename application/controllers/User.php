<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';


class User extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('main_model');
        $this->isLoggedIn();   
         $this->global['notification'] =$this->main_model->getNotification($this->session->userdata('role'));
    }
    
    /**
     * This function used to load the first screen of the user
     */
    public function index()
    {
        $this->global['pageTitle'] = 'MEWU : Dashboard';
        $this->global['notification'] = $this->main_model->getNotification($this->session->userdata('role'));
        $this->loadViews("dashboard", $this->global, NULL , NULL);
    }
    
    /**
     * This function is used to load the user list
     */
    function userListing()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {        
            $searchText = $this->security->xss_clean($this->input->post('searchText'));
            $data['searchText'] = $searchText;
            
            $this->load->library('pagination');
            
            $count = $this->user_model->userListingCount($searchText);

			$returns = $this->paginationCompress ( "userListing/", $count, 10 );
            
            $data['userRecords'] = $this->user_model->userListing($searchText, $returns["page"], $returns["segment"]);
            
            $this->global['pageTitle'] = 'MEWU : User Listing';
            
            $this->loadViews("users", $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to load the add new form
     */
    function addNew()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->model('user_model');
            $data['roles'] = $this->user_model->getUserRoles();
            
            $this->global['pageTitle'] = 'MEWU : Add New User';

            $this->loadViews("addNew", $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to check whether email already exist or not
     */
    function checkEmailExists()
    {
        $userId = $this->input->post("userId");
        $email = $this->input->post("email");

        if(empty($userId)){
            $result = $this->user_model->checkEmailExists($email);
        } else {
            $result = $this->user_model->checkEmailExists($email, $userId);
        }

        if(empty($result)){ echo("true"); }
        else { echo("false"); }
    }
    
    /**
     * This function is used to add new user to the system
     */
    function addNewUser()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('fname','Full Name','trim|required|max_length[128]');
            $this->form_validation->set_rules('email','Email','trim|required|valid_email|max_length[128]');
            $this->form_validation->set_rules('password','Password','required|max_length[20]');
            $this->form_validation->set_rules('cpassword','Confirm Password','trim|required|matches[password]|max_length[20]');
            $this->form_validation->set_rules('role','Role','trim|required|numeric');
            $this->form_validation->set_rules('mobile','Mobile Number','required|min_length[10]');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->addNew();
            }
            else
            {
                $name = ucwords(strtolower($this->security->xss_clean($this->input->post('fname'))));
                $email = strtolower($this->security->xss_clean($this->input->post('email')));
                $password = $this->input->post('password');
                $roleId = $this->input->post('role');
                $mobile = $this->security->xss_clean($this->input->post('mobile'));
                
                $userInfo = array('email'=>$email, 'password'=>getHashedPassword($password), 'roleId'=>$roleId, 'name'=> $name,
                                    'mobile'=>$mobile, 'createdBy'=>$this->vendorId, 'createdDtm'=>date('Y-m-d H:i:s'));
                
                $this->load->model('user_model');
                $result = $this->user_model->addNewUser($userInfo);
                
                if($result > 0)
                {
                    $this->session->set_flashdata('success', 'New User created successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'User creation failed');
                }
                
                redirect('addNew');
            }
        }
    }

    
    /**
     * This function is used load user edit information
     * @param number $userId : Optional : This is user id
     */
    function editOld($userId = NULL)
    {
        if($this->isAdmin() == TRUE || $userId == 1)
        {
            $this->loadThis();
        }
        else
        {
            if($userId == null)
            {
                redirect('userListing');
            }
            
            $data['roles'] = $this->user_model->getUserRoles();
            $data['userInfo'] = $this->user_model->getUserInfo($userId);
            
            $this->global['pageTitle'] = 'MEWU : Edit User';
            
            $this->loadViews("editOld", $this->global, $data, NULL);
        }
    }
    
    
    /**
     * This function is used to edit the user information
     */
    function editUser()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');
            
            $userId = $this->input->post('userId');
            
            $this->form_validation->set_rules('fname','Full Name','trim|required|max_length[128]');
            $this->form_validation->set_rules('email','Email','trim|required|valid_email|max_length[128]');
            $this->form_validation->set_rules('password','Password','matches[cpassword]|max_length[20]');
            $this->form_validation->set_rules('cpassword','Confirm Password','matches[password]|max_length[20]');
            $this->form_validation->set_rules('role','Role','trim|required|numeric');
            $this->form_validation->set_rules('mobile','Mobile Number','required|min_length[10]');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->editOld($userId);
            }
            else
            {
                $name = ucwords(strtolower($this->security->xss_clean($this->input->post('fname'))));
                $email = strtolower($this->security->xss_clean($this->input->post('email')));
                $password = $this->input->post('password');
                $roleId = $this->input->post('role');
                $mobile = $this->security->xss_clean($this->input->post('mobile'));
                
                $userInfo = array();
                
                if(empty($password))
                {
                    $userInfo = array('email'=>$email, 'roleId'=>$roleId, 'name'=>$name,
                                    'mobile'=>$mobile, 'updatedBy'=>$this->vendorId, 'updatedDtm'=>date('Y-m-d H:i:s'));
                }
                else
                {
                    $userInfo = array('email'=>$email, 'password'=>getHashedPassword($password), 'roleId'=>$roleId,
                        'name'=>ucwords($name), 'mobile'=>$mobile, 'updatedBy'=>$this->vendorId, 
                        'updatedDtm'=>date('Y-m-d H:i:s'));
                }
                
                $result = $this->user_model->editUser($userInfo, $userId);
                
                if($result == true)
                {
                    $this->session->set_flashdata('success', 'User updated successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'User updation failed');
                }
                
                redirect('userListing');
            }
        }
    }


    /**
     * This function is used to delete the user using userId
     * @return boolean $result : TRUE / FALSE
     */
    function deleteUser()
    {
        if($this->isAdmin() == TRUE)
        {
            echo(json_encode(array('status'=>'access')));
        }
        else
        {
            $userId = $this->input->post('userId');
            $userInfo = array('isDeleted'=>1,'updatedBy'=>$this->vendorId, 'updatedDtm'=>date('Y-m-d H:i:s'));
            
            $result = $this->user_model->deleteUser($userId, $userInfo);
            
            if ($result > 0) { echo(json_encode(array('status'=>TRUE))); }
            else { echo(json_encode(array('status'=>FALSE))); }
        }
    }
    
    /**
     * Page not found : error 404
     */
    function pageNotFound()
    {
        $this->global['pageTitle'] = 'MEWU : 404 - Page Not Found';
        
        $this->loadViews("404", $this->global, NULL, NULL);
    }

    /**
     * This function used to show login history
     * @param number $userId : This is user id
     */
    function loginHistoy($userId = NULL)
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $userId = ($userId == NULL ? 0 : $userId);

            $searchText = $this->input->post('searchText');
            $fromDate = $this->input->post('fromDate');
            $toDate = $this->input->post('toDate');

            $data["userInfo"] = $this->user_model->getUserInfoById($userId);

            $data['searchText'] = $searchText;
            $data['fromDate'] = $fromDate;
            $data['toDate'] = $toDate;
            
            $this->load->library('pagination');
            
            $count = $this->user_model->loginHistoryCount($userId, $searchText, $fromDate, $toDate);

            $returns = $this->paginationCompress ( "login-history/".$userId."/", $count, 10, 3);

            $data['userRecords'] = $this->user_model->loginHistory($userId, $searchText, $fromDate, $toDate, $returns["page"], $returns["segment"]);
            
            $this->global['pageTitle'] = 'MEWU : User Login History';
            
            $this->loadViews("loginHistory", $this->global, $data, NULL);
        }        
    }

    /**
     * This function is used to show users profile
     */
    function profile($active = "details")
    {
        $data["userInfo"] = $this->user_model->getUserInfoWithRole($this->vendorId);
        $data["active"] = $active;
        
        $this->global['pageTitle'] = $active == "details" ? 'MEWU : My Profile' : 'MEWU : Change Password';
        $this->loadViews("profile", $this->global, $data, NULL);
    }

    /**
     * This function is used to update the user details
     * @param text $active : This is flag to set the active tab
     */
    function profileUpdate($active = "details")
    {
        $this->load->library('form_validation');
            
        $this->form_validation->set_rules('fname','Full Name','trim|required|max_length[128]');
        $this->form_validation->set_rules('mobile','Mobile Number','required|min_length[10]');
        $this->form_validation->set_rules('email','Email','trim|required|valid_email|max_length[128]|callback_emailExists');        
        
        if($this->form_validation->run() == FALSE)
        {
            $this->profile($active);
        }
        else
        {
            $name = ucwords(strtolower($this->security->xss_clean($this->input->post('fname'))));
            $mobile = $this->security->xss_clean($this->input->post('mobile'));
            $email = strtolower($this->security->xss_clean($this->input->post('email')));
            
            $userInfo = array('name'=>$name, 'email'=>$email, 'mobile'=>$mobile, 'updatedBy'=>$this->vendorId, 'updatedDtm'=>date('Y-m-d H:i:s'));
            
            $result = $this->user_model->editUser($userInfo, $this->vendorId);
            
            if($result == true)
            {
                $this->session->set_userdata('name', $name);
                $this->session->set_flashdata('success', 'Profile updated successfully');
            }
            else
            {
                $this->session->set_flashdata('error', 'Profile updation failed');
            }

            redirect('profile/'.$active);
        }
    }

    /**
     * This function is used to change the password of the user
     * @param text $active : This is flag to set the active tab
     */
    function changePassword($active = "changepass")
    {
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('oldPassword','Old password','required|max_length[20]');
        $this->form_validation->set_rules('newPassword','New password','required|max_length[20]');
        $this->form_validation->set_rules('cNewPassword','Confirm new password','required|matches[newPassword]|max_length[20]');
        
        if($this->form_validation->run() == FALSE)
        {
            $this->profile($active);
        }
        else
        {
            $oldPassword = $this->input->post('oldPassword');
            $newPassword = $this->input->post('newPassword');
            
            $resultPas = $this->user_model->matchOldPassword($this->vendorId, $oldPassword);
            
            if(empty($resultPas))
            {
                $this->session->set_flashdata('nomatch', 'Your old password is not correct');
                redirect('profile/'.$active);
            }
            else
            {
                $usersData = array('password'=>getHashedPassword($newPassword), 'updatedBy'=>$this->vendorId,
                                'updatedDtm'=>date('Y-m-d H:i:s'));
                
                $result = $this->user_model->changePassword($this->vendorId, $usersData);
                
                if($result > 0) { $this->session->set_flashdata('success', 'Password updation successful'); }
                else { $this->session->set_flashdata('error', 'Password updation failed'); }
                
                redirect('profile/'.$active);
            }
        }
    }

    /**
     * This function is used to check whether email already exist or not
     * @param {string} $email : This is users email
     */
    function emailExists($email)
    {
        $userId = $this->vendorId;
        $return = false;

        if(empty($userId)){
            $result = $this->user_model->checkEmailExists($email);
        } else {
            $result = $this->user_model->checkEmailExists($email, $userId);
        }

        if(empty($result)){ $return = true; }
        else {
            $this->form_validation->set_message('emailExists', 'The {field} already taken');
            $return = false;
        }

        return $return;
    }

     function viewEquipment()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {        
            $searchText = $this->security->xss_clean($this->input->post('searchText'));
            $data['searchText'] = $searchText;
            
            $this->load->library('pagination');
            
            $count = $this->user_model->viewEquipmentCount($searchText);

            $returns = $this->paginationCompress ( "viewEquipment/", $count, 10 );
            
            $data['userRecords'] = $this->user_model->viewEquipment($searchText, $returns["page"], $returns["segment"]);
            
            $this->global['pageTitle'] = 'MEWU : View Equipments';
            
            $this->loadViews("admin/viewEquipment", $this->global, $data, NULL);
        }
    }

    function viewEquipmentMaintenance()
    {
        if($this->isEmployee() == TRUE)
        {
            $this->loadThis();
        }
        else
        {        
            $searchText = $this->security->xss_clean($this->input->post('searchText'));
            $data['searchText'] = $searchText;
            
            $this->load->library('pagination');
            
            $count = $this->user_model->viewEquipmentCount($searchText);

            $returns = $this->paginationCompress ( "viewEquipment/", $count, 10 );
            
            $data['userRecords'] = $this->user_model->viewEquipment($searchText, $returns["page"], $returns["segment"]);
            
            $this->global['pageTitle'] = 'MEWU : View Equipments';
            
            $this->loadViews("maintenance/viewEquipment", $this->global, $data, NULL);
        }
    }


     function viewEventEquipment()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {        
            $searchText = $this->security->xss_clean($this->input->post('searchText'));
            $data['searchText'] = $searchText;
            
            $this->load->library('pagination');
            
            $count = $this->user_model->viewEventEquipmentCount($searchText);

            $returns = $this->paginationCompress ( "viewEventEquipment/", $count, 10 );
            
            $data['userRecords'] = $this->user_model->viewEventEquipment($searchText, $returns["page"], $returns["segment"]);
            
            $this->global['pageTitle'] = 'MEWU : View Event Equipments';
            
            $this->loadViews("admin/viewEventEquipment", $this->global, $data, NULL);
        }
    }

      function viewVenue()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {        
            $searchText = $this->security->xss_clean($this->input->post('searchText'));
            $data['searchText'] = $searchText;
            
            $this->load->library('pagination');
            
            $count = $this->user_model->viewVenueCount($searchText);

            $returns = $this->paginationCompress ( "viewVenue/", $count, 10 );
            
            $data['userRecords'] = $this->user_model->viewVenue($searchText, $returns["page"], $returns["segment"]);
            
            $this->global['pageTitle'] = 'MEWU : View Venue';
            
            $this->loadViews("admin/viewVenue", $this->global, $data, NULL);
        }
    }

        function viewDepartment()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {        
            $searchText = $this->security->xss_clean($this->input->post('searchText'));
            $data['searchText'] = $searchText;
            
            $this->load->library('pagination');
            
            $count = $this->user_model->viewDepartmentCount($searchText);

            $returns = $this->paginationCompress ( "viewDepartment/", $count, 10 );
            
            $data['userRecords'] = $this->user_model->viewDepartment($searchText, $returns["page"], $returns["segment"]);
            
            $this->global['pageTitle'] = 'MEWU : View Department';
            
            $this->loadViews("admin/viewDepartment", $this->global, $data, NULL);
        }
    }

     function viewLocation()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {        
            $searchText = $this->security->xss_clean($this->input->post('searchText'));
            $data['searchText'] = $searchText;
            
            $this->load->library('pagination');
            
            $count = $this->user_model->viewDepartmentCount($searchText);

            $returns = $this->paginationCompress ( "viewLocation/", $count, 10 );
            
            $data['userRecords'] = $this->user_model->viewLocation($searchText, $returns["page"], $returns["segment"]);
            
            $this->global['pageTitle'] = 'MEWU : View Location';
            
            $this->loadViews("admin/viewLocation", $this->global, $data, NULL);
        }
    }

     function addJobRequest()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('itemNo','Number of Items','trim|required|max_length[128]');
            $this->form_validation->set_rules('location','Location','trim|required|valid_email|max_length[128]');
            $this->form_validation->set_rules('workDescript','Work Description','required|max_length[128]');
            if($this->form_validation->run() == FALSE)
            {
                $this->addJobRequest();
            }
            else
            {
                $itemNo = $this->input->post('itemNo');
                $location = $this->input->post('location');
                $workDescript = $this->input->post('workDescript');
                
                $jobInfo = array('itemNo'=>$itemNo, 'location'=>$location, 'workDescript'=> $workDescript,);
                
                $this->load->model('user_model');
                $result = $this->user_model->addjobRequest($jobInfo);
                
               if($result > 0)
                {
                    $this->session->set_flashdata('success', 'created successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'creation failed');
                }
                
                redirect('jobRequest');
            }
        }
    }

     function viewEventRequest()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {        
            $searchText = $this->security->xss_clean($this->input->post('searchText'));
            $data['searchText'] = $searchText;
            
            $this->load->library('pagination');
            
            $count = $this->user_model->viewEventRequestCount($searchText);

            $returns = $this->paginationCompress ( "user/viewEventRequest/", $count, 10 );
            
            $data['userRecords'] = $this->user_model->viewEventRequest($searchText, $returns["page"], $returns["segment"]);
            
            $this->global['pageTitle'] = 'MEWU : View Event Request';
            
            $this->loadViews("admin/viewEventRequest", $this->global, $data, NULL);
        }
    }

     function viewRepairRequest()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {        
            $searchText = $this->security->xss_clean($this->input->post('searchText'));
            $data['searchText'] = $searchText;
            
            $this->load->library('pagination');
            
            $count = $this->user_model->viewRepairRequestCount($searchText);

            $returns = $this->paginationCompress ( "user/viewRepairRequest/", $count, 10 );
            
            $data['userRecords'] = $this->user_model->viewRepairRequest($searchText, $returns["page"], $returns["segment"]);
            
            $this->global['pageTitle'] = 'MEWU :Repair Request';
            
            $this->loadViews("admin/viewRepairRequest", $this->global, $data, NULL);
        }
    }

     function viewMySchedule()
    {
        // if($this->isEmployee() == TRUE || $this->isAdmin() == TRUE)
        // {
        //     $this->loadThis();
        // }
        // else
        // {        
            $searchText = $this->security->xss_clean($this->input->post('searchText'));
            $data['searchText'] = $searchText;
            
            $this->load->library('pagination');
            
            $count = $this->user_model->viewMyScheduleCount($searchText);

            $returns = $this->paginationCompress ( "viewMySchedule/", $count, 10 );
            
            $data['userRecords'] = $this->user_model->viewMySchedule($searchText, $returns["page"], $returns["segment"]);
            
            $this->global['pageTitle'] = 'MEWU : My Schedule';
            
            $this->loadViews("maintenance/viewMySchedule", $this->global, $data, NULL);
        }
    

    function viewHistory()
    {
        if($this->isEmployee() == TRUE)
        {
            $this->loadThis();
        }
        else
        {        
            $searchText = $this->security->xss_clean($this->input->post('searchText'));
            $data['searchText'] = $searchText;
            
            $this->load->library('pagination');

            $returns = $this->paginationCompress ( "viewHistory/", 10 );
            
            $data['userRecords'] = $this->user_model->viewHistory($searchText, $returns["page"], $returns["segment"]);
            
            $this->global['pageTitle'] = 'MEWU : History';
            
            $this->loadViews("maintenance/viewhistory", $this->global, $data, NULL);
        }
    }

    function editJob($userId = NULL)
    {
        if($this->isEmployee() == TRUE || $jobId == jobId)
        {
            $this->loadThis();
        }
        else
        {
            if($jobId == null)
            
            $data['jobInfo'] = $this->user_model->getJobInfo($jobId);
            
            $this->global['pageTitle'] = 'MEWU : Edit Job';
            
            $this->loadViews("updateSchedule", $this->global, $data, NULL);
        }
    }

     function viewEventRequests()
    {
        if($this->isManager() == TRUE)
        {
            $this->loadThis();
        }
        else
        {        
            $searchText = $this->security->xss_clean($this->input->post('searchText'));
            $data['searchText'] = $searchText;
            
            $this->load->library('pagination');
            
            $count = $this->user_model->viewEventRequestCounts($searchText);

            $returns = $this->paginationCompress ( "viewEventRequests/", $count, 10 );
            
            $data['userRecords'] = $this->user_model->viewEventRequests($searchText, $returns["page"], $returns["segment"]);
            
            $this->global['pageTitle'] = 'MEWU : View Event Request';
            
            $this->loadViews("staff/viewEventRequests", $this->global, $data, NULL);
        }
    }

     function viewRepairRequests()
    {
        if($this->isManager() == TRUE)
        {
            $this->loadThis();
        }
        else
        {        
            $searchText = $this->security->xss_clean($this->input->post('searchText'));
            $data['searchText'] = $searchText;
            
            $this->load->library('pagination');
            
            $count = $this->user_model->viewRepairRequestCounts($searchText);

            $returns = $this->paginationCompress ( "viewRepairRequests/", $count, 10 );
            
            $data['userRecords'] = $this->user_model->viewRepairRequests($searchText, $returns["page"], $returns["segment"]);
            
            $this->global['pageTitle'] = 'MEWU :Repair Request';
            
            $this->loadViews("staff/viewRepairRequests", $this->global, $data, NULL);
        }
    }



    function viewSummaryReport()
    {
        if($this->isEmployee() == TRUE)
        {
            $this->loadThis();
        }
        else
        {   
              $searchText = $this->security->xss_clean($this->input->post('searchText'));
            $data['searchText'] = $searchText;
            
            $this->load->library('pagination');
             $count = $this->user_model->viewSummaryReportCount($searchText);

            $returns = $this->paginationCompress ( "viewSummaryReport/", $count, 10 );
            
            $data['userRecords'] = $this->user_model->viewSummaryReport($searchText, $returns["page"], $returns["segment"]);
            
            $this->global['pageTitle'] = 'MEWU :Summary Report';
            
            $this->loadViews("maintenance/viewSummaryReport", $this->global, $data, NULL);
        }
    }    

     function viewTheEventRequest()
    {

            $id = $this->input->get('id');

            if($this->session->userdata('roleText') == 'System Administrator'){
                $this->main_model->eventUnNotifyAdmin($id);
            }else{
                $this->main_model->eventUnNotify($id);
            }
            $this->global['notification'] =$this->main_model->getNotification($this->session->userdata('role'));

            $searchText = $this->security->xss_clean($this->input->post('searchText'));
            $data['searchText'] = $searchText;
            
            $this->load->library('pagination');
            
            $count = $this->user_model->viewEventRequestCounts($searchText);

            $returns = $this->paginationCompress ( "viewEventRequests/", $count, 10 );
            
            $data['userRecords'] = $this->user_model->viewTheEventRequest($searchText, $returns["page"], $returns["segment"],$id);
            
            $this->global['pageTitle'] = 'MEWU : View Event Request';
            
            $this->loadViews("admin/viewEventRequest", $this->global, $data, NULL);
        
    }

     function viewTheRepairRequest()
    {
            $id=$this->input->get('id');

            $id = $this->input->get('id');

            if($this->session->userdata('roleText') == 'System Administrator'){
                $this->main_model->eventUnNotifyAdmin($id);
            }else{
                $this->main_model->jobRequestUnNotify($id);
            }
            $this->global['notification'] =$this->main_model->getNotification($this->session->userdata('role'));

            $searchText = $this->security->xss_clean($this->input->post('searchText'));
            $data['searchText'] = $searchText;
            
            $this->load->library('pagination');
            
            $count = $this->user_model->viewRepairRequestCounts($searchText);

            $returns = $this->paginationCompress ( "admin/viewTheRepairRequests/", $count, 10 );
            
            $data['userRecords'] = $this->user_model->viewTheRepairRequests($searchText, $returns["page"], $returns["segment"],$id);
            
            $this->global['pageTitle'] = 'MEWU :Repair Request';

            if($this->session->userdata('role') == 1){
                $this->loadViews("admin/viewRepairRequest", $this->global, $data, NULL);
            }else{
                 $this->loadViews("maintenance/viewTheRepairRequest", $this->global, $data, NULL);
            }
            
        
    }

    function viewAllEventRequest()
    {

            $id = $this->input->get('id');
           
            $searchText = $this->security->xss_clean($this->input->post('searchText'));
            $data['searchText'] = $searchText;
            
            $this->load->library('pagination');
            
            $count = $this->user_model->viewAllEventRequestCounts($searchText);

            $returns = $this->paginationCompress ( "viewEventRequests/", $count, 10 );
            
            $data['userRecords'] = $this->user_model->viewAllEventRequest($searchText, $returns["page"], $returns["segment"],$id);
            
            $this->global['pageTitle'] = 'MEWU : View Event Request';
            
            $this->loadViews("admin/viewAllEventRequest", $this->global, $data, NULL);
        
    }

     function viewAllMyRepairRequest()
    {

            $id = $this->input->get('id');
           
            $searchText = $this->security->xss_clean($this->input->post('searchText'));
            $data['searchText'] = $searchText;
            
            $this->load->library('pagination');
            
            $count = $this->user_model->viewMyRepairRequestCount($searchText);

            $returns = $this->paginationCompress ( "viewMyRepairRequest/", $count, 10 );
            
            $data['userRecords'] = $this->user_model->viewMyRepairRequest($searchText, $returns["page"], $returns["segment"],$id);
            
            $this->global['pageTitle'] = 'MEWU : View Repair Request';
            
            $this->loadViews("admin/viewAllRepairRequest", $this->global, $data, NULL);
        
    }

     function viewStudentRequest()
    {

            $id = $this->session->userdata('userId');
           
            $searchText = $this->security->xss_clean($this->input->post('searchText'));
            $data['searchText'] = $searchText;
            
            $this->load->library('pagination');
            
            $count = $this->user_model->viewEventRequestCounts($searchText);

            $returns = $this->paginationCompress ("student/viewStudentRequests", $count, 10 );
            
            $data['userRecords'] = $this->user_model->viewStudentRequests($searchText, $returns["page"], $returns["segment"],$id);
            
            $this->global['pageTitle'] = 'MEWU : View Event Request';
            
            $this->loadViews("student/viewStudentRequests", $this->global, $data, NULL);
        
    }
    
   
}

?>