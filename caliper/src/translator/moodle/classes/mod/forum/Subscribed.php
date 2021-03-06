<?php

namespace udzuki\translator\moodle\classes\mod\forum;

use udzuki\translator\moodle\db\Models\Events;
use udzuki\translator\moodle\db\traits\Forum;
use udzuki\translator\moodle\EventFactory;
use udzuki\translator\TranslatedEvent;

class Subscribed extends EventFactory
{
    function __construct()
    {
        $this->recipe = 'forum_subscribed';
    }

    use Forum;

    function setObject(Events $event): void
    {
        $this->object = $this->readForumSubscription($event->objectid);
    }

    function process(): TranslatedEvent
    {
        return (new TranslatedEvent())
            ->setRecipe($this->recipe)
            ->setApp($this->app->id)
            ->setEventTime($this->time)
            ->setActor([
                'id' => $this->actor->id,
                'name' => $this->actor->username,
                'description' => $this->actor->description,
            ])
            ->setObject([
                'id' => $this->object->id,
                'name' => $this->object->name,
                'description' => $this->object->intro,
                'part_of' => $this->course->id
            ]);
    }
}