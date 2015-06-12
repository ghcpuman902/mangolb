<?php
/*

    ************|\    /|   /\   |\  | %^^^\ |    |^^^^ | /^ |   | /^^^\ ************
    ************| \  / |  /__\  | \ | (  _  |    |---- |/   |   | |   | ************
    ************|  \/  | /    \ |  \| (___| |___ |____ |`\_ \___/ \___/ ************
    Copyright © 2015 MangleKuo
    All rights reserved.

    PLEASE DO NOT USE THIS FOR ANY COMERCIAL PURPOSE.
*/
    //@.htaccess
	//If you have access to the .htaccess file, and it's working, comment SECTION A and uncomment SECTION B
	//It allows you to use http://yourdomain.com/blog/your-article-title
	//instead of http://yourdomain.com/blog/?title=your-article-title
	//remember to change the links in all articles if you've decided to use SECTION B

	# SECTION A start
	if( isset($_GET['title']) ){
		$title = $_GET['title'];
	}else{
		$title = "default";
	}
	# SECTION A end

	# SECTION B start
	// if (strpos($_SERVER['REQUEST_URI'],"/blog/") !== false) {
	// 	$title = str_replace("/blog/","",$_SERVER['REQUEST_URI']);
	// 	if($title == ""){
	// 		$title = "default";
	// 	}
	// }else{
	// 	$title = "404";
	// 	http_redirect("../404.shtml", array(), true, HTTP_REDIRECT_PERM);
	// }
	# SECTION B end
?>
<!DOCTYPE html>
<head>
	<script>
		// Give the title information to javascript
		title = <?php echo '"'.$title.'"'; ?>;
	</script>
	<meta charset="utf-8">
	<title><?php 
	echo $title;
  ?></title>
	<meta name="author" content="MangleKuo">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="//fonts.googleapis.com/css?family=Raleway:400,300,600,800" rel="stylesheet" type="text/css">
	<!-- change the number after v if browser is not reloading -->
	<link rel="stylesheet" href="css/normalize.css?v=1">
	<link rel="stylesheet" href="css/skeleton.css?v=1">
	<link rel="icon" type="image/png" href="images/favicon.png?v=1">
	<?php
		// Use the php class to format Markdown (change from plain text to HTML)
		if(file_exists("./articles/".$title.'.txt') === true){
			$myfile = fopen("./articles/".$title.'.txt', "r") or die("Unable to open file!");
			$my_text = fread($myfile,filesize("./articles/".$title.'.txt'));
			fclose($myfile);
			include_once "phpmarkdown/markdown.php";
			$my_html = Markdown($my_text);

			//@itemprop
			// This is a trick. Read more in the article. It's for the structured data.
			$my_html = preg_replace('/<a href="#" title="" id="author" class="itemprop">(.+?)<\/a>/is', '<span itemprop="author" itemscope itemtype="http://schema.org/Person"><span itemprop="name">$1</span></span>', $my_html);
			$my_html = preg_replace('/<a href="#" title="" id="datePublished" class="itemprop">(.+?)<\/a>/is', '<span itemprop="datePublished" content="$1" markdown="1">$1</span>', $my_html);
		}else{
			$my_html = "<h1>Not Found</h1><h2>Blog-404 Not Found</h2><p>Go <a href='' onclick='window.history.back()'>back</a> or see <a href='./mangolb/'>full list of posts</a></p>";
			$title = "404";
		}
	?>

	<style>
		table{
			/* Overwrite the default font so it looks good even in Chinese. Add fonts for your own language as a new line.*/
            font-family: Raleway, HelveticaNeue, 'Helvetica Neue', Helvetica, 'Lucida Grande', 'Lucida Sans Unicode', Arial, sans-serif, 
            'Lantinghei SC', PingHei, 'Heiti SC', 微软正黑体, 'Segoe UI Webfont', 'Microsoft YaHei', MingLiU, PMingLiU,
            'Lantinghei TC', 'Hiragino Kaku Gothic Pro', 'Heiti TC', 微軟正黑體, 'STHeiti Light', 'Microsoft JhengHei';
		}

		p{
            /* If most of your articles are written in pure words (without lot's of codes and long strings) then it will look better if you set text-align to justify.*/
            /*text-align: justify;*/
        }

		h2, h3, h4, h5, h6{
			/* Overwrite the default font so it looks good even in Chinese. Add fonts for your own language as a new line.*/
			font-family:  Raleway, "Avenir Next", "Avenir", HelveticaNeue, 'Helvetica Neue', Helvetica, Arial, sans-serif,
			'Lantinghei SC', 'Hiragino Sans GB', PingHei, 微软正黑体, 'Segoe UI Webfont', 'Microsoft YaHei', 'Heiti SC', Arial, sans-serif,
            'Lantinghei TC', 'Hiragino Kaku Gothic Pro', 微軟正黑體, 'STHeiti Light', 'Microsoft JhengHei', 'Heiti TC';
            font-weight: 600;
		}

		h2{
			background-color: #F6F6F6;
			margin-top: 1.25em;
			font-weight: 800;
		}
		h2:after{
			content: " ";
			display: block;
			position: relative;
			left: -1%;
			top: 50%;
			width: 4px;
			height: 1.25em;
			margin-left: -4px;
			margin-top: -1.25em;
			background-color: #E06965;
		}

		h3{
			background-color: #F6F6F6;
			margin-top: 1.3em;
		}
		h3:after{
			content: " ";
			display: block;
			position: relative;
			left: -1%;
			top: 50%;
			width: 10px;
			height: 1.3em;
			margin-left: -4px;
			margin-top: -1.3em;
			background-color: #FFD473;
		}

		h4{
			background-color: #F6F6F6;
			margin-top: 1.35em;
		}
		h4:after{
			content: " ";
			display: block;
			position: relative;
			left: -1%;
			top: 50%;
			width: 8px;
			height: 1.35em;
			margin-left: -4px;
			margin-top: -1.35em;
			background-color: #AEFF73;
		}

		h5{
			background-color: #F6F6F6;
			margin-top: 1.5em;
		}
		h5:after{
			content: " ";
			display: block;
			position: relative;
			left: -1%;
			top: 50%;
			width: 6px;
			height: 1.5em;
			margin-left: -4px;
			margin-top: -1.5em;
			background-color: #73DEFF;
		}

		h6{
			background-color: #F6F6F6;
			margin-top: 1.6em;
		}
		h6:after{
			content: " ";
			display: block;
			position: relative;
			left: -1%;
			top: 50%;
			width: 4px;
			height: 1.6em;
			margin-left: -4px;
			margin-top: -1.6em;
			background-color: #A168E7;
		}

		img{
			/* This gives you more control for the images than you originally get from Skeleton */
			width: 100%;
		    border-radius: 4px;
			-webkit-box-shadow: 0px 1px 2px 1px rgba(0,0,0,0.2);
			-moz-box-shadow: 0px 1px 2px 1px rgba(0,0,0,0.2);
			box-shadow: 0px 1px 2px 1px rgba(0,0,0,0.2);

			-webkit-transition: all 200ms cubic-bezier(.4,0,.2,1);
			-moz-transition: all 200ms cubic-bezier(.4,0,.2,1);
			transition: all 200ms cubic-bezier(.4,0,.2,1);
		}
		img:hover{
			-webkit-box-shadow: 0px 4px 18px 4px rgba(0,0,0,0.2);
			-moz-box-shadow: 0px 4px 18px 4px rgba(0,0,0,0.2);
			box-shadow: 0px 4px 18px 4px rgba(0,0,0,0.2);
		}

		@media (min-width: 750px) {

			img.left{
				width: 46%;
				margin-right: 20px;
				float: left;
			}

			img.right{
				width: 46%;
				margin-left: 20px;
				float: right;
			}

			img.centre{
				width: 100%;
			}
		}

		@media (min-width: 1000px) {

			img.left{
				width: 36%;
				margin-right: 20px;
				float: left;
			}

			img.right{
				width: 36%;
				margin-left: 20px;
				float: right;
			}

			img.centre{
				width: 100%;
			}
		}

		hr{
			border: none;
			border-top: medium double #E1E1E1;
			color: #E1E1E1;
			text-align: center;
		}

        h1{
            font-family: "Avenir Next Condensed", "HelveticaNeue-CondensedBold", 'LeagueGothicRegular', "Impact", Charcoal, Arial Black, Gadget, Sans serif, 
            'Lantinghei SC', 'Hiragino Sans GB', PingHei, 微软正黑体, 'Segoe UI Webfont', 'Microsoft YaHei', 'Heiti SC', Arial, sans-serif,
            'Lantinghei TC', 'Hiragino Kaku Gothic Pro', 微軟正黑體, 'STHeiti Light', 'Microsoft JhengHei', 'Heiti TC';

            /*@SlabText*/
            /* These styles are for slabText. Read more in the articles/how-to-use-this-blog-system.txt */
            text-align:left;
            text-transform: uppercase;
            line-height:1;
            color:#fff;
            font-size:300%;
            font-weight:normal;
            padding-top: 100px;

            /* Be aware that IE doesn't support text-shadow but filter. There fore the cover.jpg should always be dark enough to provide a good contrast for the white headings. */
			  text-shadow: 0 1px 0 #c9c9c9,
				           0 1px 5px rgba(0,0,0,.1),
				           0 1px 3px rgba(0,0,0,.3),
				           0 3px 5px rgba(0,0,0,.2),
				           0 5px 10px rgba(0,0,0,.25),
				           0 10px 10px rgba(0,0,0,.2),
				           0 20px 20px rgba(0,0,0,.15);
			filter: dropshadow(color=#333, offx=0, offy=2);

			-webkit-transition: all 200ms cubic-bezier(.4,0,.2,1);
			-moz-transition: all 200ms cubic-bezier(.4,0,.2,1);
			transition: all 200ms cubic-bezier(.4,0,.2,1);
        }
        .slab{
        	/* Although it is not recommended, you CAN use SlabText on elements inside your articles other then your <h1> title.
			   Simply add class "slab" to your elements.
        	*/

            font-family: "Avenir Next Condensed", "HelveticaNeue-CondensedBold", 'LeagueGothicRegular', "Impact", Charcoal, Arial Black, Gadget, Sans serif, 
            'Lantinghei SC', 'Hiragino Sans GB', PingHei, 微软正黑体, 'Segoe UI Webfont', 'Microsoft YaHei', 'Heiti SC', Arial, sans-serif,
            'Lantinghei TC', 'Hiragino Kaku Gothic Pro', 微軟正黑體, 'STHeiti Light', 'Microsoft JhengHei', 'Heiti TC';

            /*@SlabText*/
            /* These styles are for slabText. Read more in the articles/how-to-use-this-blog-system.txt */
            text-align:left;
            text-transform: uppercase;
            line-height:1;
            font-size:300%;
            font-weight:normal;
        }

        #cover{
        	background-image: url(<?php echo "./articles/".$title."/cover.jpg";?>);
	        background-size: cover;
	        -webkit-background-size: cover;
	        -moz-background-size: cover;
	        -o-background-size: cover;
	        height: 100%;
	        width: 100%;
	        background-position: center center;
	        background-repeat: no-repeat;
	        margin-bottom: 5px;

	        /* For IE*/
	        filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?php echo "./articles/".$title."/cover.jpg";?>', sizingMethod='scale');
			-ms-filter: "progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?php echo "./articles/".$title."/cover.jpg";?>', sizingMethod='scale')";

			-webkit-transition: all 200ms cubic-bezier(.4,0,.2,1);
			-moz-transition: all 200ms cubic-bezier(.4,0,.2,1);
			transition: all 200ms cubic-bezier(.4,0,.2,1);
        }
		.serif{
    		font-family: Georgia, Utopia, 'Times New Roman', Times, serif;
		}
		em{
    		font-family: Georgia, Utopia, 'Times New Roman', Times, serif;
		}
		#default_title{
    		font-family: Georgia, Utopia, 'Times New Roman', Times, serif;
            text-transform: none;
			text-shadow:0 0px 1px rgba(0,0,0,.1),
			           0 0 5px rgba(0,0,0,.1),
			           0 1px 3px rgba(0,0,0,.3),
			           0 3px 5px rgba(0,0,0,.2),
			           0 5px 10px rgba(0,0,0,.25),
			           0 10px 10px rgba(0,0,0,.2),
			           0 20px 20px rgba(0,0,0,.15);
            color: #000B28;
		}

		/* 
			If your table is wide and contains multiple columns, wrap it with <div class="table-wrapper"></div>
			This is to prevent table from overflowing on small screens.
			Shadow will be added to it when scrolling by jQuery to indicate there are more contents. */
		.table-wrapper{
			overflow: scroll;
		}
		.table-wrapper > table{
			width: 100%;
			box-sizing: border-box; 
		}

		.showcase{
			color: #7F8C8D;
			outline: solid 1px #aaa;
			border-top: solid 1px #666;
			border-bottom: solid 1px #BDC3C7;
			height: 300px;
			overflow: scroll;
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
			background-color: #ECF0F1;

		}

		#fixed_scrollToTop{
			height: 40px;
			width: 80px;
			background-color: #000;
			background-color: rgba(0,0,0,0.2);
			color: #FFF;
			text-align: center;
			line-height: 40px;
			position: fixed;
			right: 0;
			bottom: 0;
			text-decoration: underline;
	        cursor:pointer;
		}
		#fixed_scrollToTop:hover{
	        cursor:pointer;
	        color: #2980B9;
		}

		/*@SlabText*/
		/* These styles will only be apply after the javascript. It's different from the .slab class. */
        /* These styles are for slabText. Read more in the articles/how-to-use-this-blog-system.txt */
        .slabtexted .slabtext
        {
	        display:-moz-inline-box;
	        display:inline-block;
	        white-space:nowrap;
        }
		.slabtextinactive .slabtext
        {
	        display:inline;
	        white-space:normal;
	        font-size:1em !important;
	        letter-spacing:inherit !important;
	        word-spacing:inherit !important;
	        *letter-spacing:0 !important;
	        *word-spacing:0 !important;
        }
		.slabtextdone .slabtext
        {
	        display:block;
        }
        
        /* Styles for the loading effect */
        .no-js #loader { display: none;  }
		.js #loader { display: block; position: absolute; left: 100px; top: 0; }
		.loader-wrapper {
			position: fixed;
			left: 0px;
			top: 0px;
			width: 100%;
			height: 100%;
			z-index: 9999;
			background: url(images/loader.gif) center no-repeat #fff;
			background-size: 64px 39px;
			color: #DA5856;
			line-height: 500px;
			text-align: center;
		}

	</style>

	<!-- MathJax 
		 formatting LaTeX. read more on http://docs.mathjax.org/en/latest/start.html -->
	<script type="text/x-mathjax-config">
	MathJax.Hub.Config({
	    tex2jax: {
	        inlineMath: [ ["\[","\]"] ],
	        displayMath: [ ['$$','$$'], ["\\[","\\]"] ],
	        processEscapes: false,
	    }
	});
	</script>
	<script type="text/javascript" src="https://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML"></script>
	
	<!-- Font-awersome see http://fortawesome.github.io/Font-Awesome/ -->
	<link rel="stylesheet" href="./css/font-awesome/css/font-awesome.min.css">
	
	<!-- highlight
		 code highlighting. read more on https://highlightjs.org/ -->
	<link rel="stylesheet" href="./js/highlight/styles/github.css">
	<script src="./js/highlight/highlight.pack.js"></script>
	<script>hljs.initHighlightingOnLoad();</script>

	<!-- 
	@features_comments
	If you want the comment feature, 
	1. visit https://eager.io/app/disqus
	2. register, get your link (something like //fast.eager.io/XXXXXXX.js)
	3. uncomment the next line, substitute your link
	<script src="//fast.eager.io/YOUR-LINK.js"></script>
	4. install https://eager.io/app/disqus
	5. set the location to #comments, and chose 'place it at the bottom of this location'
	6. find "@features_comments" in this file and uncomment the codes
	 -->
	
	</head>
<body>
	<div class="loader-wrapper"></div>
  	<?php

  		if($title != "default"){
  			echo '<span itemscope itemtype="http://schema.org/Article" id="itemscope_wrapper">';
  		}
  	?>
	<div id="cover">
	  <div class="container">
	    <div class="row" id="cover-texts">

	    </div>
	  </div>
	</div>

	<div class="container">
		<div class="row">
			<div class="twelve columns" style="margin-top: 20px;">
			  	<?php
			  		if($title != "default"){
			  			echo '<span itemprop="articleBody" markdown="1">';
			  		} 

			  		// echo htmlentities($my_html); 
			  		// show the output html codes without any further processing, use when debug

			  		echo $my_html; 

			  		if($title != "default"){
			  			echo '</span>';
			  		} 
		  		?>
			</div>
		</div>
	</div>

  	<?php
  		if($title != "default"){
  			echo '</span>';
  		}

  		// This is for the Comments feature. 
  		// find another @features_comments in this page to read more
		// if($title != "default" && $title != "404"){
		// 	echo '
		// 		<div class="container">
	//				<hr>
		// 			<div class="row">
		// 				<div class="twelve column" id="comments">
		// 				<h4><strong>Comments</strong></h4>
						  
		// 				</div>
		// 			</div>
		// 		</div>
		// 	';
		// }

	?>
	<div class="scrollToTop" id="fixed_scrollToTop">↑TOP</div>

	<div class="container">
		<hr>
		<div class="row">
			<div class="twelve column" style="text-align:center;">Thanks for reading. Go back to <a href="#top" class="scrollToTop">↑TOP</a> or see <a href='./mangolb/'>full list of posts</a>.</div>
		</div>
	</div>

	<hr>
	<div class="container">
		<div class="row">
			<div class="twelve column" style="margin-bottom: 2.5em;text-align:center;">
			  MMXV © MangleKuo
			</div>
		</div>
	</div>

	<script src="//code.jquery.com/jquery-2.1.4.min.js"></script>

	<!-- SlabText
		 Make all tables sortable. read more on http://freqdec.github.io/slabText/ 
		 @SlabText-->
	<script src="./js/slabText/js/jquery.slabtext.min.js"></script>

	<!-- sorttable
		 Adjust the font-size to make title full width. read more on http://www.kryogenix.org/code/browser/sorttable/ -->
	<script src="./js/sorttable.js"></script>
	<script>

		// Fade out the loading effect when the page is load.
		$(window).load(function() {
			// Animate loader off screen
			$(".loader-wrapper").fadeOut("slow");;
		});

        if($("h1").first().text() != "defalut"){
		    $("h1").first().attr("itemprop","name");
        }

        //Display shadow to indicate there's more when scrolling overflowed table.
		$(".table-wrapper").each(function(){
			if ($(this).outerWidth() < $(this).children().first().width()) {
				$(this).css("-webkit-box-shadow", "inset -6px 0px 8px -6px rgba(0,0,0,0.5)");
				$(this).css("-moz-box-shadow", "inset -6px 0px 8px -6px rgba(0,0,0,0.5)");
				$(this).css("box-shadow", "inset -6px 0px 8px -6px rgba(0,0,0,0.5)");
			} else {
				$(this).css("-webkit-box-shadow", "inset -6px 0px 8px -6px rgba(0,0,0,0)");
				$(this).css("-moz-box-shadow", "inset -6px 0px 8px -6px rgba(0,0,0,0)");
				$(this).css("box-shadow", "inset -6px 0px 8px -6px rgba(0,0,0,0)");
			}
		});

		//@SlabText
		// SlabText. read more in the article
        $("h1").first().slabText(); 
        $(".slab").slabText(); 

        // Adapt the height of the cover image section with the height of the <h1> title
        $("#cover").height( ($("h1").first().height()+200) );

		$(document).ready(function() {

		    document.title = $("h1").first().text();

		    //@PutH1IntoCover
		    //Put h1 into the cover image section
		    $( "h1" ).prependTo( $( "#cover-texts" ) );

			setTimeout( function(){
				// Deal with extremely long equations
				// Wait 1 second for the MathJax script to finish running
				$( "span.MathJax" ).each(function(){
					$(this).parent().css( "overflow-x", "scroll" );
					$(this).parent().css( "overflow-y", "hidden" );
					$(this).parent().scroll(function(event){
					   var st = $(this).scrollLeft();
					   if (st == 0){
					       // rightcroll code
					       $(this).css("-webkit-box-shadow", "inset -3px 0px 2px -3px rgba(0,0,0,0)");
							$(this).css("-moz-box-shadow", "inset -3px 0px 2px -3px rgba(0,0,0,0)");
							$(this).css("box-shadow", "inset -3px 0px 2px -3px rgba(0,0,0,0)");
					   } else if (st > lastScrollLeft){
					       // rightcroll code
					       $(this).css("-webkit-box-shadow", "inset -3px 0px 2px -3px rgba(0,0,0,0.75)");
							$(this).css("-moz-box-shadow", "inset -3px 0px 2px -3px rgba(0,0,0,0.75)");
							$(this).css("box-shadow", "inset -3px 0px 2px -3px rgba(0,0,0,0.75)");
					   } else {
					      // leftscroll code
					       $(this).css("-webkit-box-shadow", "inset 3px 0px 2px -3px rgba(0,0,0,0.75)");
							$(this).css("-moz-box-shadow", "inset 3px 0px 2px -3px rgba(0,0,0,0.75)");
							$(this).css("box-shadow", "inset 3px 0px 2px -3px rgba(0,0,0,0.75)");
					   }
					   lastScrollLeft = st;
					});				
				});
			} ,1000);
			$(".make-sortable").children().addClass("sortable");
		});
		
		$(".scrollToTop").click(function() {
			$("html, body").animate({ scrollTop: 0 }, "slow");
			return false;
		});

        $(window).resize(function(){
			setTimeout( function(){
	        $("#cover").height( ($("h1").first().height()+200) );
			} ,1000);
			$(".table-wrapper").each(function(){
				if ($(this).outerWidth() < $(this).children().first().width()) {
					$(this).css("-webkit-box-shadow", "inset -6px 0px 8px -6px rgba(0,0,0,0.5)");
					$(this).css("-moz-box-shadow", "inset -6px 0px 8px -6px rgba(0,0,0,0.5)");
					$(this).css("box-shadow", "inset -6px 0px 8px -6px rgba(0,0,0,0.5)");
				} else {
					$(this).css("-webkit-box-shadow", "inset -6px 0px 8px -6px rgba(0,0,0,0)");
					$(this).css("-moz-box-shadow", "inset -6px 0px 8px -6px rgba(0,0,0,0)");
					$(this).css("box-shadow", "inset -6px 0px 8px -6px rgba(0,0,0,0)");
				}
			});
        });

	</script>

</body>
</html>
