<?php

class Artgames_Blog_IndexController extends Mage_Core_Controller_Front_Action {

	public function mataAction () {

		// $this->loadLayout();
  //   	$this->renderLayout();

		$block_1 = new Mage_Core_Block_Text(); $block_1 ->setText('abasdksdskjda');
		$block_2 = new Mage_Core_Block_Text(); $block_2 ->setText('adczczc');
		$main_block = new Artgames_Blog_Block_Blog(); $main_block ->setTemplate('helloworld.phtml');
		// $main_block ->setChild(’the_first’,$block_1); $main_block ->setChild(’the_second’,$block_2);
		echo $main_block ->toHtml();

	}

	public function listAction() {
		
		$this->loadLayout();
		$this->renderLayout();
	}

}