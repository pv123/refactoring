<?php

namespace Refactoring\Products;

use Brick\Math\BigDecimal;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use Refactoring\Products\ProductFormatter;
use Refactoring\Products\ProductManager;

class Product {

    /**
     * @var UuidInterface
     */
    private $serialNumber;

    /**
     * @var BigDecimal
     */
    private $price;

    /**
     * @var string
     */
    private $desc;

    /**
     * @var string
     */
    private $longDesc;

    /**
     * @var int
     */
    private $counter;

    /*
     * 
     */
    private $productFormatter;

    /*
     * 
     */
    private $productManager;

    /**
     * Product constructor.
     * @param BigDecimal|null $price
     * @param string|null $desc
     * @param string|null $longDesc
     * @param int|null $counter
     */
    public function __construct(?BigDecimal $price, ?string $desc, ?string $longDesc, ?int $counter) {
        $this->serialNumber = Uuid::uuid4();
        $this->price = $price;
        $this->desc = $desc;
        $this->longDesc = $longDesc;
        $this->counter = $counter;

        $this->productFormatter = new ProductFormatter();
        $this->productFormatter = new ProductManager();
    }

    /**
     * @return UuidInterface
     */
    public function getSerialNumber(): UuidInterface {
        return $this->serialNumber;
    }

    /**
     * @return BigDecimal
     */
    public function getPrice(): BigDecimal {
        return $this->price;
    }

    /**
     * @return string
     */
    public function getDesc(): string {
        return $this->desc;
    }

    /**
     * @return string
     */
    public function getLongDesc(): string {
        return $this->longDesc;
    }

    /**
     * @return int
     */
    public function getCounter(): int {
        return $this->counter;
    }

    /**
     * @throws \Exception
     */
    public function decrementCounter(): void {
        try {
            $this->counter = $this->productManager->decrementCounter($this);
        } catch (Exception $exc) {
            throw $exc;
        }
    }

    /**
     * @throws \Exception
     */
    public function incrementCounter(): void {
        try {
            $this->counter = $this->productManager->incrementCounter($this);
        } catch (Exception $exc) {
            throw $exc;
        }
    }

    /**
     * @param BigDecimal|null $newPrice
     * @throws \Exception
     */
    public function changePriceTo(?BigDecimal $newPrice): void {
        try {
            $this->price = $this->productManager->changePriceTo($newPrice, $this);
        } catch (Exception $exc) {
            throw $exc;
        }
    }

    /**
     * @param string|null $charToReplace
     * @param string|null $replaceWith
     * @throws \Exception
     */
    public function replaceCharFromDesc(?string $charToReplace, ?string $replaceWith): void {
        try {
            $descArray = $this->productFormatter->replaceCharFromDesc($charToReplace, $replaceWith, $this);
            $this->longDesc = str_replace($charToReplace, $replaceWith, $descArray['longDesc']);
            $this->desc = str_replace($charToReplace, $replaceWith, $descArray['desc']);
        } catch (Exception $exc) {
            throw $exc;
        }
    }

    /**
     * @return string
     */
    public function formatDesc(): string {
        try {
            return $this->productFormatter->formatDesc($this);
        } catch (Exception $exc) {
            throw $exc;
        }
    }

}
