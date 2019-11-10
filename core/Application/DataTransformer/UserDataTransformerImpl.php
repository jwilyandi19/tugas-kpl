<?php

namespace TugasKPL\Application\DataTransformer;

use TugasKPL\Domain\Model\User\User;

class UserDataTransformerImpl implements UserDataTransformer
{
    private $user;

    public function write(User $user)
    {
        $this->user = $user;

        return $this;
    }

    public function read()
    {
        return [
            'id' => $this->user->id()->id(),
            'num_wishes' => 0,
        ];
    }
}
