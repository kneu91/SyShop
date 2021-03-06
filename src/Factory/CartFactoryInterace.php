<?php
/**
 * Created by PhpStorm.
 * User: sznojman
 * Date: 13.07.19
 * Time: 15:27
 */

namespace App\Factory;


use App\Entity\Cart\CartInterface;
use App\Entity\Cart\CartItemInterface;
use App\Entity\Product\ProductInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

interface CartFactoryInterace {
	/**
	 * @return CartInterface
	 */
	public function getCurrent(): CartInterface;

	/**
	 * Sprawdzenie czy koszyk jest pusty.
	 *
	 * @return bool
	 */
	public function isEmpty(): bool ;

	/**
	 * Sprawdzenie czy koszyk zawiera dany produkt.
	 *
	 * @param ProductInterface $product
	 * @return bool
	 */
	public function containsProduct(ProductInterface $product): bool ;

	/**
	 * Return key number of orderItem has product
	 *
	 * @param ProductInterface $product
	 * @return int|null
	 */
	public function indexOfProduct(ProductInterface $product): ?int;

	/**
	 * Usunięcie wszystkich elementów z koszyka.
	 */
	public function clear(): void;

	/**
	 * Dodanie produktu do koszyka.
	 * Jeśli produkt istnieje zwiększana jest jego ilość.
	 *
	 * @param ProductInterface $product
	 * @param integer $quantity
	 * @return void
	 */
	public function addItem(ProductInterface $product, int $quantity): void ;

	/**
	 * Aktualizacja liczby produktów dla istniejącego produktu.
	 *
	 * @param CartItemInterface $item
	 * @param integer $quantity
	 * @throws Exception
	 */
	public function setItemQuantity(CartItemInterface $item, int $quantity): void ;

	/**
	 * Set payment method
	 *
	 * @param PaymentInterface $payment
	 */
	public function setPayment( $payment): void ;

	/**
	 * Set shipment
	 *
	 * @param ShipmentInterface $shipment
	 */
	public function setShipment( $shipment): void ;

	/**
	 * Set discount code
	 *
	 * @param DiscountInterface $discount
	 */
//	public function setDiscount(DiscountInterface $discount): void ;

	/**
	 * Usunięcie pozycji produktu z koszyka.
	 *
	 * @param CartItemInterface $item
	 * @throws Exception
	 */
	public function removeItem(CartItemInterface $item): void ;

//	/**
//	 * Pobranie informacji potrzebnych do podsumowania koszyka.
//	 *
//	 * @return Summary
//	 */
//	public function summary(): Summary ;

	/**
	 * Pobranie wszystkich produktów wraz z informacjami potrzebnymi na listingu koszyka.
	 *
	 * @return Collection
	 */
	public function items(): Collection ;


	public function getCartItemsCount(): int;
}