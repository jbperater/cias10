<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> Add Event Reservation
        <small>Add Reservation</small>
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
                    <form role="form" id="addUser" action="<?php echo base_url() ?>Main/eventRequestInsert" method="post" role="form">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="noParticipants">Number of Participants</label>
                                        <input type="Number" class="form-control required" value="" id="noParticipants" name="noParticipant" maxlength="128" placeholder="Number of Participants">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tittleEvent">Title Of Event</label>
                                        <input type="text" name="tittleEvent" id="tittleEvent" class='form-control' required placeholder="Tittle" value="" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="dateActual">Date Actual Use</label>
                                        <input type="date" name="dateActual" id="dateActual" class='form-control' required placeholder="Date Actual Use" value="" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="dateEnd">Date End Use</label>
                                        <input type="date" name="dateEnd" id="dateEnd" class='form-control' required placeholder="Date End" value="" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="timeActual">Time Actual Use</label>
                                        <input type="time" name="timeActual" id="timeActual" class='form-control' required placeholder="Time Actual" value="" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="timeEnd">Time End Use</label>
                                        <input type="time" name="timeEnd" id="timeEnd" class='form-control' required placeholder="Time End" value="" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="purpose">Purpose</label>
                                        <input type="text" name="purpose" id="purpose" class='form-control' required placeholder="Purpose">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="contactNo">Contact No</label>
                                        <input type="text" class="form-control required" id="contactNo" value="" name="contactNo" maxlength="10" placeholder="Contact Number">
                                    </div>
                                </div>    
                            </div>
                            <div class="row">
                                 <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="venue">Venue (please check)</label><br>
                                       
                                              <!-- <input type="checkbox" id="venue" name="venue[]" value="<?=$venuedata->venID;?>"><?=$venuedata->bldgNo;?>&nbsp<?=$venuedata->name;?>&nbsp<?=$venuedata->type;?><br> -->
                                            <select name="venue" id="" class="form-control">
                                                  <?php foreach($venuedata as $venuedata){?>
                                                <option value=<?=$venuedata->venID;?>><?=$venuedata->bldgNo;?> - &nbsp<?=$venuedata->name;?></option>
                                                <?php }?>
                                            </select>
                                            
                                    </div>
                                </div>
                                <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="department">Department (please select)</label>
                                            <select name="department" id="" class="form-control">
                                                  <?php foreach($option as $option){?>
                                                <option value=<?=$option->departId;?>><?=$option->acroname;?> - &nbsp<?=$option->name;?></option>
                                                <?php }?>
                                                </select>
                                        </div>
                                    </div>
                            </div>
                            <div class="row">
                                 <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="venue">Equipment (please check)</label><br>
                                        <?php foreach($equipment as $equipment){?>
                                              <input type="checkbox" id="venue" name="equipment[]" value="<?=$equipment->equipId;?>"><?=$equipment->name;?>&nbsp<?=$equipment->type;?><br>
                                            <?php }?>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="tableNo">Table No</label>
                                        <input type="text" class="form-control required" id="tableNo" value="" name="tableNo" maxlength="10" placeholder="Table No">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="chairNo">Chair No</label>
                                        <input type="text" class="form-control required" id="chairNo" value="" name="chairNo" maxlength="10" placeholder="Chair No">
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
<script src="<?php echo base_url(); ?>assets/js/addEvent.js" type="text/javascript"></script>