<?php

namespace SimpleCrud\Service;

use SimpleCrud\Entity\Artikel;

class ArtikelCreator
{
	protected $em;

	public function __construct($em)
	{
		$this->em = $em;
	}

	public function dispatch($data)
	{
		$artikel    = new Artikel();
		$model      = $this->populateModel($artikel, $data);
		$validation = $this->validateModel($model);

		if (empty($validation)) {
			$this->em->persist($model);
        	$this->em->flush();
        	return "data berhasil disimpan";
		} else {
			return $validation;
		}
	}

	protected function populateModel($artikel, $data)
	{
		if (isset($data["judul"])) {
			$artikel->setJudul($data["judul"]);
		}
		
		if (isset($data["konten"])) {
			$artikel->setKonten($data["konten"]);
		}

		$artikel->setPenulis("admin");
		$artikel->setTanggal(new \DateTime());

		return $artikel;
	}

	protected function validateModel($model)
	{
		$judul = $model->getJudul();
		if (empty($judul)) {
			return "judul tidak boleh kosong";
		}

		$konten = $model->getKonten();
		if (empty($konten)) {
			return "konten tidak boleh kosong";
		}
	}
}