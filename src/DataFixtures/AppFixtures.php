<?php

namespace App\DataFixtures;

use App\Entity\Cart\Carrier;
use App\Entity\Cart\CartStatus;
use App\Entity\Cart\Payment;
use App\Entity\Customer\Customer;
use App\Entity\Employe\Employe;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Product\Product;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{

	private $passwordEncoder;

	public function __construct(UserPasswordEncoderInterface $passwordEncoder){
		$this->passwordEncoder = $passwordEncoder;
	}


    public function load(ObjectManager $manager)
    {

		for($i=0;$i < 15;$i++){
			$product = new Product();
			$product->setEan('ean'.$i);
			$product->setName('nazwa produktu '.$i);
			$product->setQuantity($i*4);
			$product->setPrice($i*2.33+1);
			$manager->persist($product);
		}

	    $payment = new Payment();
	    $payment->setName('Odbiór osobisty');
	    $manager->persist($payment);
	    $payment2 = new Payment();
	    $payment2->setName('Przelew bankowy');
	    $manager->persist($payment2);

	    for($i=0;$i < 2;$i++){
		    $carrier = new Carrier();
		    $carrier->setName('opcja wysyłki nr'.$i);
		    $carrier->setCost(3.33*$i);


		    $manager->persist($carrier);
	    }

	    $stat1 = new CartStatus();
	    $stat1->setName('Oczekuje na płatność');
	    $manager->persist($stat1);

	    $stat2 = new CartStatus();
	    $stat2->setName('W trakcie realizacji');
	    $manager->persist($stat2);

	    $stat3 = new CartStatus();
	    $stat3->setName('Zrealizowane');
	    $manager->persist($stat3);

	    $stat4 = new CartStatus();
	    $stat4->setName('Anulowane');
	    $manager->persist($stat4);

	    $stat5 = new CartStatus();
	    $stat5->setName('Zwrócone');
	    $manager->persist($stat5);

	    $stat6 = new CartStatus();
	    $stat6->setName('Nieudane');
	    $manager->persist($stat6);

	    $stat7 = new CartStatus();
	    $stat7->setName('Wstrzymane');
	    $manager->persist($stat7);

	    $empoye = new Employe();
	    $empoye->setEmail('sznojman@gmail.com');
	    $empoye->setRoles(['ROLE_ADMIN']);
	    $empoye->setPassword($this->passwordEncoder->encodePassword($empoye,'pass'));
	    $manager->persist($empoye);

	    $customer = new Customer();
	    $customer->setEmail('mail@test.test');
	    $customer->setRoles(['ROLE_USER']);
	    $customer->setPassword($this->passwordEncoder->encodePassword($customer,'pass'));
	    $manager->persist($customer);


        $manager->flush();
    }
}
