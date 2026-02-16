<?php

namespace Drupal\mrsi_custom\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Database\Database;

class EventListController extends ControllerBase {

  public function list() {

  $connection = \Drupal::database();

  $header = [
    ['data' => 'Name'],
    ['data' => 'Email'],
    ['data' => 'Organization'],
    ['data' => 'Event ID'],
    ['data' => 'Registered On'],
  ];

  $rows = [];

  $query = $connection->select('mrsi_event_registration', 'e')
    ->fields('e', ['name', 'email', 'organization', 'event_id', 'created'])
    ->orderBy('created', 'DESC');

  $results = $query->execute();

  foreach ($results as $record) {
    $rows[] = [
      'data' => [
        ['data' => $record->name],
        ['data' => $record->email],
        ['data' => $record->organization],
        ['data' => $record->event_id],
        ['data' => date('d M Y, h:i A', $record->created)],
      ],
    ];
  }

  $count = count($rows);

 return [
  '#type' => 'container',
  '#attributes' => [
    'class' => ['event-registration-wrapper'],
  ],
  '#attached' => [
    'library' => [
      'mrsi_custom/event_styles',
    ],
  ],
  'summary' => [
    '#markup' => '<div class="event-registration-summary">
                    Total Registrations: ' . $count . '
                  </div>',
  ],
  'table' => [
    '#type' => 'table',
    '#header' => $header,
    '#rows' => $rows,
    '#empty' => 'No registrations found.',
    '#attributes' => [
      'class' => ['event-registration-table'],
    ],
  ],
];

}

}
