<?php

namespace App\Controller;

use App\Entity\Property;
use App\Repository\PropertyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PropertyController extends AbstractController
{

    /**
     * @var PropertyRepository
     */
    private $repository;

    public function __construct(PropertyRepository $repository, EntityManagerInterface $em)
    {

        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @Route("/biens", name="property.index")
     * @return Response
     */

    /*    public function index(): Response
        {*/
    /*        $property = new Property();
            $property->setTitle('Premier Bien')
                ->setPrice(225000)
                ->setRooms(6)
                ->setBedrooms(4)
                ->setDescription('Une belle maison')
                ->setSurface(120)
                ->setFloor(2)
                ->setHeat(1)
                ->setCity('Roubaix')
                ->setAddress('333 Avenue Alfred Motte')
                ->setPostalCode('59100');
            $em = $this->getDoctrine()->getManager();
            $em->persist($property);
            $em->flush();*/
    /*        return $this->render('property/index.html.twig', ['current_page' => 'properties']);
        }*/

    public function index(): Response
    {
        //$property = $this->repository->findAllVisible();
        //$property[0]->setSold(true);
        // $this->em->flush();
        //dump($this->repository);
        return $this->render('property/index.html.twig', ['current_page' => 'properties']);
    }

    /**
     * @Route("/biens/{slug}-{id}", name="property.show", requirements={"slug": "[a-z0-9\-]*"})
     * @param Property $property
     * @return Response
     */

    public function show(Property $property, string $slug): Response
    {
        if ($property->getSlug() !== $slug){
            return $this->redirectToRoute('property.show', [
                'id' =>$property->getId(),
                'slug'=>$property->getSlug()
            ], 301);
        }
        return $this->render('property/show.html.twig', [
            'property' => $property,
            'current_page' => 'properties'
        ]);
    }
}
