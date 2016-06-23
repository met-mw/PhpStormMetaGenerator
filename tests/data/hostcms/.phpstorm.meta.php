<?php
namespace PHPSTORM_META {

   /** @noinspection PhpUnusedLocalVariableInspection */
   /** @noinspection PhpIllegalArrayKeyTypeInspection */

   $STATIC_METHOD_TYPES = array(
      \Core_ORM::factory('') => array(
          'Module1' instanceof \Module1_Model,
          'Module1_Module1sub' instanceof \Module1_Module1sub_Model,
      ),
      \Admin_Form_Entity::factory('') => array(
          'Test1' instanceof \Admin_Form_Entity_Test1,
          'Test2' instanceof \Admin_Form_Entity_Test2,
      ),
  );
}