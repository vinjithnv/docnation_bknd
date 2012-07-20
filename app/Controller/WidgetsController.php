<?php
App::uses('AppController', 'Controller');
/**
 * Widgets Controller
 *
 * @property Widget $Widget
 */
class WidgetsController extends AppController {


/**
 * index beforeFilter
 *
 * @return void
 */

	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('index', 'view');
	}

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Widget->recursive = 0;
		$this->set('widgets', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Widget->id = $id;
		if (!$this->Widget->exists()) {
			throw new NotFoundException(__('Invalid widget'));
		}
		$this->set('widget', $this->Widget->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Widget->create();
			if ($this->Widget->save($this->request->data)) {
				$this->Session->setFlash(__('The widget has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The widget could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Widget->id = $id;
		if (!$this->Widget->exists()) {
			throw new NotFoundException(__('Invalid widget'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Widget->save($this->request->data)) {
				$this->Session->setFlash(__('The widget has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The widget could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Widget->read(null, $id);
		}
	}

/**
 * delete method
 *
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Widget->id = $id;
		if (!$this->Widget->exists()) {
			throw new NotFoundException(__('Invalid widget'));
		}
		if ($this->Widget->delete()) {
			$this->Session->setFlash(__('Widget deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Widget was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
