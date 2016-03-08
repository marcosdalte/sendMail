<?php
/**
 * 
 * Namespace contendo uma camada de negocio especifica para
 * autenticação de usuario
 * 
 * @class Auth
 * 
 */
namespace Application\Backend\Business\Auth {
    use Core\Controller;
    use Core\DAO\Transaction;
    use Core\Util;
    use Application\Backend\Model\User;
    use \Exception as Exception;
    /**
     * 
     * Classe especifica para efetuar autenticão de usuário
     * 
     * Contem as seguintes contantes,
     * utilizadas para dar nome aos cookies
     * 
     * @const COOKIE_USERNAME string
     * @const COOKIE_HASH string
     * 
     * Contem as seguintes propriedades
     * @var $db_transaction object
     * @var $username string
     * @var $password string
     * @var $user object
     * 
     * No construtor é recebido uma "Variadic"
     * onde é esperado os dados para username e password
     * 
     * @return void
     * 
     */
    class Auth {
        const COOKIE_USERNAME = 'username';
        const COOKIE_HASH = 'hash';

        private $db_transaction;
        private $username;
        private $password;
        private $user;

        public function __construct(...$kwargs) {
            if (!empty($kwargs)) {
                $kwargs = $kwargs[0];
            }

            $this->db_transaction = new Transaction();
            
            $username = Util::get($kwargs,'username',null);
            $this->setUsername($username);

            $password = Util::get($kwargs,'password',null);
            $this->setPassword($password);
        }
        /**
         * 
         * Inicia a validação de dados do usuário
         * 
         * Retorna um dicionario de dados contendo
         * os dados do usuario.
         * 
         * @return $cookie dict
         * 
         */
        public function init() {
            $this->getAuth();
            $cookie = $this->setCookie();
            
            return $cookie;
        }
        
        private function getUser() {
            return $this->user;
        }
        
        private function setUser($user) {
            $this->user = $user;
        }
        
        private function getUsername() {
            return $this->username;
        }
        
        private function setUsername($username) {
            $this->username = $username;
        }
        
        private function getPassword() {
            return $this->password;
        }
        
        private function setPassword($password) {
            $this->password = $password;
        }
        /**
         * 
         * Efetua a consulta de usuario no model User
         * Em caso de erro, retorna uma exceção coma mensagem de eror
         * 
         * @return void
         * 
         */
        private function getAuth() {
            $user = new User($this->db_transaction);
            
            try {
                $this->db_transaction->connect();

                $username = $this->getUsername();
                $password = $this->getPassword();

                $user->get([
                    'username' => $username,
                    'password' => $password]);

            } catch (Exception $error) {
                throw new Exception($error->getMessage());
            }

            $this->setUser($user);
            
            return $this;
        }
        /**
         * 
         * Retorna os dados de cookie
         * 
         * @return dict
         * 
         */
        public function getCookie() {
            return [
                self::COOKIE_USERNAME => $_COOKIE[self::COOKIE_USERNAME],
                self::COOKIE_HASH => $_COOKIE[self::COOKIE_HASH]];
        }
        /**
         * 
         * Cria e retorna os cookie
         * Caso ja exista os cookie, os retorna, sem reescrita
         * 
         * @return $cookie dict
         * 
         */
        private function setCookie() {
            $cookie = $this->getCookie();

            if (empty($cookie[self::COOKIE_USERNAME]) || empty($cookie[self::COOKIE_HASH])) {
                $user = $this->getUser($user);

                setcookie(self::COOKIE_USERNAME,$user->username,time() + 60);
                setcookie(self::COOKIE_HASH,md5($user->password),time() + 60);
                
                $cookie = [
                    self::COOKIE_USERNAME => $user->username,
                    self::COOKIE_HASH => md5($user->password)];
            }

            return $cookie;
        }
        /**
         * 
         * Este metodo limpa os cookies
         * 
         * @return true
         * 
         */
        public function clearCookie() {
            setcookie(self::COOKIE_USERNAME,'',0);
            setcookie(self::COOKIE_HASH,'',0);
            
            return true;
        }
    }
}