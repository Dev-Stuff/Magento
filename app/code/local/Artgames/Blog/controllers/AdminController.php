<?php


class Artgames_Blog_AdminController extends Mage_Adminhtml_Controller_Action
{  
    public function indexAction()
    {
        $this->loadLayout();
         
        $block = $this->getLayout()->createBlock('core/text', 'green-block')->setText('<h1>See all posts</h1>');
        $this->_addContent($block);
         
        $this->_setActiveMenu('blog')->renderLayout();      
    }   


    public function infoAction()
    {
        $this->loadLayout();
         
        $block = $this->getLayout()->createBlock('core/text', 'green-block')->setText('<h1>About this blog etc etc </h1>');
        $this->_addContent($block);
         
        $this->_setActiveMenu('blog')->renderLayout();      
    }  

}