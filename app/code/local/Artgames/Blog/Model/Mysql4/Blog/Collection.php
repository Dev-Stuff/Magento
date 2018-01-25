<?php

/**
* 
*/
class Artgames_Blog_Model_Mysql4_Blog_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
	public function _construct () 
	{
		$this->init('blog/blog');
	}
}