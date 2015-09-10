<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Luxifer\DQL\Datetime\Hour;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
//         $previous_week = strtotime("-1 week +1 day");
        
//         $start_week = strtotime("last sunday midnight",$previous_week);
//         $end_week = strtotime("next saturday",$start_week);
        
//         $start_week = date("Ymd",$start_week);
//         $end_week = date("Ymd",$end_week);
        
//         \TeamWorkPm\Auth::set('wind516floor');
//         echo '<pre>';
//         $timeEntries = \TeamWorkPm\Factory::build('time')->getAll(['fromdate' => $start_week, 'todate' => $end_week, 'userId' => 94235]);
//         $minutes = 0;
//         foreach($timeEntries as $t){
//             if($t->isbillable){
//                 $minutes += $t->minutes + $t->hours * 60;
//                 //print_r($t);
//             }
//         }
        
// //         weekly billable target achievment chart (group by person + his weekly goal, among other team members) pie
// //         this week daily billable hour (group by billable hour everyday of all the people in the team, from Monday to Friday) line
// //         historical billable hours (group by person)
        
//         echo '</pre>';
        $stop_date = new \DateTime('1899-12-30');
        echo 'date before day adding: ' . $stop_date->format('Y-m-d');
        $stop_date->modify('+34520 day');
        echo 'date after adding days: ' . $stop_date->format('Y-m-d');
        return new ViewModel();
    }
    
    public function dashboardAction()
    {
        return new ViewModel();
    }
}
