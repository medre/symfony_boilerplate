<?php
// src/EventListener/Entity/UserListener.php

namespace App\EventListener\Entity;

use App\Entity\User;

class UserListener
{
    // This method will be called before saving a new User entity
    public function prePersist(User $user): ?User
    {
        // Check if the entity is a User entity
        if (!$user instanceof User) {
            return null;
        }

        $this->normalizeUser($user);

        return $user;
    }

    // This method will be called before updating an existing User entity
    public function preUpdate(User $user): ?User
    {
        // Check if the entity is a User entity
        if (!$user instanceof User) {
            return null;
        }

        $this->normalizeUser($user);
    }

    private function normalizeUser(User $user): ?User
    {
        $email = $user->getEmail();

        if ($email) {
            $user->setEmail(strtolower($email));
        }

        return $user;
    }
}
