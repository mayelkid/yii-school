<?php
namespace common\models;

use Yii;
use backend\models\Teacher;
use backend\models\School;
use common\models\Admin;
/**
 * Login form
 */
class AdminForm extends \yii\base\Model
{
    public $username;
    public $password;
    public $rememberMe = true;

    private $_user = false;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'username'   => '管理员账号',
            'password'   => '管理员密码',
            'rememberMe' => '记住登录',
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, Yii::t('app', 'Incorrect username or password.'));
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return boolean whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        } else {
            return false;
        }
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
			$user = Admin::findByUsername($this->username);	
			if($user == false){
				if($users = Teacher::findByUsername($this->username)){
					\backend\models\Admin::addAdmin(['username'=>$users['phone'],'password'=>'123456','repassword'=>'123456','email'=>$users['email'],'status'=>'10','role'=>'admin','face'=>'']);
					//print_r(['username'=>$users['phone'],'password'=>'123456','role'=>'teacher']);exit('waw');
					$this->_user = Admin::findByUsername($this->username);		
				}else{
					$this->_user = $user;					
				}				
			}else{
				$this->_user = $user;
			}
			/*
			if($this->_user = Admin::findByUsername($this->username) == false){
				//$this->_user = Teacher::findTeacherByUsername($this->username);
				//admin::addadmin($this->username);
			}*/
        }
		//Teacher::addTeacher($this->username);
		
		$user = $this->_user;
		switch ($user['role'])
			{
			case 'administrator':
			  $user['created_id'] = '';		
			  $user['updated_at'] ='';
			  break;  
			case 'school':
			  $data = School::getSid($user['username']);
			  $user['created_id'] = $data['sid'];
			  $user['updated_at'] ='';
			  break;
			case 'gradedirector':
			  $data = Teacher::getclass($user['username']);
			  $user['created_id'] = $data['sid'];
			  $user['updated_at'] = $data['grade'];
			  break;
			case 'classteacher':
			  $data = Teacher::getclass($user['username']);
			  $user['created_id'] = $data['sid'];
			  $user['updated_at'] = $data['grade'];
			  break;
			case 'instructor':
			  $data = Teacher::getclass($user['username']);
			  $user['created_id'] = $data['sid'];
			  $user['updated_at'] = $data['grade'];
			  break;
			default:
			  $user = '';
			  break;
			}
		$session = Yii::$app->session;
		$session->set('user',$user);  
        return $this->_user;
    } 
}
