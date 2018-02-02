<?php

class Artgames_Blog_Block_Post extends Artgames_Blog_Block_Blog
{


	public function _construct()
	{
		parent::_construct();
		$this->setTemplate('artgames/blog/post.phtml');
	}

}