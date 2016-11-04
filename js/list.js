$(document).on("click","li.entry",function(){
	location.href = './detail.php?disp_faulty=' + DISP_FAULTY + '&announce_id=' + $(this).attr('data-announce-id');
}).on("click","div#load-next",function(){
	var b = $(this);
	b.addClass("disabled");
	var originalText = b.text();
	b.text(b.attr("data-loading-msg"));
	var last = document.getElementById('list').lastElementChild;
	var offset = parseInt(last.getAttribute('data-disp-order'), 10)-1;
	var url = "./partial.php?disp_faulty=" + DISP_FAULTY + "&offset="+offset;
	$.get(url, function(data){
		if (data.length == 0){
			b.text(b.attr("data-no-more-msg"));
			return;
		}
		b.removeClass("disabled");
		b.text(originalText);
		$("#list").append(data);	
	});	
});