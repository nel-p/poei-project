<?php
namespace Drupal\participant_list\Controller;

use Drupal\Core\Entity;
use Drupal\Node\NodeInterface;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Field\EntityReferenceFieldItemList;

class Participant_listController extends ControllerBase{
    public function content(NodeInterface $node){
        return ['#markup' => $this->t('Participants conference ')];
    }
}