<?php
namespace Backend\Form;

use Zend\Form\Form;

class SectionForm extends Form {
	public function __construct($name = null) {
		
		parent::__construct('Section');

		$this->add(array(
				'name' => 'description',
				'attributes' => array(
						'type'  => 'text',
				),
				'options' => array(
						'label' => 'Descripcion',
				),
		));
		
		
		$this->add(array(
				'name' => 'submit',
				'attributes' => array(
						'type'  => 'submit',
						'value' => 'Agregar'
				),
		));
		
	}

}

?>