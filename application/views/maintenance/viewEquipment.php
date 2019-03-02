<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i>Equipments
        <small>View</small>
      </h1>
    </section>
    <section class="content">
        <div class="row">
        </div>
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Equipments</h3>
                    <div class="box-tools">
                        <form action="<?php echo base_url() ?>viewEquipment" method="POST" id="searchList">
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
                        <th>Equipment Name</th>
                        <th>Brand</th>
                        <th>Model</th>
                        <th>Serial Number</th>
                        <th>Office</th>
                        <th>Department</th>
                        <th>Type</th>
                        <th>Year Acquired</th>
                         <th class="text-center">Actions</th>
                    </tr>
                    <?php
                    if(!empty($userRecords))
                    {
                        foreach($userRecords as $record)
                        {
                    ?>
                    <tr>
                        <td><?php echo $record->equipName ?></td>
                        <td><?php echo $record->brand ?></td>
                        <td><?php echo $record->model ?></td>
                        <td><?php echo $record->serialNo ?></td>
                        <td><?php echo $record->office ?></td>
                        <td><?php echo $record->department ?></td>
                        <td><?php echo $record->type ?></td>
                        <td><?php echo $record->yearAcc ?></td>
                        <td class="text-center">
                            <a class="btn btn-sm btn-info" href="<?= base_url().'main/viewAddNewHistory?id='.$record->equipId; ?>" data-userid="" title="Add Records"><i class="fa fa-check"></i></a>
                            <a class="btn btn-sm btn-info" href="<?= base_url().'user/viewHistory?id='.$record->equipId; ?>" data-userid="" title="View Records"><i class="fa fa-pencil"></i></a>
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
