<?php

class Artgames_Blog_Block_Adminhtml_Blog_Grid extends Mage_Adminhtml_Block_Widget_Grid {
 
    public function __construct() {
        parent::__construct();
        $this->setId('news_grid');
        $this->setDefaultSort('id');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
    }
 
    protected function _prepareCollection() {
        $collection = Mage::getModel('blog/blog')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }
 
    protected function _prepareColumns() {
        $this->addColumn('id', array(
            'header' => Mage::helper('blog')->__('ID'),
            'align' => 'center',
            'width' => '50px',
            'height' => '20px',
            'index' => 'id',
        ));
 
        $this->addColumn('title', array(
            'header' => Mage::helper('blog')->__('Title'),
            'align' => 'center',
            'index' => 'title',
            'width' => '50px',
            'frame_callback' => array($this, 'callback_title'),
        ));
 
 
        $this->addColumn('post', array(
            'header' => Mage::helper('blog')->__('Post'),
            'width' => '200px',
            'index' => 'post',
            'frame_callback' => array($this, 'callback_post'),
        ));
 
        $this->addColumn('image', array(
            'header' => Mage::helper('blog')->__('Image'),
            'width' => '80px',
            'index' => 'image',
            'frame_callback' => array($this, 'callback_image'),
        ));
 
         $this->addColumn('author', array(
            'header' => Mage::helper('blog')->__('Author'),
            'width' => '70px',
            'index' => 'username',
            'frame_callback' => array($this, 'callback_author'),
        ));
 
 
        $this->addColumn('category', array(
            'header' => Mage::helper('blog')->__('Category'),
            'width' => '150px',
            'index' => 'category',
        ));

        $this->addColumn('slugs', array(
            'header' => Mage::helper('blog')->__('Slugs'),
            'width' => '100px',
            'index' => 'slugs',
            // 'frame_callback' => array($this, 'callback_slugs'),
        ));


        $this->addColumn('created_at', array(
            'header' => Mage::helper('blog')->__('Posted On'),
            'width' => '150px',
            'index' => 'created_at',
        ));
 
        return parent::_prepareColumns();
    }
 
 
    public function getRowUrl($row) {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }

    public function callback_image($value)
	{
	    $width = 70;
	    $height = 70;
	    return "<img src='".Mage::getBaseUrl('media') .$value."' width=".$width." height=".$height." style='margin-left:25px;display:block;'/>";
	}

    public function callback_post($value)
	{
		if (strlen($value) > 170) {
			return substr($value,0,170) . '...';
		}
		return $value;
	}

	public function callback_title($value)
	{
		return '<b><span style="color:red;display:block; margin-top:30px;margin-left:18px;">' . $value . '</span></b>';
	}

	public function callback_author($value)
	{
		return '<span style="color:green;display:block; margin-top:30px;margin-left:18px;">' . ucfirst($value) . '</span>';
	}

}