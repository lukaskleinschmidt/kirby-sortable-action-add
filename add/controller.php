<?php

class AddActionController extends LukasKleinschmidt\Sortable\Controllers\Action {

  /**
   * Add a entry
   */
  public function add() {

    $self   = $this;
    $parent = $this->field()->origin();

    if($parent->ui()->create() === false) {
      throw new PermissionsException();
    }

    $form = $parent->form('add', function($form) use($parent, $self) {

      try {

        $form->validate();

        if(!$form->isValid()) {
          throw new Exception(l('pages.add.error.template'));
        }

        $data = $form->serialize();
        $page = $parent->children()->create($data['uid'], $data['template'], array(
          'title' => $data['title']
        ));

        $self->notify(':)');
        $this->redirect($page, 'edit');

      } catch(Exception $e) {
        $form->alert($e->getMessage());
      }

    });

    return $this->modal('pages/add', compact('form'));
  }

}
