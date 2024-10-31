<?php
// src/EventListener/EntityListener.php

namespace App\EventListener;

use Doctrine\Persistence\Event\LifecycleEventArgs;

class EntityListener
{
    /**
     * Execute the listener
     *
     * This method will execute the listener class if it exists and the listener method exists.
     *
     * @param LifecycleEventArgs $args The LifecycleEventArgs instance
     * @param string $listenerType The listener type (prePersist, preUpdate, preRemove, postPersist, postUpdate, postRemove)
     * @return mixed The object after the listener is executed
     */
    protected function executeListener($args, $listenerType)
    {
        $object = $args->getObject();

        // Check if Pre Listener class exists under User folder with the same name
        $reflectionClass = new \ReflectionClass($object);
        $className = $reflectionClass->getShortName();

        $listenerClass = 'App\\EventListener\\Entity\\' . $className . 'Listener';

        if (class_exists($listenerClass)) {
            $listener = new $listenerClass();

            if (method_exists($listener, $listenerType)) {
                $object = $listener->$listenerType($object);
            }
        }

        return $object;
    }

    // This method will be called before saving a new entity
    public function prePersist(LifecycleEventArgs $args): void
    {
        $object = $this->executeListener($args, __FUNCTION__);

        // Set the created_at field to the current date and time if the entity has this field
        if (method_exists($object, 'setCreatedAt')) {
            $object->setCreatedAt(new \DateTimeImmutable());
        }
    }

    // This method will be called before updating an existing entity
    public function preUpdate(LifecycleEventArgs $args): void
    {
        $object = $this->executeListener($args, __FUNCTION__);

        // Set the updated_at field to the current date and time if the entity has this field
        if (method_exists($object, 'setUpdatedAt')) {
            $object->setUpdatedAt(new \DateTimeImmutable());
        }
    }

    // This method will be called before removing an existing entity
    public function preRemove(LifecycleEventArgs $args): void
    {
        $object = $this->executeListener($args, __FUNCTION__);

        // Set the deleted_at field to the current date and time if the entity has this field
        if (method_exists($object, 'setDeletedAt')) {
            $object->setDeletedAt(new \DateTimeImmutable());
        }
    }

    // This method will be called after saving a new entity
    public function postPersist(LifecycleEventArgs $args): void
    {
        $this->executeListener($args, __FUNCTION__);
    }

    // This method will be called after updating an existing entity
    public function postUpdate(LifecycleEventArgs $args): void
    {
        $this->executeListener($args, __FUNCTION__);
    }

    // This method will be called after removing an existing entity
    public function postRemove(LifecycleEventArgs $args): void
    {
        $this->executeListener($args, __FUNCTION__);
    }
}
