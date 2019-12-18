<?php

namespace Drupal\participant_list;

use Drupal\Core\Entity\ContentEntityStorageInterface;
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
interface participant_listStorageInterface extends ContentEntityStorageInterface {

  /**
   * Gets a list of Participant revision IDs for a specific Participant.
   *
   * @param \Drupal\participant_list\Entity\participant_listInterface $entity
   *   The Participant entity.
   *
   * @return int[]
   *   Participant revision IDs (in ascending order).
   */
  public function revisionIds(participant_listInterface $entity);

  /**
   * Gets a list of revision IDs having a given user as Participant author.
   *
   * @param \Drupal\Core\Session\AccountInterface $account
   *   The user entity.
   *
   * @return int[]
   *   Participant revision IDs (in ascending order).
   */
  public function userRevisionIds(AccountInterface $account);

  /**
   * Counts the number of revisions in the default language.
   *
   * @param \Drupal\participant_list\Entity\participant_listInterface $entity
   *   The Participant entity.
   *
   * @return int
   *   The number of revisions in the default language.
   */
  public function countDefaultLanguageRevisions(participant_listInterface $entity);

  /**
   * Unsets the language for all Participant with the given language.
   *
   * @param \Drupal\Core\Language\LanguageInterface $language
   *   The language object.
   */
  public function clearRevisionsLanguage(LanguageInterface $language);

}
