<?php

if($this->request->prefix == 'admin'){

	// $this->Verify->auths();

	$roles = array('admin','staff','staffM','staffC');

	// if(!$this->Session->isLogged() && !in_array($this->Session->user('role'), $roles) && $this->Session->user('role') != 'admin'){
	// 	$this->redirect('office/connexion'); 
	// }elseif(!$this->Session->isLogged() && !in_array($this->Session->user('role'), $roles) && $this->Session->user('role') != 'staff'){
	// 	$this->redirect('office/connexion'); 
	// }elseif(!$this->Session->isLogged() && !in_array($this->Session->user('role'), $roles) && $this->Session->user('role') != 'staffM'){
	// 	$this->redirect('office/connexion'); 
	// }elseif(!$this->Session->isLogged() && !in_array($this->Session->user('role'), $roles) && $this->Session->user('role') != 'staffC'){
	// 	$this->redirect('office/connexion'); 
	// }

	$this->layout = 'office'; 
}

if($this->request->prefix == 'comm'){

	$this->layout = 'comm'; 
}