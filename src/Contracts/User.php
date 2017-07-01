<?php

namespace Bitporch\Forum\Contracts;

interface User
{
    public function discussions();

    public function posts();
}