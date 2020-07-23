<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of listsClass
 *
 * @author apary
 */
class listsClass {
    //put your code here
    public function markAsDone($done)
    {
        if($done == true){
            $markAsDone = 'done';
            return $markAsDone;
        } elseif($done == false) {
            return "";
        }
    }
}
