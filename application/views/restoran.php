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
      <div id="home-slider" class="carousel slide carousel-fade" data-ride="carousel">
      <div class="carousel-inner">
        <div class="item active" style="background-image: url(<?php echo base_url('/vendors/images/Background/Wallpapers-fruit-flowers-black-background-hd-desktop-wallpapers.jpg');?>)">
          <div class="captionRestoran">
            <div class="media">
              <img class="media-object displayPicture img-circle  letakMediaRestoran" src="<?php echo base_url('/vendors/images/Background/337094-zero.jpg');?>" alt="Generic placeholder image">
            </div>
              <h1><span> <?php echo $resto->NAMA_RESTORAN ;?> </span>  </h1>
                  <h2 style="margin-top:-30px;color:#fff"> <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                  <span class="glyphicon glyphicon-star-empty" aria-hidden="true"></span>
                  </h2>
                  
              </h1>
              <p><span class="glyphicon glyphicon-road" aria-hidden="true"> </span><?php echo ' '.$resto->ALAMAT_RESTORAN ;?></p>
              <p><span class="glyphicon glyphicon-earphone" aria-hidden="true"></span> <?php echo  ' '.$resto->NO_TELEPON_RESTORAN ;?></p>
              <p><span class="glyphicon glyphicon-time" aria-hidden="true"></span> <?php echo  ' '.$resto->HARI_BUKA_RESTORAN.','.$resto->JAM_BUKA_RESTORAN ;?></p>
              <p><span class="glyphicon glyphicon-flag" aria-hidden="true"></span><?php echo  ' '.$resto->STATUS ;?></p>
          </div>
        </div>
      </div>
    </div>
      <div class="main-nav">
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
            <li class="scroll">
                
                <a type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Sorted By <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="#">Promo</a></li>
                    <li><a href="#">Jenis Menu</a></li>
                    <li><a href="#">Kartu Kredit</a></li>
                </ul>
            </li> 
            <li class="scroll"><a href="#">About Us</a></li>                     
            <li class="scroll"><a href="#portfolio">Portfolio</a></li>
            <li class="scroll"><a href="#">Team</a></li>
            <li class="scroll"><a href="#">Blog</a></li>
            <li class="scroll"><a href="#">Contact</a></li>       
          </ul>
        </div>
      </div>
    </div>
  </header><!--/#home-->
    
    <div class = "container navbarSpace" style="background-color:#fafafa">
        <div>
			<center> 
				<h4> Give Rating </h4>
				<h2 class="rating"> <span class="glyphicon <?php echo $glyphicon1;?> bintang" data-val="1" aria-hidden="true"></span>
                  <span class="glyphicon <?php echo $glyphicon2;?> bintang" data-val="2" aria-hidden="true"></span>
                  <span class="glyphicon <?php echo $glyphicon3;?> bintang" data-val="3" aria-hidden="true"></span>
                  <span class="glyphicon <?php echo $glyphicon4;?> bintang" data-val="4" aria-hidden="true"></span>
                  <span class="glyphicon <?php echo $glyphicon5;?> bintang" aria-hidden="true" data-val="5"></span>
				  </h2>
			</center>
            <h2>Sorted By :</h2>
            <ul class="nav nav-tabs">
                <li role="presentation" class="<?php echo $active1.' ';?> toogleNavBar"><a href="<?php echo site_url('/fatncurious/sortByPromoRestoran/'.$resto->KODE_RESTORAN.'') ?>">Promo</a></li>
                <li role="presentation" class="<?php echo $active2.' ';?> toogleNavBar"><a href="<?php echo site_url('/fatncurious/sortByKreditRestoran/'.$resto->KODE_RESTORAN.'') ?>">Kartu Kredit</a></li>
                <li role="presentation" class="<?php echo $active3.' ';?> toogleNavBar"><a href="<?php echo site_url('/fatncurious/sortByMenuRestoran/'.$resto->KODE_RESTORAN.'') ?>">Jenis Menu</a></li>
                 <li role="presentation" style="float:right" class="toogleNavBar"><a href="">Lihat Review Restoran</a></li>
            </ul>
        </div>
        <?php
			if(isset($promo)){
				foreach($promo as $p){
					echo "<div class='media'>";
						echo "<div class='media-left'>";
						echo "<a href='#'>";
		?>
							<img class="media-object img-rounded img-responsive fotoPromo"  src="<?php echo base_url('/vendors/images/promo/'.$p->FOTO_PROMO);?>" alt="...">
		<?php
						echo "</a>";
						echo "</div>";
					echo "</a>";
				}
			}
		?>
		
		<?php
		$adaMenu=false;
		//===========MAKANAN=========
			if(isset($menu)){
				echo "<h4>MAKANAN</h4>";
				foreach($menu as $m){
					
					if($m->KODE_JENIS_MENU == 'JM001'){
						$adaMenu=true;
						echo "<div class='media'>";
							echo "<div class='media-left'>";
			?>
							<img class="media-object displayPicture displayPictureMenu img-rounded"  src="<?php echo base_url('/vendors/images/menu/nasi goreng/1.jpg');?>" alt="...">
			<?php
							echo "</div>";
						echo "<div class='media-body'>";
							echo "<h4 class='media-heading'>".$m->NAMA_MENU."</h4>";
							echo $m->DESKRIPSI_MENU;
							echo "<div class='media m-t-2'>";
								echo "<div class='media-left' href='#'>";
			?>
								<img class="media-object displayPictureComment img-circle" src="<?php echo base_url('/vendors/images/team/1.jpg');?>" alt="Generic placeholder image">
			<?php
								echo "</div>";
								echo "<div class='media-body'>";
									echo "<h4 class='media-heading'>Michelle Withney</h4>";
									echo "Mantab bener ni menu.. wkwkkwk";
								echo "</div>";
							echo "</div>";
							echo "<br/>";
							echo "<div class='input-group customInputGroup img-rounded'>";
								echo "<input type='text' class='form-control' placeholder='Search for...'>";
								echo "<span class='input-group-btn'>";
									echo "<button class='btn btn-default img-rounded' type='button'>Go!</button>";
								echo "</span>";
							echo "</div>";
						echo "</div>";
						echo "</div>";
					}
					
				}
				if($adaMenu==false){
					echo "<h5>Tidak Ada Menu Makanan</h5>";
				}
			}
			
			//===========MAKANAN=========
		?>
		
		<?php
		$adaMenu=false;
		//===========MINUMAN=========
			if(isset($menu)){
				echo "<h4>MINUMAN</h4>";
				foreach($menu as $m){
					
					if($m->KODE_JENIS_MENU == 'JM002'){
						$adaMenu=true;
						echo "<div class='media'>";
							echo "<div class='media-left'>";
			?>
							<img class="media-object displayPicture displayPictureMenu img-rounded"  src="<?php echo base_url('/vendors/images/menu/nasi goreng/1.jpg');?>" alt="...">
			<?php
							echo "</div>";
						echo "<div class='media-body'>";
							echo "<h4 class='media-heading'>".$m->NAMA_MENU."</h4>";
							echo $m->DESKRIPSI_MENU;
							echo "<div class='media m-t-2'>";
								echo "<div class='media-left' href='#'>";
			?>
								<img class="media-object displayPictureComment img-circle" src="<?php echo base_url('/vendors/images/team/1.jpg');?>" alt="Generic placeholder image">
			<?php
								echo "</div>";
								echo "<div class='media-body'>";
									echo "<h4 class='media-heading'>Michelle Withney</h4>";
									echo "Mantab bener ni menu.. wkwkkwk";
								echo "</div>";
							echo "</div>";
							echo "<br/>";
							echo "<div class='input-group customInputGroup img-rounded'>";
								echo "<input type='text' class='form-control' placeholder='Search for...'>";
								echo "<span class='input-group-btn'>";
									echo "<button class='btn btn-default img-rounded' type='button'>Go!</button>";
								echo "</span>";
							echo "</div>";
						echo "</div>";
						echo "</div>";
					}
					
				}
				if($adaMenu==false){
					echo "<h5>Tidak Ada Menu Minuman</h5>";
				}
			}
			//===========MINUMAN=========
		?>
		
		<?php
		$adaMenu=false;
		//===========SNACK=========
			if(isset($menu)){
				echo "<h4>SNACK</h4>";
				foreach($menu as $m){
					
					if($m->KODE_JENIS_MENU == 'JM003'){
						$adaMenu=true;
						echo "<div class='media'>";
							echo "<div class='media-left'>";
			?>
							<img class="media-object displayPicture displayPictureMenu img-rounded"  src="<?php echo base_url('/vendors/images/menu/nasi goreng/1.jpg');?>" alt="...">
			<?php
							echo "</div>";
						echo "<div class='media-body'>";
							echo "<h4 class='media-heading'>".$m->NAMA_MENU."</h4>";
							echo $m->DESKRIPSI_MENU;
							echo "<div class='media m-t-2'>";
								echo "<div class='media-left' href='#'>";
			?>
								<img class="media-object displayPictureComment img-circle" src="<?php echo base_url('/vendors/images/team/1.jpg');?>" alt="Generic placeholder image">
			<?php
								echo "</div>";
								echo "<div class='media-body'>";
									echo "<h4 class='media-heading'>Michelle Withney</h4>";
									echo "Mantab bener ni menu.. wkwkkwk";
								echo "</div>";
							echo "</div>";
							echo "<br/>";
							echo "<div class='input-group customInputGroup img-rounded'>";
								echo "<input type='text' class='form-control' placeholder='Search for...'>";
								echo "<span class='input-group-btn'>";
									echo "<button class='btn btn-default img-rounded' type='button'>Go!</button>";
								echo "</span>";
							echo "</div>";
						echo "</div>";
						echo "</div>";
					}

				}
				if($adaMenu==false){
					echo "<h5>Tidak Ada Menu Snack</h5>";
				}
			}
			//===========SNACK=========
		?>
		
		<?php
		$adaMenu=false;
		//===========Kredit=========
			if(isset($kartu)){
				echo "<h4>Kartu Kredit</h4>";
				foreach($kartu as $k){
					echo "<div class='media'>";
						echo "<div class='media-left'>";
			?>
						<img class="media-object displayPicture displayPictureMenu img-rounded"  src="<?php echo base_url('/vendors/images/menu/nasi goreng/1.jpg');?>" alt="...">
			<?php
						echo "</div>";
					echo "<div class='media-body'>";
						echo "<h4 class='media-heading'>".$k->KARTU."</h4>";
						echo "Deskripsi : ".$k->DESKRIPSI_PROMO."<br/>";
						echo "Persentase : ".$k->PERSENTASE_PROMO."<br/>";
						echo "<div class='media m-t-2'>";
							echo "<div class='media-left' href='#'>";
			?>
							<img class="media-object displayPictureComment img-circle" src="<?php echo base_url('/vendors/images/team/1.jpg');?>" alt="Generic placeholder image">
			<?php
							echo "</div>";
							echo "<div class='media-body'>";
								echo "<h4 class='media-heading'>Michelle Withney</h4>";
								echo "Promo Termurahh.....";
							echo "</div>";
						echo "</div>";
						echo "<br/>";
						echo "<div class='input-group customInputGroup img-rounded'>";
							echo "<input type='text' class='form-control' placeholder='Search for...'>";
							echo "<span class='input-group-btn'>";
								echo "<button class='btn btn-default img-rounded' type='button'>Go!</button>";
							echo "</span>";
						echo "</div>";
					echo "</div>";
					echo "</div>";					
				}
			}
			//===========Kredit=========
		?>
    </div>
    <br/>
    <div class="imageGallery">
        <div id="links">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-3 gambarImageGallery">
                        <a href="images/menu/nasi goreng/1.jpg">
                            <img src="images/menu/nasi goreng/1.jpg" class="img-responsive">
                        </a>
                    </div>
                    <div class="col-sm-3 gambarImageGallery">
                        <a href="images/menu/nasi goreng/2.jpg">
                            <img src="images/menu/nasi goreng/2.jpg" class="img-responsive">
                        </a>
                    </div>
                    <div class="col-sm-3 gambarImageGallery">
                        <a href="images/menu/nasi goreng/3.jpg">
                            <img src="images/menu/nasi goreng/3.jpg" class="img-responsive">
                        </a>
                    </div>
                    <div class="col-sm-3 gambarImageGallery">
                        <a href="images/menu/nasi goreng/4.jpg">
                            <img src="images/menu/nasi goreng/4.jpg">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls">
        <div class="slides"></div>
        <h3 class="title"></h3>
        <a class="prev">‹</a>
        <a class="next">›</a>
        <a class="close">×</a>
        <a class="play-pause"></a>
        <ol class="indicator"></ol>
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