<?php

namespace OC\PlatformBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdvertType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
      //  $builder->add('date')->add('title')->add('author')->add('content')->add('published')->add('updatedAt')->add('nbApplications')->add('slug')->add('image')->add('categories');
        // Arbitrairement, on récupère toutes les catégories qui commencent par "D"
        $pattern = 'D%';

        $builder
            // ...
            ->add('categories', EntityType::class, array(
                'class'         => 'OCPlatformBundle:Category',
                'choice_label'  => 'name',
                'multiple'      => true,
                'query_builder' => function(CategoryRepository $repository) use($pattern) {
                    return $repository->getLikeQueryBuilder($pattern);
                }
            ))
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'OC\PlatformBundle\Entity\Advert'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'oc_platformbundle_advert';
    }


}
