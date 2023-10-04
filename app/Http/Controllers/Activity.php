<?php

namespace App\Http\Controllers;

use App\Models\Activity_model;
use Illuminate\Http\Request;


class Activity extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $model;
    public function __construct()
    {
        $this->model = new Activity_model;
    }
    public function getactivity()
    {
        $data = $this->model->activity();
        return self::setRes(true, $data, 200);
    }
    public function getemp()
    {
        $data = $this->model->get_activity();
        return self::setRes(true, $data, 200);
    }
    public function update(Request $request)
    {
        $post = (object)$request->input();
        $data = $this->model->update_activity($post);
        return self::setRes($data, ['msg' => ""], 200);
    }
}
