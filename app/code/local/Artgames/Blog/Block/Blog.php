<?php
class Artgames_Blog_Block_Blog extends Mage_Core_Block_Template
{

	public function _construct() 
	{
		parent::_construct();
		$this->setTemplate('artgames/blog/list.phtml');
	}

    public function getContent()
    {
        return "Hello World";
    }
}