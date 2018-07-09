<?php

namespace SimpleCrud\Entity;

/**
 * @Entity @Table(name="komentar")
 **/

class Komentar
{
    /** @Id @Column(type="integer") @GeneratedValue **/
    protected $id;

    /** @Column(type="text") **/
    protected $konten;

    /** @Column(type="string") **/
    protected $penulis;

    /** @Column(type="datetime") **/
    protected $tanggal;

    /**
     * @ManyToOne(targetEntity="Artikel", inversedBy="komentar")
     */
    protected $artikel;

    public function getId()
    {
        return $this->id;
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

    public function setAddress(\DateTime $tanggal)
    {
        $this->tanggal = $tanggal;
    }

    public function getTanggal()
    {
        return $this->tanggal;
    }

    public function setTanggal(\DateTime $tanggal)
    {
        $this->tanggal = $tanggal;
    }

    public function getArtikel()
    {
        return $this->artikel;
    }

    public function setArtikel(Artikel $artikel)
    {
        $this->artikel = $artikel;
    }
}
