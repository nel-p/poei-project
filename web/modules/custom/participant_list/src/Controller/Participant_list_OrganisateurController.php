<?php
namespace Drupal\participant_list\Controller;

use Drupal\Core\Entity;
use Drupal\Node\NodeInterface;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Field\EntityReferenceFieldItemList;

class Participant_list_OrganisateurController extends ControllerBase{
    public function content(NodeInterface $node){
      if($node->bundle() === "programme"){
        
        $programme = \Drupal::service('entity_field.manager')->getFieldDefinitions('node', 'programme');
        
        $nodes_list = $this->entityTypeManager()->getStorage('node_type')->loadMultiple();
        $id_organisateurs = $node->field_organisateurs->getValue();
        $i = 0;
        $name_organisateurs = [];
        while($i < count($id_organisateurs)){
          $query = \Drupal::database()->select('users_field_data','ufa')->fields('ufa', ['name'])->condition('uid', $id_organisateurs[$i]['target_id']);
		  $resultat = $query->execute();
          foreach ($resultat as $res) {
            $name_organisateurs[] = ['name' => $res->name,'uid' => $id_organisateurs[$i]['target_id']];
          }
          $i++;
        }
       
        return [
          '#table' => [
            '#type' => 'table',
            '#empty' => $this->t('No Organizer'),
            '#header' => $this->t('Organizer in the program'),
            '#rows' => $this->t('Name'),
          ],
          'template' => [
            '#theme' => 'participant_list',
            'liste' => $name_organisateurs,
            '#role' => 'organisateurs',
          ],
          '#cache' =>[
            'max-age' => 0,
          ]
        ];
      }
      else{
        return ['#markup' => $this->t('else')];
      }
    }
}