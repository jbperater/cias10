<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> Event Requests
        <small>View/Approve</small>
      </h1>
    </section>
    <section class="content">
        <div class="row">
        </div>
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Event Requests</h3>
                    <div class="box-tools">
                        <form action="<?php echo base_url() ?>user/viewEventRequest" method="POST" id="searchList">
                            <div class="input-group">
                              <input type="text" name="searchText" value="<?php echo $searchText; ?>" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Search"/>
                              <div class="input-group-btn">
                                <button class="btn btn-sm btn-default searchList"><i class="fa fa-search"></i></button>
                              </div>
                            </div>
                        </form>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                    <tr>
                        <th>Form Number</th>
                        <th>Number of Participants</th>
                        <th>Date Actual Use</th>
                        <th>Time Actual Use</th>
                        <th>Date Ended</th>
                        <th>Time Ended</th>
                        <th>Purpose</th>
                        <th>Title Of Event</th>
                        <th>Contact Number</th>
                        <th>Department</th>
                        <th>Venue</th>
                        <th>Reserved By</th>
                        <th>Status</th>
                        <th>Date Requested</th>
                          <th class="text-center">Actions</th>
                    </tr>
                    <?php
                    if(!empty($userRecords))
                    {
                        foreach($userRecords as $record)
                        {
                    ?>
                    <tr>
                        <td><?php echo $record->formNo ?></td>
                        <td><?php echo $record->noParticipant ?></td>
                        <td><?php echo $record->dateActual ?></td>
                        <td><?php echo $record->timeActual ?></td>
                        <td><?php echo $record->dateEnd ?></td>
                        <td><?php echo $record->timeEnd ?></td>
                        <td><?php echo $record->purpose ?></td>
                        <td><?php echo $record->tittleEvent ?></td>
                        <td><?php echo $record->contactNo ?></td>
                        <td><?php echo $record->acroname ?></td>
                        <td><?php echo $record->name ?></td>
                        <td><?php echo $record->fullname ?></td>
                        <td><?php echo $record->status ?></td>
                        <td><?php echo $record->dateReq ?></td>
                         <td class="text-center">
                            <a class="btn btn-sm btn-info" href="<?php echo base_url() ?>main/approveEventDescription?id=<?php echo $record->formNo ?>" title="Approve"><i class="fa fa-check"></i></a>
                            <a class="btn btn-sm btn-danger" href="<?php echo base_url() ?>main/approveEventDescriptionDisapprove?id=<?php echo $record->formNo ?>" data-userid="" title="Disapprove"><i class="fa fa-close"></i></a>
                        </td>
                    </tr>
                    <?php
                        }
                    }
                    ?>
                  </table>
                  
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                    <?php echo $this->pagination->create_links(); ?>
                </div>
              </div><!-- /.box -->
            </div>
        </div>

           <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">
            
              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Notice</h4>
                </div>
                <div class="modal-body">
                  <p>Successfully Approve.</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
              </div>
              
            </div>
          </div>
          <div class="modal fade" id="myModalDis" role="dialog">
            <div class="modal-dialog">
            
              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Notice</h4>
                </div>
                <div class="modal-body">
                  <p>Successfully Disapprove.</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
              </div>
              
            </div>
          </div>
    </section>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/common.js" charset="utf-8"></script>
<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('ul.pagination li a').click(function (e) {
            e.preventDefault();            
            var link = jQuery(this).get(0).href;            
            var value = link.substring(link.lastIndexOf('/') + 1);
            jQuery("#searchList").attr("action", baseURL + "user/viewEventRequest/" + value);
            jQuery("#searchList").submit();
        });
    });

    <?php  
    $this->load->helper('form');
    $success = $this->session->flashdata('success');
        if($success){?>
            $(document).ready(function(){
                $("#myModal").modal('show');
            });
    <?php } ?>

    <?php  
    $this->load->helper('form');
    $error = $this->session->flashdata('error');
        if($error){?>
            $(document).ready(function(){
                $("#myModalDis").modal('show');
            });
    <?php } ?>
</script>
