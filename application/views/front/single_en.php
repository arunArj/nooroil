<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<link rel="icon" href="<?php echo base_url('assets/front/images/faveicon.ico');?>" type="images/x-icon"/>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link type="text/css" rel="stylesheet" href="<?php echo base_url('assets/front/css/style.css'); ?>">
<title>Noor Oil :: Recipes</title>
</head>
<style>
	.error{
		color: red;
	}
</style>
<body>
<div class="wrapper">
	<header class="py-3 mb-4">
	<div class="container d-flex flex-wrap justify-content-between">
	  <a href="<?php echo base_url('/'); ?>" class="d-flex align-items-center mb-3 mb-lg-0 me-lg-auto ms-3 ms-lg-5 text-dark text-decoration-none">
		<img src="<?php echo base_url('assets/front/images/logo.png'); ?>" alt="" class="logo img-fluid">
	  </a>
		<div class="col-auto mb-3 mb-lg-0 me-3 me-lg-5 d-flex align-items-start justify-content-center">
			<ul class="nav nav-pills">
				<li class="nav-item"><a href="<?php echo base_url('en/'.$recipe_data['id']); ?>" class="nav-link active">English</a></li>
				<li class="nav-item">|</li>
				<li class="nav-item"><a href="<?php echo base_url('ar/'.$recipe_data['id']); ?>" class="nav-link arabic-text">العربية</a></li>
			</ul>
		</div>
	</div>
	</header>
  <section class="content-container">
    <div class="container custom-bg-blue custom-drop-shadow">
		<div class="row">
			<div class="col-12 p-0 position-relative">
				<div class="name-plate">
					<div class="inner">
						<h1><?php echo $recipe_data['en_name'] ?></h1>
						<h3><?php echo $recipe_data['en_country'] ?></h3>
					</div>
				</div>
				<img src="<?php echo base_url($recipe_data['image']); ?>" alt="" class="img-fluid">
			</div>
		</div>
		<div class="row text-center custom-bg-gradient custom-style">
			<div class="col-4"><span class="custom-icons"><img src="<?php echo base_url('assets/front/images/minutes.png'); ?>" alt=""></span><?php echo $recipe_data['en_cooking_time'] ?> minutes</div>
			<div class="col-4 border-start border-end"><span class="custom-icons"><img src="<?php echo base_url('assets/front/images/kcal.png'); ?>" alt=""></span><?php echo $recipe_data['en_kcal']; ?> Kcal</div>
			<div class="col-4"><span class="custom-icons"><img src="<?php echo base_url('assets/front/images/people.png'); ?>" alt=""></span><?php echo $recipe_data['en_n_people'] ?> people</div>
		</div>
		<div class="row py-5">
			<div class="col-11 m-auto pb-2 pb-lg-4"><h2>Ingredients</h2></div>
				<div class="col-11 m-auto ingredients-list">
						<?php echo $recipe_data['en_ingredients'] ?>							
				</div>
			<div class="col-11 m-auto pt-3 pb-2 pt-lg-5 pb-lg-4"><h2>Instructions</h2></div>
			<div class="col-11 m-auto instructions-list">
						<?php echo $recipe_data['en_instruction'] ?>						
					</div>
			<?php if($recipe_data['en_notes'] != ''){ ?>
			<div class="col-11 m-auto pt-3 pb-2 pt-lg-5 pb-lg-4"><h2>Notes</h2></div>
			<div class="col-11 m-auto recipe-notes">
						<?php echo $recipe_data['en_notes'] ?>
			</div>
			<?php } ?>
			<?php if($recipe_data['oil'] == 'sun'){ ?>
			<div id="sunflowerOil" class="col-11 m-auto position-relative">
				<img src="<?php echo base_url('assets/front/images/sunflower-oil-inner-page-english.png'); ?>" alt="" class="img-fluid oil-bottle-02">
			</div>
			<?php } 
			else{  ?>
			<div id="canolaOil" class="col-11 m-auto position-relative">
				<img src="<?php echo base_url('assets/front/images/canola-oil-inner-page-english.png'); ?>" alt="" class="img-fluid oil-bottle-02">
			</div>
			<?php } ?>
			<div class="col-11 m-auto position-relative py-5 text-center">
				<a href="<?php echo base_url($recipe_data['pdf']); ?>" target="_blank" class="download-pdf"><img src="<?php echo base_url('assets/front/images/download.png'); ?>" alt="Download" class="img-fluid"></a>
			</div>
		</div>
    </div>
  </section>
   <footer class="py-5">
    <div class="container" id="footers">
      <div class="row">
        <div class="col-12 px-lg-5 text-center"><span class="d-block mb-3"><img src="<?php echo base_url('assets/front/images/footer-logo.jpg'); ?>" alt="" class="footer-logo"></span>
          <p class="d-none">Sign up now and stay updated with new tips from Noor</p>
          <!--<form  action="<?php //echo base_url('home/createUser') ?>" id="myform" method="post" enctype="multipart/form-data">-->
             <?php  echo form_open('home/createUser', 'class="email" id="myform" method="post" enctype="multipart/form-data"');?>
              <div class="row g-3 d-none">
              	<div class="col-sm-6">
              		<label for="name" class="form-label">Name</label>
              		<input type="text" class="form-control" name="name" id="name">
              		<?php echo form_error('name'); ?> 
            		</div>
            		<input type="hidden" class="form-control" name="lang" id="lang" value="eng">
		           <div class="col-sm-6">
		              <label for="email" class="form-label">Email ID</label>
		              <input type="email" name="email" class="form-control" id="email" >
		              <?php echo form_error('email'); ?> 
		            </div> 
		            <div class="col-sm-6">
		              <label for="country" class="form-label">Country</label>
		              <select class="form-select" id="country" name="country">
		                <option value="">Select Country</option>
		                <option>UAE</option>
		                <option>KSA</option>
		                <option>Other</option>
		              </select>
		              <?php echo form_error('country'); ?> 
		            </div>
		            <div class="col-sm-6">
		              <label for="mobileNumber" class="form-label">Mobile</label>
		              <input type="tel" class="form-control" id="firstName" name="mobile">
		              <?php echo form_error('mobile'); ?> 
		            </div>
            		<div class="col-sm-6">
              		<button type="submit" class="w-100 btn btn-primary btn-lg custom-yellow" >Submit</button>
            		</div>
          		</div>
          </form>
          <?php if($this->session->flashdata('success')): ?>
          <div class="alert alert-success alert-dismissible custom-success" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php echo $this->session->flashdata('success'); 
            $this->session->unset_userdata('success');?>
          </div>
        <?php elseif($this->session->flashdata('error')): ?>
          <div class="alert alert-error alert-dismissible custom-error" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php echo $this->session->flashdata('error'); $this->session->unset_userdata('success'); ?>
          </div>
        <?php endif; ?>
        </div>
        <div class="col-12 text-center mt-5 mt-lg-0"> 
<span class="footer-span text-start instagram"><a href="https://www.instagram.com/NOORArabiaOfficial" target="_blank">NOORArabiaOfficial</a></span>
<span class="footer-span text-start facebook"><a href="https://www.facebook.com/noorarabiaofficial/?__nodl&refsrc=deprecated&ref=external%3Awww.google.com&_rdr" target="_blank">MYClubNOOR</a></span>
<span class="footer-span text-start youtube"><a href="https://www.youtube.com/@NOORArabia" target="_blank">NOORArabiaOfficial</a></span>
      </div>
    </div>
  </footer>
</div>
<script src="https://code.jquery.com/jquery-1.9.1.min.js" integrity="sha256-wS9gmOZBqsqWxgIVgA8Y9WcQOa7PgSIX+rPA0VL2rbQ=" crossorigin="anonymous"></script> 
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<!-- jQuery Validate Plugin -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
<script>
	$(document).ready(function(){
    $('#myform').validate({ // initialize the plugin
        rules: {
	        	name: {
	                required: true,
	                maxlength: 15,
	            },
            email: {
                required: true,
                email: true,
                maxlength: 35,
            },
            mobile: {
                required: true,
                minlength: 5,
                maxlength: 15,
        				number : true
            },
            country: {
	                required: true,
	            },
        }
    });
	});
	</script>
</body>
</html>
