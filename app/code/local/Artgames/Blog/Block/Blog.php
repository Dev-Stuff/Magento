<?php
class Artgames_Blog_Block_Blog extends Mage_Core_Block_Template
{

	public $posts;

	public function _construct()
	{
		parent::_construct();
		$this->setTemplate('artgames/blog/list.phtml');
	}

	// verifies if user is logged in. If not logged in, form is greyed out
	public function hasBlogWriteAccess () 
	{
		return Mage::getSingleton('customer/session')->isLoggedIn();
	}

	// get header image
	public function getHeaderImage()
	{
		$image = Mage::getBaseUrl('media') . 'blog/' . 'blog1.png';
		return "<img src=$image alt='blog' style='margin:auto;max-height:160px;'>";
	}

	//get avatar
	public function getUserImage()
	{
		$image = Mage::getBaseUrl('media') . 'blog/' . 'user.svg';
		return "<img src=$image alt='blog' style='margin:auto;max-height:180px;'>";
	}

	//get all posts
	public function getPosts() 
	{
		$posts = Mage::getModel('blog/blog')->getCollection();
		$posts->getSelect()->order('created_at DESC')->limit(5);
		return $posts;
	}

	public function viewPost() 
	{
		$params = $this->getRequest()->getParams();
        $blogpost = Mage::getModel('blog/blog');
        $blogpost->load($params['id']);
       	return (object)	$blogpost->getData();
	}

	public function getCategories() 
	{
		$resource = Mage::getSingleton('core/resource');
		$readConnection = $resource->getConnection('core_read');
		$query = 'SELECT * FROM ' . $resource->getTableName('categories');
		$results = $readConnection->fetchAll($query);
		return $results;
	}

	public function getSlugs() 
	{
		$resource = Mage::getSingleton('core/resource');
		$readConnection = $resource->getConnection('core_read');
		$query = 'SELECT * FROM ' . $resource->getTableName('slugs');
		$results = $readConnection->fetchAll($query);
		return $results;
	}

	public function getSelectedTitle()
	{
		$params = $this->getRequest()->getParams();
		return $params['selected'];
	}

	public function getSelectedCategories() 
	{
		$params = $this->getRequest()->getParams();
		$posts = Mage::getModel('blog/blog')->getCollection();
		$posts->addFieldToFilter('category', array('eq' => $params['selected']));
		return $posts;

	}

}
