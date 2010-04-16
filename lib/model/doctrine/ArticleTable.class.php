<?php


class ArticleTable extends myDoctrineTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Article');
    }
}