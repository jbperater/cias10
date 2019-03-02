<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class : Login_model (Login Model)
 * Login model class to get to authenticate user credentials 
 * @author : Kishor Mali
 * @version : 1.1
 * @since : 15 November 2016
 */
class Main_model extends CI_Model
{


	function approveEventRequests($id,$description){
      	$this->db->set('status','approve');
        $this->db->set('description',$description);
      	$this->db->where('formNo',$id);
      	$this->db->update('tbl_reserve_request');
  	}

  function disapproveEventRequests($id,$description){
        $this->db->set('status','disapprove');
        $this->db->set('description',$description);
        $this->db->where('formNo',$id);
        $this->db->update('tbl_reserve_request');
    }

	function approveJobRequests($id,$personel,$date_actual,$description){

      	$this->db->set('remark','approve');
        $this->db->set('dateTimeStart',$date_actual);
      	$this->db->set('personAtend',$personel);
        $this->db->set('description',$description);
      	$this->db->where('jobId',$id);
      	$this->db->update('tbl_job_request');
  	}

    function disapproveJobRequests($id,$description){

        $this->db->set('remark','disapprove');
        $this->db->set('description',$description);
        $this->db->where('jobId',$id);
        $this->db->update('tbl_job_request');
    }


    function assignNotify($id){
    
        $this->db->set('ownerNotify',1);
        $this->db->where('id',$id);
        $this->db->where('type','maintenance');
        $this->db->update('tbl_notification');
    }

    function eventNotify($id){
        $this->db->set('ownerNotify',1);
        $this->db->where('id',$id);
        $this->db->where('type','event');
        $this->db->update('tbl_notification');
    }

    function eventUnNotifyAdmin($id){
        $this->db->set('adminNotify',0);
        $this->db->where('id',$id);
        $this->db->where('type','maintenance');
        $this->db->update('tbl_notification');
    }
    function eventUnNotify($id){
        $this->db->set('ownerNotify',0);
        $this->db->where('id',$id);
        $this->db->where('type','event');
        $this->db->update('tbl_notification');
    }

     function jobRequestNotify($id,$personel){
        $this->db->set('ownerNotify',1);
        $this->db->set('assign',$personel);
        $this->db->where('id',$id);
        $this->db->where('type','maintenance');
        $this->db->update('tbl_notification');
    }

    function jobRequestUnNotify($id){
        $this->db->set('ownerNotify',0);
        $this->db->where('id',$id);
        $this->db->where('type','maintenance');
        $this->db->update('tbl_notification');
    }
    
    function getVenue(){
      	$this->db->select('venID,bldgNo,name,type');
      	$result = $this->db->get('tbl_venue');
      	return $result->result();
  	}

  	function getEventEquipment(){
      	$this->db->select('equipId,name,type');
      	$result = $this->db->get('tbl_event_equip');
      	return $result->result();
  	}

    function getJobRequestData($id){
        $this->db->select('jobId,itemNo,workDescript,location,dateTimeStart,dateTimeEnd,remark');
        $this->db->where('jobId',$id);
        $result = $this->db->get('tbl_job_request');
        return $result->result();
    }  

  	function getDepartment(){
      	$this->db->select('departId,acroname,name');
      	$result = $this->db->get('tbl_department');
     	return $result->result();
  	}

    function getLocation(){
        $this->db->select('locID,bldgNo,roomNo,name');
        $result = $this->db->get('tbl_location');
      return $result->result();
    }

  	function getLastId(){
      	$last=$this->db->insert_id('tbl_reserve_request',array('form_no' => 'value'));
		return $last;
  	}

  	function getMaintenanceStaff(){
      	$this->db->select('userId,name,roleId');
      	$this->db->where('roleId',3);
      	$result = $this->db->get('tbl_users');
     	return $result->result();
  	}

  	function venueInsert($data) {
		$this->db->insert('tbl_venue',$data);		
	}

	function departmentInsert($data) {
		$this->db->insert('tbl_department',$data);		
	}
  function locationInsert($data) {
    $this->db->insert('tbl_location',$data);    
  }

	function equipmentInsert($data) {
		$this->db->insert('tbl_equipment',$data);		
	}

	function jobRequestInsert($data) {
		$this->db->insert('tbl_job_request',$data);		
	}

	function eventRequestInsert($data) {
		$this->db->insert('tbl_reserve_request',$data);		
	}

	function eventVenueInsert($lastId,$data){
		foreach ($data as $data) {
			$query="insert into ass_reserve_venue values('$lastId','$data')";
			$this->db->query($query);
		}	
	}

	function eventEquipmentInsert($lastId,$data,$table,$chair) {
		foreach ($data as $data) {
			$query="insert into ass_reserve_equip_need values('$lastId','$data',$table,$chair)";
			$this->db->query($query);
		}	
	}

  function adminEventEquipmentInsert($data) {
    $this->db->insert('tbl_event_equip',$data); 
    
  }

	function getEquipment(){
      	$this->db->select('equipName,brand,model,serialNo,office,department,type,yearAcc');
      	$result = $this->db->get('tbl_equipment');
     	return $result->result();
  	}

  	function getNotification($roleId){
      	$this->db->select('tbl_notification.id,tbl_notification.nofiName,tbl_notification.type,tbl_notification.ownerNotify,tbl_notification.adminNotify,tbl_notification.resBy,tbl_users.name');
      	$this->db->from('tbl_notification');
      	$this->db->join('tbl_users','tbl_notification.resBy=tbl_users.userId');
      	if($roleId == 1){
      		$this->db->where('adminNotify',1);
      		$this->db->where('resBy !=',$this->session->userdata('userId'));
      	}
      	elseif($roleId == 2){
      		$this->db->where('ownerNotify',1);
      		$this->db->where('resBy',$this->session->userdata('userId'));
          
      	}
      	elseif($roleId == 3){
      		$this->db->where('ownerNotify',1);
      		$this->db->where('assign',$this->session->userdata('userId'));
          
      	}
      	else{
      		$this->db->where('ownerNotify',1);
      		$this->db->where('resBy',$this->session->userdata('userId'));
         
      	}
        $this->db->order_by('time','desc');
      	$result = $this->db->get();
     	return $result->result();
  	}

  	function historyInsert($data) {
		$this->db->insert('tbl_equipment_history',$data);		
	}

   function get_data(){
      $this->db->select('year,purchase,sale,profit');
      $result = $this->db->get('account');
      return $result;
  }

  function jobRequestUpdate($id,$date,$remark) {
     $this->db->set('dateTimeEnd',$date);
     $this->db->set('remark',$remark);
     $this->db->where('jobId',$id);
     $this->db->update('tbl_job_request');
       
  }

  function viewStudentRequestsCounts($searchText = '')
    {
        $this->db->select('BaseTbl.formNo, BaseTbl.noParticipant, BaseTbl.dateActual, BaseTbl.timeActual, BaseTbl.dateEnd, BaseTbl.timeEnd, BaseTbl.purpose,BaseTbl.tittleEvent,BaseTbl.contactNo,BaseTb2.acroname,BaseTb3.name,BaseTb4.name as fullname,BaseTbl.dateReq, BaseTbl.status');
        $this->db->from('tbl_reserve_request as BaseTbl');
        $this->db->join('tbl_department as BaseTb2','BaseTbl.departmentID = BaseTb2.departId');
        $this->db->join('tbl_venue as BaseTb3','BaseTbl.venueID = BaseTb3.venID');
        $this->db->join('tbl_users as BaseTb4','BaseTbl.resBy = BaseTb4.userId');
        $this->db->where('resBy',$this->session->userdata('userId'));
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.workDescript  LIKE '%".$searchText."%'
                            OR  BaseTbl.location  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
       
        $query = $this->db->get();
        
        return $query->num_rows();
    }

  function viewStudentRequests($searchText = '', $page, $segment)
    {
        $this->db->select('BaseTbl.formNo, BaseTbl.noParticipant, BaseTbl.dateActual, BaseTbl.timeActual, BaseTbl.dateEnd, BaseTbl.timeEnd, BaseTbl.purpose,BaseTbl.tittleEvent,BaseTbl.contactNo,BaseTb2.acroname,BaseTb3.name,BaseTb4.name as fullname,BaseTbl.dateReq, BaseTbl.status');
        $this->db->from('tbl_reserve_request as BaseTbl');
        $this->db->join('tbl_department as BaseTb2','BaseTbl.departmentID = BaseTb2.departId');
        $this->db->join('tbl_venue as BaseTb3','BaseTbl.venueID = BaseTb3.venID');
        $this->db->join('tbl_users as BaseTb4','BaseTbl.resBy = BaseTb4.userId');
        $this->db->where('resBy',$this->session->userdata('userId'));
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

    function viewStudentApproveRequestsCounts($searchText = '')
    {
        $this->db->select('BaseTbl.formNo, BaseTbl.noParticipant, BaseTbl.dateActual, BaseTbl.timeActual, BaseTbl.dateEnd, BaseTbl.timeEnd, BaseTbl.purpose,BaseTbl.tittleEvent,BaseTbl.contactNo,BaseTb2.acroname,BaseTb3.name,BaseTb4.name as fullname,BaseTbl.dateReq, BaseTbl.status');
        $this->db->from('tbl_reserve_request as BaseTbl');
        $this->db->join('tbl_department as BaseTb2','BaseTbl.departmentID = BaseTb2.departId');
        $this->db->join('tbl_venue as BaseTb3','BaseTbl.venueID = BaseTb3.venID');
        $this->db->join('tbl_users as BaseTb4','BaseTbl.resBy = BaseTb4.userId');
        $this->db->where('status','approve');
        $this->db->where('resBy',$this->session->userdata('userId'));
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.workDescript  LIKE '%".$searchText."%'
                            OR  BaseTbl.location  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
       
        $query = $this->db->get();
        
        return $query->num_rows();
    }

  function viewStudentApproveRequests($searchText = '', $page, $segment)
    {
        $this->db->select('BaseTbl.formNo, BaseTbl.noParticipant, BaseTbl.dateActual, BaseTbl.timeActual, BaseTbl.dateEnd, BaseTbl.timeEnd, BaseTbl.purpose,BaseTbl.tittleEvent,BaseTbl.contactNo,BaseTb2.acroname,BaseTb3.name,BaseTb4.name as fullname,BaseTbl.dateReq, BaseTbl.status');
        $this->db->from('tbl_reserve_request as BaseTbl');
        $this->db->join('tbl_department as BaseTb2','BaseTbl.departmentID = BaseTb2.departId');
        $this->db->join('tbl_venue as BaseTb3','BaseTbl.venueID = BaseTb3.venID');
        $this->db->join('tbl_users as BaseTb4','BaseTbl.resBy = BaseTb4.userId');
        $this->db->where('status','approve');
        $this->db->where('resBy',$this->session->userdata('userId'));
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

    function viewStudentPendingRequestsCounts($searchText = '')
    {
        $this->db->select('BaseTbl.formNo, BaseTbl.noParticipant, BaseTbl.dateActual, BaseTbl.timeActual, BaseTbl.dateEnd, BaseTbl.timeEnd, BaseTbl.purpose,BaseTbl.tittleEvent,BaseTbl.contactNo,BaseTb2.acroname,BaseTb3.name,BaseTb4.name as fullname,BaseTbl.dateReq, BaseTbl.status');
        $this->db->from('tbl_reserve_request as BaseTbl');
        $this->db->join('tbl_department as BaseTb2','BaseTbl.departmentID = BaseTb2.departId');
        $this->db->join('tbl_venue as BaseTb3','BaseTbl.venueID = BaseTb3.venID');
        $this->db->join('tbl_users as BaseTb4','BaseTbl.resBy = BaseTb4.userId');
        $this->db->where('status','pending');
        $this->db->where('resBy',$this->session->userdata('userId'));
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.workDescript  LIKE '%".$searchText."%'
                            OR  BaseTbl.location  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
       
        $query = $this->db->get();
        
        return $query->num_rows();
    }

  function viewStudentPendingRequests($searchText = '', $page, $segment)
    {
        $this->db->select('BaseTbl.formNo, BaseTbl.noParticipant, BaseTbl.dateActual, BaseTbl.timeActual, BaseTbl.dateEnd, BaseTbl.timeEnd, BaseTbl.purpose,BaseTbl.tittleEvent,BaseTbl.contactNo,BaseTb2.acroname,BaseTb3.name,BaseTb4.name as fullname,BaseTbl.dateReq, BaseTbl.status');
        $this->db->from('tbl_reserve_request as BaseTbl');
        $this->db->join('tbl_department as BaseTb2','BaseTbl.departmentID = BaseTb2.departId');
        $this->db->join('tbl_venue as BaseTb3','BaseTbl.venueID = BaseTb3.venID');
        $this->db->join('tbl_users as BaseTb4','BaseTbl.resBy = BaseTb4.userId');
        $this->db->where('status','pending');
        $this->db->where('resBy',$this->session->userdata('userId'));
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

    function viewStudentDeclineRequestsCounts($searchText = '')
    {
        $this->db->select('BaseTbl.formNo, BaseTbl.noParticipant, BaseTbl.dateActual, BaseTbl.timeActual, BaseTbl.dateEnd, BaseTbl.timeEnd, BaseTbl.purpose,BaseTbl.tittleEvent,BaseTbl.contactNo,BaseTb2.acroname,BaseTb3.name,BaseTb4.name as fullname,BaseTbl.dateReq, BaseTbl.status');
        $this->db->from('tbl_reserve_request as BaseTbl');
        $this->db->join('tbl_department as BaseTb2','BaseTbl.departmentID = BaseTb2.departId');
        $this->db->join('tbl_venue as BaseTb3','BaseTbl.venueID = BaseTb3.venID');
        $this->db->join('tbl_users as BaseTb4','BaseTbl.resBy = BaseTb4.userId');
        $this->db->where('status','decline');
        $this->db->where('resBy',$this->session->userdata('userId'));
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.workDescript  LIKE '%".$searchText."%'
                            OR  BaseTbl.location  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
       
        $query = $this->db->get();
        
        return $query->num_rows();
    }

  function viewStudentDeclineRequests($searchText = '', $page, $segment)
    {
        $this->db->select('BaseTbl.formNo, BaseTbl.noParticipant, BaseTbl.dateActual, BaseTbl.timeActual, BaseTbl.dateEnd, BaseTbl.timeEnd, BaseTbl.purpose,BaseTbl.tittleEvent,BaseTbl.contactNo,BaseTb2.acroname,BaseTb3.name,BaseTb4.name as fullname,BaseTbl.dateReq, BaseTbl.status');
        $this->db->from('tbl_reserve_request as BaseTbl');
        $this->db->join('tbl_department as BaseTb2','BaseTbl.departmentID = BaseTb2.departId');
        $this->db->join('tbl_venue as BaseTb3','BaseTbl.venueID = BaseTb3.venID');
        $this->db->join('tbl_users as BaseTb4','BaseTbl.resBy = BaseTb4.userId');
        $this->db->where('status','decline');
        $this->db->where('resBy',$this->session->userdata('userId'));
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
        $this->db->where('resBy',$this->session->userdata('userId'));
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
    function viewRepairRequests($searchText = '', $page, $segment,$id)
    {
        $this->db->select('BaseTbl.jobId,BaseTbl.itemNo, BaseTbl.workDescript, BaseTbl.location, BaseTbl.dateTimeStart, BaseTbl.remark, BaseTbl.dateReq');
        $this->db->from('tbl_job_request as BaseTbl');
        $this->db->where('resBy',$this->session->userdata('userId'));
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

     function viewRepairPendingRequestCounts($searchText = '')
    {
        $this->db->select('BaseTbl.jobId,BaseTbl.itemNo, BaseTbl.workDescript, BaseTbl.location, BaseTbl.dateReq');
        $this->db->from('tbl_job_request as BaseTbl');
        $this->db->where('remark','pending');
        $this->db->where('resBy',$this->session->userdata('userId'));
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
    function viewRepairPendingRequests($searchText = '', $page, $segment,$id)
    {
        $this->db->select('BaseTbl.jobId,BaseTbl.itemNo, BaseTbl.workDescript, BaseTbl.location, BaseTbl.dateTimeStart, BaseTbl.remark, BaseTbl.dateReq');
        $this->db->from('tbl_job_request as BaseTbl');
        $this->db->where('remark','pending');
        $this->db->where('resBy',$this->session->userdata('userId'));
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

    function viewRepairApproveRequestCounts($searchText = '')
    {
        $this->db->select('BaseTbl.jobId,BaseTbl.itemNo, BaseTbl.workDescript, BaseTbl.location, BaseTbl.dateReq');
        $this->db->from('tbl_job_request as BaseTbl');
        $this->db->where('remark','approve');
        $this->db->where('resBy',$this->session->userdata('userId'));
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
    function viewRepairApproveRequests($searchText = '', $page, $segment,$id)
    {
        $this->db->select('BaseTbl.jobId,BaseTbl.itemNo, BaseTbl.workDescript, BaseTbl.location, BaseTbl.dateTimeStart, BaseTbl.remark, BaseTbl.dateReq');
        $this->db->from('tbl_job_request as BaseTbl');
        $this->db->where('remark','approve');
        $this->db->where('resBy',$this->session->userdata('userId'));
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

    function viewRepairDeclineRequestCounts($searchText = '')
    {
        $this->db->select('BaseTbl.jobId,BaseTbl.itemNo, BaseTbl.workDescript, BaseTbl.location, BaseTbl.dateReq');
        $this->db->from('tbl_job_request as BaseTbl');
        $this->db->where('remark','decline');
        $this->db->where('resBy',$this->session->userdata('userId'));
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
    function viewRepairDeclineRequests($searchText = '', $page, $segment,$id)
    {
        $this->db->select('BaseTbl.jobId,BaseTbl.itemNo, BaseTbl.workDescript, BaseTbl.location, BaseTbl.dateTimeStart, BaseTbl.remark, BaseTbl.dateReq');
        $this->db->from('tbl_job_request as BaseTbl');
        $this->db->where('remark','decline');
        $this->db->where('resBy',$this->session->userdata('userId'));
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

    function viewRepairFinishedRequestCounts($searchText = '')
    {
        $this->db->select('BaseTbl.jobId,BaseTbl.itemNo, BaseTbl.workDescript, BaseTbl.location, BaseTbl.dateReq');
        $this->db->from('tbl_job_request as BaseTbl');
        $this->db->where('remark','finished');
        $this->db->where('resBy',$this->session->userdata('userId'));
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
    function viewRepairFinishedRequests($searchText = '', $page, $segment,$id)
    {
        $this->db->select('BaseTbl.jobId,BaseTbl.itemNo, BaseTbl.workDescript, BaseTbl.location, BaseTbl.dateTimeStart, BaseTbl.remark, BaseTbl.dateReq');
        $this->db->from('tbl_job_request as BaseTbl');
        $this->db->where('remark','finished');
        $this->db->where('resBy',$this->session->userdata('userId'));
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

    function validateRequest($dateActual,$timeActual,$dateEnd,$timeEnd,$venueID){

        $this->db->select('*');
        $this->db->from('tbl_reserve_request');
        $this->db->where('status','approve');
        $this->db->where('dateActual',$dateActual);
        $this->db->where('timeActual <=',$timeEnd);
        $this->db->where('dateEnd',$dateEnd);
        $this->db->where('timeEnd >=',$timeActual);
        $this->db->where('venueID',$venueID);
        $query = $this->db->get();
        $result = $query->result(); 
        if($result == NUll){
            return TRUE;
        }else{
            return FALSE;
        }      
        

    }


	
}

?>