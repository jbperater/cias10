<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> Report
        <small>View</small>
         <i class="button">
                            <input type="submit" onclick="window.print()" class="btn btn-primary" style="float: right;" value="Print" />
                    </i>
      </h1>
    </section>
    <section class="content">
        <div class="row">
        </div>
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Summary Report</h3>
                    <div class="box-tools">

                    </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                    <tr>
                        <th>Number of Items</th>
                        <th>Work Description</th>
                        <th>Location</th>
                        <th>Date and Time Started</th>
                        <th>Date and Time Finished</th>
                        <th>Date and Time Requested</th>
                    </tr>
                    <?php
                    if(!empty($userRecords))
                    {
                        foreach($userRecords as $record)
                        {
                    ?>
                    <tr>
                        <td><?php echo $record->itemNo ?></td>
                        <td><?php echo $record->workDescript ?></td>
                        <td><?php echo $record->location ?></td>
                        <td><?php echo $record->dateTimeStart ?></td>
                        <td><?php echo $record->dateTimeEnd ?></td>
                        <td><?php echo $record->dateReq ?></td>
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
    </section>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/common.js" charset="utf-8"></script>
<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('ul.pagination li a').click(function (e) {
            e.preventDefault();            
            var link = jQuery(this).get(0).href;            
            var value = link.substring(link.lastIndexOf('/') + 1);
            jQuery("#searchList").attr("action", baseURL + "userListing/" + value);
            jQuery("#searchList").submit();
        });
    });
</script>

