$.postJSON = function(url, data, callback) {
	$.post(url, data, callback, "json");
};

$.ajaxSetup({
    crossDomain: false, // obviates need for sameOrigin test
    cache: false,
    beforeSend: function(xhr, settings) {
        if (!csrfSafeMethod(settings.type)) {
            xhr.setRequestHeader("X-CSRFToken", confAM.csrf_token);
        }
    }
});

function csrfSafeMethod(method) {
    return (/^(GET|HEAD|OPTIONS|TRACE)$/.test(method));
};

function goBack() { 
	window.history.back();
}

function setLocation(url){
    window.location.href = url;
}