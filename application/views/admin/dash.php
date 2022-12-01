
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Dashboard
            <small>Version 2.0</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Assignment</a></li>
            <li class="active">Dashboard</li>
          </ol>
        </section>
        <?foreach($deadline_date->result() as $dead) {
            $newdate = new DateTime($dead->deadline_date);
            $dd= $newdate->format('d-m-Y');   #d-m-Y  // March 10, 2001, 5:16 pm
            ?>
        <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-ban"></i> Alert!</h4>
        <?='Assignment: "'.$dead->assignment_name.'" due date is '.$dd?>
        </div>
        <? } ?>

        <section class="content">
          <!-- Info boxes -->

          <div class="row">

            <div class="col-md-3 col-sm-6 col-xs-12">

              <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-user"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Total Students</span>
                  <span class="info-box-number">
<?
echo $team2;
?>

                  </span>
                </div><!-- /.info--content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->

            <div class="col-md-3 col-sm-6 col-xs-12">
                <!-- Info boxes -->
              <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-file"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Total Assigments</span>
                  <span class="info-box-number">
                    <?
                    echo $tyy;

                    ?>
                  </span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <a href="<?=base_url()?>dcadmin/Assignment/view_assignment">
              <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="fa fa-file"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Total Pending Assigments</span>
                  <span class="info-box-number">
                    <?
                    echo $pending;

                    ?>
                  </span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->

            <!-- fix for small devices only -->
            <div class="clearfix visible-sm-block"></div>
                        <div class="col-md-3 col-sm-6 col-xs-12">
              <a href="<?=base_url()?>dcadmin/Assignment/view_complete_assignment">
                          <div class="info-box">
                            <span class="info-box-icon bg-green"><i class="fa fa-user"></i></span>
                            <div class="info-box-content">
                              <span class="info-box-text">Total Complete Assignments</span>
                              <span class="info-box-number">

                                <?
                                echo $ten;
                                ?>

                  </span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
            <div class="clearfix visible-sm-block"></div>


              <div class="col-md-3 col-sm-6 col-xs-12">
                  <a href="<?=base_url()?>dcadmin/Assignment/view_due_assignment">
              <div class="info-box">
                <span class="info-box-icon bg-orange"><i class="fa fa-file"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Upcoming Due Assignments</span>
                  <span class="info-box-number">
                    <span class="info-box-number">
<?=$deadline_count?>
</span>
</div><!-- /.info-box-content -->
</div><!-- /.info-box -->
</div>
<div class="clearfix visible-sm-block"></div>
  <a href="<?=base_url()?>dcadmin/system/view_team">
<div class="col-md-3 col-sm-6 col-xs-12">
  <div class="info-box">
    <span class="info-box-icon bg-blue"><i class="fa fa-users"></i></span>
    <div class="info-box-content">
      <span class="info-box-text">Total Team</span>
      <span class="info-box-number">
        <span class="info-box-number">
<?
echo $teams;
?>



</span>
</div><!-- /.info-box-content -->
</div><!-- /.info-box -->
</div>

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

</a>

    </div><!-- ./wrapper -->
