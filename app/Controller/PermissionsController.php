<?php
class PermissionsController extends AppController {


	var $uses = array('Permission','Grupo');
	var $components=array('ControllerList','RequestHandler');
	/**
	 * Used to display all permissions of site by Admin
	 *
	 * @access public
	 * @return array
	 */
	public function index() {
		$c=-2;
		if (isset($_GET['c']) && $_GET['c'] !='') {
			$c=$_GET['c'];
		}
		$this->set('c',$c);
		$allControllers=$this->ControllerList->getControllers();
		$this->set('allControllers',$allControllers);
		if ($c >-2) {
			$con=array();
			$conAll=$this->ControllerList->get();
			if ($c ==-1) {
				$con=$conAll;
				$user_group_permissions=$this->Permission->find('all', array('order'=>array('controller', 'action')));
			} else {
				$user_group_permissions=$this->Permission->find('all', array('order'=>array('controller', 'action'), 'conditions'=>array('controller'=>$allControllers[$c])));
				$con[$allControllers[$c]]= (isset($conAll[$allControllers[$c]])) ? $conAll[$allControllers[$c]] : array();
			}
			foreach ($user_group_permissions as $row) {
				$cont=$row['Permission']['controller'];
				$act=$row['Permission']['action'];
				$ugname=$row['Grupo']['alias_name'];
				$allowed=$row['Permission']['allowed'];
				$con[$cont][$act][$ugname]=$allowed;
			}
			$this->set('controllers',$con);
			$result=$this->Grupo->getGroupNamesAndIds();
			$groups=array();
			$groups2=array();
			foreach ($result as $row) {
				$groups[]= $row['alias_name'];
			}
			$groups = implode(',', $groups);
			$this->set('grupos',$result);
			$this->set('groups',$groups);
		}
	}


	public function index_usergroup() {
		$c=-2;
		if (isset($_GET['c']) && $_GET['c'] !='') {
			$c=$_GET['c'];
		}
		$this->set('c',$c);
		$this->set('allControllers',$this->Grupo->getGroups());
		$user_group_permissions="";
		if ($c >-2) $user_group_permissions = $this->Permission->getPermissoesGrupo($this->ControllerList->get(),$c);
		$this->set('controllers',$user_group_permissions);
	}


	/**
	 *  Used to update permissions of site using Ajax by Admin
	 *
	 * @access public
	 * @return integer
	 */
	public function update() {
		$this->autoRender = false;
		$controller=$this->params['data']['controller'];
		$action=$this->params['data']['action'];
		$result=$this->Grupo->getGroupNamesAndIds();
		$success=0;
		foreach ($result as $row) {
			if (isset($this->params['data'][$row['alias_name']])) {
				$res=$this->Permission->find('first',array('conditions' => array('controller'=>$controller,'action'=>$action,'grupo_id'=>$row['id'])));
				if (empty($res)) {
					$data=array();
					$data['Permission']['grupo_id']=$row['id'];
					$data['Permission']['controller']=$controller;
					$data['Permission']['action']=$action;
					$data['Permission']['allowed']=$this->params['data'][$row['alias_name']];
					$data['Permission']['id']=null;
					$rtn=$this->Permission->save($data);
					if ($rtn) {
						$success=1;
					}
				} else {
					if ($this->params['data'][$row['alias_name']] !=$res['Permission']['allowed']) {
						$data=array();
						$data['Permission']['allowed']=$this->params['data'][$row['alias_name']];
						$data['Permission']['id']=$res['Permission']['id'];
						$rtn=$this->Permission->save($data);
						if ($rtn) {
							$success=1;
						}
					} else {
						 $success=1;
					}
				}
			}
		}
		echo $success;
		$this->__deleteCache();
	}


	public function update_group() {
		$this->autoRender = false;
		if ($this->request->is('post') || $this->request->is('put')) {
			$grupo_id = $this->request->data['Permission']['grupo_id'];
			unset($this->request->data['Permission']);			

			if ($this->Permission->addPermissoesGrupo($this->request->data,$grupo_id)) {
				$this->alert("As permissões foram salvas com sucesso.",'success');
			} else	$this->alert("As permissões não puderam ser salvas.",'error');

			$this->redirect('/permissoes_grupo/?c='.$grupo_id);
		}
	}




	/**
	 * Used to delete cache of permissions and used when any permission gets changed by Admin
	 *
	 * @access private
	 * @return void
	 */
	private function __deleteCache() {
		$iterator = new RecursiveDirectoryIterator(CACHE);
		foreach (new RecursiveIteratorIterator($iterator, RecursiveIteratorIterator::CHILD_FIRST) as $file) {
			$path_info = pathinfo($file);
			if ($path_info['dirname']==TMP."cache" && $path_info['basename']!='.svn') {
				if (!is_dir($file->getPathname())) {
					unlink($file->getPathname());
				}
			}
		}
	}
}