<?php
namespace App\Database\Models;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="products")
 **/
class Product
{
    /**
     * @ORM\id @ORM\Column(name="id", type="integer") @ORM\GeneratedValue
     */
    protected $id;

    /**
     * @ORM\Column(name="title", type="string")
     */
    protected $title;

    /**
     * @ORM\Column(name="description", type="string")
     */
    protected $description;

    /**
     * @ORM\Column(name="price", type="integer")
     */
    protected $price;

    /**
     * @return mixed
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
    * @return string
    */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return integer
     */
    public function getPrice(): int
    {
        return $this->price;
    }

    /**
     * @param string $title
     * @return Product
     */
    public function setTitle($title): self
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @param string $description
     * @return Product
     */
    public function setDescription($description): self
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @param integer $price
     * @return Product
     */
    public function setPrice($price): self
    {
        $this->price = $price;
        return $this;
    }
}