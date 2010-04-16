<?php
/**
 * Article components
 * 
 * No redirection nor database manipulation ( insert, update, delete ) here
 * 
 * 
 */
class articleComponents extends myFrontModuleComponents
{

  public function executeList()
  {
    $query = $this->getListQuery();
    
    $this->articlePager = $this->getPager($query);

    $this->articlePager->setOption('ajax', true);
  }

  public function executeShow()
  {
    $query = $this->getShowQuery();
    
    $this->article = $this->getRecord($query);
  }


}
