<?php

namespace TugasKPL\Application\DataTransformer;

use TugasKPL\Domain\Model\User\User;

interface UserDataTransformer
{
    public function write(User $user);

    public function read();
}
