<?php

namespace App\Contracts;

interface Payment
{
    public function payment(): bool;
}
