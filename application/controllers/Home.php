<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Public_controller {

	/* public function __construct()
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
		$this->wishlist = $this->main->getWishlist($this->session->userId);
		$this->show = ['Deals Of The Day', 'Top Featured', 'Top Selling'];
		$this->breadcrumb = 'assets/images/breadcrumb/';
	} */
	
	public function index()
	{
		$data['title'] = 'Home';
        $data['name'] = 'home';
        $data['banners'] = $this->main->getBanners();
        $data['prods'] = $this->main->getProds($this->show);

		return $this->template->load('template', 'home', $data);
	}
	
	public function wishlist()
	{
		$data['title'] = 'Wishlist';
        $data['name'] = 'wishlist';
        $data['breadcrumb'] = $this->breadcrumb.'wishlist.jpg';

		return $this->template->load('template', 'wishlist', $data);
	}
	
	public function cart()
	{
		$data['title'] = 'Cart';
        $data['name'] = 'cart';
        $data['breadcrumb'] = $this->breadcrumb.'cart.jpg';

		return $this->template->load('template', 'cart', $data);
	}

	public function product($cat, $sub_cat, $prod)
	{
		$data['prod'] = $this->main->getProd($cat, $sub_cat, $prod);
		if ($data['prod']) {
			$data['title'] = 'Product';
			$data['name'] = 'product';
			
			return $this->template->load('template', 'product', $data);
		}else{
			return $this->error_404();
		}
	}

	public function getCart()
	{
		check_ajax();
		
		$total = '₹ '.array_sum(array_map(function($prod) {
			return $prod['qty'] * $prod['p_price'];
		}, $this->cart));

		die(json_encode(['cart' => $this->cart, 'total' => $total, 'counts' => count($this->cart)]));
	}

	public function addCart()
	{
		check_ajax();
		
		$id = $this->main->addCart($this->session->userId);

		die(json_encode(['success' => 1, 'message' => "Product added to cart."]));
	}

	public function addWish()
	{
		check_ajax();

		$id = $this->main->addWish($this->session->userId);

		die(json_encode(['success' => 1, 'message' => "Product added to cart."]));
	}
}