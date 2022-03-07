<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Public_controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->cats = array_map(function($cat){
			return [
				'cat_slug' => $cat['cat_slug'],
				'cat_name' => $cat['cat_name'],
				'sub_cats' => $this->main->getAll('category', 'cat_slug, cat_name', ['is_deleted' => 0, 'parent_id' => $cat['id']])
			];
		}, $this->main->getAll('category', 'id, cat_slug, cat_name', ['is_deleted' => 0, 'parent_id' => 0]));
		
		$this->cart = $this->main->getCart($this->session->userId);
		$this->show = ['Deals Of The Day', 'Top Featured', 'Top Selling'];
	}
	
	public function index()
	{
		$data['title'] = 'Home';
        $data['name'] = 'home';
        $data['banners'] = $this->main->getBanners();
        $data['prods'] = $this->main->getProds($this->show);
		// echo $this->load->view('get-cart', $data, TRUE);
		// re();
		return $this->template->load('template', 'home', $data);
	}
	
	public function getCart()
	{
		check_ajax();
		
		$total = '₹ '.array_sum(array_map(function($var) {
			return $var['prod_id'];
		}, $this->cart));

		die(json_encode(['cart' => $this->cart, 'total' => $total, 'counts' => count($this->cart)]));
	}

	public function addCart()
	{
		check_ajax();

		$id = $this->main->addCart($this->session->userId);

		die(json_encode(['success' => $id, 'message' => "Product added to cart."]));
	}
}