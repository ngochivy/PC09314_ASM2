<?php 

    namespace App\Views;

    abstract class BaseView{
        /**
         * Phuong Thuc nay dung de in ra giao dien
         */
        abstract public static function render();

        abstract public static function handle();
        
    }