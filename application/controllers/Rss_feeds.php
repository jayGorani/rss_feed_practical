<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rss_feeds extends CI_Controller {

	public $data;
	public function __construct()
    {
        parent::__construct();
		include('Include.php');
		$this->load->helper('utility');
    }

	public function index()
	{
		$this->data['title'] = 'Import RSS Feed';
		$this->load->view('rss/feed_import',$this->data);
	}

	public function feed_list()
	{
		$this->data['title'] = 'RSS Feed List';
		$this->load->view('rss/feed_list', $this->data);
	}

	public function dashboard()
	{
		$this->data['title'] = 'RSS Feed Dashboard';
		$this->data['available_platforms'] = $this->db_operation->get_available_platforms();
		$this->load->view('rss/feed_dashboard', $this->data);
	}

	public function load_feed_ajax()
	{
		$page = $this->input->post('page');
		$page = ($page) ? $page : 0;

		$limit = 10;
		$offset = $page;

		$total = $this->db_operation->count_posts();
		$posts = $this->db_operation->get_posts($limit, $offset);

		$this->load->library('pagination');
		$config['total_rows'] = $total;
		$config['base_url'] = '#';
		$config['per_page'] = $limit;
		$config['use_page_numbers'] = FALSE;

		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';

		$config['attributes'] = ['class' => 'page-link'];

		$config['first_link'] = false;
		$config['last_link'] = false;

		$config['prev_tag_open'] = '<li class="page-item">';
		$config['prev_tag_close'] = '</li>';
		$config['prev_link'] = '<i class="bi bi-chevron-left"></i> Previous';

		$config['next_tag_open'] = '<li class="page-item">';
		$config['next_tag_close'] = '</li>';
		$config['next_link'] = 'Next <i class="bi bi-chevron-right"></i>';

		$config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
		$config['cur_tag_close'] = '</a></li>';

		$config['num_tag_open'] = '<li class="page-item">';
		$config['num_tag_close'] = '</li>';

		$this->pagination->initialize($config);

		$pagination = $this->pagination->create_links();

		echo json_encode([
			'posts' => $posts,
			'pagination' => $pagination,
		]);
	}


	public function rss_ajax_list()
	{
		$page = $this->input->post('page');
		$limit = 10;
		$offset = ($page - 1) * $limit;

		$total = $this->db_operation->count_posts();
		$posts = $this->db_operation->get_posts($limit, $offset);

		$pagination = $this->create_pagination_links($page, $total, $limit);

		$available_platforms = $this->db_operation->get_available_platforms();

		$templates = [];
		foreach($available_platforms as $platform){
			$templates[$platform['platform_id']] = $platform['tagged_html'];
		}

		foreach($posts as $post){
			if(!empty($post->tagged_platform)){
				$post['tagged_platform_keys'] = array_filter(array_map('trim', explode(',', $post->tagged_platform)));
			} else {
				$post['tagged_platform_keys'] = [];
			}
		}

		echo json_encode([
			'status'     => (!empty($posts)) ? true : false,
			'posts'      => $posts,
			'templates'  => $templates,
			'pagination' => $pagination
		]);
	}

	private function create_pagination_links($page, $total, $limit)
	{
		$total_pages = ceil($total / $limit);
		if ($total_pages <= 1) return '';

		$html = '<ul class="pagination">';

		$prevDisabled = ($page == 1) ? 'disabled' : '';
		$html .= '<li class="page-item ' . $prevDisabled . '">
					<a href="#" class="page-link ajax-page" data-page="' . ($page - 1) . '">
						<i class="bi bi-chevron-left"></i> Previous
					</a>
				</li>';

		for ($i = 1; $i <= $total_pages; $i++) {
			$active = ($i == $page) ? 'active' : '';
			$html .= '<li class="page-item ' . $active . '">
						<a href="#" class="page-link ajax-page" data-page="' . $i . '">' . $i . '</a>
					</li>';
		}

		$nextDisabled = ($page == $total_pages) ? 'disabled' : '';
		$html .= '<li class="page-item ' . $nextDisabled . '">
					<a href="#" class="page-link ajax-page" data-page="' . ($page + 1) . '">
						Next <i class="bi bi-chevron-right"></i>
					</a>
				</li>';

		$html .= '</ul>';

		return $html;
	}

	public function delete($id)
	{
		$this->db->where('id', $id)->delete('posts');

		echo json_encode([
			'status' => true,
			'message' => 'Post deleted'
		]);
	}

	public function get($id)
	{
		$post = $this->db->where('id', $id)->get('posts')->row_array();

		echo json_encode([
			'status' => true,
			'data' => $post
		]);
	}

	public function update()
	{
		$id = $this->input->post('post_id');

		$platforms = $this->input->post('socaial_platform');
		$platform_string = is_array($platforms) ? implode(",", $platforms) : "";
		$data = [
			'title' => $this->input->post('title'),
			'tagged_platform' => $platform_string
		];

		$this->db->where('id', $id)->update('posts', $data);

		echo json_encode([
			'status' => true,
			'message' => 'Updated successfully'
		]);
	}

	public function import_feed_data()
	{
		$feed_url = $this->input->post('feed_url');
		$feed_url = trim($feed_url);
		if(empty($feed_url)) {
			$this->session->set_flashdata('error', 'Please enter valid RSS feed URL !!');
			redirect(base_url('rss_feeds'));
		}

        $rss = @simplexml_load_file($feed_url);
        if (!$rss) {
			$this->session->set_flashdata('error', 'RSS feed not reachable or invalid URL.');
			redirect(base_url('rss_feeds'));
        }

		$insertFeeds = [];

        foreach ($rss->channel->item as $item) {
            $title   = (string) trim(normalizeString($item->title));
            $content = (string) trim($item->description);
            $pubDate = date('Y-m-d H:i:s', strtotime((string)$item->pubDate));
            $charCount = mb_strlen($content, 'UTF-8');
			$insertFeeds[] = [
				'title'      => $title,
				'content'    => $content,
				'char_count' => $charCount,
				'pub_date'   => $pubDate,
				'priority'   => 0
			];
		}

		if(check_array($insertFeeds)) {

			$titles = array_column($insertFeeds, 'title');

			$existing = $this->db->select('title')
							->where_in('title', $titles)
							->get('posts')
							->result_array();

			if(check_array($existing)){
				$existingTitles = array_column($existing, 'title');
				$finalBatch = array_filter($insertFeeds, function($p) use ($existingTitles) {
					return !in_array($p['title'], $existingTitles);
				});

				if(check_array($finalBatch)){
					$insertFeeds = $finalBatch;
				}
			}
			$inserted = false;
			if(check_array($insertFeeds)){
				$inserted = $this->db_operation->insert_posts_batch($insertFeeds);
			}

			if($inserted) {
				$this->session->set_flashdata('success', 'RSS feed items imported successfully !!');
			} else {
				$this->session->set_flashdata('error', 'Failed to import RSS feed items !!');
			}
		} else {
			$this->session->set_flashdata('warning', 'No feed items found to import !!');
		}


		redirect(base_url('rss_feeds'));

	}

	public function rss_dashboard_ajax_list()
	{
		$page = $this->input->post('page');
		$limit = 10;
		$offset = ($page - 1) * $limit;

		$selected_platform = trim($this->input->post('platform'));
		$where_array = [];
		$selected_platform = (int)$selected_platform;

		$where_array = array('tagged_platform != ' => NULL);

		$total = $this->db_operation->count_posts($where_array,$selected_platform);

		$posts = $this->db_operation->get_posts($limit, $offset, $selected_platform, $where_array);

		$pagination = $this->create_pagination_links($page, $total, $limit);

		$available_platforms = $this->db_operation->get_available_platforms();

		foreach($available_platforms as $platform){
			$templates[$platform['platform_id']] = $platform['tagged_html'];
		}

		foreach($posts as $post){
			if(!empty($post->tagged_platform)){
				$post['tagged_platform_keys'] = array_filter(array_map('trim', explode(',', $post->tagged_platform)));
			} else {
				$post['tagged_platform_keys'] = [];
			}
		}

		echo json_encode([
			'status'     => (!empty($posts)) ? true : false,
			'data'       => $posts,
			'templates'  => $templates,
			'pagination' => $pagination,
			'total'      => $total,
			'page'       => $page,
			'limit'      => $limit
		]);

	}


	public function update_priority_order() {
		$order = json_decode($this->input->post('order'), true);
		if(!empty($order)) {
			foreach($order as $item) {
				$this->db->where('id', $item['id'])
						->update('posts', ['priority' => $item['priority']]);
			}
		}
		echo json_encode(["status" => true]);
	}

}
