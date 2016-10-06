var players = 4;
var variant;
var activeColorsCount = 0;

$(document).ready(function () {
    $('.panel-heading span.clickable').click();
    $('.panel div.clickable').click();

	$('#fullpage').fullpage({
		sectionsColor: ['#1ABC9C', '#E67E22', '#e74c3c','#ECF0F1', 'ccddff', '#ccddff'],
		easingcss3: 'cubic-bezier(0.175, 0.885, 0.320, 1.275)',
        anchors:['welcome','players','variant','colors']
	});
});
	
$(document).on('click', '.panel-heading span.clickable', function (e) {
	var $this = $(this);
	if (!$this.hasClass('panel-collapsed')) {
	    $this.parents('.panel').find('.panel-body').slideUp();
	    $this.addClass('panel-collapsed');
	    $this.find('i').removeClass('glyphicon-minus').addClass('glyphicon-plus');
	} else {
	    $this.parents('.panel').find('.panel-body').slideDown();
	    $this.removeClass('panel-collapsed');
	    $this.find('i').removeClass('glyphicon-plus').addClass('glyphicon-minus');
	}
});

$(document).on('click', '.panel div.clickable', function (e) {
    var $this = $(this);
    if (!$this.hasClass('panel-collapsed')) {
        $this.parents('.panel').find('.panel-body').slideUp();
        $this.addClass('panel-collapsed');
        $this.find('i').removeClass('glyphicon-minus').addClass('glyphicon-plus');
    } else {
        $this.parents('.panel').find('.panel-body').slideDown();
        $this.removeClass('panel-collapsed');
        $this.find('i').removeClass('glyphicon-plus').addClass('glyphicon-minus');
    }
});


$('#playersbtns .btn').on("click",function(){
   players = parseInt($(this).text());
   window.location.hash = "variant";
})

$('#variantbtns .btn').on("click",function(){
	variant = $(this).find("input").val();
   window.location.hash = "colors";
})

$('#colorsbtns .btn').on("click",function(e){
	var isChecked = !this.children[0].checked;
		if(players == activeColorsCount && isChecked == true ){
			var lastColor = $(":checkbox:checked:last");
			lastColor[0].checked = false;
			lastColor.parent().removeClass('active');
			return;
		}

   	isChecked === true ? activeColorsCount++ : activeColorsCount--;
   	$("#cChosen").html(activeColorsCount +" colors chosen");
})

function init(){
    $('#fullpage').fullpage({
		sectionsColor: ['#1ABC9C', '#E67E22', '#ECF0F1', '#2C3E50', '#2C3E50'],
		easingcss3: 'cubic-bezier(0.175, 0.885, 0.320, 1.275)',
        anchors:['welcome','players','variant','colors','result'],
        loopHorizontal: false,
	    onSlideLeave: function(anchorLink, index, slideIndex, direction, nextSlideIndex){
			//$("#section3 .fp-slides .fp-slidesContainer .slide")[slideIndex].remove();
	    },
	    afterSlideLoad: function( anchorLink, index, slideAnchor, slideIndex){
	        $('div.fp-controlArrow.fp-prev').hide()
		 }
    });
    $.fn.fullpage.setKeyboardScrolling(false, 'left');
    $.fn.fullpage.setAllowScrolling(false, 'left');
}

$('#shuffleCards').on("click",function(e){
	var activeColors = $(":checkbox:checked");

	if(activeColors.length != players)
		return;

	var colors = [];
	for (var i = activeColors.length - 1; i >= 0; i--) {
		colors.push(activeColors[i].value);
	}
	$.ajax({
	    type:"GET", 
	    data: "players=" + players + "&colors=" + colors + "&variant=" + variant,
	    url: "http://localhost:8888/Risk/Api.php",
	    success: function(data) {
		//	$.each(data, function( i, l ){
		//	  alert( "Index #" + i + ": " + l );
		//	});

	$('#fullpage').append('<div class="section" id="section4" data-anchor="result" >' + data + '</div>');

    //remembering the active section / slide
    var activeSectionIndex = $('.fp-section.active').index();
    var activeSlideIndex = $('.fp-section.active').find('.slide.active').index();

    $.fn.fullpage.destroy('all');

    //setting the active section as before
    $('.section').eq(activeSectionIndex).addClass('active');

    //were we in a slide? Adding the active state again
    if(activeSlideIndex > -1){
        $('.section.active').find('.slide').eq(activeSlideIndex).addClass('active');
    }
	   window.location.hash = "result";

    init();

        }, 
	    error: function(jqXHR, textStatus, errorThrown) {
	        }
	   //dataType: "json"
	});
});