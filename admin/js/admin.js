$(document).ready(function(){
	$(".btn-refresh-all").click(function() {
		$.get("../cron/all.php",
			function(){
				$(".btn-refresh-all").toggleClass('btn-info btn-success');
			});
	});
	$(".btn-refresh-purge").click(function() {
		$.get("../cron/purge.php",
			function(){
				$(".btn-refresh-purge").toggleClass('btn-info btn-success');
			});
	});
	$(".btn-refresh-count").click(function() {
		$.get("../cron/count.php",
			function(){
				$(".btn-refresh-count").toggleClass('btn-info btn-success');
			});
	});



	$(".btn-updateb").click(function() {
		$.get("inc/update.php", { hashtag: $(this).data("id") },
			function(){
				$(".btn-updateb").addClass('btn-success');
			});
	});
	$(".btn-updatep").click(function() {
		$.get("inc/update.php", { hashtag: $(this).data("id") },
			function(){
				$(".btn-updatep").addClass('btn-success');
			});
	});
	$(".btn-updaten").click(function() {
		$.get("inc/update.php", { hashtag: $(this).data("id") },
			function(){
				$(".btn-updaten").addClass('btn-success');
			});
	});

	$(".btn-delete").click(function() {
		var returndelete = $(this).closest("tr");
		$.get("inc/delete.php", { delete: $(this).data("id") , base: $(this).data("base") },
			function(){
				returndelete.fadeOut();
			});
	});

});