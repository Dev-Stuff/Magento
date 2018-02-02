<?php

class Artgames_Blog_Block_Category extends Artgames_Blog_Block_Blog
{


	public function _construct()
	{
		parent::_construct();
		$this->setTemplate('artgames/blog/category.phtml');
	}

}