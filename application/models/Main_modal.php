<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 
 */
class Main_modal extends MY_Model
{
    public function __construct()
	{
		parent::__construct();
		$this->banners = $this->config->item('banners');
		$this->heads = $this->config->item('heads');
		$this->gallery = $this->config->item('gallery');
	}

	public function getBanners()
    {
        return $this->getAll('banners', "CONCAT('".$this->banners."', banner) banner", []);
    }

	public function getHeads()
    {
        return $this->getAll('heads', "name, hoddo, CONCAT('".$this->heads."', img) img", []);
    }

	public function getEvents()
    {
        return $this->getAll('events', "title", ['is_deleted' => 0], 'id DESC', 10);
    }

	public function getNews()
    {
        return $this->getAll('news', "id, title", ['is_deleted' => 0], 'id DESC', 10);
    }

	public function getImageGallery()
    {
        return $this->getAll('image_gallery', "CONCAT('".$this->gallery."', image) image", ['is_deleted' => 0], 'id DESC', 8);
    }

	public function getVideoGallery()
    {
        return $this->getAll('video_gallery', "name, v_url", ['is_deleted' => 0], 'id DESC', 8);
    }

	public function getVisitors()
    {
		if (!$this->main->get('app_configs', 'value', ['cong_name' => 'visitors']))
			$this->main->add(['cong_name' => 'visitors', 'value' => 0], 'app_configs');
			
		$visitors = $this->main->check('app_configs', ['cong_name' => 'visitors'], 'value');
		$this->main->update(['cong_name' => 'visitors'], ['value' => ($visitors + 1)], 'app_configs');
		return $visitors;
    }
}