<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> View Venue
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
                  <div id="graph"></div>
                </div><!-- /.box-body -->
                
              </div><!-- /.box -->
            </div>
        </div>
    </section>
</div>

<script src="<?php echo base_url(); ?>assets/bower_components/chart.js/chart.min.js"></script>
<script src="<?php echo base_url().'assets/js/raphael-min.js'?>"></script>
    <script src="<?php echo base_url().'assets/bower_components/morris.js/morris.min.js'?>"></script>

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

    Morris.line({
          element: 'graph',
          data: <?php echo $data;?>,
          xkey: 'year',
          ykeys: ['purchase', 'sale', 'profit'],
          labels: ['Purchase', 'Sale', 'Profit']
    });
</script>
