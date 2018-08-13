<?php
namespace Drupal\event\Services;
use Drupal\node\Entity\Node;
use Drupal\Core\Datetime\DrupalDateTime;
use Drupal\Component\Datetime\DateTimePlus;



/**
 * Class EventStatus.
 *
 * @package Drupal\eventstatus
 */
class EventStatus {
  public function getStatus($d) {
    $now = time();
    $event_date = strtotime($d);
    $datediff = $now - $event_date;
    
    $days = round($datediff / (60 * 60 * 24));
    return $days;
  }
}
