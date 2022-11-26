<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Update Assignment
    </h1>

  </section>
  <section class="content">
    <div class="row">
      <div class="col-lg-12">

        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-money fa-fw"></i>Update Assignment</h3>
          </div>

          <? if (!empty($this->session->flashdata('smessage'))) { ?>
            <div class="alert alert-success alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h4><i class="icon fa fa-check"></i> Alert!</h4>
              <? echo $this->session->flashdata('smessage'); ?>
            </div>
          <? }
          if (!empty($this->session->flashdata('emessage'))) { ?>
            <div class="alert alert-danger alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h4><i class="icon fa fa-ban"></i> Alert!</h4>
              <? echo $this->session->flashdata('emessage'); ?>
            </div>
          <? } ?>

          <div class="panel-body">
            <div class="col-lg-10">
              <form action="<?php echo base_url() ?>dcadmin/assignment/add_assignment_data/<? echo base64_encode(2); ?>/<?= $id ?>" method="POST" id="slide_frm" enctype="multipart/form-data">
                <div class="table-responsive">
                  <table class="table table-hover">

                    <tr>
                      <td> <strong>Student Name</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <select class="form-control" name="student">
                          <option value="">Select Name</option>
                          <? foreach ($student_data->result() as $s) {
                          ?>
                            <!-- <option value="<? echo $s->id; ?>"><? echo $s->full_name; ?></option> -->
                            <option value="<?= $s->id ?>" <?php if ($assignment->student == $s->id) {
                                                            echo "selected";
                                                          } ?>> <?= $s->full_name ?> </option>
                          <?
                          } ?>
                      </td>
                    </tr>


                    <tr>
                      <td> <strong>Assignment Name</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <input type="text" name="assignment" class="form-control" placeholder="" required value="<?= $assignment->assignment_name ?>" />
                      </td>
                    </tr>
                    <td> <strong>Date</strong> <span style="color:red;">*</span></strong> </td>
                    <td>
                      <input type="date" name="deadline_date" class="form-control" placeholder="" required value="<?= $assignment->deadline_date ?>" />
                    </td>



                    <tr>
                      <td> <strong>Word count</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <input type="text" onkeypress="return isNumberKey(event)" name="word" class="form-control" placeholder="" required value="<?= $assignment->word_count ?>" />
                      </td>
                    </tr>

                    <tr>
                      <td> <strong>Total Amount</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <input type="text" onkeypress="return isNumberKey(event)" name="total_amount" class="form-control" placeholder="" required value="<?= $assignment->total_amount ?>" />
                      </td>
                    </tr>

                    <tr>
                      <td> <strong>Paid Amount</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <input type="text" onkeypress="return isNumberKey(event)" name="paid" class="form-control" placeholder="" required value="<?= $assignment->paid_amount ?>" />
                      </td>
                    </tr>

                    <tr>
                      <td> <strong>Pending Amount</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <input type="text" onkeypress="return isNumberKey(event)" name="pending" class="form-control" placeholder="" required value="<?= $assignment->pending_amount ?>" />
                      </td>
                    </tr>

                    <tr>
                      <td> <strong>Upload</strong> <span style="color:red;"><br />Big: 2220px X 1000px<br /></span></strong> </td>
                      <td>
                        <input type="file" name="image" class="form-control" placeholder="" value="<?= $assignment->image ?>" />
                        <?php if ($assignment->image != "") {  ?>
                          <img id="slide_img_path" height=50 width=100 src="<?php echo base_url() . $assignment->image ?>">
                        <?php } else {  ?>
                          Sorry No image Found
                        <?php } ?>
                      </td>
                    </tr>

                    <td colspan="2">
                      <input type="submit" class="btn btn-success" value="save">
                    </td>
                    </tr>
                  </table>
                </div>

              </form>

            </div>


          </div>

        </div>

      </div>
    </div>
  </section>
</div>


<script type="text/javascript" src="<?php echo base_url() ?>assets/slider/ajaxupload.3.5.js"></script>
<link href="<? echo base_url() ?>assets/cowadmin/css/jqvmap.css" rel='stylesheet' type='text/css' />
<script>
function isNumberKey(evt){
var charCode = (evt.which) ? evt.which : evt.keyCode
if (charCode > 31 && (charCode < 48 || charCode > 57))
return false;
return true;
}
</script>