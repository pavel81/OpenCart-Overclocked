<?php
class ModelCheckoutOffers extends Model {

	// Product Product
	public function getOfferProductProduct($offer_product_product_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM `" . DB_PREFIX . "offer_product_product` WHERE offer_product_product_id = '" . (int)$offer_product_product_id . "' AND ((date_start = '0000-00-00' OR date_start < NOW()) AND (date_end = '0000-00-00' OR date_end > NOW())) AND status = '1'");

		if ($query->num_rows) {
			return array(
				'offer_product_product_id'	=> $query->row['offer_product_product_id'],
				'name'             		=> $query->row['name'],
				'discount'             	=> $query->row['discount'],
				'type'             		=> $query->row['type'],
				'logged'      			=> $query->row['logged'],
				'product_one'			=> $query->row['product_one'],
				'product_two'  		=> $query->row['product_two'],
				'date_start'				=> $query->row['date_start'],
				'date_end'  			=> $query->row['date_end'],
				'status'           		=> $query->row['status']
			);

		} else {
			return false;
		}
	}

	public function getOfferProductProducts($data = array()) {
		$status = true;

		$product_product_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "offer_product_product` WHERE ((date_start = '0000-00-00' OR date_start < NOW()) AND (date_end = '0000-00-00' OR date_end > NOW())) AND status = '1'");

		$product_product_data = array();

		foreach ($product_product_query->rows as $result) {
			if ($result['logged'] && !$this->customer->getId()) {
				$status = false;
			}

			$product_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "offer_product_product` WHERE offer_product_product_id = '" . (int)$result['offer_product_product_id'] . "'");

			if ($product_query->num_rows) {
				$product_product_data[] = array(
					'one'	=> $product_query->row['product_one'],
					'two'	=> $product_query->row['product_two'],
					'type'	=> $product_query->row['type'],
					'disc'	=> $product_query->row['discount']
				);

			} else {
				$status = false;
			}
		}

		if ($status) {
			return $product_product_data;
		}
	}

	// Product Category
	public function getOfferProductCategory($offer_product_category_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM `" . DB_PREFIX . "offer_product_category` WHERE offer_product_category_id = '" . (int)$offer_product_category_id . "' AND ((date_start = '0000-00-00' OR date_start < NOW()) AND (date_end = '0000-00-00' OR date_end > NOW())) AND status = '1'");

		if ($query->num_rows) {
			return array(
				'offer_product_category_id'	=> $query->row['offer_product_category_id'],
				'name'             		=> $query->row['name'],
				'discount'             	=> $query->row['discount'],
				'type'             		=> $query->row['type'],
				'logged'      			=> $query->row['logged'],
				'product_one'			=> $query->row['product_one'],
				'category_two'  		=> $query->row['category_two'],
				'date_start'				=> $query->row['date_start'],
				'date_end'  			=> $query->row['date_end'],
				'status'           		=> $query->row['status']
			);

		} else {
			return false;
		}
	}

	public function getOfferProductCategories($data = array()) {
		$status = true;

		$product_category_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "offer_product_category` WHERE ((date_start = '0000-00-00' OR date_start < NOW()) AND (date_end = '0000-00-00' OR date_end > NOW())) AND status = '1'");

		$product_category_data = array();

		foreach ($product_category_query->rows as $result) {
			if ($result['logged'] && !$this->customer->getId()) {
				$status = false;
			}

			$product_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "offer_product_category` WHERE offer_product_category_id = '" . (int)$result['offer_product_category_id'] . "'");

			if ($product_query->num_rows) {
				$product_category_data[] = array(
					'one'	=> $product_query->row['product_one'],
					'two'	=> $product_query->row['category_two'],
					'type'	=> $product_query->row['type'],
					'disc'	=> $product_query->row['discount']
				);

			} else {
				$status = false;
			}
		}

		if ($status) {
			return $product_category_data;
		}
	}

	// Category Product
	public function getOfferCategoryProduct($offer_category_product_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM `" . DB_PREFIX . "offer_category_product` WHERE offer_category_product_id = '" . (int)$offer_category_product_id . "' AND ((date_start = '0000-00-00' OR date_start < NOW()) AND (date_end = '0000-00-00' OR date_end > NOW())) AND status = '1'");

		if ($query->num_rows) {
			return array(
				'offer_category_product_id'	=> $query->row['offer_category_product_id'],
				'name'             		=> $query->row['name'],
				'discount'             	=> $query->row['discount'],
				'type'             		=> $query->row['type'],
				'logged'      			=> $query->row['logged'],
				'category_one'			=> $query->row['category_one'],
				'product_two'  		=> $query->row['product_two'],
				'date_start'				=> $query->row['date_start'],
				'date_end'  			=> $query->row['date_end'],
				'status'           		=> $query->row['status']
			);

		} else {
			return false;
		}
	}

	public function getOfferCategoryProducts($data = array()) {
		$status = true;

		$category_product_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "offer_category_product` WHERE ((date_start = '0000-00-00' OR date_start < NOW()) AND (date_end = '0000-00-00' OR date_end > NOW())) AND status = '1'");

		$category_product_data = array();

		foreach ($category_product_query->rows as $result) {
			if ($result['logged'] && !$this->customer->getId()) {
				$status = false;
			}

			$category_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "offer_category_product` WHERE offer_category_product_id = '" . (int)$result['offer_category_product_id'] . "'");

			if ($category_query->num_rows) {
				$category_product_data[] = array(
					'one'	=> $category_query->row['category_one'],
					'two'	=> $category_query->row['product_two'],
					'type'	=> $category_query->row['type'],
					'disc'	=> $category_query->row['discount']
				);

			} else {
				$status = false;
			}
		}

		if ($status) {
			return $category_product_data;
		}
	}

	// Category Category
	public function getOfferCategoryCategory($offer_category_category_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM `" . DB_PREFIX . "offer_category_category` WHERE offer_category_category_id = '" . (int)$offer_category_category_id . "' AND ((date_start = '0000-00-00' OR date_start < NOW()) AND (date_end = '0000-00-00' OR date_end > NOW())) AND status = '1'");

		if ($query->num_rows) {
			return array(
				'offer_category_category_id'	=> $query->row['offer_category_category_id'],
				'name'             		=> $query->row['name'],
				'discount'             	=> $query->row['discount'],
				'type'             		=> $query->row['type'],
				'logged'      			=> $query->row['logged'],
				'category_one'			=> $query->row['category_one'],
				'category_two'  		=> $query->row['category_two'],
				'date_start'				=> $query->row['date_start'],
				'date_end'  			=> $query->row['date_end'],
				'status'           		=> $query->row['status']
			);

		} else {
			return false;
		}
	}

	public function getOfferCategoryCategories($data = array()) {
		$status = true;

		$category_category_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "offer_category_category` WHERE ((date_start = '0000-00-00' OR date_start < NOW()) AND (date_end = '0000-00-00' OR date_end > NOW())) AND status = '1'");

		$category_category_data = array();

		foreach ($category_category_query->rows as $result) {
			if ($result['logged'] && !$this->customer->getId()) {
				$status = false;
			}

			$category_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "offer_category_category` WHERE offer_category_category_id = '" . (int)$result['offer_category_category_id'] . "'");

			if ($category_query->num_rows) {
				$category_category_data[] = array(
					'one'	=> $category_query->row['category_one'],
					'two'	=> $category_query->row['category_two'],
					'type'	=> $category_query->row['type'],
					'disc'	=> $category_query->row['discount']
				);

			} else {
				$status = false;
			}
		}

		if ($status) {
			return $category_category_data;
		}
	}

	// Category List
	public function getCategoryList($product_id) {
        $category_list = array();

        $query = $this->db->query("SELECT category_id FROM " . DB_PREFIX . "product_to_category WHERE product_id = '" . (int)$product_id . "'");

        if ($query->num_rows) {
            foreach ($query->rows as $result) {
                $category_list[] = $result['category_id'];
            }
        }

        return $category_list;
    }
}
?>