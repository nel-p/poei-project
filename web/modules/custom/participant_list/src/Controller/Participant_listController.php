<?php
namespace Drupal\participant_list\Controller;

use Drupal\Core\Entity;
use Drupal\Node\NodeInterface;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Field\EntityReferenceFieldItemList;
use Drupal\Core\Link;
use Drupal\Core\Url;

class Participant_listController extends ControllerBase{
    public function content(NodeInterface $node){
      $storage = $this->entityTypeManager()->getStorage('webform_submission');
      $webform_submission = $storage->loadByProperties([
        'entity_id' => $node->id(),
      ]);
      $candidat = [];
      foreach($webform_submission as $submission)
      {
        //recupere l'id du webform et l'id de la soumission
        $ids = [
          'webform' => $submission->getWebform()->id(),
          'webform_submission' => $submission->id()
        ];
        $url = new Url('entity.webform.user.submission.edit', $ids);
        $link = new Link('Editer', $url);
        $candidat[] = [
          $submission->getData()['adresse']['given_name'],
          $submission->getData()['adhesion_status'],
          $link,
          ];
      }
      return [
        '#type' => 'table',
        '#empty' => $this->t('No participants'),
        '#header' => [$this->t('Participants in the program'),'Statut',' '],
        '#rows' => $candidat,
        '#cache' => [
          'max-age' => 0,
        ],
      ];
  }
}