<?php
namespace Application\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\Common\Collections\Criteria;

/**
 * Base Repository
 *
 * @author Siwei Mu <Siwei@newtonsnerds.com>
 */
class BaseRepository extends EntityRepository
{

    const ALIAS = "mainAlias";

    const CONNECTOR = ".";

    const ALIASDOT = "mainAlias.";
    
    public function runDQL($dql){
        return $this->getEntityManager()->createQuery($dql)->getArrayResult();
    }

    public function setupDatatable($columnConfig = null, $filter = null)
    {
        
        $columns = $columnConfig;
        
        // Add an empty field to the beginning of columns (e.g. used for checkbox)
        array_unshift($columns, [
            'field' => ''
        ]);
        
        /* @var $qb \Doctrine\DBAL\Query\QueryBuilder */
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->from($this->getEntityName(), static::ALIAS);
        
        // Initialize select clause
        foreach ($columns as $num => $c) {
            $field = $c['field'];
            if (! empty($field)) {
                // When requesting an simple attribute, e.g. an integer or string value like id and description
                if (! array_key_exists('joinEntity', $c)) {
                    
                    // Add select
                    $qb->addSelect(static::ALIASDOT . $field);
                } else {
                    // When requesting an entity, e.g. status, customer
                    
                    $entity = $c['joinEntity'];
                    
                    $join = static::ALIASDOT . $entity;
                    $joinResultField = $c['joinResultField'];
                    $jAlias = $entity . 'Alias';
                    
                    // Add select
                    $qb->addSelect("$jAlias.$joinResultField as {$entity}_{$joinResultField}_{$num}");
                    
                    // Check whether join exists already
                    $joinDqlParts = $qb->getDQLParts()['join'];
                    
                    $aliasAlreadyExists = false;
                    /* @var $j \Doctrine\ORM\Query\Expr\Join */
                    foreach ($joinDqlParts as $joins) {
                        foreach ($joins as $j) {
                            
                            if ($j->getAlias() === $jAlias) {
                                $aliasAlreadyExists = true;
                                break 2;
                            }
                        }
                    }
                    
                    if ($aliasAlreadyExists === false) {
                        // Add join
                        $qb->leftJoin($join, $jAlias);
                    }
                }
            }
        }
        
        // Group filter
        if (isset($_POST['customActionName']) && $_POST['customActionName'] == 'filterByStatus') {
            $value = $_POST['customActionValue'];
            if ($value) {
                $qb->andWhere("statusAlias.id = $value");
            }
        }
        
        // Program filter
        if ($filter) {
            foreach ($filter as $f) {
                if (isset($f['method']) && $f['method'] == 'or')
                    $qb->orWhere($f['query']);
                else
                    $qb->andWhere($f);
            }
        }
        
        // Datatable Filter
        if (isset($_POST['filter'])) {
            $this->_applyFilterCriteriaStrategy($_POST['filter'], $columns, $qb);
        }
        
        if (isset($_POST['order'])) {
            
            $col = $_POST['order'][0]['column'];
            
            $sort = static::ALIASDOT . $columns[$col]['field'];
            if (array_key_exists('joinEntity', $columns[$col])) {
                
                $sort = $columns[$col]['joinEntity'] . 'Alias' . static::CONNECTOR . $columns[$col]['joinResultField'];
            }
            
            switch ($_POST['order'][0]['dir']) {
                case 'asc':
                    $qb->orderBy($sort, 'asc');
                    break;
                case 'desc':
                    $qb->orderBy($sort, 'desc');
                    break;
            }
        }
        
        // Pagination, returns a page of results each time based on above.
        $paginator = new \Doctrine\ORM\Tools\Pagination\Paginator($qb, $fetchJoinCollection = false);
        $paginator->setUseOutputWalkers(false);
        
        // display limited records
        if (array_key_exists('length', $_POST) && $_POST['length'] > 0) {
            $paginator->getQuery()->setFirstResult($_POST['start'])->setMaxResults($_POST['length']);
        }
        //$start = new \DateTime( date('Y-m-d H:i:s.'.sprintf("%06d",(microtime(true) - floor(microtime(true))) * 1000000), microtime(true)) ); echo '1st: ' . $start->format('d-m-Y h:i:s.u') . "<br>";
        
        // Write own query to count total for efficiency
        $query = $this->getEntityManager()->createQuery('SELECT COUNT(q.id) FROM ' . $this->getEntityName() . ' q');
        $iTotal = $query->getSingleScalarResult();
        
        //$mid = new \DateTime( date('Y-m-d H:i:s.'.sprintf("%06d",(microtime(true) - floor(microtime(true))) * 1000000), microtime(true)) ); echo '2nd: ' . $mid->format('d-m-Y h:i:s.u') . "<br>";
        
        if(empty($qb->getDQLParts()['where'])){
            $iFilteredTotal = $iTotal;
        } else {
            $iFilteredTotal = $paginator->count();
        }
        
        $result = array();
        foreach ($paginator as $order) {
            $keys = array_keys($order);
            $row = array();
            for ($i = 0; $i < count($columns); $i ++) {
                if(empty($columns[$i]['field'])){
                    $row[] = '';
                }
                else {
                    $value = $this->_applyWordingStrategy($value = $order[$keys[$i-1]], $strategyContainer = $columns[$i]);
                    $row[] = $value;
                }
                $row['DT_RowId'] = $order['id'];
            }
            $result[] = $row;
        }
        
        $output = array(
            "data" => $result,
            "draw" => intval($_POST['draw']),
            "recordsTotal" => $iTotal,
            "recordsFiltered" => $iFilteredTotal
        );
        //$end = new \DateTime( date('Y-m-d H:i:s.'.sprintf("%06d",(microtime(true) - floor(microtime(true))) * 1000000), microtime(true)) ); echo '3rd: ' . $end->format('d-m-Y h:i:s.u');
        return $output;
    }

    protected function _applyWordingStrategy($value, $strategyContainer)
    {
        if (isset($strategyContainer['strategy'])) {
            
            switch ($strategyContainer['strategy']) {
                case 'date':
                    if(empty($value)) return $value;
                    return $value->format('d-m-Y');
                    break;
                case 'datetime':
                    if(empty($value)) return $value;
                    return $value->format('d-m-Y H:i:s');
                    break;
                case 'date-showTimespan':
                case 'datetime-showTimespan':
                    if(empty($value)) return $value;
                    $result = $value->format('d-m-Y H:i:s');
                    if ('date' == $strategyContainer['strategy']) {
                        $result = $value->format('d-m-Y');
                    }
                    
                    $today = new \DateTime();
                    $interval = $today->diff($value);
                    foreach ($interval as $timeUnit => $timeLength) {
                        if ($interval->invert == 1) {
                            if ($timeLength != 0) {
                                switch ($timeUnit) {
                                    case 'y':
                                        if ($timeLength > 1)
                                            $suffix = "$timeLength years ago";
                                        else
                                            $suffix = 'Last year';
                                        break 2;
                                    case 'm':
                                        if ($timeLength > 1)
                                            $suffix = "$timeLength months ago";
                                        else
                                            $suffix = 'Last month';
                                        break 2;
                                    case 'd':
                                        if ($timeLength > 1)
                                            $suffix = "$timeLength days ago";
                                        else
                                            $suffix = 'Yesterday';
                                        break 2;
                                    case 'h':
                                        if ($timeLength > 1)
                                            $suffix = "$timeLength hours ago";
                                        else
                                            $suffix = 'An hour ago.';
                                        break 2;
                                    case 'i':
                                        if ($timeLength > 1)
                                            $suffix = "$timeLength minutes ago";
                                        else
                                            $suffix = 'A minute ago.';
                                        break 2;
                                    case 's':
                                        if ($timeLength > 1)
                                            $suffix = "$timeLength seconds ago";
                                        else
                                            $suffix = 'A second ago.';
                                        break 2;
                                }
                            }
                        } else {
                            if ($timeLength != 0) {
                                switch ($timeUnit) {
                                    case 'y':
                                        if ($timeLength > 1)
                                            $suffix = "$timeLength years left";
                                        else
                                            $suffix = 'Next year';
                                        break 2;
                                    case 'm':
                                        if ($timeLength > 1)
                                            $suffix = "$timeLength months left";
                                        else
                                            $suffix = 'Next month';
                                        break 2;
                                    case 'd':
                                        if ($timeLength > 1)
                                            $suffix = "$timeLength days left";
                                        else
                                            $suffix = 'Tomorrow';
                                        break 2;
                                    case 'h':
                                        if ($timeLength > 1)
                                            $suffix = "$timeLength hours left";
                                        else
                                            $suffix = 'An hour left.';
                                        break 2;
                                    case 'i':
                                        if ($timeLength > 1)
                                            $suffix = "$timeLength minutes left";
                                        else
                                            $suffix = 'One minute left.';
                                        break 2;
                                    case 's':
                                        if ($timeLength > 1)
                                            $suffix = "$timeLength seconds left";
                                        else
                                            $suffix = 'A second left.';
                                        break 2;
                                }
                            }
                        }
                    }
                    
                    // Formating result
                    if (isset($suffix)) {
                        $result = $result . " ($suffix)";
                    }
                    
                    return $result;
                    break;
                case 'age':
                    if(empty($value)) return 'DOB not set';
                    $result = $value->format('d/m/Y');
                    
                    $today = new \DateTime();
                    $interval = $today->diff($value);
                    foreach ($interval as $timeUnit => $timeLength) {
                        if ($interval->invert == 1) {
                            if ($timeLength != 0) {
                                switch ($timeUnit) {
                                    case 'y':
                                        if ($timeLength > 1)
                                            $suffix = "Age $timeLength";
                                        else
                                            $suffix = 'Last year';
                                        break 2;
                                    case 'm':
                                        if ($timeLength > 1)
                                            $suffix = "Age $timeLength months";
                                        else
                                            $suffix = '1 month';
                                        break 2;
                                    case 'd':
                                        if ($timeLength > 1)
                                            $suffix = "Age $timeLength days";
                                        else
                                            $suffix = '1 Day';
                                        break 2;
                                }
                            }
                        }
                    }
                    
                    // Formating result
                    if (isset($suffix)) {
                        $result = $result . " ($suffix)";
                    }
                    
                    return $result;
                    
            }
        }
        // When there is no strategy specified, return plain value.
        return $value;
    }

    /**
     * Filter strategy is useful when you need to filter relationships (with join fields)
     *
     * @param string $attr            
     * @param string $filter            
     * @param string $filterValue            
     * @param Doctrine\ORM\QueryBuilder $qb            
     */
    protected function _applyFilterQueryBuilderStrategy($attr, $filter, $filterValue, \Doctrine\ORM\QueryBuilder &$qb)
    {
        $value = $filterValue['value'];
        
        // Do not filter if the filter value is empty
        if ('' == $value) {
            return;
        }
        
        switch ($filter) {
            case 'contains':
                $qb->andWhere($qb->expr()
                    ->like($attr, "'%$value%'"));
                break;
            case 'notContain':
                $qb->andWhere($qb->expr()
                    ->notLike($attr, "'%$value%'"));
                break;
            case 'is':
                $qb->andWhere($qb->expr()
                    ->eq($attr, $value));
                break;
            case 'isNot':
                $qb->andWhere($qb->expr()
                    ->neq($attr, $value));
                break;
            case 'isEmpty':
                $qb->andWhere($qb->expr()
                    ->isNull($attr));
                break;
            case 'isNotEmpty':
                $qb->andWhere($qb->expr()
                    ->isNotNull($attr));
                break;
            case 'largerThan':
                $qb->andWhere($qb->expr()
                    ->gt($attr, $value));
                break;
            case 'noLessThan':
                $qb->andWhere($qb->expr()
                    ->gte($attr, $value));
                break;
            case 'lessThan':
                $qb->andWhere($qb->expr()
                    ->lt($attr, $value));
                break;
            case 'noLargerThan':
                $qb->andWhere($qb->expr()
                    ->lte($attr, $value));
                break;
            case 'between':
                $qb->andWhere($qb->expr()
                    ->gte($attr, $filterValue['betweenLeft']));
                $qb->andWhere($qb->expr()
                    ->lte($attr, $filterValue['betweenRight']));
                break;
            case 'dateGte':
                $value = date_create_from_format('d/m/Y', $value)->format('Y-m-d');
                $qb->andWhere($qb->expr()
                    ->gte($attr, $value));
                break;
            case 'dateLte':
                $value = date_create_from_format('d/m/Y', $value)->format('Y-m-d');
                $qb->andWhere($qb->expr()
                    ->lte($attr, $value));
                break;
            case 'in':
                $value = array_filter($value);
                
                if (! empty($value)) {
                    $qb->andWhere($qb->expr()
                        ->in($attr, $value));
                }
                break;
        }
    }

    /**
     * Criteria strategy is handy when you only need to filter within the entity scope (attributes of this entity)
     *
     * @param array $filterArray            
     * @param array $columns            
     * @param Doctrine\ORM\QueryBuilder $qb            
     * @return \Doctrine\Common\Collections\Criteria
     */
    protected function _applyFilterCriteriaStrategy($filterArray, $columns, \Doctrine\ORM\QueryBuilder $qb)
    {
        // Criteria to be matched
        $criteria = new Criteria();
        // e.g filter['id_eq'] = 21;
        foreach ($_POST['filter'] as $key => $value) {
            if (! empty($value)) {
                foreach ($columns as $col) {
                    // When this field is a join field name, we should use query builder strategy
                    if (isset($col['joinEntity']) && preg_match("/(\\w+)_(\\w+)$/", $key, $matches) && ($matches[1] == $col['field'])) {
                        $filterValue['value'] = $value;
                        $this->_applyFilterQueryBuilderStrategy("mainAlias.{$col['field']}", $matches[2], $filterValue, $qb);
                        // Done querying, skip below
                        break;
                    }
                    
                    // When this field is a join result field, we should use query builder strategy
                    if (isset($col['joinEntity']) && preg_match("/(\\w+)_(\\w+)$/", $key, $matches) && ($matches[1] == $col['joinResultField'])) {
                        
                        $filterValue['value'] = $value;
                        $this->_applyFilterQueryBuilderStrategy("{$col['joinEntity']}Alias.{$col['joinResultField']}", $matches[2], $filterValue, $qb);
                        
                        // Done querying, skip below
                        break;
                    }
                    
                    // Regular expression to match XX_YY ($matches[1] => XX, $matches[2] => YY)
                    if (isset($col['field']) && preg_match("/(\\w+)_(\\w+)$/", $key, $matches) && ($matches[1] == $col['field'])) {
                        
                        switch ($filterType = $matches[2]) {
                            case 'is':
                                $criteria->andWhere($criteria->expr()
                                    ->eq($col['field'], $value));
                                break;
                            case 'contains':
                                $criteria->andWhere($criteria->expr()
                                    ->contains($col['field'], $value));
                                break;
                            case 'dateGte':
                                $value = date_create_from_format('d/m/Y', $value)->format('Y-m-d');
                                $criteria->andWhere($criteria->expr()
                                    ->gte($col['field'], $value));
                                break;
                            case 'dateLte':
                                $value = date_create_from_format('d/m/Y', $value)->format('Y-m-d');
                                $criteria->andWhere($criteria->expr()
                                    ->lte($col['field'], $value));
                                break;
                        }
                    }
                }
            }
        }
        
        $qb->addCriteria($criteria);
    }
}