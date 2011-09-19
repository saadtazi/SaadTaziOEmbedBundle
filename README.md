Introduction
------------
SaadTaziOEmbedBundle is a simple Symfony bundle that fetches OEmbed data.

It uses the simple-oembed PHP5.3 library (https://github.com/saadtazi/simple-oembed)
 
Read more about oembed here: http://oembed.com


Installation
------------

  1. Add this bundle to your and the Facebook PHP SDK to your ``vendor/`` dir:
      * Using the vendors script.

        Add the following lines in your ``deps`` file::

            [SaadTaziOEmbedBundle]
                git=git://github.com/SaadTazi/OEmbedBundle.git
                target=/bundles/SaadTazi/Bundle/OEmbedBundle
            
            [simple-oembed]
                git=git://github.com/SaadTazi/simple-oembed.git
                target=/simple-oembed

        Run the vendors script:

            ./bin/vendors install

      * Using git submodules.

            $ git submodule add git://github.com/SaadTazi/OEmbedBundle.git vendor/bundles/SaadTazi/Bundle/OEmbedBundle
            $ git submodule add git://github.com/SaadTazi/simple-oembed.git vendor/simple-oembed

  2. Add the SaadTazi namespace to your autoloader:

``` php

          // app/autoload.php
          $loader->registerNamespaces(array(
                'SaadTazi' => __DIR__.'/../vendor/bundles',
                'OEmbed'   => __DIR__.'/../vendor/simple-oembed/lib'
                // your other namespaces
          ));
```

  3. Add this bundle to your application's kernel:

``` php

          // app/ApplicationKernel.php
          public function registerBundles()
          {
              return array(
                  // ...
                  new SaadTazi\Bundle\OEmbedBundle\SaadTaziOEmbedBundle(),
                  // ...
              );
          }
```

  4. Configure the `saad` service in your config:

``` yaml
    saad_tazi_o_embed:
        endpoints:
            youtube: { pattern: '/http:\/\/www\.youtube\.com/', url: 'http://www.youtube.com/oembed' }
            any: { pattern: '/.*/', url: 'http://api.embed.ly/1/oembed', params: { key: 'YOUR_KEY' }}
        discovery: false
        allowedurls:
            youtube: /http:\/\/www\.youtube\.com/
            flickr:  /http:\/\/www\.flickr\.com/
```

For more information about the configuration, read the simple-oembed [OEmbed\OEmbedService source code](http://github.com/saadtazi/simple-oembed/blob/master/lib/OEmbed/OEmbedService.php).

Example
-------

In a controller, do the following:
``` php

        $oembed = $this->get('saadtazi_oembed');
        $oembedResponse = $oembed->get('http://www.youtube.com/watch?v=REy3wCFjqZo');
        /*
            object(stdClass)[265]
              public 'provider_url' => string 'http://www.youtube.com/' (length=23)
              public 'title' => string 'Têtes à claques   À l'école' (length=31)
              public 'html' => string '<object width="480" height="270"><param name="movie" value="http://www.youtube.com/v/REy3wCFjqZo?version=3"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src="http://www.youtube.com/v/REy3wCFjqZo?version=3" type="application/x-shockwave-flash" width="480" height="270" allowscriptaccess="always" allowfullscreen="true"></embed></object>' (length=411)
              public 'author_name' => string 'gg89300' (length=7)
              public 'height' => int 270
              public 'thumbnail_width' => int 480
              public 'width' => int 480
              public 'version' => string '1.0' (length=3)
              public 'author_url' => string 'http://www.youtube.com/user/gg89300' (length=35)
              public 'provider_name' => string 'YouTube' (length=7)
              public 'thumbnail_url' => string 'http://i3.ytimg.com/vi/REy3wCFjqZo/hqdefault.jpg' (length=48)
              public 'type' => string 'video' (length=5)
              public 'thumbnail_height' => int 360
        */
```