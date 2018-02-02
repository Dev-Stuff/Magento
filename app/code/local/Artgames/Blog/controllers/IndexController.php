<?php

class Artgames_Blog_IndexController extends Mage_Core_Controller_Front_Action {

	public $image_full_path;

	public function listAction() 
	{
		$this->loadLayout();
		$this->renderLayout();
	}

	public function createAction() 
	{
		$post = $this->getRequest()->getParams();
		$newPost = Mage::getModel('blog/blog');

		$newPost->title = $post['title'];
		$newPost->post = $post['post'];
		$newPost->username = $post['author'];
		$newPost->created_at = date("Y/m/d/h:i:sa");
		$newPost->category = $post['category'];
		$newPost->slugs = serialize($post['slugs']);
		$this->uploadAction();
		$newPost->image = $this->image_full_path;
		$newPost->save();

		$this->_redirectReferer();
	}

	public function postAction ()
	{
		$this->loadLayout();
		$this->renderLayout();
	}

	public function categoriesAction ()
	{
		$this->loadLayout();
		$this->renderLayout();
	}

	public function uploadAction()
	{
        if( !empty($_FILES['image']['name']) ){
            try {
	            	$uploaded_image = $_FILES['image']['name'];
					$extension = substr($uploaded_image, strpos($uploaded_image, ".") + 1);    
					$full_name = uniqid() . '.'. $extension;
	                $uploader = new Varien_File_Uploader('image');
	                $uploader->setAllowedExtensions(array('jpg', 'jpeg', 'gif', 'png'));
	                $uploader->setAllowRenameFiles(true);
	                $uploader->setFilesDispersion(false);
	                $path = Mage::getBaseDir('media') . DS; // where we save images
	                $result = $uploader->save($path, $full_name);
                $this->extension = $extension;
            	} catch (Exception $e) {
	                echo $e->getMessage();
		        }
	    }

	    $this->image_full_path = $result['file'];
	    return $result;
	}

}