<?php

namespace Drupal\participant_list\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Link;
use Drupal\Core\Url;
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
      $editLink = '';
      if ($submission->getData()['adhesion_status'] == 'standby') {
        $urlParams = [
          'webform' => $submission->getWebform()->id(),
          'webform_submission' => $submission->id()
        ];
        
        $url = new Url('entity.webform.user.submission.edit', $urlParams);
        $editLink = new Link('Modifier', $url);
      }

      $rows[] = [
        $submission->getSourceEntity()->toLink(),
        $submission->getData()['adhesion_status'],
        $editLink,
      ];
    }

    $header = [
      $this->t('Programme'),
      $this->t('Status de la demande'),
      '',
    ];

    return [
      '#type' => 'table',
      '#header'=> $header,
      '#rows'=> $rows,
      '#empty'=> $this->t('Aucune adhésion enregistrée !!'),
      '#cache' => ['max-age' => '0'],
    ];
  }

}
