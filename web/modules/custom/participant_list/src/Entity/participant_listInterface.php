<?php

namespace Drupal\participant_list\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\RevisionLogInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\Core\Entity\EntityPublishedInterface;

/**
 * Provides an interface for defining Participant entities.
 *
 * @ingroup participant_list
 */
interface participant_listInterface extends ContentEntityInterface, RevisionLogInterface, EntityChangedInterface, EntityPublishedInterface {

  /**
   * Add get/set methods for your configuration properties here.
   */

  /**
   * Gets the Participant name.
   *
   * @return string
   *   Name of the Participant.
   */
  public function getName();

  /**
   * Sets the Participant name.
   *
   * @param string $name
   *   The Participant name.
   *
   * @return \Drupal\participant_list\Entity\participant_listInterface
   *   The called Participant entity.
   */
  public function setName($name);

  /**
   * Gets the Participant creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Participant.
   */
  public function getCreatedTime();

  /**
   * Sets the Participant creation timestamp.
   *
   * @param int $timestamp
   *   The Participant creation timestamp.
   *
   * @return \Drupal\participant_list\Entity\participant_listInterface
   *   The called Participant entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Gets the Participant revision creation timestamp.
   *
   * @return int
   *   The UNIX timestamp of when this revision was created.
   */
  public function getRevisionCreationTime();

  /**
   * Sets the Participant revision creation timestamp.
   *
   * @param int $timestamp
   *   The UNIX timestamp of when this revision was created.
   *
   * @return \Drupal\participant_list\Entity\participant_listInterface
   *   The called Participant entity.
   */
  public function setRevisionCreationTime($timestamp);

  /**
   * Gets the Participant revision author.
   *
   * @return \Drupal\user\UserInterface
   *   The user entity for the revision author.
   */
  public function getRevisionUser();

  /**
   * Sets the Participant revision author.
   *
   * @param int $uid
   *   The user ID of the revision author.
   *
   * @return \Drupal\participant_list\Entity\participant_listInterface
   *   The called Participant entity.
   */
  public function setRevisionUserId($uid);

}
