<?php

namespace App\Http\Controllers;

use App\Categories;
use App\Products;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Categories::all();
        return view('products.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data  = new Products();
        $query = Categories::all('id', 'name');

        #echo $query;

        foreach ($query as $item) {
            if ($item->name == $request->transporte) {
                $id = $item->id;
            }
        }
        $data->name        = $request->nombre;
        $data->description = $request->descripcion;
        $data->tax         = $request->iva;
        $data->price       = $request->precio;
        $data->stock       = $request->unidades;
        $data->category_id = $id;
        $data->user_id     = \Auth::user()->id;

        $data->save();

        flash($request->nombre . ' creado con exito', 'success');

        return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($name, $id)
    {
        $products = Products::where('category_id', $id)->paginate(5);
        return view('products.index', ['products' => $products,
            'nameCategory'                            => $name]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($nameC, $name, $id)
    {
        $product = Products::find($id);
        $query   = Categories::all('name');

        return view('products.edit',
            ['nameC'  => $nameC,
                'name'    => $name,
                'id'      => $id,
                'product' => $product,
                'query'   => $query]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $categoriaOrigen, $h)
    {

        $query  = Categories::all('id', 'name');
        $query2 = Categories::where('name', $categoriaOrigen)->get();

        foreach ($query2 as $key) {
            $idCateogoriaOrigen = $key->id;
        }

        foreach ($query as $item) {
            if ($item->name == $request->transporte) {
                $id = $item->id;
            }
        }

        $product = new Products();

        $product->name        = $request->nombre;
        $product->description = $request->descripcion;
        $product->tax         = $request->iva;
        $product->price       = $request->precio;
        $product->stock       = $request->unidades;
        $product->category_id = $id;
        $product->user_id     = \Auth::user()->id;

        $product->save();
        $deleted = $product::destroy($h);

        flash($request->nombre . ' Ha sido editado con exito', 'success');

        return redirect('categories/' . $categoriaOrigen . '/' . $idCateogoriaOrigen . '/products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $product = new Products();

        $vari = Products::find($id);

        $delete = Products::destroy($id);

        if ($delete) {

            flash($vari->name . ' Eliminada con exito', 'warning');
            return redirect('/categories');
        } else {
            return 'error';
        }
    }
}
