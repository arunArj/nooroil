
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        User Data
        <small>Overview</small>
      </h1>
      
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-md-12 col-xs-12">
          <div id="messages"></div>         
          
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
                                <th>Name</th>
                                <th>Email</th>
                                <th>Mobile</th>
                                <th>Location</th>
                                <th>Date</th>

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





<script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>

  <script type="text/javascript">
  var manageTable;
  var base_url = "<?php echo base_url(); ?>";
  
  $(document).ready(function() {
    $("#mainUserdataNav").addClass('active');

    manageTable = $('#manageTable').DataTable({
      "pageLength" : 10,
      "serverSide": true,
        "searching": false,
      "order": [[0, "asc" ]],
      "dom": 'Bfrtip',
    'buttons': [
            'csv', 'excel'
        ],
      "ajax":{
              url :  base_url + 'recipe/fetchRecordUser/',
              type : 'POST',
              'data': function(data){
               data.searchlaguage = $('#FilterLangauge').val();
            }
            },
        });
        $('#FilterLangauge').change(function(){
          manageTable.draw();
       });
  });



</script> 
