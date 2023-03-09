var counter = 1;
var survey_options = document.getElementById('inputImage')
function add_more_field(){
    counter++;
    html='<div class="media my-4" id="foto-input-'+counter+'">\
        <div class="col-sm-3 border-0" id="row">\
            <img src="/img/default.jpg" id="img" class="img-thumbnail col-sm-12 p-0 sebelum-preview'+counter+' rounded" alt="Generic placeholder image">\
        </div>\
        <div class="media-body mx-3">\
            <div class="d-flex justify-content-between">\
                <h5 class="text-gray-900 font-weight-bold align-middle my-3">Gambar '+counter+'.</h5>\
                    <input type="image" multiple class="btn" id="foto_sebelum1" name="foto_sebelum'+counter+'[]" onchange="preview_sebelum()">\
                    <div class="invalid-feedback">\
                        \
                    </div>\
                <button type="button" id="remove" onclick="$(\'#foto-input-'+counter+'\').remove();" data-id="'+counter+'" class="btn btn-outline-danger rounded-circle h-25 mt-2 mr-3 delete-record"><i class="fas fa-times"></i></button>\
            </div>\
            <textarea class="form-control mt-2 rounded bg-light" rows="6" id="ket_foto" placeholder="Keterangan Foto '+counter+'" name="ket_foto'+counter+'[]"></textarea>\
        </div>\
    </div>'
    var form = document.getElementById('inputImage')
    form.innerHTML+=html
}

// $('#inputImage').on('click', '.delete-record', function(){
//     let id = $(this).attr('data-id')
//     $('#foto-input-'+id).remove()
// })


// function remove_field(){
//     let id = $("button#remove").attr('data-id')
//     $('#foto-input-'+id).remove()
//     alert(id);
//     // $(this).closest.remove();
//     // var input_tags = survey_options.getElementsByTagName('div')
//     // survey_options.removeChild(input_tags[(input_tags.length) - 1]);

// }

//  remove_field.onclick = function(){
//     var input_tags = inputImage.getElementByTagName('input');
//     if(input_tags.length > 2){
//         inputImage.removeChild(input_tags[(input_tags.length) - 1]);
//     }

// }

/* <script language="Javascript">
    function add(type) {

        //Create an input type dynamically.
        var elementHeading = document.createElement("h5");
        var elementInput = document.createElement("input");
        var elementLabel = document.createElement("label");
        var elementImg = document.createElement("img");
        var elementTextarea = document.createElement("textarea");

        //Assign INPUT to the element.
        elementHeading.setAttribute("value", "Foto 2");
        elementHeading.setAttribute("class", "text-gray-900 text-center my-4 font-weight-bold");

        //Assign INPUT to the element.
        elementInput.setAttribute("type", type);
        elementInput.setAttribute("name", "foto_sebelum");
        elementInput.setAttribute("id", "foto_sebelum");
        elementInput.setAttribute("class", "custom-file-input");
        elementInput.setAttribute("value", "<?= old('foto_sebelum'); ?>");
        elementInput.setAttribute("onchange", "preview_sebelum()");

        //Assign LABEL to the element.
        elementLabel.setAttribute("class", "custom-file-label");
        elementLabel.setAttribute("for", "foto_sebelum");
        elementLabel.setAttribute("id", "label_sebelum");

        //Assign LABEL to the element.
        elementImg.setAttribute("class", "img-thumbnail col-sm-12 mx-auto d-block my-4 p-0 sebelum-preview");
        elementImg.setAttribute("src", "/img/default.jpg");
        elementImg.setAttribute("id", "foto_sebelum");

        //Assign LABEL to the element.
        elementTextarea.setAttribute("placeholder", "Keterangan Foto 2");
        elementTextarea.setAttribute("class", "form-control");
        elementTextarea.setAttribute("rows", "3");
        elementTextarea.setAttribute("id", "ket_foto2");

        var head = document.getElementById("title");
        var foo = document.getElementById("fooBar");
        var gambar = document.getElementById("previewImg");
        var ket = document.getElementById("ketImg");

        //Append the element in page (in span/div).
        foo.appendChild(elementInput);
        foo.appendChild(elementLabel);
        gambar.appendChild(elementImg);
        head.appendChild(elementHeading);
        ket.appendChild(elementTextarea);

    }
</script> */