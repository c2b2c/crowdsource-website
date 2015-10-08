<?php
   session_start();
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />

  <meta name="viewport" content="width=device-width, initial-scale=1.0">


  <link href="https://g0.iggcdn.com/assets/select2/select2-14ce12500df4fd61a74cd958316e55f1.css" media="screen" rel="stylesheet" type="text/css" />
  <link href="https://g2.iggcdn.com/assets/site/fonts-3ec4e129795fa2eecea935b31e30a485.css" media="screen" rel="stylesheet" type="text/css" />
  <link href="https://g2.iggcdn.com/assets/site/common-3ebfcb39b14b4170834df0c41137921c.css" media="screen" rel="stylesheet" type="text/css" />
  
    <link href="https://g1.iggcdn.com/assets/site/explore-1c92800ae0db35d869020e4d4775af28.css" media="screen" rel="stylesheet" type="text/css" />


  <script type="text/javascript">
//<![CDATA[
window.gon = {};gon.pageview_data={"new_url":"/explore/NULL/popular_all"};gon.subdomain=null;
//]]>
</script>
  <script type="text/javascript">
  try {
    var _gaq = _gaq || [];
  } catch(err) {}
</script>


</head>
<body ng-app="lite" >
  <div id="fb-root"></div>
<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '2392863781',
      version    : 'v2.2',
      channelUrl: 'http://www.indiegogo.com//channel.html', // Channel File for x-domain communication
      status: true, // check the login status upon init?
      cookie: true, // set sessions cookies to allow your server to access the session?
      xfbml: true
    });
  };

  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) {return;}
    js = d.createElement(s); js.id = id;
    var fbLocale = {'en': 'en_US', 'fr': 'fr_FR', 'de': 'de_DE', 'es': 'es_ES'}['en'];
    js.src = "//connect.facebook.net/" + fbLocale + "/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));</script>


  
  

      
<div header-main>
  <div class="i-page-header">
    <div class="visible-xs">
      <a class="i-search-button" href="" ng-click="toggleSearchMode()" ng-class="{'i-active': inSearchMode}"><span class="i-icon i-glyph-icon-30-search"></span></a>

        <div class="i-header-bar" header-dropdown-link>
          <span class="i-site-logo">PROWDSOURCE</span>
          <span class="i-icon i-glyph-icon-30-downcarrot"></span>
        </div>
        <div class="dropdown-menu i-linklist-dropdown i-capitalize">
            <a href="https://www.indiegogo.com/accounts/sign_up?return_to=https%3A%2F%2Fwww.indiegogo.com%2Fexplore">Log in or Sign up</a>
        </div>
    </div>
    <div class="hidden-xs">
      <div class="container">
          <div class="i-header-links-area pull-right">
            <div class="i-header-links i-header-account-links">

                <!-- in/out-of session nav bar.  Do not change -->
                <?php
                  if($_SESSION['is_open']){ 
                    echo "Welcome ". $_SESSION["login_user"] . "!    "; 
                    echo "<a href=\"logout.php\"> Log out</a> ";
                    echo "<a href=\"userprofile.php?username=" . $_SESSION["login_user"] . "\"> Account </a>";
                    echo "<a href=\"createproject.html\"> Create Project</a> ";
                    echo "<a href=\"post.php\"> Create Post</a> ";
                  }
                  else{ ?>
                  <!-- HTML here -->
                   <a href="register.html" ng-click="openModal('signupForm')">Sign up</a>
                   <a href="login.html" ng-click="openModal('loginForm')">Log in</a>   

                 <?php } ?>

            </div>
            <div class="i-header-links i-header-menu-links">
            </div>
          </div>

        <h2>PROWDSOURCE</h2>
        </div>
    </div>

  </div>
</div>

  





<div class="container hidden" header-flash-container>
</div>


  <div class="visible-xs visible-sm">
      <div class="i-filter-search-area">
    <span class="i-explore-breadcrumb hidden-xs">
    </span>


      <div class="i-float-tab-links i-filter-tab-links hidden-xs">
        <a href="/explore?filter_quick=popular_all" class="i-tab i-selected"><span>Trending</span></a>
        <a href="/explore?filter_quick=countdown" class="i-tab"><span>Final Countdown</span></a>
        <a href="/explore?filter_quick=new" class="i-tab"><span>New This Week</span></a>
        <a href="/explore?filter_quick=most_funded" class="i-tab"><span>Most Funded</span></a>
      </div>
  </div>

  </div>

</form>
      <div class="col-md-9 i-mobile-fullwidth i-overflow-hidden i-explore-col">
        <div class="visible-lg">
            <div class="i-filter-search-area">
    <span class="i-explore-breadcrumb hidden-xs">
    </span>

      
  </div>

        </div>


          <div class="i-project-cards">


              

<?php
  require_once "common.php";

  $stmt = "SELECT * FROM project NATURAL JOIN post_on NATURAL JOIN article_post";

  $post_info = mysqli_query($conn,$stmt);


  if ($post_info->num_rows > 0) {
      // output data of each row
      while($row = $post_info->fetch_assoc()) {
        $post_id = $row['post_id'];
        $name = $row['name'];
        $title = $row['title'];
        $category = $row['category'];
        $image = $row['image'];

        echo " <div class=\"i-project-card \">  ";
        echo "<a href=\"article.php?postid=" . $post_id . "\" class=\"i-category-header\">";
        echo "<span class=\"i-icon i-category-icon i-glyph-icon-22-community\"></span>";
        echo "<span>" . $category . "</span>";
        echo "</a>";

        echo " <a href=\"article.php?postid=" . $post_id . "\" class=\"i-project\">";

        echo "<div class=\"i-img\" data-src=". $image . "> </div>";
        echo "<div class=\"i-content\">";
        echo "<div class=\"i-title\">" . $name . "</div>";
        echo "<div class=\"i-tagline\">" . $title . "</div>";
        echo "</div>";
        echo "  </a> </div> ";
      }
  } else {
      echo "No post!";
  }

?>

<!-- <p> Works </p> -->


<!--       <a href="/explore/community" class="i-category-header">
        <span class="i-icon i-category-icon i-glyph-icon-22-community"></span>
        <span>$category</span>
      </a> -->
<!--   <a href="/projects/george-takei-s-legacy-project/pipp?sa=0&amp;sp=0" class="i-project">
    <div class="i-img" data-src=$image>
    </div>
    <div class="i-content">
      <div class="i-title">$summary:</div>
      <div class="i-tagline ">$title</div>
    </div>

</a></div> -->

                      <div style="height: 5px;"></div>
                      

      
              </div>

          </div>

      </div>
    </div>
  </div>

</div>


  <!--[if gte IE 9]-->
  <script src="https://g3.iggcdn.com/assets/jquery/jquery-d0b22947e1c602ca30e3d763c1b5b34b.js" type="text/javascript"></script>
  <script src="https://g3.iggcdn.com/assets/hammerjs/hammer-e44209398b23dea8bbf0113c889a30f1.js" type="text/javascript"></script>
  <!--<![endif]-->

    <script src="https://g1.iggcdn.com/assets/i18n_stack-81b04cf48381ace79ae375e21d42f112.js" type="text/javascript"></script>
    <script src="https://g2.iggcdn.com/assets/igg/site/common-5682e845b49bd63bc87b54a6e2ccb842.js" type="text/javascript"></script>
    <script src="https://g0.iggcdn.com/assets/lite_angular-b7075479eaf0ba160ab741cdc1a966ad.js" type="text/javascript"></script>
    <script src="https://g2.iggcdn.com/assets/ancillary-8604656c73ffd9365e128e96922175af.js" type="text/javascript"></script>
    

  <script type="text/javascript">
    I18n.defaultLocale = "en";
    I18n.locale = "en";

      $(document).ready(function() {
        igg.site.onDocumentReady();
      });

    $.cloudinary.config({"api_key":"754759674861391",
      "cloud_name": "indiegogo-media-prod-cld",
      "cname": ""
    });

      $(document).ready(function() {
  new igg.site.ExplorePage({el: $(".i-explore-page")}).start();
  });
  $(".i-icon-info-bubble").iggPopover();

  </script>

  

</body>
</html>