<?php

namespace App\models;

class User implements \JsonSerializable
{
    public $id, $name, $email, $created_at, $password;

    public function __construct($id = null, $name = null, $email = null, $created_at = null, $password = null)
    {
        $this->id       = $id;
        $this->name     = $name;
        $this->email    = $email;
        $this->created_at = $created_at;
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
            'created_at' => $this->created_at,
        ];
    }
}
