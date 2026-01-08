jQuery(document).ready(function($){
			
			function resizeIframe(obj) {
						//obj.style.height = obj.contentDocument.documentElement.scrollHeight + 'px';
						obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px';
			}			

			
			$("iframe").load(function() {
						resizeIframe(this);
			});
			
			$(".class_summary").click(function() {
						$(".class_update").hide();
						$(".class_summary").show();
						$(this).hide('fast');
						$(this).next('.class_update').show('fast');
						$('#viewport').height(parseInt($('#viewport').height()) + 300 + 'px');
			});

			$(".class_summary2").click(function() {
						$(".class_update").hide();
						$(".class_summary").show();
						$(this).hide('fast');
						$(this).next('.class_update').show('fast');
						$('#viewport').height(parseInt($('#viewport').height()) + 600 + 'px');
			});
			
});