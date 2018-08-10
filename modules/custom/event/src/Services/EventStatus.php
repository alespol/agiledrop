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
  public function getStatus($n) {
    $node = Node::load($n);
    $w = $node->get('field_event_date')->getValue();
    $now = time();
    $your_date = strtotime($w[0]['value']);
    $datediff = $now - $your_date;
    
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