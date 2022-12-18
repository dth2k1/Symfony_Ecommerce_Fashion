<?php

namespace App\Controller\Admin;

use App\Entity\Order;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class OrderCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Order::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add('index', 'detail');                                  // Add the 'voir' tab
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud->setDefaultSort(['id' => 'DESC']);
    }

    public function configureFields(string $pageName): iterable         // allows to modify the entries for the orders in the admin
    {
        return [
            IdField::new('id'),
            DateTimeField::new('createdAt', 'Date create'),
            TextField::new('user.fullName', 'User'),
            MoneyField::new('total')->setCurrency('EUR'),
            TextField::new('carrierName', 'Transport'),
            MoneyField::new('carrierPrice', 'Shipping fees')->setCurrency('EUR'),
            BooleanField::new('isPaid', 'is_Paid'),
            ArrayField::new('orderDetails', 'Products purchased')->hideOnIndex()
        ];
    }
}
