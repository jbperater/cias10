<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class : Errorr_404 (ErrorController)
 * Error class to redirect on errors
 * @author : Kishor Mali
 * @version : 1.1
 * @since : 15 November 2016
 */
class Calendar extends CI_Controller
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('calendar_model');
    }

    /**
     * Index Page for this controller.
     */
    public function index()
    {
        $this->isLoggedIn();
    }
    
    /**
     * This function used to check the user is logged in or not
     */
     public function get_events()
     {
         // Our Start and End Dates
         $start = $this->input->get("start");
         $end = $this->input->get("end");

         $startdt = new DateTime('now'); // setup a local datetime
         $startdt->setTimestamp($start); // Set the date based on timestamp
         $start_format = $startdt->format('Y-m-d H:i:s');
        
         $enddt = new DateTime('now'); // setup a local datetime
         $enddt->setTimestamp($end); // Set the date based on timestamp
         $end_format = $enddt->format('Y-m-d H:i:s');
         
         // $events = $this->calendar_model->get_events($start_format, $end_format);
         $events = $this->calendar_model->get_events($start_format, $end_format);

         $data_events = array();

         foreach($events->result() as $r) {

             $data_events[] = array(
                 "id" => $r->formNo,
                 "title" => $r->tittleEvent,
                 "description" => $r->purpose,
                 "start" => $r->dateActual,
                 "end" => $r->dateEnd.'T12:30:00'
                 
             );
         }

         echo json_encode(array("events" => $data_events));
         exit();
     }
}

?>
