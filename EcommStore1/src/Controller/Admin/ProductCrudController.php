<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ProductCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Product::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name'),
            TextField::new('description'),
            AssociationField::new('categories')->autocomplete(),
            MoneyField::new('price')->setCurrency('USD'),
            BooleanField::new('isBestSeller'),
            BooleanField::new('isFeatured'),
            BooleanField::new('isNewArrival'),
            BooleanField::new('isSpecialOffer'),
            ImageField::new('featuredImage')->setBasePath('assets/uploads/products/')
                                                        ->setUploadDir('public/assets/uploads/products/')
                                                        ->setUploadedFileNamePattern('[randomhash].[extension]')
                                                        ->setRequired(false)
        ];
    }

}
