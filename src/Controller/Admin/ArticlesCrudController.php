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
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
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

            ImageField::new('picture')
                ->setLabel('Image')
                ->setUploadDir('public/asset/img') // Remplacez 'asset/img' par le répertoire de téléchargement souhaité
                ->setBasePath('public/asset/img') // Ajoutez cette ligne si vous souhaitez afficher les images après le téléchargement
                ->onlyOnForms(),

                CollectionField::new('picture')
                ->setLabel('Images')
                ->setEntryType(PicturesFormType::class) // Utiliser le type de formulaire dédié pour Pictures
                ->setFormTypeOption('by_reference', true) // Assurez-vous que la relation est bien gérée par référence
                ->onlyOnForms(),

            AssociationField::new('category'),
            BooleanField::new('active'),
            DateTimeField::new('createdAt'),
            //DateTimeField::new('updateAt')->hideOnForm(),
        ];
    }

    public function prePersist(EntityManagerInterface $em, $entityInstance): void
    {
        if ($entityInstance instanceof Articles) {
            $pictures = $entityInstance->getPicture();

            /** @var Pictures $picture */
            foreach ($pictures as $picture) {
                $uploadedFile = $picture->getArticles();

                if ($uploadedFile instanceof UploadedFile) {
                    // Gérer la logique de téléchargement du fichier ici
                    $fileName = md5(uniqid()) . '.' . $uploadedFile->guessExtension();
                    $uploadedFile->move($this->getParameter('images_directory'), $fileName);

                    // Enregistrez le nom du fichier dans l'entité Pictures
                    $picture->setTitle($fileName);

                    // Associez l'article à la nouvelle instance de Picture
                    $picture->setArticles($entityInstance);

                    $em->persist($picture);
                }
            }
        }

        //$em->persist($picture);
        $entityInstance->setCreatedAt(new \DateTime());

        $em->persist($entityInstance);
    }

    
}
