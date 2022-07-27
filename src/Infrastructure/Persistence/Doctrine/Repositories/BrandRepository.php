<?php


namespace App\Infrastructure\Persistence\Doctrine\Repositories;


use App\Domain\Brand;

use App\Domain\Contract\BrandRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

class BrandRepository extends ServiceEntityRepository implements BrandRepositoryInterface
{
    private EntityManagerInterface $em;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Brand::class);
        $this->em = $this->getEntityManager();
    }

    public function add(Brand $brand): Brand
    {
        $this->em->persist($brand);
        $this->em->flush();
        return $brand;
    }

    public function all(): array
    {
        return $this->createQueryBuilder('brand', 'brand.id')
            ->select('brand')
            ->getQuery()
            ->getArrayResult();
    }

    public function findByName(string $name): array
    {
        return $this->findBy(['name' => $name]);
    }

    public function findById(int $id) : object|null
    {
        return $this->find($id);
    }
}