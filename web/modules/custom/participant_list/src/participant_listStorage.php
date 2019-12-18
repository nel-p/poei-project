<?php

namespace Drupal\participant_list;

use Drupal\Core\Entity\Sql\SqlContentEntityStorage;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Language\LanguageInterface;
use Drupal\participant_list\Entity\participant_listInterface;

/**
 * Defines the storage handler class for Participant entities.
 *
 * This extends the base storage class, adding required special handling for
 * Participant entities.
 *
 * @ingroup participant_list
 */
class participant_listStorage extends SqlContentEntityStorage implements participant_listStorageInterface {

  /**
   * {@inheritdoc}
   */
  public function revisionIds(participant_listInterface $entity) {
    return $this->database->query(
      'SELECT vid FROM {participant_list_revision} WHERE id=:id ORDER BY vid',
      [':id' => $entity->id()]
    )->fetchCol();
  }

  /**
   * {@inheritdoc}
   */
  public function userRevisionIds(AccountInterface $account) {
    return $this->database->query(
      'SELECT vid FROM {participant_list_field_revision} WHERE uid = :uid ORDER BY vid',
      [':uid' => $account->id()]
    )->fetchCol();
  }

  /**
   * {@inheritdoc}
   */
  public function countDefaultLanguageRevisions(participant_listInterface $entity) {
    return $this->database->query('SELECT COUNT(*) FROM {participant_list_field_revision} WHERE id = :id AND default_langcode = 1', [':id' => $entity->id()])
      ->fetchField();
  }

  /**
   * {@inheritdoc}
   */
  public function clearRevisionsLanguage(LanguageInterface $language) {
    return $this->database->update('participant_list_revision')
      ->fields(['langcode' => LanguageInterface::LANGCODE_NOT_SPECIFIED])
      ->condition('langcode', $language->getId())
      ->execute();
  }

}
