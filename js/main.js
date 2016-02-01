$(document).ready(function() {

	$("#form").on("submit", function (e) {
    e.preventDefault();

		$(".error").remove();
		$(".alert").remove();

		var className = $("#form").find("#class-name");
		var superClass = $("#form").find("#superclass");
		var classInterface = $("#form").find("#interface");
		var classAttributes = $("#form").find("#class-attributes");
		var isAbstract = 0;

		if($("#abstract").is(':checked')) { isAbstract = 1; }
		else { isAbstract = 0; }

		var valid = false;

		var error = "<div class='alert alert-danger'>You have to enter class name AND class attributes.</div>";

		if(className.val() === "") {
			$("#form").prepend(error);
			className.focus();
		}
		else if(classAttributes.val() === "") {
			$("#form").prepend(error);
			classAttributes.focus();
		}
		else {
			valid = true;
		}

		if (valid === true) {

			var request = $.ajax({
		      method: "POST",
			    url:"main.php",
			    data: {className: className.val(), superClass: superClass.val(), classInterface: classInterface.val(), isAbstract: isAbstract, classAttributes: classAttributes.val().split(",")},
			    success: function(response) {

						var text = response;
						var alert = "<div class='alert alert-success'>Your class file was successfully saved in 'php-classes' folder.</div>";

						$("#source-code").children().children().html(text);
						$("#source-code").prepend(alert);

						Prism.highlightAll(true, function() {});

		   		}
			});
		}
	});
});
