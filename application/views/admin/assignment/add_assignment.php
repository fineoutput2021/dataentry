<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Add New Assignment
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url() ?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="<?php echo base_url() ?>admin/college"><i class="fa fa-dashboard"></i> All Assignment</a></li>

    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-lg-12">

        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> Add New Assignment</h3>
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
              <form action="<?php echo base_url() ?>dcadmin/assignment/add_assignment_data/<? echo base64_encode(1); ?>" method="POST" id="slide_frm" enctype="multipart/form-data">
                <div class="table-responsive">
                  <table class="table table-hover">


                    <tr>
                      <td> <strong>Student Name</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <select class="form-control" name="student">
                          <option value="">Select Name</option>
                          <? foreach ($student_data->result() as $s) {
                          ?>
                            <option value="<? echo $s->id; ?>"><? echo $s->full_name; ?></option>
                          <?
                          } ?>
                      </td>
                    </tr>


                    <tr>
                      <td> <strong>Assignment Name</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <input type="text" name="assignment" class="form-control" placeholder="" required value="" />
                      </td>
                    </tr>

                    <tr>
                      <td> <strong>Given date</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <input type="date" name="deadline_date" class="form-control" placeholder="" required value="" />
                      </td>
                    </tr>
                    <tr>

                      <td> <strong>Word Count</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <input type="text" onkeypress="return isNumberKey(event)" name="word" class="form-control" placeholder="" required value="" />
                      </td>
                    </tr>
                    <tr>
                      <td> <strong>Currency</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                              <input type="text" name="currency" class="form-control" placeholder="" required value="" />
                      </td>
                    <tr>
                      <td> <strong>Total Amount</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
  <input type="text" id="total" onkeypress="return isNumberKey(event)" name="total_amount" class="form-control" placeholder="" required value="" />

                  </td>
                    </tr>

                    <tr>
      <td> <strong>Paid Amount</strong> <span style="color:red;">*</span></strong> </td>
        <td>
        <input type="text" id="paid"  onkeypress="return isNumberKey(event)" name="paid" class="form-control" placeholder="" required value="" />
                      </td>
                    </tr>

                    <tr>
                      <td> <strong>Pending Amount</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <input type="text" readonly  id="pending"  onkeypress="return isNumberKey(event)" name="pending" class="form-control" placeholder="" required value="" />
                      </td>
                    </tr>


                    <tr>

                    <tr>
                      <td> <strong>Upload Document</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <input type="file" name="image" class="form-control" placeholder="" value="" />
                      </td>
                    </tr>






                    <tr>
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
$('#total,#paid').keyup(function() {
var total = $("#total").val();
var paid = $("#paid").val();
if(paid!==''){
$('#pending').val(total-paid);
}
});
function isNumberKey(evt){
var charCode = (evt.which) ? evt.which : evt.keyCode
if (charCode > 31 && (charCode < 48 || charCode > 57))
return false;
return true;
}
</script>
