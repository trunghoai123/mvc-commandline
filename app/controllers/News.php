<?php

class News extends Controller
{
    public function index()
    {
        echo 'News index';
    }

    public function category($id)
    {
        echo 'News category ' . $id;
    }
}
