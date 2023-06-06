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
				<li class="nav-item"><a href="javascript:void(0);" class="nav-link active">English</a></li>
				<li class="nav-item">|</li>
				<li class="nav-item"><a href="ar" class="nav-link arabic-text">العربية</a></li>
			</ul>
		</div>
	</div>
	</header>
  <section class="inner-wrapper">
    <div class="container">
		<div class="row">
		<img src="<?php echo base_url('assets/front/images/home-banner31052023.png'); ?>" alt="" class="img-fluid">
		</div>
      <div class="row">
        <div class="col-12 home-description text-center text-lg-start">
          <h3>Welcome!</h3>
          <p>You are the mother, sister, daughter, and for that NOOR supports you every day to choose your favorite recipe from 30 delicious recipes that are collected with precision and love to definitely suit your family members and your family.</p>
          <p>NOOR, It’s your choice</p>
        </div>
        <div class="col-6 position-relative d-none"> <img src="<?php echo base_url('assets/front/images/oil-bottle.png'); ?>" alt="" class="oil-bottle"> </div>
      </div>
      <div class="row py-lg-5 py-4">
        <div class="col-12 text-center">
          <div class="subtitle"> <span>30 Recipes - You choose</span> </div>
        </div>
      </div>
      <div id="recipies" class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-3 g-4">

        <?php

        foreach ($recipes_data as $value) {
         ?>
        <div class="col">
			    <a href="<?php echo base_url('en/'.$value->id);?> " class="recipe-link">
            <div class="card">
              <div class="card-img"> <img src="<?php echo base_url($value->image); ?>" alt="" class="img-fluid"> </div>
              <div class="card-body">
                <div class="card-title"><?php echo $value->en_name; ?></div>
                <div class="card-footer"> <span class="min"><?php echo $value->en_cooking_time; ?> min</span> <span class="kcal"><?php echo $value->en_kcal; ?> Kcal</span> <span class="pers"><?php echo $value->en_n_people; ?> Pers</span> </div>
              </div>
            </div>
			   </a>
        </div>
        <?php } ?>  
        
        
        
        <a id="seeMore" href="javascript:void(0);"></a>
	</div>
    </div>
  </section>
  <footer class="py-5">
    <div class="container" id="footers">
      <div class="row">
        <div class="col-12 col-lg-9 px-lg-5 text-center text-lg-start"><span class="d-block mb-3"><img src="<?php echo base_url('assets/front/images/footer-logo.jpg'); ?>" alt="" class="footer-logo"></span>
          <p>Sign up now and stay updated with new tips from Noor</p>
          <!--<form  action="<?php //echo base_url('home/createUser') ?>" id="myform" method="post" enctype="multipart/form-data">-->
             <?php  echo form_open('home/createUser', 'class="email" id="myform" method="post" enctype="multipart/form-data"');?>
              <div class="row g-3">
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
        <div class="col-12 col-lg-3 text-center text-lg-start mt-5 mt-lg-0"> 
<span class="footer-span instagram"><a href="https://www.instagram.com/NOORArabiaOfficial" target="_blank">NOORArabiaOfficial</a></span>
<span class="footer-span facebook"><a href="https://www.facebook.com/noorarabiaofficial/?__nodl&refsrc=deprecated&ref=external%3Awww.google.com&_rdr" target="_blank">MYClubNOOR</a></span>
<span class="footer-span youtube"><a href="https://www.youtube.com/@NOORArabia" target="_blank">NOORArabiaOfficial</a></span>
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
	    
	    $('.close').click(function(){
			$('.alert-success').fadeOut(500);
		});
		
		if ($(window).width() <= 600) {
			$("#recipies .col").slice(0,3).show();
			$("#seeMore").click(function(e){
				e.preventDefault();
				$("#recipies .col:hidden").slice(0,1).fadeIn("slow");

				if($("#recipies .col:hidden").length == 0){
					$("#seeMore").fadeOut("slow");
				}
			});
		} else if ($(window).width() <= 1023) {
			$("#recipies .col").slice(0,4).show();
			$("#seeMore").click(function(e){
				e.preventDefault();
				$("#recipies .col:hidden").slice(0,2).fadeIn("slow");

				if($("#recipies .col:hidden").length == 0){
					$("#seeMore").fadeOut("slow");
				}
			});
		} else {
			$("#recipies .col").slice(0,6).show();
			$("#seeMore").click(function(e){
				e.preventDefault();
				$("#recipies .col:hidden").slice(0,3).fadeIn("slow");

				if($("#recipies .col:hidden").length == 0){
					$("#seeMore").fadeOut("slow");
				}
			});
	}


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
