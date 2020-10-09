
function save(){
    var data = $('#addsection_form').serialize();
    console.log(data);
    $.ajax({
        url: addurl,
        data: data,
       
        type: 'POST',
   
        success: function (response) {
            console.log(response);
            data=response.data;
            template="";
            if(data.type==0){

                template=  $("#semi").html();
            }else{
                template=  $("#full").html();

            }

            template=template.replace('{id}',data.id);
            template=template.replace('{id}',data.id);
            template=template.replace('{w}',types[data.type]);
            template=template.replace('{id}',data.id);
            template=template.replace('{id}',data.id);
            template=template.replace('{id}',data.id);
            template=template.replace('{id}',data.id);
            template=template.replace('{id}',data.id);
            template=template.replace('{id}',data.id);
            template=template.replace('{id}',data.id);
            template=template.replace('{parent_id}',data.parent_id);
            template=template.replace('{row}',data.row);
            template=template.replace('{order}',data.order);
            template=template.replace('{name}',data.name);
            murl=manageurl.replace('_s_',data.id);
            template=template.replace('{m}',murl);


            if(data.parent_id==0){
                $('#root').append(template);
            }else{
                $('#section'+data.parent_id).append(template);
            }
            console.log(template);
            $('#addsection_form')[0].reset();
            $('#addsection').modal('hide')
        }
    });
}


function del(id){
    url=delurl.replace('_s_',id);
    console.log(url);
    $.ajax({
        url: url,
      
        type: 'GET',
   
        success: function (response) {
            console.log(response);
            $('#s_'+id).remove();
        }
    });
}

function saveedit(){
    var data = $('#editsection_form').serialize();
 

    console.log(data);
    $.ajax({
        url: editurl,
        data: data,
       
        type: 'POST',
   
        success: function (response) {
            console.log(response);
            $('#sec_'+response.id+'_name').text(response.name);
            $('#sec_'+response.id+'_order').text(response.order);
            $('#sec_'+response.id+'_row').text(response.row);
            $('#editsection_form')[0].reset();
            $('#editsection').modal('hide');  
        }
    });
}