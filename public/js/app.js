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

    var template = new Template();

    $("form.lesson-form-ajax").on("submit", function(e){
        e.preventDefault();
        var varningText = $('.warning-text');
        var listLesson = $('.list-lessons');
        let data = {};
        $(this).serializeArray().forEach((object)=>{
            data[object.name] = object.value;
        });
        var url = $(this).attr('data-url');
        $.ajax({
            type: "post",
            url: url,
            data: data,
            success: function(data)
            {
                varningText.css('display', 'none');
                listLesson.append(template.lesson(data.name, "/edit-lesson/" + data.id))
                $('#lessons').find('input[type=text]').val('')
            }
        });

    })
});
