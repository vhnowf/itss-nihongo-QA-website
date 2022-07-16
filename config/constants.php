<?php
/**
 * Created by Visual Code.
 * User: linhnq.dev@gmail.com
 * Date: 07/11/2019
 * Time: 9:27 AM.
 */
if (!defined('APP_VERSION')) {
    define('APP_VERSION', 'v1.0.0-alpha');
}

if (!defined('PAGE_NUMBER')) {
    define('PAGE_NUMBER', 10);
}

if (!defined('PAGE_NUMBER_MORE')) {
    define('PAGE_NUMBER_MORE', 3);
}

if (!defined('CSS_VERSION')) {
    define('CSS_VERSION', env('CSS_VERSION', '1.0.0'));
}

if (!defined('STATUS_INACTIVE')) {
    define('STATUS_INACTIVE', 'inactive');
}

if (!defined('STATUS_ACTIVE')) {
    define('STATUS_ACTIVE', 'active');
}

if (!defined('STATUS_VERIFY')) {
    define('STATUS_VERIFY', 'verify');
}

if (!defined('STATUS_DISABLE')) {
    define('STATUS_DISABLE', 'disable');
}

if (!defined('STATUS_INACTIVE')) {
    define('STATUS_INACTIVE', 'inactive');
}

if (!defined('STATUS_PUBLIC')) {
    define('STATUS_PUBLIC', 'public');
}

if (!defined('STATUS_DRAFT')) {
    define('STATUS_DRAFT', 'draft');
}

if (!defined('STATUS_PRIVATE')) {
    define('STATUS_PRIVATE', 'private');
}

if (!defined('STATUS_NEW')) {
    define('STATUS_NEW', 'new');
}

if (!defined('STATUS_CHANGED')) {
    define('STATUS_CHANGED', 'changed');
}

if (!defined('STATUS_ORDER')) {
    define('STATUS_ORDER', 'order');
}
if (!defined('STATUS_PROCESSING')) {
    define('STATUS_PROCESSING', 'processing');
}
if (!defined('STATUS_CANCEL')) {
    define('STATUS_CANCEL', 'cancel');
}

if (!defined('STATUS_PAID')) {
    define('STATUS_PAID', 'paid');
}

if (!defined('STATUS_DELIVERY')) {
    define('STATUS_DELIVERY', 'delivery');
}

if (!defined('STATUS_RECEIVE')) {
    define('STATUS_RECEIVE', 'receive');
}

if (!defined('STATUS_FINISH')) {
    define('STATUS_FINISH', 'finish');
}

if (!defined('STATUS_ERROR_404')) {
    define('STATUS_ERROR_404', 404);
}

if (!defined('STATUS_ERROR_500')) {
    define('STATUS_ERROR_500', 500);
}

if (!defined('DELAY_TIME')) {
    define('DELAY_TIME', 10);
}
