<?php
namespace Application\Entity\Repository;

/**
 * Calendar Work Item Repository
 *
 * @author Siwei Mu <Siwei@newtonsnerds.com>
 */
class CalendarWorkItemRepository extends BaseRepository{
    
    public function getAllForCurrentUser($startAt, $endAt, $user){
        
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select(array('c.id', 'c.name AS title', 'c.startAt AS start', "c.endAt"))
           ->from('Application\Entity\CalendarWorkItem','c')
           ->where('c.user = ?1')
           ->andWhere($qb->expr()->gte('DATE(c.startAt)', "'$startAt'"))
           ->andWhere($qb->expr()->orX($qb->expr()->lte('DATE(c.endAt)', "'$endAt'"), $qb->expr()->isNull('c.endAt')))
           ->setParameter(1, $user);
        
        $result = $qb->getQuery()->getArrayResult();
        foreach($result as &$r){
            $r['start'] = $r['start']->format(\DateTime::ISO8601);
            if(!empty($r['end'])){
                $r['end'] = $r['endAt']->format(\DateTime::ISO8601);
            }
            unset($r['endAt']);
        }
        return $result;
    }
    
    public function getById($startAt, $endAt, $id){
        
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select(array('c.id', 'c.name AS title', 'c.startAt AS start', "c.endAt"))
        ->from('Application\Entity\CalendarWorkItem','c')
        ->where('c.id = ?1')
        ->andWhere($qb->expr()->gte('DATE(c.startAt)', "'$startAt'"))
        ->andWhere($qb->expr()->lte('DATE(c.endAt)', "'$endAt'"))
        ->setParameter(1, $id);
        
        $result = $qb->getQuery()->getArrayResult();
        return $result;
    }
    
    public function updateById($params){
        
        $qb = $this->getEntityManager()->createQueryBuilder();
        $q = $qb->update('Application\Entity\CalendarWorkItem', 'c')
        ->where('c.id = ?1')
        ->setParameter(1, $params['eventid']);
        
        // Update particular field if it's set.
        if(isset($params['title'])){
            $qb->set('c.name', '?2')
               ->setParameter(2, $params['title']);
        }
        
        if(isset($params['start'])){
            $start = new \DateTime();
            $start->setTimestamp(strtotime($params['start']));
            
            $qb->set('c.startAt', '?3')
               ->setParameter(3, $start);
        }
        
        if(isset($params['end'])){
            $end = new \DateTime();
            $end->setTimestamp(strtotime($params['end']));
            
            $qb->set('c.endAt', '?4')
               ->setParameter(4, $end);
        }
        
        $result = $q->getQuery()->execute();
        
        return $result;
    }
}
