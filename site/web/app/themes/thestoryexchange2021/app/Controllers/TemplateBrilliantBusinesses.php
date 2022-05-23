<?php

namespace App\Controllers;

use Sober\Controller\Controller;

class TemplateBrilliantBusinesses extends Controller
{
    public function data()
    {
        $data = [];
        $data['sections'] = get_field('sections');
        $data['subheading'] = get_field('subheading');

        return $data;
    }

}