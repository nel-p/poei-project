<?php

namespace Drupal\participant_list\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Participant entities.
 */
class participant_listViewsData extends EntityViewsData {

  /**
   * {@inheritdoc}
   */
  public function getViewsData() {
    $data = parent::getViewsData();

    // Additional information for Views integration, such as table joins, can be
    // put here.
    return $data;
  }

}
