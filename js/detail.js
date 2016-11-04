$(document).on("click","#back",function(){
	location.href = './' + (DISP_FAULTY != 0?("?disp_faulty="+DISP_FAULTY):"");
});