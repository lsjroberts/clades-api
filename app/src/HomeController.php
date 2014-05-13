<?php namespace Clades;

use View;
use BaseController;
use Clades\Taxa\Taxon;

class HomeController extends BaseController
{
    public function index()
    {
        $root = Taxon::root();
        // $root = Taxon::where('name', '=', 'Deuterostomia')->first();

        // $hierarchy = $root->getTree(0, 10, false);

        $hierarchy = Taxon::all();

        return View::make('index', [
            'hierarchy' => $hierarchy
        ]);
    }
}