<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class : Login_model (Login Model)
 * Login model class to get to authenticate user credentials 
 * @author : Kishor Mali
 * @version : 1.1
 * @since : 15 November 2016
 */
class Calendar_model extends CI_Model
{
    public function get_events($start, $end)
	{
	    // return $this->db->where("dateTimeActual >=", $start)->where("dateTimeEnd <=", $end)->get("tbl_reserve_request");
	    return $this->db->where("status","approve")->get("tbl_reserve_request");
	}

	public function add_event($data)
	{
	    $this->db->insert("calendar_events", $data);
	}

	public function get_event($id)
	{
	    return $this->db->where("ID", $id)->get("calendar_events");
	}

	public function update_event($id, $data)
	{
	    $this->db->where("ID", $id)->update("calendar_events", $data);
	}

	public function delete_event($id)
	{
	    $this->db->where("ID", $id)->delete("calendar_events");
	}
}

?>