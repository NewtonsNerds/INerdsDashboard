<?php
namespace Application\Controller;

use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;
use INerdsBase\Controller\BaseController;
use Application\Entity\Attendance;

/**
 * AttendanceController
 *
 * @author Siwei Mu <Siwei@newtonsnerds.com>
 */
class AttendanceController extends BaseController
{

    public function indexAction()
    {
        if ($this->_isXmlHttpRequestViaPost()) {
            $em = $this->getEntityManager();
            
            $result = $em->getRepository('Application\Entity\Attendance')->getAll();
            
            return new JsonModel($result);
        }
        
        return new ViewModel();
    }

    public function punchInAction()
    {
        if ($this->_isXmlHttpRequestViaPost()) {
            
            $timeIn = $this->params()->fromPost('timeIn');
            DateTime::createFromFormat('h:i A', $timeIn);
            $attendance = new Attendance();
            $attendance->setTimeIn($timeIn);
            $attendance->setUser($this->getCurrentUser());
            
            $em = $this->getEntityManager();
            
            try {
                $em->persist($attendance);
                $em->flush();
                
                return new JsonModel(array(
                    'status' => 1,
                    'msg' => 'You are in. '
                ));
            } catch (\Exception $e) {
                return new JsonModel(array(
                    'status' => 0,
                    'msg' => 'Something went wrong when punching you in. '
                ));
            }
        }
    }

    private function getEverydayQuote()
    {
        $quotes = [
            [
                'content' => 'The only person you are destined to become is the person you decide to be.',
                'author' => 'Ralph Waldo Emerson'
            ],
            [
                'content' => 'Start where you are. Use what you have. Do what you can. ',
                'author' => 'Arthur Ashe'
            ],
            [
                'content' => 'How wonderful it is that nobody need wait a single moment before starting to improve the world. ',
                'author' => 'Anne Frank'
            ],
            [
                'Content' => 'When one door closes another door opens; but we so often look so long and so regretfully upon the closed door, that we do not see the ones which open for us.',
                'Author' => 'Alexander Graham Bell'
            ],
            [
                'Content' => 'Life is a succession of lessons which must be lived to be understood.',
                'Author' => 'Helen Keller'
            ],
            [
                'Content' => 'When you get into a tight place and everything goes against you, till it seems as though you could not hang on a minute longer, never give up then, for that is just the place and time that the tide will turn.',
                
                'Author' => 'Harriet Beecher Stowe'
            ],
            [
                'Content' => 'You must do the thing you think you cannot do.',
                'Author' => 'Eleanor Roosevelt'
            ],
            [
                'Content' => 'If you don¡¯t pay appropriate attention to what has your attention, it will take more of your attention than it deserves.',
                'Author' => 'David Allen'
            ],
            [
                'Content' => 'I find hope in the darkest of days, and focus in the brightest. I do not judge the universe.',
                'Author' => 'Dalai Lama'
            ],
            [
                'Content' => 'Character cannot be developed in ease and quiet. Only through experience of trial and suffering can the soul be strengthened, ambition inspired, and success achieved.',
                'Author' => 'Helen Keller'
            ],
            [
                'Content' => 'It is by going down into the abyss that we recover the treasures of life. Where you stumble, there lies your treasure.',
                'Author' => 'Joseph Campbell'
            ],
            [
                'Content' => 'In essence, if we want to direct our lives, we must take control of our consistent actions. It¡¯s not what we do once in a while that shapes our lives, but what we do consistently.',
                'Author' => 'Tony Robbins'
            ],
            [
                'Content' => 'Our greatest weakness lies in giving up. The most certain way to succeed is always to try just one more time.',
                'Author' => 'Thomas A. Edison'
            ],
            [
                'Content' => 'You are never to old to set another goal or to dream a new dream.',
                'Author' => 'C.S. Lewis'
            ],
            [
                'Content' => 'Even if you fall on your face, you¡¯re still moving forward.',
                'Author' => 'Victor Kiam'
            ],
            [
                'Content' => 'Be miserable. Or motivate yourself. Whatever has to be done, it¡¯s always your choice.',
                'Author' => 'Wayne Dyer'
            ],
            [
                'Content' => 'Learn from the past, set vivid, detailed goals for the future, and live in the only moment of time over which you have any control: now.',
                'Author' => 'Denis Waitley'
            ],
            [
                'Content' => 'Do you want to know who you are? Don¡¯t ask. Act! Action will delineate and define you.',
                'Author' => 'Thomas Jefferson'
            ],
            [
                'Content' => 'The key is to keep company only with people who uplift you, whose presence calls forth your best.',
                'Author' => 'Epictetus'
            ],
            [
                'Content' => 'Be impeccable with your word. Speak with integrity. Say only what you mean. Avoid using the word to speak against yourself or to gossip about others. Use the power of your word in the direction of truth and love.',
                'Author' => 'Miguel Angel Ruiz'
            ],
            [
                'Content' => 'Act as if what you do makes a difference. It does.',
                'Author' => 'William James'
            ],
            [
                'Content' => 'Learning is the beginning of wealth. Learning is the beginning of health. Learning is the beginning of spirituality. Searching and learning is where the miracle process all begins.',
                
                'Author' => 'Jim Rohn'
            ]
        ]
        ;
    }
}