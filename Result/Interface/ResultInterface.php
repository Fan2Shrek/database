<?php

namespace Sruuua\Database\Database\Result\Interface;

interface ResultInterface
{
    public function fetchAssociative();

    public function fetchNumeric();

    public function fetchAllAssociative();

    public function fetchAllNumeric();
}
