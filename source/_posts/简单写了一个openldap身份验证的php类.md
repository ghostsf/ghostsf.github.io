title: 简单写了一个openldap身份验证的php类
categories: 技术栈
tags: [ldap]
date: 2016-04-09 03:47:29
---
    <?php
    
    /**
     * simple class for LDAP authentification
     *
     * Created by ghostsf
     * Date: 2016/4/9
     */
    class openldap
    {
        protected $ldap_host;
        protected $ldap_port;
        protected $ldap_user;
        protected $ldap_pwd;
        protected $base_dn;
        protected $ldap;
        protected $filterattr = "uid";
        protected $userinfo;
    
        /**
         * Exeptions code constants
         */
        const ERROR_WRONG_USERDN = 4;
        const ERROR_CANT_AUTH = 5;
        const ERROR_CANT_SEARCH = 3;
        const ERROR_CANT_LDAP_BIND = 2;
        const ERROR_CANT_CONNECT = 0;
        const ERROR_CANT_DISCONNECT = 1;
        const SUCCESS_INIT = -1;
        const SUCCESS_AUTH = 6;
    
        /**
         * __construct
         * openldap constructor.
         * @param $ldap_host
         * @param $ldap_port
         * @param $ldap_user
         * @param $ldap_pwd
         * @param $base_dn
         */
        function __construct($ldap_host, $ldap_port, $ldap_user, $ldap_pwd, $base_dn)
        {
            $this->ldap_host = $ldap_host;
            $this->ldap_port = $ldap_port;
            $this->ldap_user = $ldap_user;
            $this->ldap_pwd = $ldap_pwd;
            $this->base_dn = $base_dn;
        }
    
        /**
         * init_connection
         * @return int
         */
        protected function init_connection()
        {
            $this->ldap = ldap_connect($this->ldap_host, $this->ldap_port);
            if ($this->ldap) {
                ldap_set_option($this->ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
                ldap_set_option($this->ldap, LDAP_OPT_REFERRALS, 0);
                $ldap_bind = ldap_bind($this->ldap, $this->ldap_user, $this->ldap_pwd);
                if ($ldap_bind)
                    return self::SUCCESS_INIT;
                else
                    return self::ERROR_CANT_LDAP_BIND;
            } else
                return self::ERROR_CANT_CONNECT;
    
        }
    
        /**
         * authenticate
         * @param null $user
         * @param null $password
         * @return int
         */
        public function authenticate($user = null, $password = null)
        {
            $returnCode = $this->init_connection();
            if ($returnCode != self::SUCCESS_INIT) {
                return $returnCode;
            }
            $filter = $this->filterattr . "=" . $user;
            $result = ldap_search($this->ldap, $this->base_dn, $filter);
            $entry = ldap_get_entries($this->ldap, $result);
            $count = $entry['count'];
            if ($count != 0) {
                $entry = $entry[0];
                $userdn = $entry['dn'];
                if ($userdn != null) {
                    $r = ldap_bind($this->ldap, $userdn, $password);
                    if ($r) {
                        $name = $entry['displayname'][0];
                        $this->userinfo['name'] = $name;
                        $email = $entry['mail2'][0];
                        $this->userinfo['email'] = $email;
                        ldap_unbind($this->ldap);
                        return self::SUCCESS_AUTH;
                    }
                    ldap_unbind($this->ldap);
                    return self::ERROR_CANT_AUTH;
                }
                return self::ERROR_WRONG_USERDN;
            }
            return self::ERROR_CANT_SEARCH;
        }
    
        /**
         * getUserinfo
         * @return mixed
         */
        public function getUserinfo()
        {
            return $this->userinfo;
        }
    }

分享给大家咯～

