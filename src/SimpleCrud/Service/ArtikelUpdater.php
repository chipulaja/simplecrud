<?php

namespace SimpleCrud\Service;

use SimpleCrud\Entity\Artikel;

class ArtikelUpdater
{
	protected $em;

	public function __construct($em)
	{
		$this->em = $em;
	}

	public function dispatch($data)
	{
		$id = $data["id"];
		$artikel    = $this->getArtikelById($id);
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

	public function getArtikelById($id)
	{
		$data = $this->em->createQueryBuilder()
		->select("artikel")
        ->from("SimpleCrud\Entity\Artikel", "artikel")
        ->where("artikel.id = :id")
        ->setParameter("id", $id)
        ->getQuery()
        ->getOneOrNullResult();

        return $data;
	}

	protected function populateModel(Artikel $artikel, $data)
	{
		if (isset($data["judul"])) {
			$artikel->setJudul($data["judul"]);
		}
		
		if (isset($data["konten"])) {
			$artikel->setKonten($data["konten"]);
		}

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