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
	
	public function shop($cat, $sub_cat='')
	{
		$url = $this->config->site_url($this->uri->uri_string());
		$q = '';
		
		foreach ($this->input->get() as $k => $v) {
			$q .= $k != 'per_page' && $k != array_key_first($this->input->get()) ? '&' : '';
			$q .= $k != 'per_page' ? $k."=".urlencode($v) : '';
		}
		
		$base = $_SERVER['QUERY_STRING'] ? $url.'?'.$q : $url;

		$where = $data['bread'] = [];

		if ($cat == 'all') {
			$data['bread'][] = ['name' => 'ALL', 'slug' => $cat];
		}else if($cat_check = $this->main->get('category', 'id, cat_name', ['cat_slug' => $cat, 'parent_id' => 0])){
			$where['c.cat_slug'] = $cat;
			$data['bread'][] = ['name' => $cat_check['cat_name'], 'slug' => $cat];
		}else{
			return $this->error_404();
		}
		
		if ($sub_cat != '') {
			$where['sc.cat_slug'] = $sub_cat;

			if($sub_check = $this->main->get('category', 'cat_name', ['parent_id' => $cat_check['id'], 'cat_slug' => $sub_cat]))
			{
				$data['bread'][] = ['name' => $sub_check['cat_name'], 'slug' => "$cat/$sub_cat"];
			}else{
				return $this->error_404();
			}
		}
		
		$this->load->library('pagination');
		
		$config = [
			'base_url' => $base,
			'total_rows' => $this->main->prodCount($where),
			'per_page' => $this->input->get('show') ? $this->input->get('show') : 4,
			'use_page_numbers' => TRUE,
			'page_query_string' => TRUE,
			'cur_tag_open' => '<li><a class="active" href="javascript:;">',
			'cur_tag_close' => '</a></li>',
			'first_link' => '<<',
			'first_tag_open' => '<li>',
			'first_tag_close' => '</li>',
			'last_link' => '>>',
			'last_tag_open' => '<li>',
			'last_tag_close' => '</li>',
			'next_link' => '>',
			'next_tag_open' => '<li>',
			'next_tag_close' => '</li>',
			'prev_link' => '<',
			'prev_tag_open' => '<li>',
			'prev_tag_close' => '</li>',
			'num_tag_open' => '<li>',
			'num_tag_close' => '</li>',
		];
		
		$this->pagination->initialize($config);
		$start = $this->input->get('per_page') ? ($this->input->get('per_page') - 1) * $config['per_page'] : 0;

        $data['title'] = 'Shop';
        $data['name'] = 'shop';
		
        $data['prods'] = $this->main->getProducts($start, $config['per_page'], $where);
        $data['total'] = $config['total_rows'];
        $data['start'] = $start + 1;
        $data['end'] = $start + count($data['prods']);
		
		return $this->template->load('template', 'shop', $data);
	}
}