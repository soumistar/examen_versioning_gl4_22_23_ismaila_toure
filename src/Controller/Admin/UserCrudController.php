<?php

namespace App\Controller\Admin;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('email'),
            TextField::new('password')->setFormType(PasswordType::class)->onlyWhenCreating(),
            TextField::new('firstname'),
            TextField::new('lastname'),
            ImageField::new('avatar')
                ->setBasePath('upload/images/users')
                ->setUploadDir('public/upload/images/users')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setSortable(false),
            BooleanField::new('active'),
            CollectionField::new('roles')->hideOnForm(),
            DateTimeField::new('created_at'),
            DateTimeField::new('login_at')->hideOnForm()
        ];
    }

    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        if(!$entityInstance instanceof User) return;
        if(!$entityInstance->getCreatedAt()) $entityInstance->setCreatedAt(new \DateTimeImmutable);
        parent::persistEntity($entityManager, $entityInstance);
    }
}
