<?php

namespace SimpleCrud\Service;

use SimpleCrud\Entity\Komentar;
use SimpleCrud\Entity\Artikel;

class KomentarCreator
{
	protected $em;

	public function __construct($em)
	{
		$this->em = $em;
	}

	public function dispatch($data)
	{
		$komentar      = new Komentar();
		$komentarModel = $this->populateModel($komentar, $data);
		$artikelModel  = isset($data["id"]) ? $this->getArtikelById($data["id"]) : null;
		$validation    = $this->validateModel($komentarModel, $artikelModel);

		if (empty($validation)) {
			$artikelModel->addKomentar($komentarModel);
			$this->em->persist($komentarModel);
			$this->em->persist($artikelModel);
        	$this->em->flush();
        	return "data berhasil disimpan";
		} else {
			return $validation;
		}
	}

	protected function getArtikelById($id)
	{
		$artikel = $this->em->createQueryBuilder()
		->select("artikel")
        ->from("SimpleCrud\Entity\Artikel", "artikel")
        ->where("artikel.id = :id")
        ->setParameter("id", $id)
        ->getQuery()
        ->getOneOrNullResult();

        return $artikel;
	}

	protected function populateModel(Komentar $komentar, $data)
	{	
		if (isset($data["konten"])) {
			$komentar->setKonten($data["konten"]);
		}

		$komentar->setPenulis("komentator");
		$komentar->setTanggal(new \DateTime());

		return $komentar;
	}

	protected function validateModel(Komentar $komentar, Artikel $artikel)
	{
		if (empty($artikel)) {
			return "maaf artikel tidak di temukan";
		}

		$konten = $komentar->getKonten();
		if (empty($konten)) {
			return "konten komentar tidak boleh kosong";
		}
	}
}