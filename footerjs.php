<!--
	<script src="/js/jquery.js"></script>
    <script src="/js/jquery.min.js"></script>
-->
    <script src="/js/jquery.sudoSlider.min.js"></script>

    <script src="/js/bootstrap.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/hover-dropdown.js"></script>
    
    <!-- <script src="/js/bootstrap-transition.js"></script>
    // <script src="/js/bootstrap-alert.js"></script>
    // <script src="/js/bootstrap-modal.js"></script>
    // <script src="/js/bootstrap-scrollspy.js"></script>
    // <script src="/js/bootstrap-tab.js"></script>
    // <script src="/js/bootstrap-tooltip.js"></script>
    // <script src="/js/bootstrap-popover.js"></script>
    // <script src="/js/bootstrap-button.js"></script>
    // <script src="/js/bootstrap-collapse.js"></script>
    // <script src="/js/bootstrap-carousel.js"></script>
    // <script src="/js/bootstrap-typeahead.js"></script> -->
    
    <script src="/js/jquery/jquery.jticker/jquery.jticker.js"></script>
    <script src="/js/jquery/jquery.galleriffic/jquery.history.js"></script>
    <script src="/js/jquery/jquery.galleriffic/jquery.galleriffic.js"></script>
    <script src="/js/jquery/jquery.galleriffic/jquery.opacityrollover.js"></script>
    
    <script>
    // very simple to use!
    $(document).ready(function() {
        // $('body').on('hover.tab.data-api', '[data-toggle="tab"], [data-toggle="pill"]', function (e) {
        //     e.preventDefault()
        //     $(this).tab('show')
        // });
        $("#slider").sudoSlider({
            controlsShow:false,
            numeric:false,
            auto:true,
            fade:true,
            pause:'5000',
            continuous:true,
            slideCount:2,               
        });
        $('.dropdown-toggle').dropdown();
        $('.dropdown-toggle').dropdownHover(true);
        // var sudoSlider = $("#slider").sudoSlider({
        //     continuous:        true,
        //     history:           true,
        //     numericText:       ['one','two','three'],
        //     customLink:        'a.tablink',
        //     updateBefore:      true,
        //     nextHtml:          '<span> next </span>'
        // });

        $("#newsline").ticker({
            cursorList:  " ",
            rate:        10,
            delay:       4000
        }).trigger("play").trigger("play"); 
        $("#newsline").trigger("play"); 
    });

</script>
	