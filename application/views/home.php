<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<section class="background">
  <section class="content">
    <div class="container">
      <div class="row content_main">
        <div class="padd">
          <div class="col-lg-3 content_left">
            <?php foreach($heads as $head): ?>
            <div class="director_img">
                <?= img(['src' => $head['img'], 'class' => "img_der"]) ?>
            </div>
            <div class="btnn">
                <p class="name"><strong><?= $head['name'] ?></strong></p>
                <p class="name"><?= $head['hoddo'] ?></p>
            </div>
            <?php endforeach ?>
          </div>
          <div class="col-lg-9 content_right">
            <div class="row cont_right_main">
              <div class="col-12 carousel_content">
                <div id="carouselBannersControls" class="carousel slide" data-ride="carousel">
                  <div class="carousel-inner">
                    <?php foreach($banners as $k => $banner): ?>
                    <div class="carousel-item <?= $k === 0 ? 'active' : ''?>">
                        <?= img(['src' => $banner['banner'], 'class' => "d-block w-100"]) ?>
                    </div>
                    <?php endforeach ?>
                  </div>
                  <a class="carousel-control-prev" href="#carouselBannersControls" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                  </a>
                  <a class="carousel-control-next" href="#carouselBannersControls" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                  </a>
                </div>
              </div>
            </div>
            <div class="row cont_main">
              <div class="col-lg-9 marqe_content">
                <div class="panel panel-primary">
                  <div class="texture heading-texture">
                    <div class="bg_image_mar">
                        <div style="float:left;padding:5px;font-size: 21px;">
                            <i class="fa fa-newspaper-o fa-lg"></i>કાર્યક્રમ ની વિગતો
                        </div>
                        <?= anchor("events", 'વધુમાં જાણો', 'class="btn Hind_Vadodara_fnt" style="color: black; float: right;background-color:#ffffff;border:1px solid white;font-size: 10px;margin-top: 6px;margin-right: 8px;"'); ?>
                    </div>
                    <div class="panel-body">
                        <marquee behavior="scroll" direction="UP" class="ojas-small" scrolldelay="500" style="height: 256px;background-color: #f6f6f8;">
                            <div class="mrq_content">
                                <?php 
                                    foreach($events as $event):
                                        echo anchor("events", '<p><span><i class="fa fa-caret-right" aria-hidden="true"></i> '.$event['title'].'</span></p>', 'class="mar_con"');
                                    endforeach 
                                ?>
                            </div>
                        </marquee>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-3 sec_detail">
                <div class="sec_content">
                  <div class="content-1">
                    <p><?= anchor('what-is-mahila-samakhya', 'મહિલા સામખ્ય એટલે શું?', 'class="contet_a"'); ?></p>
                  </div>
                  <div class="content-1">
                    <p><?= anchor('work-vistar', 'કાર્યક્રમનો કાર્યવિસ્તાર', 'class="contet_a"'); ?></p>
                  </div>
                  <div class="content-1">
                    <p><?= anchor('kamgiri', 'કાર્યક્રમની કામગીરી', 'class="contet_a"'); ?></p>
                  </div>
                  <div class="content-1">
                    <p><?= anchor('kendro', 'મહિલા સામખ્ય દ્વારા ચાલતા કેન્દ્રો', 'class="contet_a"'); ?></p>
                  </div>
                </div>
              </div>
            </div>
            <div class="row gallery_sec mt-4">
              <div class="col-lg-7 gallery_sec_main">
                <ul class="nav nav-pills mb-3 mt-3" id="pills-tab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Photo Gallery</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Video Gallery</a>
                  </li>
                </ul>
                <div class="tab-content" id="pills-tabContent">
                  <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                    <div class="row">
                        <?php foreach($image_gallery as $k => $ig): ?>
                        <div class="col-lg-3 <?= $k > 3 ? 'mt-3' : '' ?>">
                            <?= anchor('gallery', img(['src' => $ig['image'], 'class' => "same_width"])); ?>
                        </div>
                        <?php endforeach ?>
                    </div>
                  </div>
                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                      No Video
                    </div>
                </div>
              </div>
              <div class="col-lg-5">
                <div class="panel panel-primary">
                  <div class="texture heading-texture">
                    <div class="bg_image_mar">
                        <div style="float:left;padding:5px;font-size: 21px;">
                            <i class="fa fa-newspaper-o fa-lg"></i>સમાચાર
                        </div>
                        <?= anchor('news', 'વધુમાં જાણો', 'class="btn Hind_Vadodara_fnt" style="color: black; float: right;background-color:#ffffff;border:1px solid white;font-size: 10px;margin-top: 6px;margin-right: 8px;"'); ?>
                    </div>
                    <div class="panel-body">
                      <marquee behavior="scroll" direction="UP" class="ojas-small" scrolldelay="500" style="height: 216px;background-color: #f6f6f8;">
                        <div class="mrq_content">
                            <?php foreach($news as $n): ?>
                                <?= anchor('news/'.e_id($n['id']), '<p class="marque_p"><span><i class="fa fa-caret-right" aria-hidden="true"></i> '.$n['title'].'</span></p>', 'class="mar_con"'); ?>
                            <?php endforeach ?>
                        </div>
                      </marquee>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</section>