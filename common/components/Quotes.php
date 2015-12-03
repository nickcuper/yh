<?php

/**
 * Class Quotes
 */
class Quotes extends CApplicationComponent
{
    /**
     * Set mod request
     * CURL or SOAP.
     *
     * @var string $mode
     */
    public $mode = '';

    /**
     * Set responce format
     * JSON or XML.
     *
     * @var string $format
     */
    public $format = '';

    /**
     * List of quotes.
     *
     * @var array $result
     */
    private $result = [];

    /**
     * Api url.
     *
     * @var string $_apiUrl
     */
    protected $_apiUrl = 'http://finance.yahoo.com/webservice/v1/symbols/allcurrencies/quote';

    /**
     * Return responce.
     *
     * @return array
     */
    public function call()
    {
        if ($this->mode == 'CURL')
            $this->curlMode();
        else $this->soapMode();

        return $this->result;
    }

    /**
     * Use CURL for get quotes.
     */
    protected function curlMode()
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $this->getUrl());
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, false);
        $data = curl_exec($curl);
        curl_close($curl);

        $this->_handlerResponse($data);
    }

    /**
     * Use SOAP protocol for get quotes.
     *
     * @todo need research
     */
    protected function soapMode()
    {
        throw new CException('Not implemented yet');
    }

    /**
     * @return string
     */
    protected function getUrl()
    {
        return $this->_apiUrl . '?' . http_build_query([
                'format' => $this->format
            ]);
    }

    /**
     * Decode responce to array.
     *
     * @param string $data
     */
    protected function _handlerResponse($data = '')
    {
        if ($data) {
            $quotes = CJSON::decode($data);
            // @todo Need checked list
            if ($quotes['list']['meta']['count']) {
                $resources = array_column($quotes['list']['resources'],'resource');
                foreach ($resources as $resource)  {
                    // Sometime $resource have keys 'change', 'chg_percent'
                    $resource['fields']['classname'] = $resource['classname'];
                    $this->result[] = $resource['fields'];
                }
            }
        }
    }
}
