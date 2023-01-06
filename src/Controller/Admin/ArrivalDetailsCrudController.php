<?php

namespace App\Controller\Admin;

use App\Entity\ArrivalDetails;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;

class ArrivalDetailsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ArrivalDetails::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            AssociationField::new('arrival'),
            AssociationField::new('product'),
            IntegerField::new('quantity')
        ];
    }
}
