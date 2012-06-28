<?php
/**
 * @author  Mesa <mesa@xebro.de>
 * @license http://creativecommons.org/licenses/by-nc-sa/3.0/
 * @link    http://www.xebro.de
 *
 */

/**
 *
 */
class Speicher
{

    protected $ip = array();
    protected $regex = "/^\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}$/";

    public function add ( $ip )
    {
        if ($this->isIp($ip)) {
            if (isset($this->ip[$ip])) {
                $this->ip[$ip]++;
            } else {
                $this->ip[$ip] = 1;
            }
            return true;
        } else {
            return false;
        }
    }

    /**
     * How many times was ip added
     *
     * @param [String] $ip Ip string
     *
     * @return [Int|Boolean] On Error false
     */
    public function getCount ( $ip )
    {
        if ($this->isIp($ip)) {
            if (isset($this->ip[$ip])) {
                return $this->ip[$ip];
            } else {
                return 0;
            }
        } else {
            return false;
        }
    }

    /**
     * Check for valid ip
     *
     * @param [String] $ip Ip
     *
     * @return [Boolean] valid === true
     */
    protected function isIp ( $ip )
    {
        $match_count = preg_match($this->regex, $ip);

        if ($match_count == 0) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Get all added Ips
     *
     * @return [Array] All added Ips
     */
    public function getAll ()
    {
        ksort($this->ip);
        return $this->ip;
    }

}