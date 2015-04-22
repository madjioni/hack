<?php

class IndexController extends Controller {

    public function run()
    {
        Template::load('basic')
            ->title("Home")
            ->content('<div>Ovo je glavna strana. <br><a href="/register">registration</a><br><a href="/login">login</a></div>')
            ->render();
    }
}