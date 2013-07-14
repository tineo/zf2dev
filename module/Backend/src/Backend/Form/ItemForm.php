<?php
namespace Backend\Form;

use Zend\Form\Form;

class ItemForm  extends Form {

	public function __construct($name = null) {

		parent::__construct('Item');
		$this->setAttribute('method', 'post');
		$this->setAttribute('enctype', 'multipart/form-data');
		
		
		
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
				'name' => 'comentario',
				'attributes' => array(
						'type'  => 'text',
				),
				'options' => array(
						'label' => 'Comentario',
				),
		));
		
		
		$this->add(array(
				'name' => 'fileupload',
				'attributes' => array(
						'type'  => 'file',
				),
				'options' => array(
						'label' => 'Imagen',
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