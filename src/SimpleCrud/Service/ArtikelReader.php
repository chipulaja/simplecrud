<?php

namespace SimpleCrud\Service;

use SimpleCrud\Entity\Employee;

class ArtikelReader
{
	protected $em;

	public function __construct($em)
	{
		$this->em = $em;
	}

	public function getData()
	{
		$data = $this->em->createQueryBuilder()
		->select("artikel")
        ->from("SimpleCrud\Entity\Artikel", "artikel")
        ->getQuery()
        ->getResult();

        return $data;
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