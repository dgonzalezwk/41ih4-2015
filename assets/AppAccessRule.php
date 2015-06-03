<?php
 
namespace app\assets;
 
use app\models\Users;
class AppAccessRule extends \yii\filters\AccessRule {
 
    /**
     * @inheritdoc
     */
    protected function matchRole($user)
    {
        if (empty($this->roles)) {
            return true;
        }
        foreach ($this->roles as $role) {
            
            if ($role == '?') {
                if (!$user->getIsGuest()) {
                    return true;
                }
            } else if ($role == '@') {
                return true;
            } else {
                if (!$user->getIsGuest()) {
                    $acciones = $user->identity->accionUsuarios;
                    foreach ($acciones as $accion) {
                        if ( $role == $accion->accion0->key && $accion->estado == 1 ) {
                            return true;
                        }
                    }
                }
            }
        }
        return false;
    }
}