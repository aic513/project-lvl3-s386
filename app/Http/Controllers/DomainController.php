<?php

namespace App\Http\Controllers;

use \App\Domain;

class DomainController extends Controller
{
    public function __construct()
    {
        //
    }
    
    public function index()
    {
        $domains = Domain::paginate(5);
        
        return view('domains', ["domains" => $domains, 'isSingleRow' => false]);
    }
    
    public function show($id)
    {
        $domain = Domain::find($id);
        
        return view('domains', ["domains" => [$domain], 'isSingleRow' => true]);
    }
    
    public function store(\Illuminate\Http\Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'url' => 'required|url',
        ]);
        if ($validator->fails()) {
            return view('home', ['errors' => $validator->errors()->all()]);
        }
        $url = parse_url($request['url'], PHP_URL_HOST);
        $domain = new Domain();
        $domain->name = $url;
        $domain->saveOrFail();
        
        return redirect()->route('domains.show', ['id' => $domain->id]);
    }
}
