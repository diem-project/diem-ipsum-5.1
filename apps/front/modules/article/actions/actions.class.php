<?php
/**
 * Article actions
 */
class articleActions extends myFrontModuleActions
{
  public function executeFeed($request)
  {
    // Firstly, fetch the articles we will put in the feed
    $articles = Doctrine_Query::create()->from('Article a')
    // join the translation table to avoid later queries
    ->withI18n()
    // get only active articles
    ->where('aTranslation.is_active = ?', true)
    // order them by date of creation
    ->orderBy('aTranslation.created_at DESC')
    // get only the 20 last articles
    ->limit(20)
    // send the query to the database and get our articles
    ->execute();

    // Then create a sfRssFeed instance and configure it
    $this->feed = new sfRssFeed();

    $this->feed->setTitle('diem ipsum blog');
    $this->feed->setAuthorName('Diem developer');

    // here we use £link to get blog page absolute url.
    // this is the prefered way to get a page url.
    $blogUrl = $this->getHelper()->link('article/list')->getAbsoluteHref();

    $this->feed->setLink($blogUrl);

    // Add each article to the feed
    foreach ($articles as $article)
    {
      $item = new sfFeedItem();

      $item->setTitle($article->title);

      // use link helper to get the article page url
      $item->setLink($this->getHelper()->link($article)->getAbsoluteHref());
      $item->setAuthorName($article->Author);
      $item->setUniqueId($article->title.' ('.$article->id.')');

      $dateObject = new DateTime($article->createdAt);
      $item->setPubdate($dateObject->format('U'));

      $item->setDescription(
        // use media helper to insert an image in the feed
        $this->getHelper()->media($article->Image)->size(300, 200).
        $this->getService('markdown')->toHtml($article->body)
      );

      $this->feed->addItem($item);
    }

    // disable the layout
    $this->setLayout(false);
  }

}
