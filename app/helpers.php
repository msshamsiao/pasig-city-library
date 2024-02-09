<?php

if (! function_exists('withSuccess')) {
    function withSuccess($message)
    {
        session()->flash('success', $message);
    }
}

?>