<?php

namespace Backend\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity @ORM\Table(name="gallery")
 */
class Gallery {
	/**
	 * @ORM\Id @ORM\GeneratedValue @ORM\Column(type="integer")
	 */
	protected $id;

	/**
	 * @ORM\Column(type="integer")
	 */
	protected $id_section;

	/**
	 * @ORM\Column(type="string")
	 */
	protected $descripcion;

	/**
	 * @ORM\Column(type="string")
	 */
	protected $path;

	/**
	 * @ORM\Column(type="string")
	 */
	protected $slug;

	/**
	 * @ORM\Column(type="string")
	 */
	protected $url;

	/**
	 * @ORM\Column(type="string")
	 */
	protected $comment;

	/**
	 * @ORM\Column(type="string")
	 */
	protected $visible;

	/**
	 * @ORM\Column(type="string")
	 */
	protected $deleted;

	public function getId() {
		return $this->id;
	}

	public function setId($id) {
		$this->id = $id;
	}

	public function getId_section() {
		return $this->id_section;
	}

	public function setId_section($id_section) {
		$this->id_section = $id_section;
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

	public function getUrl() {
		return $this->url;
	}

	public function setUrl($url) {
		$this->url = $url;
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

	public function getSlug() {
		return $this->slug;
	}

	public function setSlug($slug) {
		$this->slug = $slug;
	}

}
