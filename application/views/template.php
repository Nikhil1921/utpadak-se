<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?= "$title | " . APP_NAME ?></title>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?= link_tag('assets/images/favicon.png', 'icon', 'image/x-icon') ?>
        <?= link_tag('assets/css/bootstrap.css', 'stylesheet', 'text/css') ?>
        <?= link_tag('assets/css/style.css', 'stylesheet', 'text/css') ?>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
		<section class="header_up">
			<div class="container-fluid">
				<div class="row header_up_main">
				<div class="col-lg-6 header_up_left">
					<div class="logo">
						<?= anchor('', img(['src' => 'assets/images/logo.png'])) ?>
					</div>
					<div class="mahila_conte">
						<h3><strong>મહિલા સામખ્ય સોસાયટી, ગુજરાત <span class="small_font">(પ્રાથમિક શિક્ષણ વિભાગ)</span></strong></h3>
					</div>
				</div>
				<div class="col-lg-6 header_up_right">
					<nav style="float: left;">
						<ul class="header_up_ul">
							<li>
								<a class="header_up_a" href="tel:0123456789"><span><i class="fa fa-phone header_phone" aria-hidden="true"></i> <strong>9824429616</strong></span></a><br />
								<a class="header_up_a" href="mailto:demo@example.com"><span><i class="fa fa-envelope header_phone" aria-hidden="true"><br></i>   <strong>msgujarat.ahd@gmail.com</strong></span></a>
							</li>
						</ul>
					</nav>
				</div>
				</div>
			</div>
		</section>
		<section class="header_middle_section">
			<div class="container">
				<nav class="navbar navbar-expand-lg navbar-light">
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>
					<div class="collapse navbar-collapse" id="navbarSupportedContent">
						<ul class="navbar-nav">
							<li class="nav-item">
								<?= anchor('', "Home", 'class="nav-link"') ?>
							</li>
							<li class="nav-item">
								<?= anchor('about_us', "About Us", 'class="nav-link"') ?>
							</li>
							<li class="nav-item">
								<?= anchor('gallery', "Gallery", 'class="nav-link"') ?>
							</li>
							<li class="nav-item">
								<?= anchor('staff', "Staff", 'class="nav-link"') ?>
							</li>
							<li class="nav-item">
								<?= anchor('events', "Events", 'class="nav-link"') ?>
							</li>
							<li class="nav-item">
								<?= anchor('news', "News", 'class="nav-link"') ?>
							</li>
							<li class="nav-item">
								<?= anchor('contact_us', "Contact Us", 'class="nav-link"') ?>
							</li>
						</ul>
					</div>
				</nav>
			</div>
		</section>
		<?= $contents ?>
		<section class="ftr_end">
			<div class="container-fluid">
				<div class="row">
					<div class="col-12">
						<div class="ftr_cont text-center">
						<p class="ftr_p"> <a href="#">DISCLAIMER</a> | <a href="#">PRIVACY POLICY</a> | <a href="#">TERMS OF USE</a> </p>
						<p class="ftr_p"> Copyrights © 2022 Mahila Samakhya</p>
						<p class="ftr_p"> Site Last Updated on <strong>10 FEB 2022</strong> | Visitor No. : <?= $this->main->getVisitors() ?></p>
						</div>
					</div>
				</div>
			</div>
		</section>
        <?= script('assets/js/jquery.js') ?>
        <?= script('assets/js/popper.min.js') ?>
        <?= script('assets/js/bootstrap.min.js') ?>
		<?php if($name === 'home'): ?>
		<?php endif ?>
    </body>
</html>