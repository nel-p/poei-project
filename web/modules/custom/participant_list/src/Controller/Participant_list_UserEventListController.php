<?php

namespace Drupal\participant_list\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\user\UserInterface;

class Participant_list_UserEventListController extends ControllerBase {

  public function content(UserInterface $user) {
    $webformStorage = $this->entityTypeManager()->getStorage('webform_submission');
    /*$query = $webformStorage->getQuery()
      ->condition('uid', $user->id())
      ->execute();
    $webformSubmissions = $webformStorage->loadMultiple($query);*/

    $webformSubmissions = $webformStorage->loadByProperties(['uid'=>$user->id()]);

    $rows = [];
    foreach ($webformSubmissions as $submission) {
      $rows[] = [
        $submission->getSourceEntity()->toLink(),
        $submission->getData()['adhesion_status'],
      ];
    }

    $header = [
      $this->t('Programme'),
      $this->t('Status de la demande'),
    ];

    return [
      '#type' => 'table',
      '#header'=> $header,
      '#rows'=> $rows,
      '#empty'=> $this->t('No event subscribe !!'),
      '#cache' => ['max-age' => '0'],
    ];
  }

}
