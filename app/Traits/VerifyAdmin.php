<?php

namespace App\Traits;

trait VerifyAdmin{
    public function before($user, $ability){
        if($user->isAdmin()){
            return true;
        }
    }
}