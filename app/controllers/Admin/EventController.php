<?php
AdminLoader::model('EventModel');

class EventController extends AdminBaseController
{
  public function index()
  {
    ConstantsAdmin::eventPage();

    $eventData = EventModel::read(columns: ['*']);

    $this->setData('eventData', $eventData);

    $this->renderAdmin('Event/main');
  }
}