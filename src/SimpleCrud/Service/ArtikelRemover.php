<?php

namespace SimpleCrud\Service;

use SimpleCrud\Entity\Artikel;

class ArtikelRemover
{
	
	protected $em;

	public function __construct($em)
	{
		$this->em = $em;
	}

	public function dispatch(Artikel $artikelModel, $data)
	{
		$validation = $this->validateData($artikelModel, $data);

		if (empty($validation)) {
			$this->em->remove($artikelModel);
			$this->em->flush();
        	return "data berhasil dihapus";
		} else {
			return $validation;
		}
	}

	protected function validateData(Artikel $model, $data)
	{
		$hashModel = $model->getHash();
		$hashData  = isset($data["hash"]) ? $data["hash"] : "";

		if ($hashData !== $hashModel && !empty($hashModel)) {
			return "hash konfirmasi hapus tidak valid";
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
}