<!DOCTYPE HTML> 
<html lang="en-us">
  <head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8"> 
    <title>Google tags test</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" rel="stylesheet">

    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="/bower_components/waypoints/lib/noframework.waypoints.min.js"></script>

    <style type="text/css" media="screen">
      #ads div {
        float: left;
        margin: 3px;
        height: 250px;
        width: 300px;
      }
      .waypoint {
        clear: both;
        height: 20px;
        background-color: red;
      }
    </style>
    <script type='text/javascript'>
      var googletag = googletag || {};
      googletag.cmd = googletag.cmd || [];
      (function() {
        var gads = document.createElement('script');
        gads.async = true;
        gads.type = 'text/javascript';
        var useSSL = 'https:' == document.location.protocol;
        gads.src = (useSSL ? 'https:' : 'http:') + 
        '//www.googletagservices.com/tag/js/gpt.js';
        var node = document.getElementsByTagName('script')[0];
        node.parentNode.insertBefore(gads, node);
      })();
    </script>

    <script type='text/javascript'>
      googletag.cmd.push(function() {

        // Declare any slots initially present on the page
        googletag.defineSlot('/7231/Newsvine/arts', [300, 250], 'initialAd-0').setTargeting("test","infinitescroll").addService(googletag.pubads());
        googletag.defineSlot('/7231/Newsvine/arts', [300, 250], 'initialAd-1').setTargeting("test","infinitescroll").addService(googletag.pubads());
        
        // Infinite scroll requires SRA
        googletag.pubads().enableSingleRequest();

        // Disable initial load, we will use refresh() to fetch ads.
        // Calling this function means that display() calls just
        // register the slot as ready, but do not fetch ads for it.
        googletag.pubads().disableInitialLoad();

        googletag.enableServices();
      });
      // Function to generate unique names for slots
      var nextSlotId = 1;
      function generateNextSlotName() {
        var id = nextSlotId++;
        return 'dynamicAd' + id;
      }
      // Function to add content to page, mimics real infinite scroll
       // but keeps it much simpler from a code perspective.
       function moreContent() {

         // Generate next slot name
         var slotName = generateNextSlotName();

         // Create a div for the slot
         var slotDiv = document.createElement('div');
         slotDiv.id = slotName; // Id must be the same as slotName
         document.getElementById("ads").appendChild(slotDiv);


         // Define the slot itself, call display() to 
         // register the div and refresh() to fetch ad.
         googletag.cmd.push(function() {
           var slot = googletag.defineSlot('/7231/Newsvine/arts', [300, 250], slotName).
               setTargeting("test","infinitescroll").
               addService(googletag.pubads());

           // Display has to be called before
           // refresh and after the slot div is in the page.
           googletag.display(slotName);
           googletag.pubads().refresh([slot]);
         });
       }



       //Bacon ipsum
       var ipsumCounter = 1;
       var getIpsum = function (){
        $.getJSON('http://baconipsum.com/api/?callback=?', 
          { 'type':'meat-and-filler', 'start-with-lorem':'ipsumCounter', 'paras':'3' }, 
          function(baconGoodness) {
            if (baconGoodness && baconGoodness.length > 0) {
              for (var i = 0; i < baconGoodness.length; i++)
                $(".ipsum-container").append('<p>' + baconGoodness[i] + '</p>');
            }
            ipsumCounter += 3;
          });
        }
        $(document).ready(function() {
          getIpsum();

          //Waypoints
          var $adsWaypoint = $('#ads-column-waypoint');
          new Waypoint({
            element: $adsWaypoint,
            handler: function() {
              moreContent(),
              console.log("more please")
            }, 
            continuous: false,
            offset: '100%'
          });

          var $copyWaypoint = $('#copy-column-waypoint');
          new Waypoint({
            element: $copyWaypoint,
            handler: function() {
              getIpsum()
            }, 
            continuous: false,
            offset: '120%'
          });
          
        });

    </script>
  </head>
  <body>
    <div class="container">
      <h1>GPT Test</h1>
      <button class="btn" onclick="moreContent()">More Content</button>
      <hr />
      
      <div class="row">
        <div class="col-md-8 copy-column">
          <section class="ipsum-container"></section>
          <div id="copy-column-waypoint" class="waypoint"></div>
        </div>
        <div class="col-md-4 ads-column">
          <div id="ads">
            <div id='initialAd-0' style='width:300px; height:250px;'>
              <script>
                // Call display() to register the slot as ready
                // and refresh() to fetch an ad.
                googletag.cmd.push(function() {
                  googletag.display('initialAd-0');
                  googletag.pubads().refresh();
                });
              </script>
            </div>

            <div id='initialAd-1' style='width:300px; height:250px;'>
              <script>
                // Call display() to register the slot as ready
                // and refresh() to fetch an ad.
                googletag.cmd.push(function() {
                  googletag.display('initialAd-1');
                  googletag.pubads().refresh();
                });
              </script>
            </div>
          </div>
          <div id="ads-column-waypoint" class="waypoint"></div>
        </div>
      </div>
    </div>
  </body>
