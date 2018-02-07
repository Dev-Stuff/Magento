<?php


class Artgames_Blog_Adminhtml_BlogController extends Mage_Adminhtml_Controller_action {
 
    public function indexAction() {
        $this->loadLayout();
        $this->renderLayout();
    }
 
    public function newAction(){
        $this->loadLayout();
        $this->_addContent($this->getLayout()->createBlock('blog/adminhtml_blog_edit'))
                ->_addLeft($this->getLayout()->createBlock('blog/adminhtml_blog_edit_tabs'));
        $this->renderLayout();
    }
 
    public function deleteAction() {
        if ($this->getRequest()->getParam('id') > 0) {
            try {
                $model = Mage::getModel('blog/blog');
 
                $model->setId($this->getRequest()->getParam('id'))
                        ->delete();
 
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Item was successfully deleted'));
                $this->_redirect('*/*/');
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
            }
        }
        $this->_redirect('*/*/');
    }
 
    public function saveAction() {
 
        if ($data = $this->getRequest()->getPost())
        {
            $model = Mage::getModel('blog/blog');
            $id = $this->getRequest()->getParam('id');
            foreach ($data as $key => $value)
            {
                if (is_array($value))
                {
                        $data[$key] = implode(',',$this->getRequest()->getParam($key));
                }
            }
 
            if ($id) {
                $model->load($id);
            }
            $model->setData($data);
 
            Mage::getSingleton('adminhtml/session')->setFormData($data);
            try {
                if ($id) {
                    $model->setId($id);
                }
 
                $model->save();
 
                if (!$model->getId()) {
                    Mage::throwException(Mage::helper('news')->__('Error saving news details'));
                }
 
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('news')->__('Details was successfully saved.'));
 
                Mage::getSingleton('adminhtml/session')->setFormData(false);
 
                // The following line decides if it is a "save" or "save and continue"
                if ($this->getRequest()->getParam('back')) {
                    $this->_redirect('*/*/edit', array('id' => $model->getId()));
                } else {
                    $this->_redirect('*/*/');
                }
 
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                if ($model && $model->getId()) {
                    $this->_redirect('*/*/edit', array('id' => $model->getId()));
                } else {
                    $this->_redirect('*/*/');
                }
            }
 
          return;
        }
        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('news')->__('No data found to save'));
        $this->_redirect('*/*/');
    }
 
 
    public function editAction() {
 
        $id = $this->getRequest()->getParam('id', null);
 
        $model = Mage::getModel('blog/blog');
        if ($id) {
            $model->load((int) $id);
            if ($model->getId()) {
                $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
                if ($data) {
                    $model->setData($data)->setId($id);
                }
            } else {
                Mage::getSingleton('adminhtml/session')->addError(Mage::helper('blog')->__('blog does not exist'));
                $this->_redirect('*/*/');
            }
        }
        Mage::register('blog_data', $model);
 
        $this->_title($this->__('blog'))->_title($this->__('Edit blog'));
        $this->loadLayout();
        $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);
 
        $this->_addContent($this->getLayout()->createBlock('blog/adminhtml_blog_edit'))
                ->_addLeft($this->getLayout()->createBlock('blog/adminhtml_blog_edit_tabs'));
        $this->renderLayout();
    }    
}