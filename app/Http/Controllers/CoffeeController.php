<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coffee; // Assuming your Coffee model is in the 'App\Models' namespace

class CoffeeController extends Controller
{
    public function index()
    {
        $coffees = Coffee::all();
        $active = 'Shop';
        $subPageTitle = 'FRESH AND ORGANIC';
        $pageTitle = 'Shop';
        return view('ui.transaction.shop', compact(
            'coffees',
            'active',
            'subPageTitle',
            'pageTitle'
        ));
    }
    public function create()
    {
        return view('coffees.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'description' => 'nullable|string', // Adding validation for description
        ]);

        Coffee::create($request->all());

        return redirect()->route('coffees.index')
            ->with('success', 'Coffee created successfully.');
    }

    public function show($id)
    {
        $coffee = Coffee::find($id);

        if (!$coffee) {
            return view('ui.404.404');
        }

        // Fetch related products (you can customize this query based on your criteria)
        $coffees = Coffee::where('id', '!=', $id)->inRandomOrder()->limit(3)->get();

        return view('ui.transaction.single-product', [
            'coffee' => $coffee,
            'active' => 'Single Product',
            'coffees' => $coffees,
            'subPageTitle' => 'SEE MORE DETAILS',
            'pageTitle' => 'Single Product'
        ]);
    }

    public function edit($id)
    {
        $coffee = Coffee::find($id);
        return view('coffees.edit', compact('coffee'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'description' => 'nullable|string', // Adding validation for description
        ]);

        $coffee = Coffee::find($id);
        $coffee->update($request->all());

        return redirect()->route('coffees.index')
            ->with('success', 'Coffee updated successfully');
    }

    public function destroy($id)
    {
        Coffee::destroy($id);

        return redirect()->route('coffees.index')
            ->with('success', 'Coffee deleted successfully');
    }
}
