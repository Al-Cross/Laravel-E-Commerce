<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Attribute;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoriesController extends Controller
{
    /**
     * Dispplay a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.categories');
    }

    /**
     * Display a page for creating a resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $data = request()->validate([
            'name' => 'required',
            'attribute' => ['required', 'array', 'min:1'],
            'attribute.*' => 'required'
        ]);

        $category = Category::create([
            'name' => $data['name'],
            'slug' => Str::slug($data['name'])
        ]);
        \Cache::forget('categories');

        if (is_array($data['attribute'])) {
            foreach ($data['attribute'] as $attribute) {
                Attribute::create([
                    'category_id' => $category->id,
                    'name' => $attribute
                ]);
            }
        } else {
            Attribute::create([
                'category_id' => $category->id,
                'name' => $data['attribute']
            ]);
        }


        return redirect()->route('admin.dashboard.categories');
    }
}
