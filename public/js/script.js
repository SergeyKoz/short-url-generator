function setCustomUrlGeneration()
{
    if ($('input[name="isCustom"]').is(':checked')) {
        $("#custom-url-form-group").show();
    } else {
        $("#custom-url-form-group").hide();
    }
}

$(document).ready(function() {
    setCustomUrlGeneration();
});
