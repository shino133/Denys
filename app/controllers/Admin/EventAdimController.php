<?php
AdminLoader::model('EventModel');

class EventAdminController extends AdminBaseController
{
  public static function index()
  {
    ConstantsAdmin::eventPage();

    $eventData = EventModel::getEvents(conditions: [] , limit: null);

    self::setData('eventData', $eventData);

    self::renderAdmin('Event/main');
  }
}