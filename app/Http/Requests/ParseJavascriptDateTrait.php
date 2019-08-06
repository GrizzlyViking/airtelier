<?php namespace App\Http\Requests;

use Carbon\Carbon;

trait ParseJavascriptDateTrait
{
    public function parseJavaScriptDate($date): Carbon
    {
        return Carbon::parse($date, config('app.timezone'));
    }

    public function prepareDate($key)
    {
        if ($this->has($key) && preg_match('/\d{4}-\d{2}-\d{2}T\d{2}:\d{2}:\d{2}\.\d+\w/', $this->get($key))) {
            $this->merge([$key => $this->parseJavaScriptDate($this->get($key))->format('Y-m-d')]);
        }
    }
}
