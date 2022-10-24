<?php

/** Namespace */
namespace iaematt;

/**
 * ReCaptcha.php
 *
 * ReCaptcha
 *
 * @package iaematt\Recaptcha
 * @author Matheus Bastos <matheusbastos@outlook.com>
 * @copyright 2022 Matheus Bastos
 * @version 1.0
 * @link https://github.com/iaematt/recaptcha
 */
class ReCaptcha
{
    /** @var string api url */
    private $api_url = 'https://www.google.com/recaptcha/api/siteverify?secret=%s&response=%s&remoteip=%s';

    /** @var string secret key */
    private $secret_key;

    /** @var string public key */
    private $public_key;

    /** @var string code */
    private $code;

    /**
     * Constructor
     * @param string $secret_key
     * @param string $public_key
     */
    public function __construct(string $secret_key, string $public_key)
    {
        $this->secret_key = $secret_key;
        $this->public_key = $public_key;
    }

    /**
     * Set api url
     * @param string $api_url
     */
    public function setApiUrl(string $api_url)
    {
        $this->api_url = $api_url;
    }

    /**
     * Mount url
     * @return string
     */
    private function mount(): string
    {
        $remote_ip = $_SERVER['REMOTE_ADDR'];
        return sprintf($this->api_url, $this->secret_key, $this->code, $remote_ip);
    }

    /**
     * Check
     * @param string $code
     * @return bool
     */
    public function check(string $code): bool
    {
        $this->code = filter_var($code, FILTER_DEFAULT);

        $response = $this->get();
        if (isset($response->success) && $response->success === true) {
            return true;
        }

        return false;
    }

    /**
     * Get
     * @return null|object
     */
    private function get(): ?object
    {
        $response = file_get_contents($this->mount());
        return json_decode($response);
    }

    /**
     * Import script
     * @return string
     */
    public function importScript(): string
    {
        return '<script src="https://www.google.com/recaptcha/api.js" async defer></script>';
    }

    /**
     * Import captcha div
     * @return string
     */
    public function importCaptcha(): string
    {
        return "<div class=\"g-recaptcha\" data-sitekey=\"{$this->public_key}\"></div>";
    }
}
