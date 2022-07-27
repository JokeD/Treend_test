<?php


namespace App\Infrastructure\Persistence\Doctrine\Repositories;


use App\Domain\Contract\ShippingRepositoryInterface;
use App\Domain\Shipping;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

class ShippingRepository extends ServiceEntityRepository implements ShippingRepositoryInterface
{
    private EntityManagerInterface $em;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Shipping::class);
        $this->em = $this->getEntityManager();
    }

    public function add(Shipping $shipping): Shipping
    {
        $this->em->persist($shipping);
        $this->em->flush();
        return $shipping;
    }

    public function all(): array
    {
        return $this->findAll();
    }

    public function findById(int $id): object|null
    {
        return $this->find($id);
    }
}