<?php
use Illuminate\Support\Str;

if(!function_exists('uuidUnique')){
    function uuidUnique($data){
        return Str::uuid($data).'-'.Str::random(8);
    }
}