<?php

namespace App\models;

class User implements \JsonSerializable
{
    public $id, $name, $email, $password;

    public function __construct($id = null, $name = null, $email = null, $password = null)
    {
        $this->id       = $id;
        $this->name     = $name;
        $this->email    = $email;
        $this->password = $password;
    }

    /**
     * Specify data to be serialized to JSON.
     *
     * @return array Data to be serialized
     */
    public function jsonSerialize(): array
    {
        // Return an array without the password field
        return [
            'id'    => $this->id,
            'name'  => $this->name,
            'email' => $this->email,
        ];
    }
}
