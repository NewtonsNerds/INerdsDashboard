<?php
namespace Application\Entity\Repository;

/**
 * Project Repository
 *
 * @author Siwei Mu <Siwei@newtonsnerds.com>
 */
class ProjectRepository extends BaseRepository implements GetValuePairInterface{
    
    public function getValuePair($keyword){
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->from($this->getClassName(), 'q');
        $qb->select(array("q.id as id", "q.name as text"));
        $qb->where($qb->expr()->like("q.name", "'%$keyword%'"));
        return $qb->getQuery()->getResult();
    }
    
    public function getPairById($id){
    
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->from($this->getClassName(), 'q');
        $qb->select(array("q.id as id", "q.name as text"));
        $qb->where($qb->expr()->eq("q.id", $id));
    
        return $qb->getQuery()->getSingleResult();
    }
    
    public function getAll()
    {
        return $this->getDatatableOutput();
    }
    
    /**
     * Fetch for datatable ajax function
     *
     * @param array $options
     * @return array $output
     */
    public function getDatatableOutput($filter = null, $columnConfig = null)
    {
        $defaultColumns = [
            [
                'field' => 'id'
            ],
            [
                'field' => 'name'  
            ],
            [
                'field' => ''
            ]
        ];
        $columnConfig = $columnConfig? : $defaultColumns;
        return $this->setupDatatable($defaultColumns, $filter);
    }
}
