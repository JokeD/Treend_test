<?php


namespace App\Infrastructure\Persistence\Doctrine\Repositories;


use App\Domain\Contract\ProductRepositoryInterface;
use App\Domain\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

class ProductRepository extends ServiceEntityRepository implements ProductRepositoryInterface
{
    private EntityManagerInterface $em;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
        $this->em = $this->getEntityManager();
    }

    public function add(Product $product): Product
    {
        $this->em->persist($product);
        $this->em->flush();
        return $product;
    }

    public function all(): array
    {
        return $this->createQueryBuilder('product', 'product.id')
            ->select('product')
            ->getQuery()
            ->getArrayResult();
    }

    public function findByName(string $name): array
    {
        return $this->findBy(['name' => $name]);
    }

    public function findById(int $id): object|null
    {
        return $this->find($id);
    }
}