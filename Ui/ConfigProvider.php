<?php

namespace Gg2\AuthorizenetVisa\Ui;

use Gg2\AuthorizenetVisa\Gateway\Config;
use Magento\Checkout\Model\ConfigProviderInterface;
use Magento\Checkout\Model\Session;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\UrlInterface;
use Magento\Framework\View\Asset\Repository;
use Magento\Quote\Model\Quote;

class ConfigProvider implements ConfigProviderInterface
{

    /**
     * @var Config
     */
    private $config;
    /**
     * @var UrlInterface
     */
    private $url;
    /**
     * @var RequestInterface
     */
    private $request;
    /**
     * @var Repository
     */
    private $repository;
    /**
     * @var Quote
     */
    private $quote;

    public function __construct(Config $config, UrlInterface $url, RequestInterface $request, Session $session)
    {
        $this->config = $config;
        $this->url = $url;
        $this->request = $request;
        $this->quote = $session->getQuote();
    }

    public function getConfig()
    {
        $visaCheckoutButtonSrc = $this->config->getCheckoutButtonSrc() . '?cardBrands=VISA,MASTERCARD,DISCOVER,AMEX';
        return [
            'payment' => [
                'gg2_authorizenetvisa' => [
                    'title'                       => $this->config->getTitle(),
                    'sdkUrl'                      => $this->config->getSdkUrl(),
                    'paymentCardSrc'              => $this->config->getPaymentCardSrc(),
                    'visaCheckoutButtonSrc'       => $visaCheckoutButtonSrc,
                    'visaCheckoutInitialSettings' => [
                        'apiKey' => $this->config->getApiKey(),
                        'sourceId' => $this->config->getMerchantSourceId(),
                        'settings' => []
                    ]
                ]
            ]
        ];
    }

    public function getLogoUrl()
    {
        return $this->getViewFileUrl('images/logo.png');
    }


}
