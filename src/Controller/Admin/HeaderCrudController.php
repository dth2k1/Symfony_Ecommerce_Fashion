<?php

namespace App\Controller\Admin;

use App\Entity\Header;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class HeaderCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Header::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('title', 'Carousel title'),
            TextareaField::new('content', 'carousel content'),
            TextField::new('btnTitle', 'Title button'),
            TextField::new('btnUrl', 'Destination URL button'),
            ImageField::new('illustration')
                ->setBasePath('uploads/')
                ->setUploadDir('public/uploads/')
                ->setUploadedFileNamePattern('[randomhash].[extension]')    // The way to hash the name
                ->setRequired(false),
        ];
    }
}
