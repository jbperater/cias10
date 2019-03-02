<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> Repair Management
        <small>Add Personel</small>
      </h1>
    </section>
    
    <section class="content">
    
        <div class="row">
            <!-- left column -->
            <div class="col-md-8">
              <!-- general form elements -->
                
                
                
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Select Assign Personel</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <?php $this->load->helper("form"); ?>
                    <form role="form" id="addUser" action="<?php echo base_url() ?>Main/approveJobRequests" method="post" role="form">
                        <div class="box-body">
                             <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="hidden" value="<?php echo $id ?>" name="id">
                                            <label for="department">Maintenance Personel</label>
                                            <select name="personel" id="" class="form-control">
                                                  <?php foreach($option as $option){?>
                                                <option value=<?=$option->userId;?>><?=$option->name;?></option>
                                                <?php }?>
                                                </select>
                                        </div>
                                    </div>
                            <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="department">Date Started</label>
                                            <input type="date" name="date_actual" class="form-control">
                                        </div>
                                    </div>
                            <div class="col-xs-12">
                                <textarea rows="4" class="col-xs-12" name="description" placeholder="Descriptions"></textarea>    
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