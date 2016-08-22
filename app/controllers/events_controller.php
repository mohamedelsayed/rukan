<?php /**
 * @author Author "Mohamed Elsayed"  
 * @author Author Email "me@mohamedelsayed.net"
 * @link http://www.mohamedelsayed.net
 * @copyright Copyright (c) 2015 Programming by "mohamedelsayed.net"
 */
require_once '../auth_controller.php';
class EventsController extends AuthController {
    var $name = 'Events';
    var $uses = array('Event');   
    //use upload component.
    var $components = array('Upload');
    function index() {
        $this->Event->recursive = 0;
        $conditions =  array();
        $title = '';     
        if(isset($_REQUEST['title']) && trim($_REQUEST['title']) != ''){
            $title = $_REQUEST['title'];
            $conditions['Event.title LIKE'] = "%".$title."%";
        }
        $year = 0;
        if(isset($_REQUEST['year']) && $_REQUEST['year'] != 0){
            $year = $_REQUEST['year'];
            $conditions['YEAR(Event.from_date) = '] = $year;            
        }
        $month = 0;
        if(isset($_REQUEST['month']) && $_REQUEST['month'] != 0){
            $month = $_REQUEST['month'];
            $conditions['MONTH(Event.from_date) = '] = $month;            
        }
        $order = array('Event.from_date'=> 'DESC', 'Event.to_date'=> 'DESC', 'Event.id' => 'DESC');
        if(!empty($conditions)){
            $this->paginate = array(            
                'conditions' => $conditions,    
                'order' => $order,
            );            
        }else{
            $this->paginate = array(            
                'order' => $order,
            );
        }
        $this->set('events', $this->paginate());
    }
    function view($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid event', true));
            $this->redirect(array('action' => 'index'));
        }
        $this->set('event', $this->Event->read(null, $id));
    }
    function add() {
        if (!empty($this->data)) {
            $this->Event->create();
            if ($this->Event->save($this->data)) {
                $this->Session->setFlash(__('The event has been saved', true));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The event could not be saved. Please, try again.', true));
            }            
        }
        $categories = $this->Event->Category->find('list');
        $this->set(compact('categories'));
    }
    function edit($id = null) {
        if (!$id && empty($this->data)) {
            $this->Session->setFlash(__('Invalid event', true));
            $this->redirect(array('action' => 'index'));
        }
        if (!empty($this->data)) {
            $this->Event->id = $id;  
            if ($this->Event->save($this->data)) {
                $this->Session->setFlash(__('The event has been saved', true));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The event could not be saved. Please, try again.', true));
            }            
        }
        if (empty($this->data)) {
            $this->data = $this->Event->read(null, $id);
        }
        $categories = $this->Event->Category->find('list');
        $this->set(compact('categories'));
    }
    function delete($id = null) {
        $forbidden_ids = array();
        if(in_array($id, $forbidden_ids)){
            $this->Session->setFlash(__('You cannot delete this Event!', true));
            $this->redirect(array('action'=>'index'));
        }
        if (!$id) {
            $this->Session->setFlash(__('Invalid id for event', true));
            $this->redirect(array('action'=>'index'));
        }
        if ($this->Event->delete($id)) {
            $this->Session->setFlash(__('Event deleted', true));
            $this->redirect(array('action'=>'index'));
        }
        $this->Session->setFlash(__('Event was not deleted', true));
        $this->redirect(array('action' => 'index'));
    }   
}