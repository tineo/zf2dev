<?php



namespace Backend\Controller;


use Zend\View\Model\JsonModel;
use Zend\View\View;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Doctrine\ORM\EntityManager;
use Backend\Entity\Gallery;
use Backend\Entity\Section;
use Backend\Entity\Item;



class SectionController extends AbstractActionController {
	
	public function indexAction() {
		$result = new JsonModel ( array () );
		
		return $result;
	}
	
	public function createAction() {
		$result = new JsonModel ( array ("create") );
	
		return $result;
	}
	public function updateAction() {
		$result = new JsonModel ( array ("update") );
	
		return $result;
	}
	
	
}
