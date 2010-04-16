<?php // Vars: $articlePager

use_helper('Date');

echo $articlePager->renderNavigationTop();

echo _open('ul.elements');

foreach ($articlePager as $article)
{
  echo _open('li.element');

    // wrap the article link into a H2 tag with the t_medium CSS class
    echo _tag('h2.t_medium', _link($article));

    // show the article extract, processed with markdown
    echo markdown($article->extract, '.extract');

    // in a P tag, we put some infos about the article
    echo _tag('p.article_infos',

      // creation date of the article, formatted with a symfony helper
      _tag('span', format_date($article->createdAt, 'D')).
      ' | '.
      // article author
      _tag('span', $article->Author).
      ' | '.
      // another link to the article, with the "Read more" translated text
      _link($article)->text(__('Read more...'))
    );

  echo _close('li');
}

echo _close('ul');

echo $articlePager->renderNavigationBottom();