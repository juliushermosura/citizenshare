<?php
/**
*	CakePHP Component to parse XML file
*/
class WpRssComponent extends Component {

	var $feed_url = "http://blog.citizenshare.net/?feed=rss2";
	var $rss_item = array();
	
	public function feeds(){
		App::uses('Xml', 'Utility');
		// xml to array conversion
		$this->rss_item = Xml::toArray(Xml::build($this->feed_url));
		return $this->rss_item['rss']['channel']['item'];
	}
}
?>
