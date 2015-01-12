<?php
/**
 * This file is part of fuel-requester package.
 */
namespace Requester;

class Requester
{
    /**
     * Configuration from app/config/requester.php
     * @var array $_config
     */
    private $_config;

    /**
     * Constructor
     */
    public function __construct($config = array())
    {
        $this->_config = \Config::get(strtolower(__NAMESPACE__));
        if (is_array($config)) {
            $this->_config = \Arr::merge($this->_config, $config);
        } else {
            $this->_config['endpoint'] = (string)$config;
        }
    }

    /**
     * POST Request method.
     *
     * @param string $uri
     * @param array $values
     * @return \Response
     */
    public function post($uri, array $values=array())
    {
        return $this->_request('post', $uri, $values);
    }

    /**
     * PUT Request method.
     *
     * @param string $uri
     * @param array $values
     * @return \Response
     */
    public function put($uri, array $values=array())
    {
        return $this->_request('put', $uri, $values);
    }

    /**
     * GET Request method.
     *
     * @param string $uri
     * @param array $values
     * @return \Response
     */
    public function get($uri, array $values=array())
    {
        return $this->_request('get', $uri, $values);
    }

    /**
     * DELETE Request method.
     *
     * @param string $uri
     * @param array $values
     * @return \Response
     */
    public function delete($uri, array $values=array())
    {
        return $this->_request('delete', $uri, $values);
    }

    /**
     * Abstracted request method.
     *
     * @param string $method
     * @param string $uri
     * @param array $values
     * @return \Response
     */
    private function _request($method, $uri, array $values)
    {
        try {
            $req = \Request::forge($this->_config['endpoint'] . $uri, 'curl', $method);
            $req->set_options(array(CURLOPT_HEADER => true));
            return $req->execute($values)->response();
        } catch (\RequestStatusException $e) {
            return $req->response();
        }
    }
}
