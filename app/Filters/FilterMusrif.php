<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class FilterMusrif implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (session()->idlevel == '') {
            return redirect()->to('/login/index');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        if (session()->idlevel == 3) {
            return redirect()->to('/layout/index');
        }

    }
}