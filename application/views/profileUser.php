<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Fast 'n Curious</title>
  <link href="<?php echo base_url('/vendors/css/bootstrap.min.css');?>" rel="stylesheet">
  <link href="<?php echo base_url('/vendors/css/animate.min.css');?>" rel="stylesheet"> 
  <link href="<?php echo base_url('/vendors/css/font-awesome.min.css');?>" rel="stylesheet">
  <link href="<?php echo base_url('/vendors/css/lightbox.css');?>" rel="stylesheet">
  
  <link id="css-preset" href="<?php echo base_url('/vendors/css/presets/preset1.css');?>" rel="stylesheet">
  <link href="<?php echo base_url('/vendors/css/main.css');?>" rel="stylesheet">
  <link href="<?php echo base_url('/vendors/css/responsive.css');?>" rel="stylesheet">

  <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
  <![endif]-->
  
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700' rel='stylesheet' type='text/css'>
  <link rel="shortcut icon" href="<?php echo base_url('/vendors/images/favicon.ico');?>">
  <link rel="stylesheet" href="<?php echo base_url('/vendors/css/blueimp-gallery.min.css');?>">
    
</head><!--/head-->

<body>
<div id="asd">Restoran</div>    
  <header id="home">
	<div class="main-nav navbar-fixed-top berubah">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.html">
            <img class="img-responsive" src="<?php echo base_url('/vendors/images/logo.png');?>" alt="logo">
          </a>                    
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav navbar-right">                 
            <li class="scroll"><a href="<?php echo site_url('/fatncurious') ?>">Home</a></li>
            <li class="scroll"><a href="#services">Service</a></li> 
            <li class="scroll"><a href="#about-us">About Us</a></li>                     
            <li class="scroll"><a href="#portfolio">Portfolio</a></li>
            <li class="scroll"><a href="#team">Team</a></li>
            <li class="scroll"><a href="#blog">Blog</a></li>
            <li class="scroll"><a href="#contact">Contact</a></li>       
          </ul>
        </div>
      </div>
    </div>
      <div id="home-slider" class="carousel slide carousel-fade" data-ride="carousel">
      <div class="carousel-inner">
        <div class="item active" style="background-image: url(<?php echo base_url('/vendors/images/Background/Wallpapers-fruit-flowers-black-background-hd-desktop-wallpapers.jpg');?>)">
          <div class="captionRestoran">
            <div class="media">
				<br/>
              <img class="media-object displayPicture img-circle  letakMediaRestoran" src="<?php echo base_url('/vendors/images/Background/337094-zero.jpg');?>" alt="Generic placeholder image">
            </div>
              <h1> <?php echo $user->NAMA_USER ;?>
              </h1>
              <p><span class="glyphicon glyphicon-earphone" aria-hidden="true"></span><?php echo $user->ALAMAT_USER ;?></p>
              <p><span class="glyphicon glyphicon-time" aria-hidden="true"></span><?php echo $user->NOR_TELEPON_USER ;?> </p>
              <p><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span><?php echo $user->EMAIL_USER ;?>  </p>
              <p><span class="glyphicon glyphicon-flag" aria-hidden="true"></span><?php echo $user->JUMLAH_REPORT_USER ;?></p>
                            <p><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> <a href="#" style="color:lightblue" data-toggle="modal" data-target="#myModal">  Click To Edit Profile</a></p>
			  <p><span class="glyphicon glyphicon-lock" aria-hidden="true"></span> <a href="#" style="color:lightblue" data-toggle="modal" data-target="#myModalPassword">  Click To Change Password</a></p>
          </div>
        </div>
      </div>
    </div>
  </header><!--/#home-->
  
  <div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
		<?php echo form_open('fatncurious/updateProfilUser'); ?>
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"><center>Profile User</center></h4>
          </div>
          <div class="modal-body">
			
				<?php $this->table->add_row('Nama User',form_input('txtRestoran',$user->NAMA_USER,['style'=>'margin-left:20px;'])); ?>
				<?php $this->table->add_row('Alamat',form_input('txtJalan',$user->ALAMAT_USER,['style'=>'margin-left:20px;'])); ?>
				<?php $this->table->add_row('Nomor Telepon',form_input('txtNoTelp',$user->NOR_TELEPON_USER,['style'=>'margin-left:20px;'])); ?>
				<?php echo $this->table->generate(); ?>
          </div>
          <div class="modal-footer">
            <?php 
				echo "<button type='submit' class='submit btn-default' >Submit</button>";
			?>
            <button type="submit" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
		<?php echo form_close(); ?>
        </div>
      </div>
    </div>
	
	<div id="myModalPassword" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
		<?php echo form_open('fatncurious/gantiPassProfilUser'); ?>
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"><center>Ganti Password</center></h4>
          </div>
          <div class="modal-body">
			
				<?php $this->table->add_row('Old Password',form_password('txtOldPassword','',['style'=>'margin-left:20px;'])); ?>
				<?php $this->table->add_row('New Password',form_password('txtNewPassword','',['style'=>'margin-left:20px;'])); ?>
				<?php $this->table->add_row('Confirmation New Password',form_password('txtConfirmNewPassword','',['style'=>'margin-left:20px;'])); ?>
				<?php echo $this->table->generate(); ?>
          </div>
          <div class="modal-footer">
            <button type="submit" class="submit btn-default" >Submit</button>
            <button type="submit" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
		<?php echo form_close(); ?>
        </div>
      </div>
    </div>

  <script type="text/javascript" src="<?php echo base_url('/vendors/js/jquery.js');?>">
  </script>
  <script type="text/javascript" src="<?php echo base_url('/vendors/js/bootstrap.min.js');?>"></script>
  <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
  <script type="text/javascript" src="<?php echo base_url('/vendors/js/jquery.inview.min.js');?>"></script>
  <script type="text/javascript" src="<?php echo base_url('/vendors/js/wow.min.js');?>"></script>
  <script type="text/javascript" src="<?php echo base_url('/vendors/js/mousescroll.js');?>"></script>
  <script type="text/javascript" src="<?php echo base_url('/vendors/js/smoothscroll.js');?>"></script>
  <script type="text/javascript" src="<?php echo base_url('/vendors/js/jquery.countTo.js');?>"></script>
  <script type="text/javascript" src="<?php echo base_url('/vendors/js/lightbox.min.js');?>"></script>
  <script type="text/javascript" src="<?php echo base_url('/vendors/js/main.js');?>"></script>

  <script src="<?php echo base_url('/vendors/js/blueimp-gallery.min.js');?>"></script>
</body>
</html>