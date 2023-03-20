<?php

$order = wc_get_order($order_id);
$order_data = array(
    'order_id' => $order->get_id(),
    'order_number' => $order->get_order_number(),
    'order_date' => date('Y-m-d H:i:s', strtotime(get_post($order->get_id())->post_date)),
    'status' => $order->get_status(),
    'shipping_total' => $order->get_total_shipping(),
    'shipping_tax_total' => wc_format_decimal($order->get_shipping_tax(), 2),
    'fee_total' => wc_format_decimal($fee_total, 2),
    'fee_tax_total' => wc_format_decimal($fee_tax_total, 2),
    'tax_total' => wc_format_decimal($order->get_total_tax(), 2),
    'cart_discount' => (defined('WC_VERSION') && (WC_VERSION >= 2.3)) ? wc_format_decimal($order->get_total_discount(), 2) : wc_format_decimal($order->get_cart_discount(), 2),
    'order_discount' => (defined('WC_VERSION') && (WC_VERSION >= 2.3)) ? wc_format_decimal($order->get_total_discount(), 2) : wc_format_decimal($order->get_order_discount(), 2),
    'discount_total' => wc_format_decimal($order->get_total_discount(), 2),
    'order_total' => wc_format_decimal($order->get_total(), 2),
    'order_currency' => $order->get_currency(),
    'payment_method' => $order->get_payment_method(),
    'shipping_method' => $order->get_shipping_method(),
    'customer_id' => $order->get_user_id(),
    'customer_user' => $order->get_user_id(),
    'customer_email' => ($a = get_userdata($order->get_user_id() )) ? $a->user_email : '',
    'billing_first_name' => $order->get_billing_first_name(),
    'billing_last_name' => $order->get_billing_last_name(),
    'billing_company' => $order->get_billing_company(),
    'billing_email' => $order->get_billing_email(),
    'billing_phone' => $order->get_billing_phone(),
    'billing_address_1' => $order->get_billing_address_1(),
    'billing_address_2' => $order->get_billing_address_2(),
    'billing_postcode' => $order->get_billing_postcode(),
    'billing_city' => $order->get_billing_city(),
    'billing_state' => $order->get_billing_state(),
    'billing_country' => $order->get_billing_country(),
    'shipping_first_name' => $order->get_shipping_first_name(),
    'shipping_last_name' => $order->get_shipping_last_name(),
    'shipping_company' => $order->get_shipping_company(),
    'shipping_address_1' => $order->get_shipping_address_1(),
    'shipping_address_2' => $order->get_shipping_address_2(),
    'shipping_postcode' => $order->get_shipping_postcode(),
    'shipping_city' => $order->get_shipping_city(),
    'shipping_state' => $order->get_shipping_state(),
    'shipping_country' => $order->get_shipping_country(),
    'customer_note' => $order->get_customer_note(),
    'download_permissions' => $order->is_download_permitted() ? $order->is_download_permitted() : 0,
);