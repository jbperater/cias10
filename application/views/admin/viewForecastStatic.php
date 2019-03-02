<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> Forecast
        <small>View</small>
      </h1>
    </section>
    <section class="content">
        <div class="row">
        </div>
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                    <tr>
                        <th>Months</th>
                        <th>Forecast</th>
                          
                    </tr>
                    <?php
                    if(!empty($data))
                    {
                        $x = 0;
                        $months = array("January","Febuary","March","April","May","June","July","August","September","October","November","December");
                        foreach($data as $record)
                        {

                    ?>
                    <tr>
                        <td><?php echo $months[$x] ?></td>
                        <td><?php echo $record ?></td>
                        <!-- <td><?php echo $record->workDescript ?></td> -->
                    </tr>
                    <?php
                        $x = $x + 1;
                        }
                    }
                    ?>
                  </table>
                  
                </div><!-- /.box-body -->
                
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
