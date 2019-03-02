<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class : User_model (User Model)
 * User model class to get to handle user related data 
 * @author : Kishor Mali
 * @version : 1.1
 * @since : 15 November 2016
 */
class User_model extends CI_Model
{
    /**
     * This function is used to get the user listing count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */
    function userListingCount($searchText = '')
    {
        $this->db->select('BaseTbl.userId, BaseTbl.email, BaseTbl.name, BaseTbl.mobile, BaseTbl.createdDtm, Role.role');
        $this->db->from('tbl_users as BaseTbl');
        $this->db->join('tbl_roles as Role', 'Role.roleId = BaseTbl.roleId','left');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.email  LIKE '%".$searchText."%'
                            OR  BaseTbl.name  LIKE '%".$searchText."%'
                            OR  BaseTbl.mobile  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.roleId !=', 1);
        $query = $this->db->get();
        
        return $query->num_rows();
    }
    
    /**
     * This function is used to get the user listing count
     * @param string $searchText : This is optional search text
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    function userListing($searchText = '', $page, $segment)
    {
        $this->db->select('BaseTbl.userId, BaseTbl.email, BaseTbl.name, BaseTbl.mobile, BaseTbl.createdDtm, Role.role');
        $this->db->from('tbl_users as BaseTbl');
        $this->db->join('tbl_roles as Role', 'Role.roleId = BaseTbl.roleId','left');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.email  LIKE '%".$searchText."%'
                            OR  BaseTbl.name  LIKE '%".$searchText."%'
                            OR  BaseTbl.mobile  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.roleId !=', 1);
        $this->db->order_by('BaseTbl.userId', 'DESC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }
    
    /**
     * This function is used to get the user roles information
     * @return array $result : This is result of the query
     */
    function getUserRoles()
    {
        $this->db->select('roleId, role');
        $this->db->from('tbl_roles');
        $this->db->where('roleId !=', 1);
        $query = $this->db->get();
        
        return $query->result();
    }

    /**
     * This function is used to check whether email id is already exist or not
     * @param {string} $email : This is email id
     * @param {number} $userId : This is user id
     * @return {mixed} $result : This is searched result
     */
    function checkEmailExists($email, $userId = 0)
    {
        $this->db->select("email");
        $this->db->from("tbl_users");
        $this->db->where("email", $email);   
        $this->db->where("isDeleted", 0);
        if($userId != 0){
            $this->db->where("userId !=", $userId);
        }
        $query = $this->db->get();

        return $query->result();
    }
    
    
    /**
     * This function is used to add new user to system
     * @return number $insert_id : This is last inserted id
     */
    function addNewUser($userInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_users', $userInfo);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }
    
    /**
     * This function used to get user information by id
     * @param number $userId : This is user id
     * @return array $result : This is user information
     */
    function getUserInfo($userId)
    {
        $this->db->select('userId, name, email, mobile, roleId');
        $this->db->from('tbl_users');
        $this->db->where('isDeleted', 0);
		$this->db->where('roleId !=', 1);
        $this->db->where('userId', $userId);
        $query = $this->db->get();
        
        return $query->row();
    }
    
    
    /**
     * This function is used to update the user information
     * @param array $userInfo : This is users updated information
     * @param number $userId : This is user id
     */
    function editUser($userInfo, $userId)
    {
        $this->db->where('userId', $userId);
        $this->db->update('tbl_users', $userInfo);
        
        return TRUE;
    }
    
    
    
    /**
     * This function is used to delete the user information
     * @param number $userId : This is user id
     * @return boolean $result : TRUE / FALSE
     */
    function deleteUser($userId, $userInfo)
    {
        $this->db->where('userId', $userId);
        $this->db->update('tbl_users', $userInfo);
        
        return $this->db->affected_rows();
    }


    /**
     * This function is used to match users password for change password
     * @param number $userId : This is user id
     */
    function matchOldPassword($userId, $oldPassword)
    {
        $this->db->select('userId, password');
        $this->db->where('userId', $userId);        
        $this->db->where('isDeleted', 0);
        $query = $this->db->get('tbl_users');
        
        $user = $query->result();

        if(!empty($user)){
            if(verifyHashedPassword($oldPassword, $user[0]->password)){
                return $user;
            } else {
                return array();
            }
        } else {
            return array();
        }
    }
    
    /**
     * This function is used to change users password
     * @param number $userId : This is user id
     * @param array $userInfo : This is user updation info
     */
    function changePassword($userId, $userInfo)
    {
        $this->db->where('userId', $userId);
        $this->db->where('isDeleted', 0);
        $this->db->update('tbl_users', $userInfo);
        
        return $this->db->affected_rows();
    }


    /**
     * This function is used to get user login history
     * @param number $userId : This is user id
     */
    function loginHistoryCount($userId, $searchText, $fromDate, $toDate)
    {
        $this->db->select('BaseTbl.userId, BaseTbl.sessionData, BaseTbl.machineIp, BaseTbl.userAgent, BaseTbl.agentString, BaseTbl.platform, BaseTbl.createdDtm');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.sessionData LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        if(!empty($fromDate)) {
            $likeCriteria = "DATE_FORMAT(BaseTbl.createdDtm, '%Y-%m-%d' ) >= '".date('Y-m-d', strtotime($fromDate))."'";
            $this->db->where($likeCriteria);
        }
        if(!empty($toDate)) {
            $likeCriteria = "DATE_FORMAT(BaseTbl.createdDtm, '%Y-%m-%d' ) <= '".date('Y-m-d', strtotime($toDate))."'";
            $this->db->where($likeCriteria);
        }
        if($userId >= 1){
            $this->db->where('BaseTbl.userId', $userId);
        }
        $this->db->from('tbl_last_login as BaseTbl');
        $query = $this->db->get();
        
        return $query->num_rows();
    }

    /**
     * This function is used to get user login history
     * @param number $userId : This is user id
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    function loginHistory($userId, $searchText, $fromDate, $toDate, $page, $segment)
    {
        $this->db->select('BaseTbl.userId, BaseTbl.sessionData, BaseTbl.machineIp, BaseTbl.userAgent, BaseTbl.agentString, BaseTbl.platform, BaseTbl.createdDtm');
        $this->db->from('tbl_last_login as BaseTbl');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.sessionData  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        if(!empty($fromDate)) {
            $likeCriteria = "DATE_FORMAT(BaseTbl.createdDtm, '%Y-%m-%d' ) >= '".date('Y-m-d', strtotime($fromDate))."'";
            $this->db->where($likeCriteria);
        }
        if(!empty($toDate)) {
            $likeCriteria = "DATE_FORMAT(BaseTbl.createdDtm, '%Y-%m-%d' ) <= '".date('Y-m-d', strtotime($toDate))."'";
            $this->db->where($likeCriteria);
        }
        if($userId >= 1){
            $this->db->where('BaseTbl.userId', $userId);
        }
        $this->db->order_by('BaseTbl.id', 'DESC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }

    /**
     * This function used to get user information by id
     * @param number $userId : This is user id
     * @return array $result : This is user information
     */
    function getUserInfoById($userId)
    {
        $this->db->select('userId, name, email, mobile, roleId');
        $this->db->from('tbl_users');
        $this->db->where('isDeleted', 0);
        $this->db->where('userId', $userId);
        $query = $this->db->get();
        
        return $query->row();
    }

    /**
     * This function used to get user information by id with role
     * @param number $userId : This is user id
     * @return aray $result : This is user information
     */
    function getUserInfoWithRole($userId)
    {
        $this->db->select('BaseTbl.userId, BaseTbl.email, BaseTbl.name, BaseTbl.mobile, BaseTbl.roleId, Roles.role');
        $this->db->from('tbl_users as BaseTbl');
        $this->db->join('tbl_roles as Roles','Roles.roleId = BaseTbl.roleId');
        $this->db->where('BaseTbl.userId', $userId);
        $this->db->where('BaseTbl.isDeleted', 0);
        $query = $this->db->get();
        
        return $query->row();
    }

     function viewEquipmentCount($searchText = '')
    {
        $this->db->select('BaseTbl.equipName, BaseTbl.brand, BaseTbl.model, BaseTbl.serialNo, BaseTbl.office,BaseTbl.department,BaseTbl.type,BaseTbl.yearAcc');
        $this->db->from('tbl_equipment as BaseTbl');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.equipName  LIKE '%".$searchText."%'
                            OR  BaseTbl.brand  LIKE '%".$searchText."%'
                            OR  BaseTbl.model  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
       
        $query = $this->db->get();
        
        return $query->num_rows();
    }
    
    /**
     * This function is used to get the user listing count
     * @param string $searchText : This is optional search text
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    function viewEquipment($searchText = '', $page, $segment)
    {
        $this->db->select('BaseTbl.equipId,BaseTbl.equipName, BaseTbl.brand, BaseTbl.model, BaseTbl.serialNo, BaseTbl.office,BaseTbl.department,BaseTbl.type,BaseTbl.yearAcc');
        $this->db->from('tbl_equipment as BaseTbl');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.equipName  LIKE '%".$searchText."%'
                            OR  BaseTbl.brand  LIKE '%".$searchText."%'
                            OR  BaseTbl.model  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
       
        $this->db->order_by('BaseTbl.equipId', 'DESC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }

     function viewEventEquipmentCount($searchText = '')
    {
        $this->db->select('BaseTbl.name, BaseTbl.type');
        $this->db->from('tbl_event_equip as BaseTbl');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.name  LIKE '%".$searchText."%'
                            OR  BaseTbl.type  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
       
        $query = $this->db->get();
        
        return $query->num_rows();
    }
    
    /**
     * This function is used to get the user listing count
     * @param string $searchText : This is optional search text
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    function viewEventEquipment($searchText = '', $page, $segment)
    {
        $this->db->select('BaseTbl.name, BaseTbl.type');
        $this->db->from('tbl_event_equip as BaseTbl');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.name  LIKE '%".$searchText."%'
                            OR  BaseTbl.type  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
       
        $this->db->order_by('BaseTbl.equipId', 'DESC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }

     function viewVenueCount($searchText = '')
    {
        $this->db->select('BaseTbl.bldgNo, BaseTbl.name, BaseTbl.type');
        $this->db->from('tbl_venue as BaseTbl');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.bldgNo  LIKE '%".$searchText."%'
                            OR  BaseTbl.name  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
       
        $query = $this->db->get();
        
        return $query->num_rows();
    }
    
    /**
     * This function is used to get the user listing count
     * @param string $searchText : This is optional search text
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    function viewVenue($searchText = '', $page, $segment)
    {
        $this->db->select('BaseTbl.bldgNo, BaseTbl.name, BaseTbl.type');
        $this->db->from('tbl_venue as BaseTbl');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.bldgNo  LIKE '%".$searchText."%'
                            OR  BaseTbl.name  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
       
        $this->db->order_by('BaseTbl.venID', 'DESC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }

    function viewDepartmentCount($searchText = '')
    {
        $this->db->select('BaseTbl.departId, BaseTbl.acroname, BaseTbl.name');
        $this->db->from('tbl_department as BaseTbl');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.bldgNo  LIKE '%".$searchText."%'
                            OR  BaseTbl.name  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
       
        $query = $this->db->get();
        
        return $query->num_rows();
    }
    
    /**
     * This function is used to get the user listing count
     * @param string $searchText : This is optional search text
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    function viewDepartment($searchText = '', $page, $segment)
    {
        $this->db->select('BaseTbl.departId, BaseTbl.acroname, BaseTbl.name');
        $this->db->from('tbl_department as BaseTbl');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.departId  LIKE '%".$searchText."%'
                            OR  BaseTbl.acroname  LIKE '%".$searchText."%')
                            OR  BaseTbl.name  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
       
        $this->db->order_by('BaseTbl.departId', 'DESC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }

     function viewLocationCount($searchText = '')
    {
        $this->db->select('BaseTbl.locID, BaseTbl.bldgNo, BaseTbl.roomNo, BaseTbl.name');
        $this->db->from('tbl_location as BaseTbl');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.bldgNo  LIKE '%".$searchText."%'
                            OR  BaseTbl.name  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
       
        $query = $this->db->get();
        
        return $query->num_rows();
    }
    
    /**
     * This function is used to get the user listing count
     * @param string $searchText : This is optional search text
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    function viewLocation($searchText = '', $page, $segment)
    {
        $this->db->select('BaseTbl.locID, BaseTbl.bldgNo, BaseTbl.roomNo, BaseTbl.name');
        $this->db->from('tbl_location as BaseTbl');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.locID  LIKE '%".$searchText."%'
                            OR  BaseTbl.name  LIKE '%".$searchText."%')
                            OR  BaseTbl.bldgNo  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
       
        $this->db->order_by('BaseTbl.locID', 'DESC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }

     function addJobRequest($requestInfo)
    {
        $this->db->insert('tbl_job_request', $requestInfo);
        
        return $result;
    }

     function viewEventRequestCount($searchText = '')
    {
        $this->db->select('BaseTbl.formNo, BaseTbl.noParticipant, BaseTbl.dateActual, BaseTbl.timeActual, BaseTbl.dateEnd, BaseTbl.timeEnd, BaseTbl.purpose,BaseTbl.tittleEvent,BaseTbl.contactNo,BaseTb2.acroname,BaseTb3.name,BaseTb4.name as fullname,BaseTbl.dateReq,BaseTbl.status');
        $this->db->from('tbl_reserve_request as BaseTbl');
        $this->db->join('tbl_department as BaseTb2','BaseTbl.departmentID = BaseTb2.departId');
        $this->db->join('tbl_venue as BaseTb3','BaseTbl.venueID = BaseTb3.venID');
        $this->db->join('tbl_users as BaseTb4','BaseTbl.resBy = BaseTb4.userId');
        $this->db->where('status','pending');
        $this->db->order_by('dateReq','DESC');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.tittleEvent  LIKE '%".$searchText."%'
                            OR  BaseTbl.resBy  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
       
        $query = $this->db->get();
        
        return $query->num_rows();
    }

    function viewAllEventRequestCounts($searchText = '')
    {
        $this->db->select('BaseTbl.formNo, BaseTbl.noParticipant, BaseTbl.dateActual, BaseTbl.timeActual, BaseTbl.dateEnd, BaseTbl.timeEnd, BaseTbl.purpose,BaseTbl.tittleEvent,BaseTbl.contactNo,BaseTb2.acroname,BaseTb3.name,BaseTb4.name as fullname,BaseTbl.dateReq,BaseTbl.status');
        $this->db->from('tbl_reserve_request as BaseTbl');
        $this->db->join('tbl_department as BaseTb2','BaseTbl.departmentID = BaseTb2.departId');
        $this->db->join('tbl_venue as BaseTb3','BaseTbl.venueID = BaseTb3.venID');
        $this->db->join('tbl_users as BaseTb4','BaseTbl.resBy = BaseTb4.userId');
        $this->db->order_by('dateReq','DESC');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.tittleEvent  LIKE '%".$searchText."%'
                            OR  BaseTbl.resBy  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
       
        $query = $this->db->get();
        
        return $query->num_rows();
    }
    
    /**
     * This function is used to get the user listing count
     * @param string $searchText : This is optional search text
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    function viewEventRequest($searchText = '', $page, $segment)
    {
        $this->db->select('BaseTbl.formNo, BaseTbl.noParticipant, BaseTbl.dateActual, BaseTbl.timeActual, BaseTbl.dateEnd, BaseTbl.timeEnd, BaseTbl.purpose,BaseTbl.tittleEvent,BaseTbl.contactNo,BaseTb2.acroname,BaseTb3.name,BaseTb4.name as fullname,BaseTbl.dateReq,BaseTbl.status');
        $this->db->from('tbl_reserve_request as BaseTbl');
        $this->db->join('tbl_department as BaseTb2','BaseTbl.departmentID = BaseTb2.departId');
        $this->db->join('tbl_venue as BaseTb3','BaseTbl.venueID = BaseTb3.venID');
        $this->db->join('tbl_users as BaseTb4','BaseTbl.resBy = BaseTb4.userId');
        $this->db->where('status','pending');
        $this->db->order_by('dateReq','DESC');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.tittleEvent  LIKE '%".$searchText."%'
                            OR  BaseTbl.resBy  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
       
        $this->db->order_by('BaseTbl.formNo', 'ASC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }

    function viewAllEventRequest($searchText = '', $page, $segment)
    {
        $this->db->select('BaseTbl.formNo, BaseTbl.noParticipant, BaseTbl.dateActual, BaseTbl.timeActual, BaseTbl.dateEnd, BaseTbl.timeEnd, BaseTbl.purpose,BaseTbl.tittleEvent,BaseTbl.contactNo,BaseTb2.acroname,BaseTb3.name,BaseTb4.name as fullname,BaseTbl.dateReq,BaseTbl.status');
        $this->db->from('tbl_reserve_request as BaseTbl');
        $this->db->join('tbl_department as BaseTb2','BaseTbl.departmentID = BaseTb2.departId');
        $this->db->join('tbl_venue as BaseTb3','BaseTbl.venueID = BaseTb3.venID');
        $this->db->join('tbl_users as BaseTb4','BaseTbl.resBy = BaseTb4.userId');
        $this->db->order_by('dateReq','DESC');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.tittleEvent  LIKE '%".$searchText."%'
                            OR  BaseTbl.resBy  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
       
        $this->db->order_by('BaseTbl.formNo', 'ASC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }

    function viewTheEventRequest($searchText = '', $page, $segment,$id)
    {
         $this->db->select('BaseTbl.formNo, BaseTbl.noParticipant, BaseTbl.dateActual, BaseTbl.timeActual, BaseTbl.dateEnd, BaseTbl.timeEnd, BaseTbl.purpose,BaseTbl.tittleEvent,BaseTbl.contactNo,BaseTb2.acroname,BaseTb3.name,BaseTb4.name as fullname,BaseTbl.dateReq,BaseTbl.status');
        $this->db->from('tbl_reserve_request as BaseTbl');
        $this->db->join('tbl_department as BaseTb2','BaseTbl.departmentID = BaseTb2.departId');
        $this->db->join('tbl_venue as BaseTb3','BaseTbl.venueID = BaseTb3.venID');
        $this->db->join('tbl_users as BaseTb4','BaseTbl.resBy = BaseTb4.userId');
        $this->db->where('formNo',$id);
        $this->db->order_by('dateReq','DESC');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.tittleEvent  LIKE '%".$searchText."%'
                            OR  BaseTbl.resBy  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
       
        $this->db->order_by('BaseTbl.formNo', 'ASC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }

    function viewRepairRequestCount($searchText = '')
    {
        $this->db->select('BaseTbl.jobId,BaseTbl.itemNo, BaseTbl.workDescript, BaseTbl3.name,BaseTbl3.bldgNo,BaseTbl3.roomNo, BaseTbl.dateReq, BaseTbl2.name as Resname, BaseTbl.remark');
        $this->db->from('tbl_job_request as BaseTbl');
        $this->db->join('tbl_users as BaseTbl2','BaseTbl.resBy = BaseTbl2.userId');
        $this->db->join('tbl_location as BaseTbl3','BaseTbl.location = BaseTbl3.locID');
        $this->db->where('remark','pending');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.workDescript  LIKE '%".$searchText."%'
                            OR  BaseTbl.location  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
       
        $query = $this->db->get();
        
        return $query->num_rows();
    }
    
    /**
     * This function is used to get the user listing count
     * @param string $searchText : This is optional search text
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    function viewRepairRequest($searchText = '', $page, $segment)
    {
       $this->db->select('BaseTbl.jobId,BaseTbl.itemNo, BaseTbl.workDescript, BaseTbl3.name,BaseTbl3.bldgNo,BaseTbl3.roomNo, BaseTbl.dateReq, BaseTbl2.name as Resname, BaseTbl.remark');
        $this->db->from('tbl_job_request as BaseTbl');
        $this->db->join('tbl_users as BaseTbl2','BaseTbl.resBy = BaseTbl2.userId');
        $this->db->join('tbl_location as BaseTbl3','BaseTbl.location = BaseTbl3.locID');
        $this->db->where('remark','pending');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.workDescript  LIKE '%".$searchText."%'
                            OR  BaseTbl.location  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
       
        $this->db->order_by('BaseTbl.jobId', 'ASC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }

     function viewMyRepairRequestCount($searchText = '')
    {
        $this->db->select('BaseTbl.jobId,BaseTbl.itemNo, BaseTbl.workDescript, BaseTbl3.name,BaseTbl3.bldgNo,BaseTbl3.roomNo, BaseTbl.dateReq, BaseTbl2.name as Resname, BaseTbl.remark');
        $this->db->from('tbl_job_request as BaseTbl');
        $this->db->join('tbl_users as BaseTbl2','BaseTbl.resBy = BaseTbl2.userId');
        $this->db->join('tbl_location as BaseTbl3','BaseTbl.location = BaseTbl3.locID');
        $this->db->where('remark','pending');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.workDescript  LIKE '%".$searchText."%'
                            OR  BaseTbl.location  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
       
        $query = $this->db->get();
        
        return $query->num_rows();
    }
    
    /**
     * This function is used to get the user listing count
     * @param string $searchText : This is optional search text
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    function viewMyRepairRequest($searchText = '', $page, $segment)
    {
       $this->db->select('BaseTbl.jobId,BaseTbl.itemNo, BaseTbl.workDescript, BaseTbl3.name,BaseTbl3.bldgNo,BaseTbl3.roomNo, BaseTbl.dateReq, BaseTbl2.name as Resname, BaseTbl.remark');
        $this->db->from('tbl_job_request as BaseTbl');
        $this->db->join('tbl_users as BaseTbl2','BaseTbl.resBy = BaseTbl2.userId');
        $this->db->join('tbl_location as BaseTbl3','BaseTbl.location = BaseTbl3.locID');
        $this->db->where('remark','pending');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.workDescript  LIKE '%".$searchText."%'
                            OR  BaseTbl.location  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
       
        $this->db->order_by('BaseTbl.jobId', 'ASC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }

     function viewMyScheduleCount($searchText = '')
    {
       
        $this->db->select('BaseTbl.jobId,BaseTbl.itemNo, BaseTbl.workDescript, BaseTbl.location, BaseTbl.dateTimeStart, BaseTbl.dateTimeEnd, BaseTbl.remark, BaseTbl.dateReq');
        $this->db->from('tbl_job_request as BaseTbl');
        $this->db->where('personAtend',$this->session->userdata('userId'));
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.workDescript  LIKE '%".$searchText."%'
                            OR  BaseTbl.remark  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
       
        $query = $this->db->get();
        
        return $query->num_rows();
    }
    
    /**
     * This function is used to get the user listing count
     * @param string $searchText : This is optional search text
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    function viewMySchedule($searchText = '', $page, $segment)
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbl_job_request as BaseTbl');
        $this->db->where('personAtend',$this->session->userdata('userId'));
        $this->db->where('remark','pending');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.workDescript  LIKE '%".$searchText."%'
                            OR  BaseTbl.remark  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
       
        $this->db->order_by('BaseTbl.jobId', 'ASC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }

    function viewHistory()
    {
        $id =$this->input->get('id');
        $this->db->select('BaseTbl.dateReq, BaseTbl.description, BaseTbl.partRep,BaseTbl.dateRep,BaseTbl.timeRep,BaseTbl.dateFin,BaseTbl.remark,BaseTb2.name');
        $this->db->from('tbl_equipment_history as BaseTbl');
       $this->db->where('BaseTbl.equipId',$id);
       $this->db->join('tbl_users as BaseTb2','BaseTbl.performedBy = BaseTb2.userId');
        $this->db->order_by('BaseTbl.dateRep', 'DESC');
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }

     function editSchedule($scheduleInfo, $jobId)
    {   
        $this->db->set('jobId','');
        $this->db->where('jobId', $jobId);
        $this->db->update('tbl_job_request', $scheduleInfo);
        
        return TRUE;
    }

     function getJobInfo($jobId)
    {
        $this->db->select('jobId, itemNo, workDescript, location, dateTimeStart,dateTimeEnd,remark,dateReq');
        $this->db->from('tbl_job_request');
        $this->db->where('jobId', $jobId);
        $query = $this->db->get();
        
        return $query->row();
    }
    function viewEventRequestCounts($searchText = '')
    {
        $this->db->select('BaseTbl.formNo, BaseTbl.noParticipant, BaseTbl.dateActual, BaseTbl.timeActual, BaseTbl.dateEnd, BaseTbl.timeEnd, BaseTbl.purpose,BaseTbl.tittleEvent,BaseTbl.contactNo,BaseTbl.departmentID,BaseTbl.venueID,BaseTbl.resBy,BaseTbl.dateReq');
        $this->db->from('tbl_reserve_request as BaseTbl');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.tittleEvent  LIKE '%".$searchText."%'
                            OR  BaseTbl.resBy  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
       
        $query = $this->db->get();
        
        return $query->num_rows();
    }
    
    /**
     * This function is used to get the user listing count
     * @param string $searchText : This is optional search text
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    function viewEventRequests($searchText = '', $page, $segment)
    {
        $this->db->select('BaseTbl.formNo, BaseTbl.noParticipant, BaseTbl.dateActual, BaseTbl.timeActual, BaseTbl.dateEnd, BaseTbl.timeEnd, BaseTbl.purpose,BaseTbl.tittleEvent,BaseTbl.contactNo,BaseTbl.departmentID,BaseTbl.venueID,BaseTbl.resBy,BaseTbl.dateReq');
        $this->db->from('tbl_reserve_request as BaseTbl');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.tittleEvent  LIKE '%".$searchText."%'
                            OR  BaseTbl.resBy  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
       
        $this->db->order_by('BaseTbl.formNo', 'ASC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }


     function viewRepairRequestCounts($searchText = '')
    {
        $this->db->select('BaseTbl.jobId,BaseTbl.itemNo, BaseTbl.workDescript, BaseTbl.location, BaseTbl.dateReq');
        $this->db->from('tbl_job_request as BaseTbl');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.workDescript  LIKE '%".$searchText."%'
                            OR  BaseTbl.location  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
       
        $query = $this->db->get();
        
        return $query->num_rows();
    }
    
    /**
     * This function is used to get the user listing count
     * @param string $searchText : This is optional search text
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    function viewRepairRequests($searchText = '', $page, $segment)
    {
        $this->db->select('BaseTbl.jobId,BaseTbl.itemNo, BaseTbl.workDescript, BaseTbl.location, BaseTbl.dateReq');
        $this->db->from('tbl_job_request as BaseTbl');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.workDescript  LIKE '%".$searchText."%'
                            OR  BaseTbl.location  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
       
        $this->db->order_by('BaseTbl.jobId', 'ASC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }

    function viewSummaryReportCount($searchText = '')
    {
        $this->db->select('BaseTbl.itemNo, BaseTbl.workDescript, BaseTbl.location,BaseTbl.dateTimeStart,BaseTbl.dateTimeEnd, BaseTbl.dateReq');
        $this->db->from('tbl_job_request as BaseTbl');
         $this->db->where('personAtend',$this->session->userdata('userId'));
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.workDescript  LIKE '%".$searchText."%'
                            OR  BaseTbl.location  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
       
        $query = $this->db->get();
        
        return $query->num_rows();
    }
    
    /**on is used to get the user listing count
     * @param string $searchText : This is optional search text
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    function viewSummaryReport($searchText = '', $page, $segment)
    {
        $this->db->select('BaseTbl.itemNo, BaseTbl.workDescript, BaseTbl.location,BaseTbl.dateTimeStart,BaseTbl.dateTimeEnd, BaseTbl.dateReq');
        $this->db->from('tbl_job_request as BaseTbl');
         $this->db->where('personAtend',$this->session->userdata('userId'));
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.workDescript  LIKE '%".$searchText."%'
                            OR  BaseTbl.location  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
       
        $this->db->order_by('BaseTbl.jobId', 'ASC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }

    function viewStudentRequestCount($searchText = '')
    {
        $this->db->select('BaseTbl.dateActual,BaseTbl.timeActual,BaseTbl.dateEnd, BaseTbl.timeEnd,BaseTbl.purpose,BaseTbl.tittleEvent,BaseTbl.contactNo,BaseTbl2.acroname,BaseTbl3.name,BaseTbl.dateReq,BaseTbl.status');
        $this->db->from('tbl_reserve_request as BaseTbl');
        $this->db->join('tbl_department as BaseTbl2','BaseTbl.departmentID = BaseTbl2.departId');
        $this->db->join('tbl_venue as BaseTbl3','BaseTbl.venueID = BaseTbl3.venID');
         $this->db->where('resBy',$this->session->userdata('userId'));
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.purpose  LIKE '%".$searchText."%'
                            OR  BaseTbl.tittleEvent  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
       
        $query = $this->db->get();
        
        return $query->num_rows();
    }
    
    /**
     * This function is used to get the user listing count
     * @param string $searchText : This is optional search text
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    function viewStudentRequest($searchText = '', $page, $segment)
    {
      
        $this->db->select('BaseTbl.dateActual,BaseTbl.timeActual,BaseTbl.dateEnd, BaseTbl.timeEnd,BaseTbl.purpose,BaseTbl.tittleEvent,BaseTbl.contactNo,BaseTbl2.acroname,BaseTbl3.name,BaseTbl.dateReq, BaseTbl.status');
        $this->db->from('tbl_reserve_request as BaseTbl');
        $this->db->join('tbl_department as BaseTbl2','BaseTbl.departmentID = BaseTbl2.departId');
        $this->db->join('tbl_venue as BaseTbl3','BaseTbl.venueID = BaseTbl3.venID');
        $this->db->where('resBy',$this->session->userdata('userId'));
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.purpose  LIKE '%".$searchText."%'
                            OR  BaseTbl.tittleEvent  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
       
        $this->db->order_by('BaseTbl.formNo', 'ASC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }

    function viewTheRepairRequestCount($searchText = '')
    {
        $this->db->select('BaseTbl.jobId,BaseTbl.itemNo, BaseTbl.workDescript, BaseTbl3.name,BaseTbl3.bldgNo,BaseTbl3.roomNo,BaseTbl.dateTimeStart, BaseTbl.dateReq, BaseTbl2.name as Resname, BaseTbl.remark');
        $this->db->from('tbl_job_request as BaseTbl');
        $this->db->join('tbl_users as BaseTbl2','BaseTbl.resBy = BaseTbl2.userId');
        $this->db->join('tbl_location as BaseTbl3','BaseTbl.location = BaseTbl3.locID');
        $this->db->where('remark','pending');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.workDescript  LIKE '%".$searchText."%'
                            OR  BaseTbl.location  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
       
        $query = $this->db->get();
        
        return $query->num_rows();
    }
        
    /**
     * This function is used to get the user listing count
     * @param string $searchText : This is optional search text
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    function viewTheRepairRequests($searchText = '', $page, $segment,$id)
    {
         $this->db->select('BaseTbl.jobId,BaseTbl.itemNo, BaseTbl.workDescript, BaseTbl3.name,BaseTbl3.bldgNo,BaseTbl3.roomNo, BaseTbl.dateTimeStart, BaseTbl.dateReq, BaseTbl2.name as Resname, BaseTbl.remark');
        $this->db->from('tbl_job_request as BaseTbl');
        $this->db->join('tbl_users as BaseTbl2','BaseTbl.resBy = BaseTbl2.userId');
        $this->db->join('tbl_location as BaseTbl3','BaseTbl.location = BaseTbl3.locID');
        $this->db->where('jobId',$id);
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.workDescript  LIKE '%".$searchText."%'
                            OR  BaseTbl.location  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
       
        $this->db->order_by('BaseTbl.jobId', 'ASC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }

    function viewStudentRequests($searchText = '', $page, $segment,$id)
    {
        $this->db->select('BaseTbl.formNo, BaseTbl.noParticipant, BaseTbl.dateActual, BaseTbl.timeActual, BaseTbl.dateEnd, BaseTbl.timeEnd, BaseTbl.purpose,BaseTbl.tittleEvent,BaseTbl.contactNo,BaseTb2.acroname,BaseTb3.name,BaseTb4.name as fullname,BaseTbl.dateReq');
        $this->db->from('tbl_reserve_request as BaseTbl');
        $this->db->join('tbl_department as BaseTb2','BaseTbl.departmentID = BaseTb2.departId');
        $this->db->join('tbl_venue as BaseTb3','BaseTbl.venueID = BaseTb3.venID');
        $this->db->join('tbl_users as BaseTb4','BaseTbl.resBy = BaseTb4.userId');
        $this->db->where('resBy',$id);
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.tittleEvent  LIKE '%".$searchText."%'
                            OR  BaseTbl.resBy  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
       
        $this->db->order_by('BaseTbl.formNo', 'ASC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }

}

  