<?php
class ControllerModuleCarousel extends Controller {
	private $_name = 'carousel';

	protected function index($setting) {
		static $module = 0;

		$this->language->load('module/' . $this->_name);

		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->document->addStyle('catalog/view/javascript/jquery/slick/slick.css');

		$this->document->addScript('catalog/view/javascript/jquery/slick/slick.min.js');
		$this->document->addScript('catalog/view/javascript/jquery/jquery.easing.min.js');

		// Module
		$this->data['theme'] = $this->config->get($this->_name . '_theme');
		$this->data['title'] = $this->config->get($this->_name . '_title' . $this->config->get('config_language_id'));

		if (!$this->data['title']) {
			$this->data['title'] = $this->data['heading_title'];
		}

		// Stylesheet mode
		$template = $this->config->get('config_template');

		$stylesheet_mode = $this->config->get($template . '_stylesheet');

		if (!$stylesheet_mode) {
			$header_color = $this->config->get($this->_name . '_header_color');
			$header_shape = $this->config->get($this->_name . '_header_shape');
			$content_color = $this->config->get($this->_name . '_content_color');
			$content_shape = $this->config->get($this->_name . '_content_shape');

			$this->data['header_color'] = ($header_color) ? $header_color . '-skin' : 'white-skin';
			$this->data['header_shape'] = ($header_shape) ? $header_shape . '-top' : 'rounded-0';
			$this->data['content_color'] = ($content_color) ? $content_color . '-skin' : 'white-skin';
			$this->data['content_shape'] = ($content_shape) ? $content_shape . '-bottom' : 'rounded-0';
		} else {
			$this->data['header_color'] = '';
			$this->data['header_shape'] = '';
			$this->data['content_color'] = '';
			$this->data['content_shape'] = '';
		}

		$this->data['stylesheet_mode'] = $stylesheet_mode;

		$skin_color = $this->config->get($this->_name . '_skin_color');

		$this->data['skin_color'] = ($skin_color) ? $skin_color . '_skin' : 'charcoal_skin';

		// Responsive
		$show_max = round($setting['show']);

		$show_1280 = ($show_max > 4) ? ($show_max - 1) : $show_max;
		$show_960 = ($show_1280 > 3) ? ($show_1280 - 1) : $show_1280;
		$show_640 = ($show_960 > 2) ? ($show_960 - 1) : $show_960;
		$show_320 = ($show_640 > 1) ? ($show_640 - 1) : $show_640;

		$this->data['show_1280'] = $show_1280;
		$this->data['show_960'] = $show_960;
		$this->data['show_640'] = $show_640;
		$this->data['show_320'] = $show_320;

		// Auto
		$this->data['auto'] = $setting['auto'] ? 'true' : 'false';

		$this->load->model('design/banner');
		$this->load->model('tool/image');

		$this->data['banners'] = array();

		$results = $this->model_design_banner->getBanner($setting['banner_id']);

		foreach ($results as $result) {
			if (file_exists(DIR_IMAGE . $result['image'])) {
				if (!empty($result['link'])) {
					if ($result['external_link']) {
						$image_link = html_entity_decode($result['link'], ENT_QUOTES, 'UTF-8');
					} else {
						$image_link = $this->url->link($result['link'], '', 'SSL');
					}
				} else {
					$image_link = '';
				}

				$this->data['banners'][] = array(
					'title' => $result['title'],
					'link'  => $image_link,
					'image' => $this->model_tool_image->resize($result['image'], $setting['width'], $setting['height'])
				);
			}
		}

		$this->data['module'] = $module++;

		// Template
		$this->data['template'] = $this->config->get('config_template');

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/' . $this->_name . '.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/module/' . $this->_name . '.tpl';
		} else {
			$this->template = 'default/template/module/' . $this->_name . '.tpl';
		}

		$this->render();
	}
}
