
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Recipes List
        <small>Overview</small>
      </h1>
      
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-md-12 col-xs-12">
          <div id="messages" style="display:none">
              <div class="alert alert-success alert-dismissible" id="msgwrap" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong><span id="msgDiv"></span>
            </div>
          </div>
          <?php if($this->session->flashdata('success')): ?>
            <div class="alert alert-success alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <?php echo $this->session->flashdata('success'); ?>
            </div>
          <?php elseif($this->session->flashdata('error')): ?>
            <div class="alert alert-error alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <?php echo $this->session->flashdata('error'); ?>
            </div>
          <?php endif; ?>

            <div class="box">
              <div class="box-header">
                <a href="<?php echo base_url('recipe/create') ?>"><button class="btn btn-primary">Create</button></a>
              </div>              
            </div>
            <div class="box">
                <div class="box-header">
                  <h3 class="box-title">List</h3>           
                    
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                
                    <table id="manageTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Recipe</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
          <!-- /.box -->
        </div>
        <!-- col-md-12 -->
      </div>
      <!-- /.row -->
      

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<!-- remove brand modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Remove Order</h4>
      </div>

      <form role="form" action="<?php echo base_url('recipe/remove') ?>" method="post" id="removeForm">
        <div class="modal-body">
          <p>Do you really want to remove?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>


    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>

  <script type="text/javascript">
  var manageTable;
  var base_url = "<?php echo base_url(); ?>";
  
  $(document).ready(function() {
  
    $("#mainRecipeNav").addClass('active');

    manageTable = $('#manageTable').DataTable({
      "pageLength" : 10,
      "serverSide": true,
      "order": [[0, "asc" ]],      
      "ajax":{
              url :  base_url + 'recipe/fetchRecord/',
              type : 'POST',
              'data': function(data){
                  data.<?php echo $this->security->get_csrf_token_name(); ?> = '<?php echo $this->security->get_csrf_hash(); ?>'
               data.searchlaguage = $('#FilterLangauge').val();
            }
            },
        "beforeSend": function(xhr) {
            xhr.setRequestHeader('<?php echo $this->security->get_csrf_token_name(); ?>','<?php echo $this->security->get_csrf_hash(); ?>');
        }
        });
        manageTable.on('xhr.dt', function(e, settings, json) {
 
        settings.ajax.data =  function(data){
                  data.<?php echo $this->security->get_csrf_token_name(); ?> = '<?php echo $this->security->get_csrf_hash(); ?>'
               data.searchlaguage = $('#FilterLangauge').val();
            }
          
    });
        $('#FilterLangauge').change(function(){
          manageTable.draw();
       });
  });
function removeFunc(id)
{
  if(id) {
    $("#removeForm").on('submit', function() {

      var form = $(this);

      // remove the text-danger
      $(".text-danger").remove();

      $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        data: { parti_id:id }, 
        dataType: 'json',
        success:function(response) {

          manageTable.ajax.reload(null, false); 

          if(response.success === true) {
          
            $("#msgwrap").removeClass('alert-warning').addClass('alert-success');

            $('.glyphicon').removeClass('glyphicon-exclamation-sign').addClass('glyphicon-ok-sign');
            
            $("#removeModal").modal('hide');

          } else {
                $("#msgwrap").removeClass('alert-success').addClass('alert-warning');

            $('.glyphicon').removeClass('glyphicon-ok-sign').addClass('glyphicon-exclamation-sign');
          }
            $("#msgDiv").text(response.messages);
              $("#messages").show();
        }
      }); 

      return false;
    });
  }
}


</script> 
