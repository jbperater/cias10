

    <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>AMS: Assisstive Management System For Mechanical And Electrical Unit Of USTP</b>
        </div>
        <strong>Copyright &copy; 2019 <a href="<?php echo base_url(); ?>">AMS</a>.</strong> All rights reserved.
    </footer>
    
    <script src="<?php echo base_url(); ?>assets/dist/js/adminlte.min.js" type="text/javascript"></script>
    <!-- <script src="<?php echo base_url(); ?>assets/dist/js/pages/dashboard.js" type="text/javascript"></script> -->
    <!-- <script src="<?php echo base_url(); ?>assets/js/jquery.validate.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/js/validation.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>assets/js/jquery.js"></script> -->
    <script src="<?php echo base_url() ?>assets/bower_components/fullcalendar/lib/moment.min.js"></script>
    <script src="<?php echo base_url() ?>assets/bower_components/fullcalendar/fullcalendar.min.js"></script>
    <script src="<?php echo base_url() ?>assets/bower_components/fullcalendar/gcal.js"></script>
    
    <script type="text/javascript">
        var windowURL = window.location.href;
        pageURL = windowURL.substring(0, windowURL.lastIndexOf('/'));
        var x= $('a[href="'+pageURL+'"]');
            x.addClass('active');
            x.parent().addClass('active');
        var y= $('a[href="'+windowURL+'"]');
            y.addClass('active');
            y.parent().addClass('active');
    </script>
    
  </body>
</html>