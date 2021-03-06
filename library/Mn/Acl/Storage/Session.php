<?php

/**
 *
 * @category   Mn
 * @package    Mn_Acl
 * @subpackage Storage
 */

/**
 * @category   Mn
 * @package    MN_Acl
 * @subpackage Storage
 */
class Mn_Acl_Storage_Session implements Mn_Acl_Storage_Interface
{
    /**
     * Default session namespace
     */
    const NAMESPACE_DEFAULT = 'Mn_Acl';

    /**
     * Default session object member name
     */
    const MEMBER_DEFAULT = 'storage';

    /**
     * Object to proxy $_SESSION storage
     *
     * @var Zend_Session_Namespace
     */
    protected $_session;

    /**
     * Session namespace
     *
     * @var mixed
     */
    protected $_namespace;

    /**
     * Session object member
     *
     * @var mixed
     */
    protected $_member;

    /**
     * Sets session storage options and initializes session namespace object
     *
     * @param  mixed $namespace
     * @param  mixed $member
     * @return void
     */
    public function __construct($namespace = self::NAMESPACE_DEFAULT, $member = self::MEMBER_DEFAULT)
    {
        $this->_namespace = $namespace;
        $this->_member    = $member;
        $this->_session   = new Zend_Session_Namespace($this->_namespace);
    }

    /**
     * Returns the session namespace
     *
     * @return string
     */
    public function getNamespace()
    {
        return $this->_namespace;
    }

    /**
     * Returns the name of the session object member
     *
     * @return string
     */
    public function getMember()
    {
        return $this->_member;
    }

    /**
     * Defined by Mn_Acl_Storage_Interface
     *
     * @return boolean
     */
    public function isEmpty()
    {
        return !isset($this->_session->{$this->_member});
    }

    /**
     * Defined by Mn_Acl_Storage_Interface
     *
     * @return mixed
     */
    public function read()
    {
        return $this->_session->{$this->_member};
    }

    /**
     * Defined by Mn_Acl_Storage_Interface
     *
     * @param  mixed $contents
     * @return void
     */
    public function write(Zend_Acl $contents)
    {
        $this->_session->{$this->_member} = $contents;
    }

    /**
     * Defined by Mn_Acl_Storage_Interface
     *
     * @return void
     */
    public function clear()
    {
        unset($this->_session->{$this->_member});
    }
}
