<?php

namespace App\Form\Cart;
use App\Entity\Product\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;



class AddItemType extends AbstractType
{
	private $urlGenerator;

	public function __construct(UrlGeneratorInterface $urlGenerator)
	{
		$this->urlGenerator = $urlGenerator;
	}

	/**
	 * {@inheritdoc}
	 */
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder->setAction($this->urlGenerator->generate('cart.addItem', ['id' => $builder->getData()->getId()]));

		$builder->add(
			'id',
			HiddenType::class
		);

		$builder->add(
			'submit',
			SubmitType::class,
			[
				'label' => 'Dodaj do koszyka',
				'attr' => [
					'icon' => 'fa fa-cart-plus'
				]
			]
		);
	}

	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults(array(
			'data_class' => Product::class,
		));
	}
	public function getName(){
		return 'cart_addItem';
	}
}