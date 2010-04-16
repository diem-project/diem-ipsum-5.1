<?php // Vars: $articlePager

echo $articlePager->renderNavigationTop();

echo _open('ul.elements');

foreach ($articlePager as $article)
{
  echo _open('li.element');

    echo _link($article);

  echo _close('li');
}

echo _close('ul');

echo $articlePager->renderNavigationBottom();