<?php
/**

 * User: Arthur
 * Date: 27.03.11
 * Time: 22:37
 * Index Controller
 */

class IndexController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function indexHandler()
    {
        echo "Index Page";
    }
}
