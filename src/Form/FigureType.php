<?php

namespace App\Form;

use App\Entity\Figure;
use App\Entity\Groupe;
use App\Form\VideoType;
use App\Repository\GroupeRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\All;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class FigureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('description')
            ->add('groupe', EntityType::class, [
                'class' => Groupe::class,
                'choice_label' => 'nom',
                'multiple' => false
            ])
            ->add('illustrations', FileType::class, [
                "label" => "Illustrations (optionnel)",
                "multiple" => true,
                "mapped" => false,
                "required" => false,
                "constraints" => [
                    new All([
                        new File([
                            "maxSize" => "10M",
                            "mimeTypes" => [
                                "image/png",
                                "image/jpg",
                                "image/jpeg",
                                "image/gif"
                            ],
                            "mimeTypesMessage" => "Veuillez envoyer une image au format png, jpg, jpeg ou gif, de 10 mégas octets maximum"
                        ])
                    ])
                ]
            ])
            ->add('videos', CollectionType::class, [
                "label" => "Videos (optionnel)",
                "entry_type" => VideoType::class,
                "allow_add" => true
            ])
            ->add('prerequis', EntityType::class, [
                'label' => "prérequis (ne sélectionnez que les prérequis direct, ne sélectionnez pas des prérequis qui sont eux même déjà prérequis d'autres prérequis que vous sélectionnez. Exemple : pour un saut perilleux vrillé, sélectionnez le saut périlleux, et la vrille, mais pas le simple saut.)",
                'class' => Figure::class,
                'choice_label' => 'nom',
                'multiple' => true,
                'expanded' => true
            ])
            ->add('Valider', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Figure::class,
        ]);
    }
}
