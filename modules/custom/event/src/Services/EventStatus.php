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
    #$node = Node::load($n);
    #$w = $node->get('field_event_date')->getValue();
    $now = time();
    $event_date = strtotime($d);
    $datediff = $now - $event_date;
    
    $days = round($datediff / (60 * 60 * 24));
    if($days == 0):
        return 'The event is in progress.';
    elseif($days>0):
        return 'The event has ended.';
    elseif($days<0):
        return 'Days left to event start: '.abs($days);
    endif;
  }
}