<?php
namespace Backend\Form;

use Zend\Form\Form;

class GalleryForm extends Form{

	public function __construct($name = null) {
		parent::__construct('Gallery');
		
		$this->add(array(
				'name' => 'id_section',
				'attributes' => array(
						'type'  => 'hidden',
				),
		));
		
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
				'name' => 'slug',
				'attributes' => array(
						'type'  => 'text',
				),
				'options' => array(
						'label' => 'Identificador',
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
				'name' => 'submit',
				'attributes' => array(
						'type'  => 'submit',
						'value' => 'Agregar'
				),
		));
		
		
		
	}
}	

?>