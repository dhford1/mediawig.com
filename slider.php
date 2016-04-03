<h1  class="clsMainContentHeader"http://www.mediawig.com/index.php?sect=1>Work of Note</h1><br/>
<div class="slideshow" id="flavor_1"></div>
<br/><br/>
<link rel="stylesheet" href="jquery/flavor_1_files/agile_carousel.css">
<link rel="stylesheet" href="jquery/flavor_1_files/slider-style.css">
<script src="jquery/flavor_1_files/ga.js" async="" type="text/javascript"></script>
<script src="jquery/flavor_1_files/modernizr-1.js" type="text/javascript"></script> 
<script src="jquery/agile_carousel.a1.1.min.js"></script> 
<script>
    $.getJSON("carousel_data.php", function(data) {
         $(document).ready(function(){
            $("#flavor_1").agile_carousel({
                carousel_data: data,
                carousel_outer_height: 150,
                carousel_height: 150,
                slide_height: 152,
                carousel_outer_width: 600,
                slide_width: 600,
                transition_time: 300,
                timer: 4000,
                continuous_scrolling: true,
                control_set_1: "numbered_buttons",
                no_control_set: "hover_previous_button,hover_next_button"
            });
        });
    });
</script>