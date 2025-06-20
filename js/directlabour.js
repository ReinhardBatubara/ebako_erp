/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


function directlabour_view(){
    $("#messagelistcontainer").html("<center><img style='padding-top:50px;' src='images/loading1.gif'/></center>");
    $('#messagelistcontainer').load(url+'directlabour');
}

function directlabour_search(offset){
    var description = $('#description_s').val();
    $("#groupsdata").html("<center><img style='padding-top:50px;' src='images/loading1.gif'/></center>");
    $.post(url+'directlabour/search/'+offset,{
        description: description
    },function(content){
        $('#groupsdata').empty();
        $('#groupsdata').append(content);
    });
}

function directlabour_add(){
    $('#messagelistcontainer').load(url+'directlabour/add');
}

function directlabour_insert(){
    var description = $('#description').val();
    var unitid = $('#unitid').val();
    var price = $('#price').val();
    
    var msg = "";
    if(description == ""){
        msg += "- Field 'Description' Required<br/>";
    }
    if(unitid == 0){
        msg += "- Field 'Unit' Required<br/>";
    }
    if(price == ""){
        msg += "- Field 'Price' Required<br/>";
    }
    if(msg != ""){
        display_error_message(msg);
    }else{
        $.post(url+'directlabour/save',{
            description: description,
            unitid: unitid,
            price: price
        },function(){
            directlabour_view();
        });
    }
}

function directlabour_edit(id){
    $('#messagelistcontainer').load(url+'directlabour/edit/'+id);
}

function directlabour_update(){
    var id = $('#id').val();
    var description = $('#description').val();
    var unitid = $('#unitid').val();
    var price = $('#price').val();
    
    var msg = "";
    if(description == ""){
        msg += "- Field 'Description' Required<br/>";
    }
    if(unitid == 0){
        msg += "- Field 'Unit' Required<br/>";
    }
    if(price == ""){
        msg += "- Field 'Price' Required<br/>";
    }
    if(msg != ""){
        display_error_message(msg);
    }else{
        $.post(url+'directlabour/update',{
            id: id,
            description: description,
            unitid: unitid,
            price: price
        },function(){
            directlabour_view();
        });
    }
}

function directlabour_delete(id){
    if(confirm('Sure?')){
        $.get(url+'directlabour/delete/'+id,function(){
            directlabour_view();
        });    
    }
}