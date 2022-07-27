<?php


namespace App\Infrastructure\Persistence\Doctrine\Repositories;


use App\Domain\Contract\PartnerShipRepositoryInterface;
use App\Domain\Partnership;
use App\Domain\Shipping;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

class PartnershipRepository extends ServiceEntityRepository implements PartnerShipRepositoryInterface
{
    private EntityManagerInterface $em;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Partnership::class);
        $this->em = $this->getEntityManager();
    }

    public function add(Partnership $partnership): Partnership
    {
        $this->em->persist($partnership);
        $this->em->flush();

        return $partnership;
    }

    public function update(object $partnership): void
    {
        $this->em->persist($partnership);
        $this->em->flush();
    }

    public function all(): array
    {
        // Dirty due need to investigate how to fetch doctrine relations in array instead of objects
        $partnerships = $this->findAll();
        $partnershipsWithShippinigs = [];
        foreach ($partnerships as $partnership) {
            $partnershipsWithShippinigs[] = $partnership->toArray();
        }
        return $partnershipsWithShippinigs;
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