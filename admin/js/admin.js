var admin = {

	init: function() {

		$('#btn-sidebar-collapse').unbind('click').click(function() {
			if ($(this).hasClass('collapsed')) {
				$('#sidebar-left').show();
				$(this).removeClass('collapsed');
				$('span.glyphicon', $(this)).removeClass('glyphicon-chevron-right').addClass('glyphicon-chevron-left');
				$('.main').removeClass('col-md-12').addClass('col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2');
			} else {
				$('#sidebar-left').hide();
				$(this).addClass('collapsed');
				$('span.glyphicon', $(this)).removeClass('glyphicon-chevron-left').addClass('glyphicon-chevron-right');
				$('.main').removeClass('col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2').addClass('col-md-12');
			}
		});

	}
};