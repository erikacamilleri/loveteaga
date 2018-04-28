<?php

namespace App\Repositories;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\QueryBuilder;

abstract class DoctrineRepository {
    
    /** @var \Doctrine\ORM\EntityRepository */
    protected $repo;
    
    /**
     *
     * @var \Doctrine\ORM\EntityManager 
     */
    protected $orm;
    
    public abstract function setRepository();
    
    public function __construct(EntityManager $entityManager) 
    {
        $this->orm = $entityManager;
        $this->setRepository();
    }
    
    public function createQueryBuilder($alias, $indexBy = null)
    {
        return $this->repo->createQueryBuilder($alias, $indexBy);
    }
    
    /**
     * @return \Illuminate\Support\Collection
     */
    public function all()
    {
        return collect($this->repo->findAll());
    }
    
    public function filter(QueryFilters $filters, QueryBuilder $builder = null)
    {
        // https://github.com/laracasts/Dedicated-Query-String-Filtering
        $query = $filters->apply(($builder ? : $this->getBuilder()))->getQuery();
        return $query;
    }
    
    protected function getBuilder()
    {
        return $this->createQueryBuilder('o');
    }
    
    public function find($id)
    {
        return $this->repo->find($id);
    }
    
    public function findWith(array $filters)
    {
        return $this->repo->findOneBy($filters);
    }
    
    public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
    {
        return collect($this->repo->findBy($criteria, $orderBy, $limit, $offset));
    }
    
    public function add($entity)
    {
        $this->orm->persist($entity);
        $this->orm->flush($entity);
    }
    
    public function update($entity)
    {
        $this->orm->flush($entity);
        return true;
    }
    
    public function delete($entity)
    {
        $this->orm->remove($entity);
        $this->orm->flush($entity);
    }
}
