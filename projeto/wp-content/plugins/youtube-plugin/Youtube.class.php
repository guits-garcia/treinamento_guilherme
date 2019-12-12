<?php

	/*
	 * Plugin Name: Youtube - Plugin
	 * Description: Carregar os vídeos do Youtube
	 * Version: 0.1
	 * Author: Astrusweb - Gustavo
	 * Author URI: http://astrusweb.com/
	 */

	date_default_timezone_set('America/Sao_Paulo');

	class Youtube
	{
		private $channel_id;
		private $api_key;
		private $limit = 5;
		private $load_by_time = 5;
		private $api_url = 'https://www.googleapis.com/youtube/v3/';
		private $publish_format = 'Y-m-d\TH:i:s\Z';

		private $CACHE_PATH = '/portal/external_content/';
		private $CACHE_FILE = 'youtube_cache.json';


		
		public function __construct($channel_id = '', $api_key = '') {
			if($channel_id){
				$this->channel_id = $channel_id;
			}
			if($api_key){
				$this->api_key = $api_key;
			}
		}


		public function set_channel_id($cid) {
			if($cid){
				$this->channel_id = $cid;
			}
			return $this;
		}


		public function set_api_key($key) {
			if($key){
				$this->api_key = $key;
			}
			return $this;
		}


		public function set_limit($l) {
			if($l){
				$this->limit = $l;
			}
			return $this;
		}


		public function get_limit() {
			return $this->limit;
		}


		public function load_by_time($l) {
			if($l){
				$this->load_by_time = $l;
			}
			return $this;
		}


		public function set_cache_filepath($path) {
			if($path)
				$this->CACHE_PATH = $path;
			return $this;
		}


		public function set_cache_filename($filename) {
			if($filename)
				$this->CACHE_FILE = $filename;
			return $this;
		}


		public function get_cache_file() {
			return $_SERVER['DOCUMENT_ROOT'] . $this->CACHE_PATH . $this->CACHE_FILE;
		}


		private function curl($url, $method='GET') {
	    	try{
	    		$ch = curl_init();
	    		curl_setopt($ch, CURLOPT_URL, $url);
	    		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	    		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	    		$result = curl_exec($ch);

	    		curl_close($ch);

	    		return json_decode($result);
	    	} catch (Exception $e){
	    		echo $e->getMessage();
	    	}
	    }


		public function get_videos($page_token = '') {
			if($page_token != ''){
				$url = $this->api_url . "search?key={$this->api_key}&channelId={$this->channel_id}&part=snippet,id&order=date&maxResults={$this->load_by_time}&pageToken={$page_token}";

				$results = $this->curl($url);

				$return_feed = new stdClass();

				if(isset($results->nextPageToken))
					$return_feed->next_page_token = $results->nextPageToken;
				if(isset($results->prevPageToken))
					$return_feed->prev_page_token = $results->prevPageToken;
				if(isset($results->pageInfo->totalResults))
					$return_feed->total_results = $results->pageInfo->totalResults;

				$return_feed->videos = array();

				foreach ($results->items as $key => $value) {
					$return_feed->videos[$key] = new stdClass();
					$return_feed->videos[$key]->id = $value->id->videoId;
					$return_feed->videos[$key]->published_at = $value->snippet->publishedAt;
					$return_feed->videos[$key]->title = $value->snippet->title;
					$return_feed->videos[$key]->description = $value->snippet->description;
					$return_feed->videos[$key]->images = new stdClass();
					$return_feed->videos[$key]->images->default = $value->snippet->thumbnails->default->url;
					$return_feed->videos[$key]->images->medium = $value->snippet->thumbnails->medium->url;
					$return_feed->videos[$key]->images->high = $value->snippet->thumbnails->high->url;
					$return_feed->videos[$key]->live = $value->snippet->liveBroadcastContent;
				}

				return $return_feed;
			} else {
				if(file_exists(self::get_cache_file()) && filemtime(self::get_cache_file()) > time()) {
					$data = file_get_contents(self::get_cache_file());
		    		$feed = json_decode($data);

			    	return $feed;
				} else {
					$url = $this->api_url . "search?key={$this->api_key}&channelId={$this->channel_id}&part=snippet,id&order=date&maxResults={$this->limit}";

					$results = $this->curl($url);

					$return_feed = new stdClass();

					if(isset($results->nextPageToken)) 
						$return_feed->next_page_token = $results->nextPageToken;
					if(isset($results->prevPageToken)) 
						$return_feed->prev_page_token = $results->prevPageToken;
					if(isset($results->pageInfo->totalResults)) 
						$return_feed->total_results = $results->pageInfo->totalResults;

					$return_feed->videos = array();
					foreach ($results->items as $key => $value) {
						$return_feed->videos[$key] = new stdClass();
						$return_feed->videos[$key]->id = $value->id->videoId;
						$return_feed->videos[$key]->published_at = $value->snippet->publishedAt;
						$return_feed->videos[$key]->title = $value->snippet->title;
						$return_feed->videos[$key]->description = $value->snippet->description;
						$return_feed->videos[$key]->images = new stdClass();
						$return_feed->videos[$key]->images->default = $value->snippet->thumbnails->default->url;
						$return_feed->videos[$key]->images->medium = $value->snippet->thumbnails->medium->url;
						$return_feed->videos[$key]->images->high = $value->snippet->thumbnails->high->url;
						$return_feed->videos[$key]->live = $value->snippet->liveBroadcastContent;
					}

					$data = json_encode((array)$return_feed);
		    		file_put_contents(self::get_cache_file(), $data);

					return $return_feed;
				}
			}
		}


		public function get_video_by_id($id = NULL) {
			if(!is_null($id)) {
				$url = $this->api_url . "videos?key={$this->api_key}&id={$id}&part=snippet,id";
				$results = $this->curl($url);

				$return_feed = new stdClass();

				$results = $results->items[0];

				$return_feed->id = $results->id;
				$return_feed->published_at = $results->snippet->publishedAt;
				$return_feed->title = $results->snippet->title;
				$return_feed->description = $results->snippet->description;
				$return_feed->images = array(
					'default' => $results->snippet->thumbnails->default->url,
					'medium' => $results->snippet->thumbnails->medium->url,
					'high' => $results->snippet->thumbnails->high->url
				);
				$return_feed->live = $results->snippet->liveBroadcastContent;

				return $return_feed;
			} else {
				return false;
			}
		}


		public function find_by_query_text($text = NULL, $page_token = '') {
			if(!is_null($text)) {
				if($page_token != ''){
					$url = $this->api_url . "search?key={$this->api_key}&channelId={$this->channel_id}&part=snippet,id&q={$text}&order=date&maxResults={$this->load_by_time}&pageToken={$page_token}";
				} else {
					$url = $this->api_url . "search?key={$this->api_key}&type=video&order=date&channelId={$this->channel_id}&part=snippet,id&q={$text}&maxResults={$this->limit}";
				}
				
				$results = $this->curl($url);

				$return_feed = array();

				if(isset($results->nextPageToken)) $return_feed['next_page_token'] = $results->nextPageToken;
				if(isset($results->prevPageToken)) $return_feed['prev_page_token'] = $results->prevPageToken;
				if(isset($results->pageInfo->totalResults)) $return_feed['total_results'] = $results->pageInfo->totalResults;
				$return_feed['videos'] = array();
				foreach ($results->items as $key => $value) {
					$return_feed['videos'][$key] = new stdClass();
					$return_feed['videos'][$key]->id = $value->id->videoId;
					$return_feed['videos'][$key]->published_at = $value->snippet->publishedAt;
					$return_feed['videos'][$key]->title = $value->snippet->title;
					$return_feed['videos'][$key]->description = $value->snippet->description;
					$return_feed['videos'][$key]->images = array(
						'default' => $value->snippet->thumbnails->default->url,
						'medium' => $value->snippet->thumbnails->medium->url,
						'high' => $value->snippet->thumbnails->high->url
					);
					$return_feed['videos'][$key]->live = $value->snippet->liveBroadcastContent;
				}

				return $return_feed;
			} else {
				return false;
			}
		}


		private function sort_items($key, &$object, $sort_order=SORT_ASC, $sort_flags=SORT_REGULAR, $api_object=false) {
			$sortFields = array();
			if($api_object) {
				foreach ($object as $k => $row) {
			        $sortFields[$k] = $row->snippet->{$key};
				}
			} else {
				foreach ($object as $k => $row) {
			        $sortFields[$k] = $row->{$key};
				}
			}
		    array_multisort($sortFields, $sort_order, $sort_flags, $object);
		}


		private function get_url_for_utc_period($utc){
			$date = new DateTime();

			$date->setTimestamp($utc);
			$publishedAfter = $date->format($this->publish_format);

			$utc = strtotime('+30 days', $utc);

			$date->setTimestamp($utc);
			$publishedBefore = $date->format($this->publish_format);

		    $url = $this->api_url . "search?key={$this->api_key}&channelId={$this->channel_id}&part=snippet,id&type=video&order=date&maxResults={$this->load_by_time}&publishedAfter=" . urlencode($publishedAfter) . "&publishedBefore=" . urlencode($publishedBefore);

		    return $url;
		}


		public function get_all_videos() {
			if(file_exists(self::get_cache_file()) && filemtime(self::get_cache_file()) > time() - 60*30) {
	    		$data = file_get_contents(self::get_cache_file());
	    		$feed = json_decode($data);

		    	return $feed;
	    	} else {
	    		$return_feed = array(
					'videos' => array()
				);
				$_it = 0;

	    		$start_date = "1 May 2017";
				$utc = strtotime($start_date);

				while($utc <= time()) {
			    	$url = $this->get_url_for_utc_period($utc);

				    $request = $this->curl($url);

				    $this->sort_items('publishedAt', $request->items, SORT_ASC, SORT_REGULAR, true);

				    foreach ($request->items as $key => $value) {
						$return_feed['videos'][$_it] = new stdClass();
						$return_feed['videos'][$_it]->id = $value->id->videoId;
						$return_feed['videos'][$_it]->url = "https://www.youtube.com/watch?v={$value->id->videoId}";
						$published_date = new DateTime($value->snippet->publishedAt);
						$return_feed['videos'][$_it]->published_at = $published_date->setTimezone(new DateTimeZone('America/Sao_Paulo'))->format("Y-m-d H:i:s");
						$return_feed['videos'][$_it]->title = $value->snippet->title;
						$return_feed['videos'][$_it]->images = array(
							'default' => "https://i.ytimg.com/vi/{$value->id->videoId}/default.jpg",
							'medium' => "https://i.ytimg.com/vi/{$value->id->videoId}/mqdefault.jpg",
							'high' => "https://i.ytimg.com/vi/{$value->id->videoId}/hqdefault.jpg"
						);
						$_it++;
					}

					$utc = strtotime('+30 days', $utc);
				}

				$this->sort_items('published_at', $return_feed['videos'], SORT_DESC);

				$data = json_encode((array)$return_feed);
		    	file_put_contents(self::get_cache_file(), $data);

		    	return $return_feed;
	    	}

			return NULL;
		}
	}

?>