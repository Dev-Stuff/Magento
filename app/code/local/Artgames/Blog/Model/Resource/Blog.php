<?php 

class Artgames_Blog_Model_Resource_Blog extends Mage_Core_Model_Resource_Db_Abstract{
    protected function _construct()
    {
        $this->_init('blog/blog', 'id');
    }
}