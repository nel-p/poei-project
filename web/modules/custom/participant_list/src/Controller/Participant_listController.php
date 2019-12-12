<?php
namespace Drupal\participant_list\Controller;

use Drupal\Core\Entity;
use Drupal\Node\NodeInterface;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Field\EntityReferenceFieldItemList;

class Participant_listController extends ControllerBase{
    public function content(NodeInterface $node){
      if($node->bundle() === "programme"){
        
        $programme = \Drupal::service('entity_field.manager')->getFieldDefinitions('node', 'programme');
        
        $nodes_list = $this->entityTypeManager()->getStorage('node_type')->loadMultiple();
        
        // Je récupere l'id des participants au a cette conférence
        $id_participant = $node->field_participants->getValue();
        
        $i = 0;
        $name_participant = [];
        while($i < count($id_participant)){
          // Recuperation du champ "name" des participants 
          $query = \Drupal::database()->select('users_field_data','ufa')->fields('ufa', ['name'])->condition('uid', $id_participant[$i]['target_id']);
		  $resultat = $query->execute();
          
          //Parcour du tableau de resultat afin de récuperer le champ name
          foreach ($resultat as $res) {
            // affectation du champ name et uid au tableau de participant
            $name_participant[] = ['name' => $res->name,'uid' => $id_participant[$i]['target_id']];
          }
          $i++;
        }        
        return [
          '#table' => [
            '#type' => 'table',
            '#empty' => $this->t('No participants'),
            '#header' => $this->t('Participants in the program'),
            '#rows' => $name_participant,
          ],
          'template' => [
            '#theme' => 'participant_list',
            'liste' => $name_participant,
            '#role' => 'participants',
          ],
          '#cache' => [
            'max-age' => 0,
          ]
        ];
      }
      else{
        return ['#markup' => $this->t('Page not found.')];
      }
    }
}