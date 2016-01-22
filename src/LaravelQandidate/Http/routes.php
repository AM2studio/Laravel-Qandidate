<?php

use AM2Studio\LaravelQandidate\Models\Toggle;
use AM2Studio\LaravelQandidate\Models\Condition;

Route::group(['prefix' => config('qandidate.routePrefix', 'qandidate'), 'middleware' => config('qandidate.middlewares')], function () {
    Route::group(['prefix' => 'toggle'], function () {
        Route::get('/', ['as' => 'qandidate.toggle.index', function () {
            $toggles = Toggle::all();

            return view('qandidate::index', compact('toggles'));
        }]);
        Route::post('store', ['as' => 'qandidate.toggle.store', function (\Illuminate\Http\Request $request) {
            $toggle = Toggle::create($request->all());

            return redirect()->route('qandidate.toggle.edit', $toggle->id);
        }]);
        Route::get('edit/{id}', ['as' => 'qandidate.toggle.edit', function ($id) {
            $toggle = Toggle::findOrFail($id);
            $conditions = $toggle->conditions;

            return view('qandidate::edit', compact('toggles', 'toggle', 'conditions'));
        }]);
        Route::put('update/{id}', ['as' => 'qandidate.toggle.update', function ($id, \Illuminate\Http\Request $request) {
            $toggle = Toggle::findOrFail($id);
            $toggle->fill($request->all());
            $toggle->save();

            return redirect()->route('qandidate.toggle.edit', $toggle->id);
        }]);
        Route::delete('delete/{id}', ['as' => 'qandidate.toggle.delete', function ($id, \Illuminate\Http\Request $request) {
            $toggle = Toggle::findOrFail($id);
            $toggle->delete();

            return redirect()->route('qandidate.toggle.index');
        }]);
    });
    Route::group(['prefix' => 'condition'], function () {
        Route::post('store', ['as' => 'qandidate.condition.store', function (\Illuminate\Http\Request $request) {
            $condition = Condition::create($request->all());

            return redirect()->route('qandidate.toggle.edit', $condition->toggle_id);
        }]);
        Route::put('update/{id}', ['as' => 'qandidate.condition.update', function ($id, \Illuminate\Http\Request $request) {
            $condition = Condition::findOrFail($id);
            $condition->fill($request->all());
            $condition->save();

            return redirect()->route('qandidate.toggle.edit', $condition->toggle_id);
        }]);
        Route::delete('delete/{id}', ['as' => 'qandidate.condition.delete', function ($id, \Illuminate\Http\Request $request) {
            $condition = Condition::findOrFail($id);
            $toggleId = $condition->toggle_id;
            $condition->delete();

            return redirect()->route('qandidate.toggle.edit', $toggleId);
        }]);
    });
});
