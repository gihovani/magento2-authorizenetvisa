<?php

namespace Gg2\AuthorizenetVisa\Gateway;

use Magento\Framework\Exception\NotFoundException;
use Magento\Payment\Gateway\Config\ValueHandlerPool;

class Config
{
    /**
     * @var ValueHandlerPool
     */
    private $valueHandlerPool;

    public function __construct(ValueHandlerPool $valueHandlerPool)
    {
        $this->valueHandlerPool = $valueHandlerPool;
    }

    public function getSdkUrl()
    {
        if ($this->isSandbox()) {
            return (string)$this->getValue('sdk_url_sandbox');
        }
        return (string)$this->getValue('sdk_url');
    }

    public function isSandbox()
    {
        return (bool)$this->getValue('is_sandbox');
    }

    public function getCheckoutButtonSrc()
    {
        if ($this->isSandbox()) {
            return (string)$this->getValue('checkout_button_src_sandbox');
        }
        return (string)$this->getValue('checkout_button_src');
    }

    public function getPaymentCardSrc()
    {
        return (string)$this->getValue('payment_card_src');
    }

    public function getTitle()
    {
        return (string)$this->getValue('title');
    }

    public function getMerchantSourceId()
    {
        return (string)$this->getValue('merchant_source_id');
    }

    public function getApiKey()
    {
        if ($this->isSandbox()) {
            return (string)$this->getValue('api_key_sandbox');
        }
        return (string)$this->getValue('api_key');
    }

    public function getReviewMessage()
    {
        return (string)$this->getValue('review_message');
    }

    public function getButtonActionTitle()
    {
        return (string)$this->getValue('button_action_title');
    }

    public function isCollectShipping()
    {
        return (string)$this->getValue('is_collect_shipping');
    }

    public function getDisplayName()
    {
        return (string)$this->getValue('display_name');
    }

    private function getValue($field)
    {
        try {
            $handler = $this->valueHandlerPool->get($field);
            return $handler->handle(['field' => $field]);
        } catch (NotFoundException $exception) {
            return null;
        }
    }
}
