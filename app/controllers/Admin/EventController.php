<?php
AdminLoader::model('EventModel');

class EventController extends AdminBaseController
{
  public function index()
  {
    ConstantsAdmin::eventPage();

    $eventData = EventModel::getEvents(conditions: [] , limit: null);

    $this->setData('eventData', $eventData);

    $this->renderAdmin('Event/main');
  }
}