<div class="container">
    <div id="faq" class="faq-term">
        <p>Frequently asked questions</p>
        <!-- class border -->
        <div class="content-faq">
            <!-- item 1-->
            <?php if (!empty($faqs)) { foreach($faqs as $key => $faq) { ?>
            <div class="drop-down-questions">
                <!--question-->
                <div class="drop-down"><i class="fa fa-circle" aria-hidden="true"></i><?=$faq->title?><i class="fa fa-angle-down" aria-hidden="true"></i></div>
                <!--answer-->
                <div class="slide-down-content"><?=$faq->content?></div>
            </div>
            <?php } } ?>
            
        </div><!-- end class border-->
    </div>
</div>
<script>
    $('.faq-term .drop-down').click(function() {
        if($(this).next('.slide-down-content').css("display")=="none") {
            $(this).next('.slide-down-content').slideDown(200);
            $(this).parent('.drop-down-questions').css({"background-color":"#f5f5f5"});
            $(this).css({"color":"#8b6ce4"});
            $(this).children('i').css({"color":"#8b6ce4"});
            $(this).children(".fa-angle-down").addClass("active");
        }
        else {
            $(this).next('.slide-down-content').slideUp(200);
            $(this).parent('.drop-down-questions').css({"background-color":"white"});
            $(this).css({"color":"#000"});
            $(this).children('i').css({"color":"#7e7e7e"});
            $(this).children(".fa-angle-down").removeClass("active");
        }
    });
</script>