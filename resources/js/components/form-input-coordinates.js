// to do list 
var coors = [];

var currentCoor = {
    long: "",
    lang: "",
    desk: "",
    id: 0
}


$('#coordinates-long').on('input',function(e){
    currentCoor.long = e.target.value;
});
$('#coordinates-lang').on('input',function(e){
    currentCoor.lang = e.target.value;
});
$('#coordinates-desk').on('input',function(e){
    currentCoor.desk = $.sanitize(e.target.value);
    console.log(currentCoor.desk);
});

function DrawCoor(coor) {
    var newCoorHTML = `
    <div class="pb-3 coor-item" coor-id="${coor.id}">
        <div class="input-group">
            <input type="text" readonly class="form-control" name="coordinates[${coor.id}][long][]" value="${coor.long}">
            <input type="text" readonly class="form-control" name="coordinates[${coor.id}][lang][]" value="${coor.lang}">
            <input type="text" readonly class="form-control" name="coordinates[${coor.id}][desk][]" value="${coor.desk}">
            
            <button coor-id="${coor.id}" class="btn btn-outline-secondary bg-danger text-white" type="button" onclick="DeleteCoor(this);" id="button-addon2 ">X</button>
            
        </div>
    </div>
      `;
    var newCoor = $.parseHTML(newCoorHTML);
    $("#coor-container").append(newCoor);
}

function RenderAllCoors() {
    var container = document.getElementById("coor-container");

    if(container){
        while (container.firstChild) {
            container.removeChild(container.firstChild);
        }
    
        for (var i = 0; i < coors.length; i++) {
            DrawCoor(coors[i]);
        }
    }

}
RenderAllCoors();

function DeleteCoor(button) {
    var deleteID = parseInt($(button).attr("coor-id"));

    for (let i = 0; i < coors.length; i++) {
        if (coors[i].id === deleteID) {
            coors.splice(i, 1);
            RenderAllCoors();
            break;
        }
    }

    var $old_item = $(`.coor-item[coor-id=${deleteID}]`);
    if($old_item){
        $old_item.remove();
    }
}


function CreateCoor() {
    newcoor = {
        long: currentCoor.long,
        lang: currentCoor.lang,
        desk: currentCoor.desk,
        id: Math.floor(Math.random() * 10000000000)
    }
    coors.push(newcoor);
    RenderAllCoors();
}



$.sanitize = function(input) {
    var output = input.replace(/<script[^>]*?>.*?<\/script>/gi, '').
                 replace(/<[\/\!]*?[^<>]*?>/gi, '').
                 replace(/<style[^>]*?>.*?<\/style>/gi, '').
                 replace(/<![\s\S]*?--[ \t\n\r]*>/gi, '').
                 replace(/"/g, '').
       replace(/&nbsp;/g, '');
    return output;
};


export {CreateCoor, DeleteCoor};













