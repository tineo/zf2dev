<?php

namespace Backend\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity @ORM\Table(name="item")
 */
class Item {
	/**
	 * @ORM\Id @ORM\GeneratedValue @ORM\Column(type="integer")
	 */
	protected $id;

	/**
	 * @ORM\Column(type="integer")
	 */
	protected $id_gallery;

	/**
	 * @ORM\Column(type="string")
	 */
	private $descripcion;

	/**
	 * @ORM\Column(type="string")
	 */
	protected $path;

	/**
	 * @ORM\Column(type="string")
	 */
	protected $path_thumb;

	/**
	 * @ORM\Column(type="string")
	 */
	protected $comment;

	/**
	 * @ORM\Column(type="integer")
	 */
	protected $visible;

	/**
	 * @ORM\Column(type="integer")
	 */
	protected $deleted;

	public function getId() {
		return $this->id;
	}

	public function setId($id) {
		$this->id = $id;
	}

	public function getId_gallery() {
		return $this->id_gallery;
	}

	public function setId_gallery($id_gallery) {
		$this->id_gallery = $id_gallery;
	}

	public function getDescripcion() {
		return $this->descripcion;
	}

	public function setDescripcion($descripcion) {
		$this->descripcion = $descripcion;
	}

	public function getPath() {
		return $this->path;
	}

	public function setPath($path) {
		$this->path = $path;
	}

	public function getPath_thumb() {
		return $this->path_thumb;
	}

	public function setPath_thumb($path_thumb) {
		$this->path_thumb = $path_thumb;
	}

	public function getComment() {
		return $this->comment;
	}

	public function setComment($comment) {
		$this->comment = $comment;
	}

	public function getVisible() {
		return $this->visible;
	}

	public function setVisible($visible) {
		$this->visible = $visible;
	}

	public function getDeleted() {
		return $this->deleted;
	}

	public function setDeleted($deleted) {
		$this->deleted = $deleted;
	}

}
