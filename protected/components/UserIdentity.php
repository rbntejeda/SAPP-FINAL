<?php
class UserIdentity extends CUserIdentity 
{
    private $_id;
    public function authenticate()
    {
        $user=UsuLogin::model()->findByAttributes(array('username'=>$this->username));
        if($user===null)
            $this->errorCode=self::ERROR_USERNAME_INVALID;
        else if(!$user->validatePassword($this->password))
            $this->errorCode=self::ERROR_PASSWORD_INVALID;
        else
        {
            $this->_id=$user->username;
            $this->username=$user->PER_ROLE;
            $this->setState('role', $user->PER_ROLE);
            $this->setState('nombre',$user->PER_NOMBRE);
            $this->setState('carrera',$user->CAR_CODIGO);
            $this->setState('ID',$user->PER_ID);
            $this->errorCode=self::ERROR_NONE;
        }
        return $this->errorCode==self::ERROR_NONE;
    }
    
    public function getId()
    {
        return $this->_id;
    }
}