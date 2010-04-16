<?php // Vars: $article

use_helper('Date');

echo _open('div.clearfix');

// Wrap the title in a H1
echo _tag('h1.t_big', $article->title);

// Open a P tag to display some article infos
echo _tag('p.article_infos',

  _tag('span', format_date($article->createdAt, 'D')).
  ' | '.
  _tag('span', $article->Author)
);

// render the article image.
// scale it to 200px width and height.
// give it the "image" CSS class.
echo _media($article->Image)->size(200, 200)->set('.image');

// render article body processed with markdown.
echo markdown($article->body);

echo _close('div'); 