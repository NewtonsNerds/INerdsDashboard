<?php
namespace Application\Entity\Repository;

interface GetValuePairInterface
{
    
    /**
     * Get value pair uses precise query (more efficient and more fast)
     *
     * @param string $keyword
     * @return array:
     */
    public function getValuePair($keyword);
    
    /**
     * Get value pair of a specific object
     * 
     * @param integer $id
     */
    public function getPairById($id);
}

?>