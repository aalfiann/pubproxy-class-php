<?php 
namespace aalfiann;
    /**
     * PubProxy class
     *
     * @package    PubProxy Class
     * @author     M ABD AZIZ ALFIAN <github.com/aalfiann>
     * @copyright  Copyright (c) 2018 M ABD AZIZ ALFIAN
     * @license    https://github.com/aalfiann/pubproxy-class-php/blob/master/LICENSE.md  MIT License
     */
    class PubProxy {

        protected $service = 'http://pubproxy.com/api/proxy';

        /**
         * PubProxy options
         * 
         * @var api = Make unlimited proxy requests.
         * @var level = Anonymity level (anonymous and elite).
         * @var type = Proxy protocol (socks4, socks5 and http).
         * @var last_check = Minutes the proxy was last checked (1-1000).
         * @var speed = How many seconds it takes for the proxy to connect (1-60 in seconds).
         * @var limit = How many proxies to list. Default is 5.
         * @var country = Country of the proxy (input multiple with separated commas).
         * @var not_country = Avoid proxy countries (input multiple with separated commas).
         * @var port = Proxies with a specific port (input multiple with separated commas).
         * @var google = Google passed proxies.
         * @var https = Proxies which is supports HTTPS request.
         * @var post = Proxies which is supports POST request.
         * @var user_agent = Proxies which is supports USER_AGENT request.
         * @var cookies = Proxies which is supports COOKIES request.
         * @var referer = Proxies which is supports REFERER request.
         */
        var $api='',$level='',$type='',$country='',$not_country='',$port='',
            $google='',$https='',$post='',$user_agent='',$cookies='',$referer='',
            $limit=5,$last_check=0,$speed=0;

        /**
         * Feature options
         * 
         * @var refresh = This will cache the proxy. Default is 1800 seconds (every 30minutes proxy will refresh automatically).
         * @var dircache = To set directory location without change the default filename cache. Default is "cache-proxy".
         * @var filepath = To create custom file cache. Default is "cache-proxy/{{md5}}.cache".
         * @var response = Is the temporary json proxy variable.
         * @var resultArray = Is the data array converted from response.
         */
        var $refresh=1800,$dircache='',$filepath='',$response,$resultArray=null;

        /**
         * Set Limit
         * @param limit = The limit number to show proxies from PubProxy. Default is 5.
         * @return this
         */
        public function setLimit($limit=5){
            if(!empty($limit)) {
                if ($limit < 1) $limit = 1;
                if ($limit > 5) $limit = 5;
                $this->limit = $limit;
            }
            return $this;
        }

        /**
         * Set Api
         * @param api = Premium user have Api code to make unlimited proxy requests.
         * @return this
         */
        public function setApi($api=''){
            if(!empty($api)) $this->api = $api;
            return $this;
        }

        /**
         * Set Type
         * @param type = Proxy protocol (socks4, socks5 and http).
         * @return this
         */
        public function setType($type=''){
            switch (strtolower($type)){
                case 'socks4':
                    $this->type = 'socks4';
                    break;
                case 'socks5':
                    $this->type = 'socks5';
                    break;
                case 'http':
                    $this->type = 'http';
                    break;
                default:
                    $this->type = '';
            }
            return $this;
        }

        /**
         * Set Level
         * @param level = Anonymity level (anonymous and elite).
         * @return this
         */
        public function setLevel($level=''){
            switch (strtolower($level)){
                case 'anonymous':
                    $this->level = 'anonymous';
                    break;
                case 'elite':
                    $this->level = 'elite';
                    break;
                default:
                    $this->level = '';
            }
            return $this;
        }

        /**
         * Set Last Check
         * @param last_check = Minutes the proxy was last checked (1-1000).
         * @return this
         */
        public function setLastCheck($last_check=0){
            if(!empty($last_check) && $last_check > 0) {
                if ($last_check > 1000) $last_check = 1000;
                $this->last_check = $last_check;
            }
            return $this;
        }

        /**
         * Set Speed
         * @param speed = How many seconds it takes for the proxy to connect (1-60 in seconds).
         * @return this
         */
        public function setSpeed($speed=0){
            if(!empty($speed) && $speed > 0) {
                if ($speed > 60) $speed = 60;
                $this->speed = $speed;
            }
            return $this;
        }

        /**
         * Set Country
         * @param country = Country of the proxy (input multiple with separated commas).
         * @return this
         */
        public function setCountry($country=''){
            if(!empty($country)) $this->country = $country;
            return $this;
        }

        /**
         * Set Not Country
         * @param not_country = Avoid proxy countries (input multiple with separated commas).
         * @return this
         */
        public function setNotCountry($not_country=''){
            if(!empty($not_country)) $this->not_country = $not_country;
            return $this;
        }

        /**
         * Set Port
         * @param port = Proxies with a specific port (input multiple with separated commas).
         * @return this
         */
        public function setPort($port=''){
            if(!empty($port)) $this->port = $port;
            return $this;
        }

        /**
         * Set Google
         * @param google = Google passed proxies.
         * @return this
         */
        public function setGoogle($google=''){
            if(is_bool($google)) $google = var_export($google,true);
            switch (strtolower($google)){
                case 'true':
                    $this->google = 'true';
                    break;
                case 'false':
                    $this->google = 'false';
                    break;
                default:
                    $this->google = '';
            }
            return $this;
        }

        /**
         * Set Https
         * @param https = Proxies which is supports HTTPS request.
         * @return this
         */
        public function setHttps($https=''){
            if(is_bool($https)) $https = var_export($https,true);
            switch (strtolower($https)){
                case 'true':
                    $this->https = 'true';
                    break;
                case 'false':
                    $this->https = 'false';
                    break;
                default:
                    $this->https = '';
            }
            return $this;
        }

        /**
         * Set Post
         * @param post = Proxies which is supports POST request.
         * @return this
         */
        public function setPost($post=''){
            if(is_bool($post)) $post = var_export($post,true);
            switch (strtolower($post)){
                case 'true':
                    $this->post = 'true';
                    break;
                case 'false':
                    $this->post = 'false';
                    break;
                default:
                    $this->post = '';
            }
            return $this;
        }

        /**
         * Set User_agent
         * @param user_agent = Proxies which is supports USER_AGENT request.
         * @return this
         */
        public function setUserAgent($user_agent=''){
            if(is_bool($user_agent)) $user_agent = var_export($user_agent,true);
            switch (strtolower($user_agent)){
                case 'true':
                    $this->user_agent = 'true';
                    break;
                case 'false':
                    $this->user_agent = 'false';
                    break;
                default:
                    $this->user_agent = '';
            }
            return $this;
        }

        /**
         * Set Cookies
         * @param cookies = Proxies which is supports COOKIES request.
         * @return this
         */
        public function setCookies($cookies=''){
            if(is_bool($cookies)) $cookies = var_export($cookies,true);
            switch (strtolower($cookies)){
                case 'true':
                    $this->cookies = 'true';
                    break;
                case 'false':
                    $this->cookies = 'false';
                    break;
                default:
                    $this->cookies = '';
            }
            return $this;
        }

        /**
         * Set Referer
         * @param referer = Proxies which is supports REFERER request.
         * @return this
         */
        public function setReferer($referer=''){
            if(is_bool($referer)) $referer = var_export($referer,true);
            switch (strtolower($referer)){
                case 'true':
                    $this->referer = 'true';
                    break;
                case 'false':
                    $this->referer = 'false';
                    break;
                default:
                    $this->referer = '';
            }
            return $this;
        }

        /**
         * Set Refresh
         * @param refresh = This will cache the proxy. Default is 1800 seconds (every 10minutes proxy will refresh automatically).
         * @return this
         */
        public function setRefresh($refresh=1800){
            if(!empty($refresh)) $this->refresh = $refresh;
            return $this;
        }

        /**
         * Set Dir Cache
         * @param dircache = To set directory location without change the default filename cache. Default is "cache-proxy".
         * @return this
         */
        public function setDirCache($dircache=''){
            if(!empty($dircache)) $this->dircache = rtrim($dircache,'/');
            return $this;
        }

        /**
         * Set Filepath
         * @param filepath = To create custom file cache. Default is "cache-proxy/{{md5}}.cache".
         * @return this
         */
        public function setFilepath($filepath=''){
            if(!empty($filepath)) $this->filepath = rtrim($filepath,'/');
            return $this;
        }

        /**
         * Get Url
         * @return string url to PubProxy
         */
        public function getUrl(){
            $url = $this->service.'?limit='.$this->limit;
            if(!empty($this->api)) $url .= '&api='.$this->api;
            if(!empty($this->type)) $url .= '&type='.$this->type;
            if(!empty($this->level)) $url .= '&level='.$this->level;
            if(!empty($this->last_check) && $this->last_check > 0) $url .= '&last_check='.$this->last_check;
            if(!empty($this->speed) && $this->speed > 0) $url .= '&speed='.$this->speed;
            if(!empty($this->country)) $url .= '&country='.$this->country;
            if(!empty($this->not_country)) $url .= '&amp;not_country='.$this->not_country;
            if(!empty($this->port)) $url .= '&port='.$this->port;
            if(!empty($this->google)) $url .= '&google='.(is_bool($this->google)?var_export($this->google,true):$this->google);
            if(!empty($this->https)) $url .= '&https='.(is_bool($this->https)?var_export($this->https,true):$this->https);
            if(!empty($this->post)) $url .= '&post='.(is_bool($this->post)?var_export($this->post,true):$this->post);
            if(!empty($this->user_agent)) $url .= '&user_agent='.(is_bool($this->user_agent)?var_export($this->user_agent,true):$this->user_agent);
            if(!empty($this->cookies)) $url .= '&cookies='.(is_bool($this->cookies)?var_export($this->cookies,true):$this->cookies);
            if(!empty($this->referer)) $url .= '&referer='.(is_bool($this->referer)?var_export($this->referer,true):$this->referer);
            return $url;
        }

        /**
         * Get Filepath
         * @return string filepath of cache
         */
        public function getFilepath(){
            if (!empty($this->filepath)) return strtolower($this->filepath);
            if (!empty($this->dircache)) {
                return $this->dircache.DIRECTORY_SEPARATOR.strtolower(md5($this->getUrl())).'.cache';    
            }
            return 'cache-proxy'.DIRECTORY_SEPARATOR.strtolower(md5($this->getUrl())).'.cache';
        }

        /**
         * Send a request proxy to PubProxy
         * @return json response 
         */
        public function requestProxy(){
            if($this->isHit()){
                return $this->fetch();
            } else {
                $url = $this->getUrl();
                // Open connection
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_ENCODING, 'UTF-8');
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
                // Execute post
                $result = curl_exec($ch);
                // Close connection
                curl_close($ch);
                // Saving content
                $json = json_decode($result);
                if (!empty($json)) $this->write($result);
                return $result;
            }
        }

        /**
         * Make process to get proxy list response
         * @return this
         */
        public function make(){
            $this->response = $this->requestProxy();
            if (!empty($this->response)) $this->resultArray = json_decode($this->response, true);
            return $this;
        }

        /**
         * Get response as json format
         * @return json
         */
        public function getJson(){
            header('Content-Type: application/json');
            if (!empty($this->response)) return $this->response;
            return null;
        }

        /**
         * Get response as text/plain
         * @return text
         */
        public function getText(){
            header('Content-Type: text/plain');
            if (!empty($this->resultArray["data"]) && is_array($this->resultArray["data"])){
                $i = 0;
                foreach($this->resultArray["data"] as $key => $value){
                    echo $this->resultArray["data"][$key]['ipPort'];
                    if(++$i !== $this->resultArray["count"]) echo "\n";
                }
            }
            return null;
        }

        /**
         * Get single proxy (ip:port)
         * Note: This also make proxy rotate automatically, so set limit to 5 to get best performance.
         * @return string
         */
        public function getProxy(){
            if (!empty($this->resultArray["data"]) && is_array($this->resultArray["data"])){
                return $this->resultArray["data"][mt_rand(0, count($this->resultArray["data"]) - 1)]['ipPort'];
            }
            return null;
        }

        /**
         * Check the cached proxy list is still valid or not
         * @return bool
         */
        public function isHit() {
            if ($this->refresh > 0){
                $file = $this->getFilepath();
                // check the expired file cache.
                $mtime = 0;
                if (file_exists($file)){
                    $mtime = filemtime($file);
                }
                $filetimemod = $mtime + $this->refresh;
                // if the renewal date is smaller than now, return true (no need for update)
                if ($filetimemod < time()){
                    return false;
                }
            } else {
                return false;
            }
            return true;
        }

        /**
         * Fetch the cached proxy list
         * @return json
         */
        public function fetch() {
            $file = $this->getFilepath();
            if (file_exists($file)){
                return file_get_contents($file);
            }
            return '';
        }

        /**
         * Write proxy list data to file cache.
         */
        public function write($content) {
            if ($this->refresh > 0){
                $file = $this->getFilepath();
                if(!file_exists(dirname($file))) mkdir(dirname($file), 0777, true);
                file_put_contents($file, $content, LOCK_EX);
            }
        }

        /**
         * Clear the file cache
         * @return bool
         */
        public function clear(){
            $file = $this->getFilepath();
            if (file_exists($file)){
                return unlink($file);
            }
            return false;
        }
    }