<?php

namespace App\Http\Controllers;

use App\Short;
use Illuminate\Http\Request;

class ShortController extends Controller
{
    private $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    private $salt = 'wxyzABCDE';
    private $padding = 11;
    private $hostname = 'http://dev.avtogorod43.ru/short';

    public static function num_to_alpha($n, $s) {
        $b = strlen($s);
        $m = $n % $b;
        if ($n - $m == 0) return substr($s, $n, 1);
        $a = '';
        while ($m > 0 || $n > 0) {
            $a = substr($s, $m, 1).$a;
            $n = ($n - $m) / $b;
            $m = $n % $b;
        }
        return $a;
    }

    public static function get_seed($n, $salt, $padding) {
        $hash = md5($n.$salt);
        $dec = hexdec(substr($hash, 0, $padding));
        $num = $dec % pow(10, $padding);
        if ($num == 0) $num = 1;
        $num = str_pad($num, $padding, '0');
        return $num;
    }

    public function encode($n) {
        $k = 0;
        if ($this->padding > 0 && !empty($this->salt)) {
            $k = self::get_seed($n, $this->salt, $this->padding);
            $n = (int)($k.$n);
        }
        return self::num_to_alpha($n, $this->chars);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($url)
    {
        $url = $this->hostname .'/' . $url;
        $result = Short::where('shorturl', '=', $url)->first();
        return redirect($result->url);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('short', ['url' => 'yandex.ru']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->isMethod('post')) {

            $this->validate($request,[
                'url' => 'required'
            ]);

            if (preg_match('/^http[s]?\:\/\/[\w]+/', $request->url)) {

                //  Поиск
                $result = Short::where('url', '=', $request->url)->first();

                if (empty($result)) {

                    $id = Short::insertGetId([
                        'url' => $request->input('url'),
                        'shorturl' => '',
                    ]);

                    $url = $this->hostname . '/' . $this->encode($id);
                    $shortUrl = Short::where('id', '=', $id)->first();
                    $shortUrl->shorturl = $url;
                    $shortUrl->save();

                    return back()->with('info','Ссылка добавлена ' . $url);

                } else {

                    return back()->with('info'," Ссылка существует! " . $result->shorturl);

                }
            } else {
                return back()->with('info','Не верно введен url');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Short  $short
     * @return \Illuminate\Http\Response
     */
    public function show(Short $short)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Short  $short
     * @return \Illuminate\Http\Response
     */
    public function edit(Short $short)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Short  $short
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Short $short)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Short  $short
     * @return \Illuminate\Http\Response
     */
    public function destroy(Short $short)
    {
        //
    }
}
