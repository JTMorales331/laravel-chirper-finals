<?php

if (!function_exists('linkifyHashtags')) {

    // https://stackoverflow.com/questions/22202443/php-converting-plain-text-to-hashtag-link
    function linkifyHashtags($text)
    {
//        $pattern = '/\B#([\w-]+)/';
        $pattern = '/(?<!\S)#([0-9\p{L}]+)/';

//        $replacement = '<a class="btn btn-ghost btn-xs text-blue-500 hover:underline active:opacity-60" href="/?tag=$1">#$1</a>';

        // Use preg_replace to perform the substitution
//        return preg_replace($pattern, $replacement, $text);

        // https://stackoverflow.com/questions/11174807/how-to-use-preg-replace-callback
        return preg_replace_callback($pattern, function ($matches) {
//            $tag = strtolower($matches[1]);
            $replacement = '<a class="btn btn-ghost btn-xs text-blue-500 hover:underline active:opacity-60" href="/?tag=' . strtolower($matches[1]) . '">' . $matches[0] . '</a>';
            return $replacement;
        }, $text);
    }
}
