<?php
$jobId = $data[0]->jobId;
$itemNo = $data[0]->itemNo;
$location = $data[0]->location;
$workDescript = $data[0]->workDescript;
$dateTimeStart = $data[0]->dateTimeStart;
$dateTimeEnd = $data[0]->dateTimeEnd;
$remark = $data[0]->remark;
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> Add Repair Request
        <small>Add</small>
      </h1>
    </section>
    
    <section class="content">
    
        <div class="row">
            <!-- left column -->
            <div class="col-md-8">
              <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Enter Details</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <?php $this->load->helper("form"); ?>
                    <form role="form" id="addUser" action="<?php echo base_url() ?>Main/jobRequestUpdate" method="post" role="form">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="itemNo">Item Number:</label>
                                        <input type="text" class="form-control required" value="<?php echo $itemNo; ?>" id="itemNo" name="itemNo" maxlength="128" placeholder="Item Number" readonly>
                                        <input type="hidden" class="form-control required" value="<?php echo $jobId; ?>" id="jobId" name="jobId" >
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="location">Location:</label>
                                        <input type="text" class="form-control required" id="location" name="location" maxlength="20" placeholder="Location" value="<?php echo $location; ?>" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="description">Work Description:</label>
                                        <input type="textarea" class="form-control required " id="description" value="<?php echo $workDescript; ?>" name="description" maxlength="128" readonly placeholder="Work Description" style="height: 50px;">

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="description">Date Time Start:</label>
                                        <input type="text" class="form-control required " id="description" value="<?php echo $dateTimeStart; ?>" name="dateTimeStart" maxlength="128" placeholder="Work Description"  readonly>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="description">Date Time End:</label>
                                        <input type="date" class="form-control required " id="description" value="<?php echo $dateTimeEnd; ?>" name="dateTimeEnd" maxlength="128" placeholder="Date Time End"  >
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="description">Remark:</label>
                                        <select name="remark" id="remark" class="form-control">
                                            <option value="pending">Pending</option>
                                            <option value="finished">Finished</option>
                                        </select>
                                        <!-- <input type="textarea" class="form-control required " id="description" value="<?php echo $remark; ?>" name="remark" maxlength="128" placeholder="Remark"  > -->
                                    </div>
                                </div>
                            </div>
                        </div><!-- /.box-body -->
                        <div class="box-footer">
                            <input type="submit" class="btn btn-primary" value="Submit" />
                            <input type="reset" class="btn btn-default" value="Reset" />
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-4">
                <?php
                    $this->load->helper('form');
                    $error = $this->session->flashdata('error');
                    if($error)
                    {
                ?>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('error'); ?>                    
                </div>
                <?php } ?>
                <?php  
                    $success = $this->session->flashdata('success');
                    if($success)
                    {
                ?>
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('success'); ?>
                </div>
                <?php } ?>
                
                <div class="row">
                    <div class="col-md-12">
                        <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                    </div>
                </div>
            </div>
        </div>    
    </section>
    
</div>
<script src="<?php echo base_url(); ?>assets/js/addUser.js" type="text/javascript"></script>