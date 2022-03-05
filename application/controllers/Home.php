<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Public_controller {

	protected $visitors;
	
	public function index()
	{
		$data['title'] = 'Home';
        $data['name'] = 'home';
        $data['banners'] = $this->main->getBanners();
        $data['heads'] = $this->main->getHeads();
        $data['events'] = $this->main->getEvents();
        $data['news'] = $this->main->getNews();
        $data['image_gallery'] = $this->main->getImageGallery();
        $data['video_gallery'] = $this->main->getVideoGallery();
		
		return $this->template->load('template', 'home', $data);
	}

	public function work_vistar()
	{
		$data['title'] = 'Home';
        $data['name'] = 'home';
        $data['banners'] = $this->main->getBanners();
        $data['heads'] = $this->main->getHeads();
        $data['events'] = $this->main->getEvents();
		
		return $this->template->load('template', 'home', $data);
	}
}