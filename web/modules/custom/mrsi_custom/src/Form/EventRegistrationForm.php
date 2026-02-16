<?php

namespace Drupal\mrsi_custom\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Database\Database;

class EventRegistrationForm extends FormBase {

  public function getFormId() {
    return 'mrsi_event_registration_form';
  }

  public function buildForm(array $form, FormStateInterface $form_state) {

    $form['name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Full Name'),
      '#required' => TRUE,
    ];

    $form['email'] = [
      '#type' => 'email',
      '#title' => $this->t('Email'),
      '#required' => TRUE,
    ];

    $form['organization'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Organization'),
    ];

    $form['event_id'] = [
  '#type' => 'number',
  '#title' => $this->t('Event ID'),
  '#required' => TRUE,
];


    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Register'),
    ];

    return $form;
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {

    Database::getConnection()->insert('mrsi_event_registration')
      ->fields([
        'name' => $form_state->getValue('name'),
        'email' => $form_state->getValue('email'),
        'organization' => $form_state->getValue('organization'),
        'event_id' => $form_state->getValue('event_id'),
        'created' => time(),
      ])
      ->execute();

    $this->messenger()->addMessage($this->t('Registration successful.'));
  }

}
