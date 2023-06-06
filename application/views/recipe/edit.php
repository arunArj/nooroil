

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Manage
      <small>Recipe</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Recipe</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-md-12 col-xs-12">

        <div id="messages"></div>

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
            <h3 class="box-title">Add Product</h3>
          </div>
          <!-- /.box-header -->
          <form role="form" action="<?php base_url('users/create') ?>" method="post" enctype="multipart/form-data">
              <div class="box-body">

                <?php echo validation_errors(); ?>

                <div class="form-group">

                  <label for="recipe_images">Image</label>
                  <div class="kv-avatar">
                      <div class="file-loading">
                          <input id="recipe_images" name="recipe_images" type="file">
                      </div>
                  </div>
                </div>
                <div class="form-group">
                  <h4>English</h4>
                </div>
                <div class="form-group">
                  <label for="recipe_name">Recipe Name</label>
                  <input type="text" class="form-control" id="recipe_name" name="recipe_name" placeholder="Enter recipe name" value="<?php echo $order_data['en_name']; ?>" autocomplete="off"/>
                </div>

                <div class="form-group">
                  <label for="country">Country</label>
                  <input type="text" class="form-control" id="country" name="country" placeholder="Enter country" value="<?php echo $order_data['en_country']; ?>" autocomplete="off" />
                </div>

                <div class="form-group">
                  <label for="calories">Calories</label>
                  <input type="text" class="form-control" id="calories" name="calories" placeholder="Enter calories" value="<?php echo $order_data['en_kcal']; ?>" autocomplete="off" />
                </div>

                <div class="form-group">
                  <label for="cooking_time">Cooking time</label>
                  <input type="text" class="form-control" id="cooking_time" name="cooking_time" placeholder="Enter cooking time" value="<?php echo $order_data['en_cooking_time']; ?>" autocomplete="off" />
                </div>
                <div class="form-group">
                  <label for="num_of_people">Number Of people</label>
                  <input type="text" class="form-control" id="num_of_people" name="num_of_people" placeholder="Enter number of people" value="<?php echo $order_data['en_n_people']; ?>" autocomplete="off" />
                </div>

                <div class="form-group">
                  <label for="ingredients">Ingredients</label>
                  <textarea type="text" class="form-control" id="ingredients" name="ingredients" placeholder="Enter ingredients" autocomplete="off">
                    <?php echo $order_data['en_ingredients']; ?>
                  </textarea>
                </div>
                <div class="form-group">
                  <label for="instruction">Instruction</label>
                  <textarea type="text" class="form-control" id="instruction" name="instruction" placeholder="Enter instruction" autocomplete="off">
                    <?php echo $order_data['en_instruction']; ?>
                  </textarea>
                </div>
                <div class="form-group">
                  <label for="note">Note</label>
                  <textarea type="text" class="form-control" id="note" name="note" placeholder="Enter note" autocomplete="off">
                    <?php echo $order_data['en_notes']; ?>
                  </textarea>
                </div>
                <div class="form-group">
                  <label for="note">PDF</label>
                  <input type='file' class="btn btn-primary" name='pdf_upload' id="pdf_upload" accept="application/pdf">
                </div>



                <div class="form-group">
                  <h4>Arabic</h4>
                </div>
                <div class="form-group">
                  <label for="recipe_name">Recipe Name Arabic</label>
                  <input type="text" class="form-control" id="ar_recipe_name" name="ar_recipe_name" placeholder="Enter recipe name" value="<?php echo $order_data['ar_name']; ?>" autocomplete="off"/>
                </div>

                <div class="form-group">
                  <label for="ar_country">Country Arabic</label>
                  <input type="text" class="form-control" id="ar_country" name="ar_country" placeholder="Enter country" value="<?php echo $order_data['ar_country']; ?>" autocomplete="off" />
                </div>

                <div class="form-group">
                  <label for="ar_calories">Calories Arabic</label>
                  <input type="text" class="form-control" id="ar_calories" name="ar_calories" placeholder="Enter calories" value="<?php echo $order_data['ar_kcal']; ?>" autocomplete="off" />
                </div>

                <div class="form-group">
                  <label for="ar_cooking_time">Cooking time Arabic</label>
                  <input type="text" class="form-control" id="ar_cooking_time" name="ar_cooking_time" placeholder="Enter cooking time" value="<?php echo $order_data['ar_cooking_time']; ?>" autocomplete="off" />
                </div>
                <div class="form-group">
                  <label for="ar_num_of_people">Number Of people Arabic</label>
                  <input type="text" class="form-control" id="ar_num_of_people" name="ar_num_of_people" placeholder="Enter number of people" value="<?php echo $order_data['ar_n_people']; ?>" autocomplete="off" />
                </div>

                <div class="form-group">
                  <label for="ar_ingredients">Ingredients Arabic</label>
                  <textarea type="text" class="form-control" id="ar_ingredients" name="ar_ingredients" placeholder="Enter ingredients" autocomplete="off">
                  <?php echo $order_data['ar_ingredients']; ?>
                  </textarea>
                </div>
                <div class="form-group">
                  <label for="ar_instruction">Instruction Arabic</label>
                  <textarea type="text" class="form-control" id="ar_instruction" name="ar_instruction" placeholder="Enter instruction" autocomplete="off">
                    <?php echo $order_data['ar_instruction']; ?>
                  </textarea>
                </div>
                <div class="form-group">
                  <label for="ar_note">Note Arabic</label>
                  <textarea type="text" class="form-control" id="ar_note" name="ar_note" placeholder="Enter note" autocomplete="off">
                    <?php echo $order_data['ar_notes']; ?>
                  </textarea>
                </div>
                <div class="form-group">
                  <label for="pdf">PDF Arabic</label>
                  <input type='file' class="btn btn-primary" name='pdf_upload_arabic' id="pdf_upload_arabic" accept="application/pdf">
                </div>

              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Save Changes</button>
              </div>
            </form>
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

<script type="text/javascript">
  $(document).ready(function() {
    $(".select_group").select2();
    $("#ingredients").wysihtml5();
    $("#instruction").wysihtml5();
    $("#note").wysihtml5();

    $("#ar_ingredients").wysihtml5();
    $("#ar_instruction").wysihtml5();
    $("#ar_note").wysihtml5();

    $("#mainProductNav").addClass('active');
    $("#addProductNav").addClass('active');
    
    var btnCust = '<button type="button" class="btn btn-secondary" title="Add picture tags" ' + 
        'onclick="alert(\'Call your custom code here.\')">' +
        '<i class="glyphicon glyphicon-tag"></i>' +
        '</button>'; 
    $("#recipe_images").fileinput({
        overwriteInitial: true,
        maxFileSize: 1500,
        showClose: false,
        showCaption: false,
        browseLabel: '',
        removeLabel: '',
        browseIcon: '<i class="glyphicon glyphicon-folder-open"></i>',
        removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
        removeTitle: 'Cancel or reset changes',
        elErrorContainer: '#kv-avatar-errors-1',
        msgErrorClass: 'alert alert-block alert-danger',
        // defaultPreviewContent: '<img src="/uploads/default_avatar_male.jpg" alt="Your Avatar">',
        layoutTemplates: {main2: '{preview} ' +  btnCust + ' {remove} {browse}'},
        allowedFileExtensions: ["jpg", "png", "gif"]
    });

  });
</script>