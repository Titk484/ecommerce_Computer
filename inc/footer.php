</div>
<div class="footer_">
    <div class="wrapper">	
        <div class="section footer_group">
                <div class="footer_1">
                        <h4>WinX</h4>
                        <ul>
                            <li><p>WinX là doanh nghiệp chuyên cung cấp thiết bị, giải pháp về máy tính, thiết bị chơi game, thiết bị công nghệ cao cấp hàng đầu Việt Nam</p></li>
                            <li><p>Hãy kết nối với chúng tôi</p></li>
                        </ul>
                    </div>
                <div >
                    <h4>HỆ THỐNG CỬA HÀNG</h4>
                        <ul>
                            <li><p>52 An Dương Vương , P.12 , Q.5 , TP.HCM</p></li>
                            <li><p>283 Lê Văn Sỹ , P.10 , Q.3 , TP.HCM</p></li>
                            <li><p>696 Lạc Long Quân , P.2 , Q.11 , TP.HCM</p></li>
                        </ul>
                </div>
                <div >
                    <h4>HỆ THỐNG TỔNG ĐÀI</h4>
                        <ul>
                            <li><p>Gọi mua hàng : 1900 9999</p></li>
                            <li><p>Gọi tư vấn : 1900 7572</p></li>
                            <li><p>Gọi đánh giá : 1900 3321</p></li>
                        </ul>
                </div>
            </div>
            <div class="copy_right">
                <p>Thương mại điện tử &amp; HKIII-2023 </p>
        </div>
    </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            /*
            var defaults = {
                containerID: 'toTop', // fading element id
                containerHoverID: 'toTopHover', // fading element hover id
                scrollSpeed: 1200,
                easingType: 'linear' 
            };
            */
            
            $().UItoTop({ easingType: 'easeOutQuart' });
            
        });
    </script>
    <a href="#" id="toTop" style="display: block;"><span id="toTopHover" style="opacity: 1;"></span></a>
    <link href="css/flexslider.css" rel='stylesheet' type='text/css' />
    <script defer src="js/jquery.flexslider.js"></script>
    <script type="text/javascript">
        $(function(){
        SyntaxHighlighter.all();
        });
        $(window).load(function(){
        $('.flexslider').flexslider({
            animation: "slide",
            start: function(slider){
            $('body').removeClass('loading');
            }
        });
        });
    </script>

    
    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
    var Tawk_API = Tawk_API || {},
      Tawk_LoadStart = new Date();
    (function () {
      var s1 = document.createElement("script"),
        s0 = document.getElementsByTagName("script")[0];
      s1.async = true;
      s1.src = 'https://embed.tawk.to/64ad0c7994cf5d49dc62d359/1h51vhf9d';
      s1.charset = 'UTF-8';
      s1.setAttribute('crossorigin', '*');
      s0.parentNode.insertBefore(s1, s0);
    })();

    // Custom styling of Offset starts here
    Tawk_API.customStyle = {
      visibility: {
        //for desktop only
        desktop: {
          position: 'br', // bottom-right
          xOffset: 15, // 15px away from right
          yOffset: 80 // 40px up from bottom
        },
        // for mobile only
        mobile: {
          position: 'bl', // bottom-left
          xOffset: 5, // 5px away from left
          yOffset: 50 // 50px up from bottom
        },
        // change settings of bubble if necessary
        bubble: {
          rotate: '0deg',
          xOffset: -20,
          yOffset: 0
        }
      }
    }
    </script>
    <!--End of Tawk.to Script-->

    <!-- Messenger Plugin chat Code -->
    <div id="fb-root"></div>

    <!-- Your Plugin chat code -->
    <div id="fb-customer-chat" class="fb-customerchat">
    </div>

    <script>
      var chatbox = document.getElementById('fb-customer-chat');
      chatbox.setAttribute("page_id", "107935075695081");
      chatbox.setAttribute("attribution", "biz_inbox");
    </script>

    <!-- Your SDK code -->
    <script>
      window.fbAsyncInit = function() {
        FB.init({
          xfbml            : true,
          version          : 'v17.0'
        });
      };

      (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));
    </script>
</body>
</html>
