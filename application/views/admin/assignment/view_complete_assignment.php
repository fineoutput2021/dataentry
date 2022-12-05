<div class="content-wrapper">
<section class="content-header">
<h1>Assigment
</h1>

</section>
<section class="content">
<div class="row">
<div class="col-lg-12">
<a class="btn btn-info cticket" href="<?php echo base_url() ?>dcadmin/assignment/add_assignment" role="button" style="margin-bottom:12px;"> Add assignment</a>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-money fa-fw"></i>View assignment</h3>
            </div>
               <div class="panel panel-default">

               			  <? if(!empty($this->session->flashdata('smessage'))){ ?>
               			        <div class="alert alert-success alert-dismissible">
               			    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
               			    <h4><i class="icon fa fa-check"></i> Alert!</h4>
               			  <? echo $this->session->flashdata('smessage'); ?>
               			  </div>
               			    <? }
               			     if(!empty($this->session->flashdata('emessage'))){ ?>
               			     <div class="alert alert-danger alert-dismissible">
               			  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
               			  <h4><i class="icon fa fa-ban"></i> Alert!</h4>
               			<? echo $this->session->flashdata('emessage'); ?>
               			</div>
               			  <? } ?>


            <div class="panel-body">
                <div class="box-body table-responsive no-padding">
                  <table class="table table-bordered table-hover table-striped" id="assignmentTable">

                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Student</th>
                            <th>Digit</th>
                            <th>Assignment</th>
                            <th>Deadline date</th>
                            <th>Word</th>

                            <th>Total amount</th>
                            <th>Paid Amount</th>
                            <th>Pending Amount</th>
                            <th>Document</th>
                             <th>Sumbit date</th>
                            <th>Status</th>

                              </tr>
                          </thead>
                          <tbody>
                          	<?php $i=1; foreach($assignment_data->result() as $data) {
                              $numlength = strlen((string)$data->digit);
                              if($numlength==1){
                                $digit="000".$data->digit;
                              }else if($numlength==2){
                                  $digit="00".$data->digit;
                              }else if($numlength==3){
                                  $digit="0".$data->digit;
                              }else{
                                  $digit=$data->digit;
                              }
                               ?>
                               <tr>
      <td><?php echo $i ?> </td>
      <td><?
$id=$data->student;
$this->db->select('*');
            $this->db->from('tbl_student');
            $this->db->where('id',$id);
            $dsa= $this->db->get();
            $da=$dsa->row();
            if(!empty($da))
            {
              echo $da->full_name;

           }

?>
</td>

      <td><?php echo $digit ?></td>
      <td><?php echo $data->assignment_name ?></td>
  <td><?php echo $data->deadline_date ?></td>
      <td><?php echo $data->word_count ?></td>
      <td><?php echo $data->total_amount ?> <?php echo $data->currency ?></td>
        <td><?php echo $data->paid_amount ?> <?php echo $data->currency ?></td>
      <td><?php echo $data->pending_amount ?> <?php echo $data->currency ?></td>

      <td>
                <?php if($data->image!=""){  ?>
  <img id="slide_img_path" height=50 width=100  src="<?php echo base_url()."".$data->image ?>" >
            <?php }else {  ?>
            Sorry No image Found
            <?php } ?>
              </td>
              <td><?php $data->date;
              {
               echo $cur_date=date("Y-m-d ");
              }
              ?></td>


              <td><?php if($data->is_active==1){ ?>
          <p class="label bg-green" >complete</p>

          <?php } else { ?>
          <p class="label bg-green" >pending</p>


          <?php		}   ?>
          </td>



</tr>
<?php $i++; } ?>
</tbody>
</table>

                </div>
            </div>
        </div>

        </div>

    </div>
    </div>
</section>
</div>


<style>
label{
margin:5px;
}
</style>
<script src="<?php echo base_url() ?>assets/admin/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url() ?>assets/admin/plugins/datatables/dataTables.bootstrap.js"></script>
<script type="text/javascript">

$(document).ready(function(){
$('#assignmentTable').DataTable({
responsive: true,
// bSort: true
});

$(document.body).on('click', '.dCnf', function() {
var i=$(this).attr("mydata");
console.log(i);

$("#btns"+i).hide();
$("#cnfbox"+i).show();

});

$(document.body).on('click', '.cans', function() {
var i=$(this).attr("mydatas");
console.log(i);

$("#btns"+i).show();
$("#cnfbox"+i).hide();
})

});

</script>
<!-- <script type="text/javascript" src="<?php echo base_url() ?>assets/slider/ajaxupload.3.5.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/slider/rs.js"></script>	  -->
