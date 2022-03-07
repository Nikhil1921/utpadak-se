<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends Admin_controller  {

    public function __construct()
	{
		parent::__construct();
		$this->path = $this->config->item('products');
        $this->cats = $this->main->getAll('category', 'id, cat_name', ['is_deleted' => 0, 'parent_id' => 0]);
	}

	private $table = 'products';
	protected $redirect = 'products';
	protected $title = 'Product';
	protected $name = 'product';
	
	public function index()
	{
		$data['title'] = $this->title;
        $data['name'] = $this->name;
        $data['url'] = $this->redirect;
        $data['operation'] = "List";
        $data['datatable'] = "$this->redirect/get";
		
		return $this->template->load('template', "$this->redirect/home", $data);
	}

    public function get()
    {
        check_ajax();
        $this->load->model('Products_model', 'data');
        $fetch_data = $this->data->make_datatables();
        $sr = $this->input->get('start') + 1;
        $data = [];

        foreach($fetch_data as $row)
        {
            $sub_array = [];
            $sub_array[] = $sr;
            $sub_array[] = $row->p_title;
            $sub_array[] = $row->p_price;
            $sub_array[] = $row->p_qty;
            $sub_array[] = img(['src' => $this->path.$row->image, 'width' => '50', 'height' => '50']);
            
            $action = '<div class="btn-group" role="group"><button class="btn btn-success dropdown-toggle" id="btnGroupVerticalDrop1" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="icon-settings"></span></button><div class="dropdown-menu" aria-labelledby="btnGroupVerticalDrop1" x-placement="bottom-start">';
            
            $action .= anchor($this->redirect."/update/".e_id($row->id), '<i class="fa fa-edit"></i> Edit</a>', 'class="dropdown-item"');
        
            $action .= form_open($this->redirect.'/delete', 'id="'.e_id($row->id).'"', ['id' => e_id($row->id)]).
                '<a class="dropdown-item" onclick="script.delete('.e_id($row->id).'); return false;" href=""><i class="fa fa-trash"></i> Delete</a>'.
                form_close();

            $action .= '</div></div>';
            $sub_array[] = $action;

            $data[] = $sub_array;  
            $sr++;
        }

        $output = [
            "draw"              => intval($this->input->get('draw')),  
            "recordsTotal"      => $this->data->count(),
            "recordsFiltered"   => $this->data->get_filtered_data(),
            "data"              => $data
        ];
        
        die(json_encode($output));
    }

    public function add()
	{
        $this->form_validation->set_rules($this->validate);

        $data['title'] = $this->title;
        $data['name'] = $this->name;
        $data['operation'] = "Add";
        $data['url'] = $this->redirect;

        if ($this->form_validation->run() == FALSE)
            return $this->template->load('template', "$this->redirect/form", $data);
        else{
            $image = $this->uploadImage('image', 'jpg|jpeg|png', ['max_width' => 250, 'max_height' => 250, 'min_width' => 250, 'min_height' => 250]);
            if ($image['error'] == TRUE){
                $this->session->set_flashdata('error', $image["message"]);
                return $this->template->load('template', "$this->redirect/form", $data);
            }else{
                $post = [
                    'cat_id'            => d_id($this->input->post('cat_id')),
                    'sub_cat_id'        => d_id($this->input->post('sub_cat_id')),
                    'p_title'           => $this->input->post('p_title'),
                    'p_slug'            => strtolower($this->input->post('p_slug')),
                    'p_qty'             => $this->input->post('p_qty'),
                    'p_price'           => $this->input->post('p_price'),
                    'description'       => $this->input->post('description'),
                    'p_show'            => $this->input->post('p_show'),
                    'seo_title'         => $this->input->post('seo_title'),
                    'seo_keyword'       => $this->input->post('seo_keyword'),
                    'seo_description'   => $this->input->post('seo_description'),
                    'image'             => $image['message']
                ];

                $id = $this->main->add($post, $this->table);

                flashMsg($id, "$this->title added.", "$this->title not added. Try again.", $this->redirect);
            }
        }
	}

	public function update($id)
	{
        $this->form_validation->set_rules($this->validate);

        if ($this->form_validation->run() == FALSE)
        {
            $data['title'] = $this->title;
            $data['name'] = $this->name;
            $data['operation'] = "Update";
            $data['url'] = $this->redirect;
            $data['data'] = $this->main->get($this->table, 'cat_id, sub_cat_id, p_title, p_slug, p_qty, p_price, description, p_show, seo_title, seo_keyword, seo_description, image', ['id' => d_id($id)]);
            
            return $this->template->load('template', "$this->redirect/form", $data);
        }else{
            $post = [
                'cat_id'            => d_id($this->input->post('cat_id')),
                'sub_cat_id'        => d_id($this->input->post('sub_cat_id')),
                'p_title'           => $this->input->post('p_title'),
                'p_slug'            => strtolower($this->input->post('p_slug')),
                'p_qty'             => $this->input->post('p_qty'),
                'p_price'           => $this->input->post('p_price'),
                'description'       => $this->input->post('description'),
                'p_show'            => $this->input->post('p_show'),
                'seo_title'         => $this->input->post('seo_title'),
                'seo_keyword'       => $this->input->post('seo_keyword'),
                'seo_description'   => $this->input->post('seo_description'),
            ];

            if (!empty($_FILES['image']['name'])) {
                $image = $this->uploadImage('image', 'jpg|jpeg|png', ['max_width' => 250, 'max_height' => 250, 'min_width' => 250, 'min_height' => 250]);
                if ($image['error'] == TRUE)
                    flashMsg(0, "", $image["message"], "$this->redirect/update/$id");
                else{
                    if (is_file($this->path.$this->input->post('image')))
                        unlink($this->path.$this->input->post('image'));
                    $post['image'] = $image['message'];
                }
            }
            
            $id = $this->main->update(['id' => d_id($id)], $post, $this->table);

            flashMsg($id, "$this->title updated.", "$this->title not updated. Try again.", $this->redirect);
        }
	}

	public function delete()
    {
        $this->form_validation->set_rules('id', 'id', 'required|numeric');
        
        if ($this->form_validation->run() == FALSE)
            flashMsg(0, "", "Some required fields are missing.", $this->redirect);
        else{
            $id = $this->main->update(['id' => d_id($this->input->post('id'))], ['is_deleted' => 1], $this->table);
            flashMsg($id, "$this->title deleted.", "$this->title not deleted.", $this->redirect);
        }
    }

    protected $validate = [
        [
            'field' => 'cat_id',
            'label' => 'Category',
            'rules' => 'required|numeric',
            'errors' => [
                'required' => "%s is required",
                'numeric' => "%s is not valid",
            ],
        ],
        [
            'field' => 'sub_cat_id',
            'label' => 'Sub Category',
            'rules' => 'required|numeric',
            'errors' => [
                'required' => "%s is required",
                'numeric' => "%s is not valid",
            ],
        ],
        [
            'field' => 'p_title',
            'label' => 'Title',
            'rules' => 'required|max_length[100]|trim',
            'errors' => [
                'required' => "%s is required",
                'max_length' => "Max 100 chars allowed.",
            ],
        ],
        [
            'field' => 'p_slug',
            'label' => 'Slug',
            'rules' => 'required|max_length[5]|trim',
            'errors' => [
                'required' => "%s is required",
                'max_length' => "Max 5 chars allowed.",
            ],
        ],
        [
            'field' => 'p_qty',
            'label' => 'Quantity',
            'rules' => 'required|max_length[100]|trim|numeric',
            'errors' => [
                'required' => "%s is required",
                'numeric' => "%s is invalid",
                'max_length' => "Max 100 chars allowed.",
            ],
        ],
        [
            'field' => 'p_price',
            'label' => 'p_price',
            'rules' => 'required|max_length[100]|trim|numeric',
            'errors' => [
                'required' => "%s is required",
                'numeric' => "%s is invalid",
                'max_length' => "Max 100 chars allowed.",
            ],
        ],
        [
            'field' => 'description',
            'label' => 'Description',
            'rules' => 'required|trim',
            'errors' => [
                'required' => "%s is required",
            ],
        ],
        [
            'field' => 'p_show',
            'label' => 'Option To show',
            'rules' => 'required|trim',
            'errors' => [
                'required' => "%s is required",
            ],
        ],
    ];
}