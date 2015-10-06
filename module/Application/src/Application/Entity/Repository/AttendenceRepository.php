<?php
namespace Application\Entity\Repository;

/**
 * Attendence Repository
 *
 * @author Siwei Mu <Siwei@newtonsnerds.com>
 */
class AttendenceRepository extends BaseRepository{
    
    public function punchIn($timeIn, $userId)
    {
        $qb = $this->getEntityManager()->createQueryBuilder();
        
        $query = $qb->update('Application\Entity\Attendance', 'a')
        ->set('a.timeIn', '?1')
        ->where('r.id = ?2')
        ->setParameter(1, $details)
        ->setParameter(2, $row['MM_TM_KEY'])
        ->getQuery();
        
        try{
            $query->execute();
            return true;
        } catch (\Exception $e){
            return false;
        }
    }
}
