<?php


namespace App\Infrastructure\Persistence\Doctrine\Repositories;


use App\Domain\Contract\InfluencerRepositoryInterface;
use App\Domain\Influencer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

class InfluencerRepository extends ServiceEntityRepository implements InfluencerRepositoryInterface
{
    private EntityManagerInterface $em;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Influencer::class);
        $this->em = $this->getEntityManager();
    }

    public function add(Influencer $influencer): Influencer
    {
        $this->em->persist($influencer);
        $this->em->flush();
        return $influencer;
    }

    public function all(): array
    {
        return $this->createQueryBuilder('influencer', 'influencer.id')
            ->select('influencer')
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