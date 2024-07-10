<?php

namespace App\Controller\Admin;

use App\Entity\Articles;
use App\Entity\Pictures;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use App\Form\PicturesFormType;
use Symfony\Component\HttpFoundation\File\UploadedFile;
class ArticlesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Articles::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            AssociationField::new('user'),
            TextField::new('title'),
            TextEditorField::new('contenu'),
            TextField::new('lieu'),

            CollectionField::new('picture', 'Images')
            ->setEntryType(PicturesFormType::class)
            ->setFormTypeOption('by_reference', false)
            ->onlyOnForms(),

            AssociationField::new('category'),
            BooleanField::new('active'),
            DateTimeField::new('createdAt'),
            DateTimeField::new('updateAt')->hideOnForm(),
        ];
    }

    public function prePersist(EntityManagerInterface $em, $entityInstance): void
    {
        if ($entityInstance instanceof Articles) {
            $pictures = $entityInstance->getPicture();

            foreach ($pictures as $picture) {
                $uploadedFile = $picture->getField(); 

                if ($uploadedFile instanceof UploadedFile) {
                    $fileName = md5(uniqid()) . '.' . $uploadedFile->guessExtension();
                    $uploadedFile->move($this->getParameter('kernel.project_dir').'public/asset/img', $fileName);

                    // $picture->setCovers($fileName);
                    // $picture->setBefores($fileName);
                    // $picture->setAfters($fileName);
                    $picture->setArticles($entityInstance);

                    $em->persist($picture);
                }
            }
        }

        $entityInstance->setCreatedAt(new \DateTime());
        $em->persist($entityInstance);
        $em->flush(); // N'oubliez pas de flush pour persister les modifications
    }

    
}
