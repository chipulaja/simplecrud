<?php

namespace SimpleCrud\Entity;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity @Table(name="artikel")
 **/
class Artikel
{
    /** @Id @Column(type="integer") @GeneratedValue **/
    protected $id;

    /** @Column(type="string") **/
    protected $judul;

    /** @Column(type="text") **/
    protected $konten;

    /** @Column(type="string") **/
    protected $penulis;

    /** @Column(type="datetime") **/
    protected $tanggal;

    /**
     * 1 artikel punya banyak komentar.
     * @OneToMany(targetEntity="Komentar", mappedBy="artikel", cascade={"remove"}, orphanRemoval=true)
     */
    protected $komentar;

    public function __construct() {
        $this->komentar = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function setJudul($judul)
    {
        $this->judul = $judul;
    }

    public function getJudul()
    {
        return $this->judul;
    }

    public function setKonten($konten)
    {
        $this->konten = $konten;
    }

    public function getKonten()
    {
        return $this->konten;
    }

    public function setPenulis($penulis)
    {
        $this->penulis = $penulis;
    }

    public function getPenulis()
    {
        return $this->penulis;
    }

    public function setTanggal(\DateTime $tanggal)
    {
        $this->tanggal = $tanggal;
    }

    public function getTanggal()
    {
        return $this->tanggal;
    }

    public function addKomentar(Komentar $komentar)
    {
        $komentar->setArtikel($this);
        $this->komentar->add($komentar);
    }

    public function getKomentar()
    {
        return $this->komentar;
    }

    public function getHash()
    {
        return md5($this->judul);
    }
}
