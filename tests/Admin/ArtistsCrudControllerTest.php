<?php

namespace App\Tests\Controller\Admin;

use App\Entity\Artists;
use PHPUnit\Framework\TestCase;
use App\Controller\Admin\ArtistsCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class ArtistsCrudControllerTest extends TestCase
{
    // Test pour vérifier que la méthode getEntityFqcn retourne bien la classe Artists
    public function testGetEntityFqcn()
    {
        $controller = new ArtistsCrudController();
        $this->assertEquals(Artists::class, $controller->getEntityFqcn());
    }

    // Test pour vérifier que les champs sont correctement configurés pour la page d'index
    public function testConfigureFieldsForIndexPage()
    {
        $controller = new ArtistsCrudController();
        $fields = iterator_to_array($controller->configureFields(Crud::PAGE_INDEX));

        // Vérifie que le nombre de champs est correct
        $this->assertCount(7, $fields);
        // Vérifie que chaque champ est du type attendu
        $this->assertInstanceOf(TextField::class, $fields[0]);
        $this->assertInstanceOf(SlugField::class, $fields[1]);
        $this->assertInstanceOf(AssociationField::class, $fields[2]);
        $this->assertInstanceOf(TextEditorField::class, $fields[3]);
        $this->assertInstanceOf(ImageField::class, $fields[4]);
        $this->assertInstanceOf(TextareaField::class, $fields[5]);
        $this->assertInstanceOf(DateField::class, $fields[6]);
    }

    // Test pour vérifier que les champs sont correctement configurés pour les autres pages CRUD
    public function testConfigureFieldsForOtherPages()
    {
        $controller = new ArtistsCrudController();
        $fields = iterator_to_array($controller->configureFields(Crud::PAGE_NEW));

        // Vérifie que le nombre de champs est correct
        $this->assertCount(8, $fields);
        // Vérifie que chaque champ est du type attendu
        $this->assertInstanceOf(TextField::class, $fields[0]);
        $this->assertInstanceOf(SlugField::class, $fields[1]);
        $this->assertInstanceOf(AssociationField::class, $fields[2]);
        $this->assertInstanceOf(TextEditorField::class, $fields[3]);
        $this->assertInstanceOf(ImageField::class, $fields[4]);
        $this->assertInstanceOf(TextareaField::class, $fields[5]);
        $this->assertInstanceOf(TextareaField::class, $fields[6]);
        $this->assertInstanceOf(DateField::class, $fields[7]);
    }
}
