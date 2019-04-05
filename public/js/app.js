class Template{
    lesson(name, href){
        return " <div class=\"row mb-5\">\n" +
            "<div class=\"col-md-10\">"+name+"</div>\n" +
            "<div class=\"col-md-2\">\n" +
            "<a href="+href+">\n" +
            "<i class=\"ti-pencil\"></i>\n" +
            "</a>\n" +
            "</div>\n" +
            "</div>"
    }
}

$(document).ready(function() {
    var varningText = $('.warning-text');
    var listLesson = $('.list-lessons');
    var template = new Template();

    $('#lessons').submit(function (e) {
        e.preventDefault();
        var form = $(this);
        var url = form.attr('action');
        $.ajax({
            type: "post",
            url: url,
            data: form.serialize(),
            success: function(data)
            {
                varningText.css('display', 'none');
                listLesson.append(template.lesson(data.name, "/edit-lesson/" + data.id))
                $('#lessons').find('input[type=text]').val('')
            }
        });
    })
});
