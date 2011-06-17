<?php

/**
 * affiliate module configuration.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage affiliate
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: configuration.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseAffiliateGeneratorConfiguration extends sfModelGeneratorConfiguration
{
  public function getActionsDefault()
  {
    return array();
  }

  public function getFormActions()
  {
    return array(  '_delete' => NULL,  '_list' => NULL,  '_save' => NULL,  '_save_and_add' => NULL,);
  }

  public function getNewActions()
  {
    return array();
  }

  public function getEditActions()
  {
    return array();
  }

  public function getListObjectActions()
  {
    return array(  'activate' => NULL,  'deactivate' => NULL,);
  }

  public function getListActions()
  {
    return array();
  }

  public function getListBatchActions()
  {
    return array(  'activate' => NULL,  'deactivate' => NULL,);
  }

  public function getListParams()
  {
    return '%%is_active%% - %%url%% - %%email%% - %%token%%';
  }

  public function getListLayout()
  {
    return 'tabular';
  }

  public function getListTitle()
  {
    return 'Affiliate Management';
  }

  public function getEditTitle()
  {
    return 'Edit Affiliate';
  }

  public function getNewTitle()
  {
    return 'New Affiliate';
  }

  public function getFilterDisplay()
  {
    return array(  0 => 'url',  1 => 'email',  2 => 'is_active',);
  }

  public function getFormDisplay()
  {
    return array();
  }

  public function getEditDisplay()
  {
    return array();
  }

  public function getNewDisplay()
  {
    return array();
  }

  public function getListDisplay()
  {
    return array(  0 => 'is_active',  1 => 'url',  2 => 'email',  3 => 'token',);
  }

  public function getFieldsDefault()
  {
    return array(
      'id' => array(  'is_link' => true,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'url' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'email' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'token' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'is_active' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Boolean',),
      'created_at' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Date',),
      'updated_at' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Date',),
      'jobeet_categories_list' => array(  'is_link' => false,  'is_real' => false,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'is_active:{label' => array(  'is_link' => false,  'is_real' => false,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
    );
  }

  public function getFieldsList()
  {
    return array(
      'id' => array(),
      'url' => array(),
      'email' => array(),
      'token' => array(),
      'is_active' => array(),
      'created_at' => array(),
      'updated_at' => array(),
      'jobeet_categories_list' => array(),
    );
  }

  public function getFieldsFilter()
  {
    return array(
      'id' => array(),
      'url' => array(),
      'email' => array(),
      'token' => array(),
      'is_active' => array(),
      'created_at' => array(),
      'updated_at' => array(),
      'jobeet_categories_list' => array(),
    );
  }

  public function getFieldsForm()
  {
    return array(
      'id' => array(),
      'url' => array(),
      'email' => array(),
      'token' => array(),
      'is_active' => array(),
      'created_at' => array(),
      'updated_at' => array(),
      'jobeet_categories_list' => array(),
    );
  }

  public function getFieldsEdit()
  {
    return array(
      'id' => array(),
      'url' => array(),
      'email' => array(),
      'token' => array(),
      'is_active' => array(),
      'created_at' => array(),
      'updated_at' => array(),
      'jobeet_categories_list' => array(),
    );
  }

  public function getFieldsNew()
  {
    return array(
      'id' => array(),
      'url' => array(),
      'email' => array(),
      'token' => array(),
      'is_active' => array(),
      'created_at' => array(),
      'updated_at' => array(),
      'jobeet_categories_list' => array(),
    );
  }


  /**
   * Gets the form class name.
   *
   * @return string The form class name
   */
  public function getFormClass()
  {
    return 'JobeetAffiliateForm';
  }

  public function hasFilterForm()
  {
    return true;
  }

  /**
   * Gets the filter form class name
   *
   * @return string The filter form class name associated with this generator
   */
  public function getFilterFormClass()
  {
    return 'JobeetAffiliateFormFilter';
  }

  public function getPagerClass()
  {
    return 'sfDoctrinePager';
  }

  public function getPagerMaxPerPage()
  {
    return 20;
  }

  public function getDefaultSort()
  {
    return array('is_active', 'asc');
  }

  public function getTableMethod()
  {
    return '';
  }

  public function getTableCountMethod()
  {
    return '';
  }
}
