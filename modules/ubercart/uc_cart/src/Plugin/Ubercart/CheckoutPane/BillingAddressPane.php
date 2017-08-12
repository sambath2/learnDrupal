<?php

namespace Drupal\uc_cart\Plugin\Ubercart\CheckoutPane;

/**
 * Gets the user's billing address.
 *
 * @CheckoutPane(
 *   id = "billing",
 *   title = @Translation("Billing information"),
 *   weight = 4
 * )
 */
class BillingAddressPane extends AddressPaneBase {



  /**
   * {@inheritdoc}
   */
  protected function getDescription() {
    return $this->t('Please fill out the <b>required(*)</b> information below.');
  }

  /**
   * {@inheritdoc}
   */
  protected function getCopyAddressText() {
    return $this->t('My billing information is the same as my delivery information.');
  }

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    return [
      'default_same_address' => FALSE,
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function settingsForm() {
    $form['default_same_address'] = array(
      '#type' => 'none',
      '#title' => $this->t('Use the same address for billing and delivery by default.'),
      '#default_value' => $this->configuration['default_same_address'],
    );
    return $form;
  }

}
