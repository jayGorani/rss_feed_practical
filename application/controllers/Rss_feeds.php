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
		// LOAD RSS FEED IMPORT VIEW
		$this->data['title'] = 'Import RSS Feed';
		$this->load->view('rss/feed_import',$this->data);
	}

	public function feed_list()
	{
		// LOAD RSS FEED LIST VIEW
		$this->data['title'] = 'RSS Feed List';
		$this->data['available_platforms'] = $this->db_operation->get_available_platforms();
		$this->load->view('rss/feed_list', $this->data);
	}

	public function dashboard()
	{
		// LOAD RSS FEED DASHBOARD VIEW
		$this->data['title'] = 'RSS Feed Dashboard';
		$this->data['available_platforms'] = $this->db_operation->get_available_platforms();
		$this->load->view('rss/feed_dashboard', $this->data);
	}

	public function rss_posts_list()
	{
		// LOAD RSS POSTS LIST WITH DATA WITH LIMIT,OFFSET VIA AJAX
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
		// GENERATE PAGINATION LINKS HTML IN AJAX RESPONSE

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

	public function deletePost($id)
	{
		// DELETE POST BY ID
		$this->db->where('id', $id)->delete('posts');
		echo json_encode([
			'status' => true,
			'msg'    => 'Post deleted successfully !!'
		]);
	}

	public function getPostDetails($id)
	{
		// GET POST DETAILS BY ID FOR EDIT MODAL POPUP
		$post = $this->db->where('id', $id)->get('posts')->row_array();
		echo json_encode([
			'status' => true,
			'data'   => $post
		]);
	}

	public function updatePost()
	{
		// UPDATE POST DETAILS BY ID
		$id              = $this->input->post('post_id');
		$platforms       = $this->input->post('socaial_platform');
		$platform_string = is_array($platforms) ? implode(",", $platforms) : "";
		$title           = trim($this->input->post('title'));

		$responseData = [
			'status' => false,
			'msg'    => ''
		];

		if($title != '') {

			$updateData = [
				'title'           => $title,
				'char_count'      => getCharCount($title),
				'tagged_platform' => $platform_string
			];

			$whereArray = [
				'id' => $id
			];

			$this->db_operation->update('posts', $updateData, $whereArray);

			$responseData['status'] = true;
			$responseData['msg']    = 'Post updated successfully !!';

		} else {
			$responseData['status'] = false;
			$responseData['msg']    = 'Title cannot be empty !!';
		}

		echo json_encode($responseData);
	}

	public function dashboard_posts_list()
	{
		// LOAD RSS POSTS LIST WITH FILTER BY PLATFORM WITH PAGINATION VIA AJAX FOR SOCIAL DASHBOARD
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

	public function updatePriority() {
		// UPDATE POSTS PRIORITY ORDER VIA AJAX
		$order = json_decode($this->input->post('order'), true);
		if(!empty($order)) {
			foreach($order as $item) {
				$this->db->where('id', $item['id'])
						->update('posts', ['priority' => $item['priority']]);
			}
		}
		echo json_encode([
			"status" => true,
			"msg"    => "Priority order updated successfully."
		]);
	}

	public function import_feed_data()
	{
		// IMPRORT RSS FEED DATA
		$feed_url = trim($this->input->post('feed_url'));
		$sorting_order = strtoupper($this->input->post('sorting_order'));

		if ($feed_url == '') {
			$this->session->set_flashdata('error', 'Please enter valid RSS feed URL !!');
			redirect(base_url('rss_feeds'));
		}

		$this->load->library('Simplepie_lib');

		$feed = $this->simplepie_lib->load_feed($feed_url);

		if ($feed->error()) {
			$this->session->set_flashdata('error', 'Feed error: ' . $feed->error());
			redirect(base_url('rss_feeds'));
		}

		$items = [];

		foreach ($feed->get_items() as $item) {

			$image = null;

			if ($enclosure = $item->get_enclosure()) {
				$image = $enclosure->get_link();
			}

			if (!$image) {
				$description = $item->get_description();
				preg_match('/<img.*?src=["\'](.*?)["\']/', $description, $match);
				$image = $match[1] ?? null;
			}

			$title = trim($item->get_title());

			if($title != '') {
				$content = $item->get_content();
				$items[] = [
					'title'      => $title,
					'content'    => $content,
					'char_count' => getCharCount($title),
					'pub_date'   => $item->get_date('Y-m-d H:i:s'),
					'image'      => $image,
				];
			}
		}

		if (check_array($items)) {
			usort($items, function($a, $b) use ($sorting_order) {
				$t1 = strtotime($a['pub_date']);
				$t2 = strtotime($b['pub_date']);
				return $sorting_order === 'ASC' ? ($t1 <=> $t2) : ($t2 <=> $t1);
			});
		}

		if (check_array($items)) {
			$titles = array_column($items, 'title');
			$existing = $this->db->select('title')
								->where_in('title', $titles)
								->get('posts')
								->result_array();
			if (check_array($existing)) {
				$existingTitles = array_column($existing, 'title');
				$items = array_filter($items, function($p) use ($existingTitles) {
					return !in_array($p['title'], $existingTitles);
				});
			}
		}

		$inserted = false;

		if (check_array($items)) {
			$inserted = $this->db_operation->insert_posts_batch($items);
		}

		if ($inserted) {
			$this->session->set_flashdata('success', 'RSS feed items imported successfully !!');
		} else {
			$msg = empty($items)
				? 'No feed items found to import !!'
				: 'Failed to import RSS feed items !!';
			$this->session->set_flashdata('error', $msg);
		}

		redirect(base_url('rss_feeds'));
	}


}
