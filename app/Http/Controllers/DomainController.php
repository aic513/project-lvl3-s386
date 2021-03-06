<?php

namespace App\Http\Controllers;

use \App\Domain;
use \GuzzleHttp\Client;
use \DiDom\Document;

class DomainController extends Controller
{
    private $guzzleClient;
    
    public function __construct(Client $client)
    {
        $this->guzzleClient = $client;
    }
    
    public function index()
    {
        $domains = Domain::paginate(5);
        
        return view('domains', ["domains" => $domains]);
    }
    
    public function show($id)
    {
        $domain = Domain::find($id);
        
        return view('domainInfo', ["domain" => $domain]);
    }
    
    public function store(\Illuminate\Http\Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'url' => 'required|url',
        ]);
        if ($validator->fails()) {
            return view('home', ['errors' => $validator->errors()->all()]);
        }
        $url = $request['url'];
        try {
            $response = $this->guzzleClient->get($url);
        } catch (\Exception $e) {
            return view('home', ['errors' => ["Something was wrong within request to $url"]]);
        }
        $pageBody = $response->getBody();
        $responseCode = $response->getStatusCode();
        $headers = $response->getHeader('Content-Length');
        $contentLength = empty($headers) ? null : $headers[0];
        $doc = new Document($pageBody->getContents());
        $pageBody->rewind();
        $keywords = $doc->first('meta[name=keywords]::attr(content)');
        $mainHeader = $doc->first('h1::text');
        $description = $doc->first('meta[name=description]::attr(content)');
        $domainName = parse_url($url, PHP_URL_HOST);
        $domain = Domain::updateOrCreate(['name' => $domainName], [
            'page_body' => $pageBody->getContents(),
            'response_code' => $responseCode,
            'content_length' => $contentLength,
            'main_header' => $mainHeader,
            'meta_keywords' => $keywords,
            'meta_description' => $description,
        ]);
        
        return redirect()->route('domains.show', ['id' => $domain->id]);
    }
}
