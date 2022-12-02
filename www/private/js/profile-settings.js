function geoSetup(){
    let select = document.getElementById("select-geo").value
    switch (parseInt(select)){
        case 1:
            document.getElementById("text-input").disabled = true;
            document.getElementById("text-input").style = 'opacity: 0.5;';
            break;
        case 2:
            document.getElementById("submit-geo").enabled = true;
            document.getElementById("text-input").disabled = false;
            document.getElementById("text-input").style = 'opacity: 1;';
            break;
        default:
            return;
    }
}
function themeSetup(){
    let select = document.getElementById("select-theme").value
    switch (parseInt(select)){
        case 1:
            document.getElementById("body").style = 'background-image: linear-gradient(to right, #0acffe 0%, #495aff 100%);';
            break;
        case 2:
            document.getElementById("body").style = 'background-image: linear-gradient(to right, #f5f5f5 0%, rgb(254, 148, 10) 100%);';
            break;
        default:
            return;
    }
}
themeSetup()
geoSetup()