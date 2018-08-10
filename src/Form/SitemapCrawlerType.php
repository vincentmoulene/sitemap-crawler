<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class SitemapCrawlerType extends AbstractType
{
    CONST URL = "https://www.google.com/sitemap.xml";
    // Eg :"//div[@id='sitemap'] or //div[@class='contentpaneopen']";
    CONST TAG = "//div[@id='sitemap']";
    CONST TAGNAME = "a";
    CONST ATTRIBUTE = "href";
    CONST NAME = "my_awesome_export";
    CONST SUBMIT = "Create an .xlsx file";

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'url',
                TextType::class,
                 array(
                     'attr' => array(
                         'placeholder' => SELF::URL,
                     ),
                     'label' => 'Url',
                 )
            )
            ->add(
                'tag',
                TextType::class,
                array(
                    'attr' => array(
                        'placeholder' => SELF::TAG,
                    ),
                    'label' => 'Tag',
                )
            )
            ->add(
                'tagName',
                TextType::class,
                array(
                    'attr' => array(
                        'placeholder' => SELF::TAGNAME,
                    ),
                    'label' => 'Tag name',
                )
            )
            ->add(
                'attribute',
                TextType::class,
                array(
                    'attr' => array(
                        'placeholder' => SELF::ATTRIBUTE,
                    ),
                    'label' => 'Attribute',
                )
            )
            ->add(
                'name',
                TextType::class,
                array(
                    'attr' => array(
                        'placeholder' => SELF::NAME,
                    ),
                    'label' => 'name',
                )
            )
            ->add(
                'submit',
                SubmitType::class,
                array(
                    'attr' => array(
                        'value' => 'Create an .xlsx file'
                    ),
                    'label' => SELF::SUBMIT
                )
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
