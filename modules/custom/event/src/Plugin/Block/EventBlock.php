<?php

/**
 * @file
 * Contains \Drupal\event\Plugin\Block\EventBlock.
 */
namespace Drupal\event\Plugin\Block;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Session\AccountInterface;


/**
 * Provides a 'article' block.
 *
 * @Block(
 *   id = "event_block",
 *   admin_label = @Translation("Event block"),
 *   category = @Translation("Custom event block example")
 * )
 */

class EventBlock extends BlockBase {
  /**
   * {@inheritdoc}
   */
  public function build() {
    #\Drupal::service('page_cache_kill_switch')->trigger();
    $node = \Drupal::routeMatch()->getParameter('node');
    if ($node instanceof \Drupal\node\NodeInterface) {
        $event_date = $node->get('field_event_date')->getValue();
        $status = \Drupal::service('event.eventstatus')->getStatus($event_date[0]['value']);
                
        if($status == 0):
          $output = 'Event is in progress.';
        elseif($status>0):
          $output = 'The event has ended.';
        elseif($status<0):
          $output = 'Days left to event start: '.abs($status);
        endif;
      
        return array(
          '#type' => 'markup',
          #'#cache'['max-age'] => 0,
          '#markup' => $this->t($output),
        );
    }
    
  }
  
  /**
   * {@inheritdoc}
   */
  public function getCacheMaxAge() {
        return 0;
  }
  
  /**
   * {@inheritdoc}
   */
  protected function blockAccess(AccountInterface $account) {
    return AccessResult::allowedIfHasPermission($account, 'access content');
  }

}
