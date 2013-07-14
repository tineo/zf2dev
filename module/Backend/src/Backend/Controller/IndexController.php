<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace Backend\Controller;

use Zend\View\View;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Doctrine\ORM\EntityManager;
use Backend\Entity\Gallery;
use Backend\Entity\Section;
use Backend\Entity\Item;

use Backend\Form\SectionForm;
use Backend\Form\GalleryForm;
use Backend\Form\ItemForm;

use Zend\Validator\File\Size;

class IndexController extends AbstractActionController {
	protected $em;
	public function setEntityManager(EntityManager $em) {
		$this->em = $em;
	}
	public function getEntityManager() {
		if (null === $this->em) {
			$this->em = $this->getServiceLocator()
					->get('Doctrine\ORM\EntityManager');
		}
		return $this->em;
	}
	public function zerofill($num, $zerofill = 2) {
		return str_pad($num, $zerofill, '0', STR_PAD_LEFT);
	}
	

	public function createThumbs( $pathToImages, $pathToThumbs, $thumbWidth )
	{
  // open the directory
  $dir = opendir( $pathToImages );

  // loop through it, looking for any/all JPG files:
  while (false !== ($fname = readdir( $dir ))) {
    // parse path for the extension
    $info = pathinfo($pathToImages . $fname);
    // continue only if this is a JPEG image
    if ( @strtolower($info['extension']) == 'jpg' )
    {
      echo "Creating thumbnail for {$fname}\n";

      // load image and get image size
      $img = @imagecreatefromjpeg( "{$pathToImages}/{$fname}" );
      $width = @imagesx( $img );
      $height = @imagesy( $img );

      // calculate thumbnail size
      $new_width = 75;
      $new_height = 75;

      // create a new temporary image
      $tmp_img = @imagecreatetruecolor( $new_width, $new_height );

      // copy and resize old image into new image
      @imagecopyresized( $tmp_img, $img, 0, 0, 0, 0, 100, 100, $width, $height );

      // save thumbnail into a file
      @imagejpeg( $tmp_img, "{$pathToThumbs}/{$fname}" );
     
    }
  }
  // close the directory
  closedir( $dir );
}	
	
	public function indexAction() {
		$viewModel = new ViewModel();
		$secciones = $this->getEntityManager()
				->getRepository('Backend\Entity\Section')->findAll();

		foreach ($secciones as $s) {

			$galerias = $this->getEntityManager()
					->getRepository('Backend\Entity\Gallery')
					->findBy(array('id_section' => $s->getId()));
			unset($galeria);
			foreach ($galerias as $g) {
				$items = $this->getEntityManager()
						->getRepository('Backend\Entity\Item')
						->findBy(array('id_gallery' => $g->getId(), 'visible' => 1 ) );
				unset($item);
				foreach ($items as $it) {
					$item[] = array("path_thumb" => $it->getPath_thumb());
				}

				$galeria[] = array("descripcion" => $g->getDescripcion(),
						"id" => $g->getId(), "items" => $item);
			}

			$sections[] = array("descripcion" => $s->getDescripcion(),
					"id" => $s->getId(), "galerias" => $galeria);
		}

		$vars["dump"] = $galerias;

		$vars["sections"] = $sections;

		$vars["data"] = getcwd() . "/public/_gallery";
		$viewModel->setVariables($vars);
		// $viewModel->setTemplate("backend/index/index");
		return $viewModel;
	}
	public function installAction() {

		$viewModel = new ViewModel();

		$viewModel->setTemplate("backend/index/index");
		return $viewModel;
	}

	public function addAction() {
		//echo getcwd()."/public/_gallery";

		//echo $this->getEvent()->getRouteMatch()->getParam('type');

		if ($this->getEvent()->getRouteMatch()->getParam('type') == "gallery") {
			$form = new GalleryForm();
			$form->add(array('name' => 'id_section',
					'attributes' => array('type' => 'hidden',
							'value' => $this->getEvent()->getRouteMatch()->getParam('id')),));

			

		} elseif ($this->getEvent()->getRouteMatch()->getParam('type')	== "item") {
			$form = new ItemForm();
			$form->add(array('name' => 'id_gallery',
					'attributes' => array('type' => 'hidden',
							'value' => $this->getEvent()
							->getRouteMatch()
							->getParam('id')),));

			//echo $this->getEvent()->getRouteMatch()->getParam('id');
		} else {
			$form = new SectionForm();
		}

		//return array('form' => $form);

		$viewModel = new ViewModel();

		$viewModel->setVariables(array('form' => $form));

		$request = $this->getRequest();
		if ($request->isPost()) {
			//echo $form->getName();
			
			
			
			if ($form->getName() == "Item") {
				/******/
				$nonFile = $request->getPost()->toArray();
				$File = $this->params()->fromFiles('fileupload');

				$data = array_merge($nonFile,
						//POST
						array('fileupload' => $File['name']) //FILE...
				);

				//set data post and file ...
				$form->setData($data);
				$size = new Size(array('max' => 2000000));
				$adapter = new \Zend\File\Transfer\Adapter\Http();
				//validator can be more than one...
				$adapter->setValidators(array($size), $File['name']);

				if (!$adapter->isValid()) {
					$dataError = $adapter->getMessages();
					$error = array();
					foreach ($dataError as $key => $row) {
						$error[] = $row;
					} //set formElementErrors
					$form->setMessages(array('fileupload' => $error));
				} else {
					
					$g = $this->getEntityManager()
					->getRepository('Backend\Entity\Gallery')
					->findOneBy(array('id'=> $this->getEvent()->getRouteMatch()->getParam('id') ));
					
					echo getcwd() . $g->getPath()." * ". getcwd() . $g->getPath()."/thumbs"."<br/>";
					
									
					$adapter->setDestination(getcwd() . $g->getPath());
					@chmod(getcwd() . $g->getPath() .$File['name'], 0777);
					
					
					
					
					/*if (!copy(getcwd() . $g->getPath()."/".$File['name'], getcwd() . $g->getPath()."/thumbs"."/".$File['name'])) {
						echo "Error al copiar ".getcwd() . $g->getPath()."/".$File['name']."...\n";
					}*/
					
					
					$path = substr($g->getPath(), 7 ) . "/".$File['name'];
					$path_thumb =  substr($g->getPath(), 7 ) . "/thumbs/".$File['name'];
					
					$i =  new Item();
					$i->setDescripcion($request->getPost("description"));
					$i->setComment($request->getPost("comentario"));
					$i->setId_gallery($this->getEvent()->getRouteMatch()->getParam('id'));
					
					$i->setPath($path);
					$i->setPath_thumb($path_thumb);
					
					$i->setDeleted(0);
					$i->setVisible(1);
					
					
					$this->getEntityManager()->persist($i);
					$this->getEntityManager()->flush();
					
					
					echo "<pre>";
					//echo $this->getEvent()->getRouteMatch()->getParam('type');
					//echo $this->getEvent()->getRouteMatch()->getParam('id');
					echo $File['name'];
					var_dump($request->getPost("description"));
					var_dump($request->getPost("comentario"));
					echo "</pre>";
					
					
					
					if ($adapter->receive($File['name'])) {
						//	$profile->exchangeArray($form->getData());
						//	echo 'Profile Name '.$profile->profilename.' upload '.$profile->fileupload;
					}
					
					$this->createThumbs(getcwd() . $g->getPath(), getcwd() . $g->getPath()."/thumbs",100);

				}
				/******/
			} elseif ($form->getName() == "Gallery"){
				
				//echo $File['name'];
				
				
				$gal = $this->getEntityManager()
				->getRepository('Backend\Entity\Gallery')
				->findOneBy(array('slug' => $request->getPost("slug"), 
								  'id_section' => $this->getEvent()->getRouteMatch()->getParam('id') ));
				
				//var_dump($gal);
				
				if(!empty($gal)){
					echo "<pre>";
					print ("Identificador repetido");
					echo "</pre>";
					
				}else{
				
				$s = $this->getEntityManager()
				->getRepository('Backend\Entity\Section')
				->findOneBy(array('id' => $this->getEvent()->getRouteMatch()->getParam('id')));
				//echo $s->getUrl();
								
				$new_url = $s->getUrl()."/".$request->getPost("slug");
				$new_path = $s->getPath()."/".$request->getPost("slug");

				
				
				//echo getcwd()."$new_path";
				
				
				$g = new Gallery();
				$g->setDescripcion($request->getPost("description"));
				$g->setComment($request->getPost("comentario"));
				$g->setSlug($request->getPost("slug"));	
				$g->setId_section($this->getEvent()->getRouteMatch()->getParam('id'));
				
				$g->setPath($new_path);
				$g->setUrl($new_url);
				
				$g->setDeleted(0);
				$g->setVisible(1);
				
				$this->getEntityManager()->persist($g);
				$this->getEntityManager()->flush();
				
				mkdir( getcwd()."$new_path", 0777,true);
				mkdir( getcwd()."$new_path"."/thumbs", 0777,true);
				
				echo "<pre>";
				print ('Se creo nueva galeria "'.$request->getPost("description").'" en la seccion "'. $s->getDescripcion().'"');
				echo "</pre>";
				
				/*echo "<pre>";
				var_dump ($this->getEvent()->getRouteMatch()->getParam('type'));
				var_dump ($this->getEvent()->getRouteMatch()->getParam('id'));
				//
				var_dump($request->getPost("description"));
				var_dump($request->getPost("slug"));
				var_dump($request->getPost("comentario"));
				echo "</pre>";
				*/
				}
				
			}
			
			//good
			return $this->redirect()->toRoute('backend');

		}

		//$viewModel->setTemplate ( "backend/index/index" );

		return $viewModel;
	}

}
